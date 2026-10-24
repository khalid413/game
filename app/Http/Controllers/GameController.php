<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Team;
use App\Models\TeamAnswer;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function selectTeam()
    {
        $teams = Team::all();
        return view('game.select-team', compact('teams'));
    }

    public function start(Request $request)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);

        $team = Team::findOrFail($request->team_id);

        $answeredQuestionIds = TeamAnswer::where('team_id', $team->id)
            ->pluck('question_id');

        $totalQuestions = Question::count();
        $answeredCount  = $answeredQuestionIds->count();

        // ── All questions already answered → results ──────────────────────
        if ($totalQuestions > 0 && $answeredCount >= $totalQuestions) {
            return redirect()->route('results.show', $team->id);
        }

        $randomQuestion = Question::whereNotIn('id', $answeredQuestionIds)
            ->inRandomOrder()
            ->first();

        // ── No questions exist at all ─────────────────────────────────────
        if (!$randomQuestion) {
            return redirect()->route('results.show', $team->id);
        }

        return redirect()->route('game.question', [$team->id, $randomQuestion->id]);
    }

    public function showQuestion(Team $team, Question $question)
    {
        $answeredQuestionIds = TeamAnswer::where('team_id', $team->id)
            ->pluck('question_id');

        $totalQuestions = Question::count();
        $answeredCount  = $answeredQuestionIds->count();

        // ── Team finished all questions ───────────────────────────────────
        if ($totalQuestions > 0 && $answeredCount >= $totalQuestions) {
            return redirect()->route('results.show', $team->id);
        }

        // ── This specific question was already answered ────────────────────
        if ($answeredQuestionIds->contains($question->id)) {
            $randomNextQuestion = Question::whereNotIn('id', $answeredQuestionIds)
                ->inRandomOrder()
                ->first();

            if (!$randomNextQuestion) {
                return redirect()->route('results.show', $team->id);
            }

            return redirect()->route('game.question', [$team->id, $randomNextQuestion->id])
                ->with('error', 'تمت الإجابة على هذا السؤال من قبل.');
        }

        $question->load('answers');
        $questionIndex = $answeredCount + 1;

        return response()
            ->view('game.question', compact('team', 'question', 'totalQuestions', 'questionIndex'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
    }

public function submitAnswer(Request $request, Team $team, Question $question)
{
    // If time ended and no answer was selected:
    // no point, no TeamAnswer saved, go to next question
    if (!$request->filled('answer_id')) {
        $answeredQuestionIds = TeamAnswer::where('team_id', $team->id)
            ->pluck('question_id');

        $totalQuestions = Question::count();

        // if all questions already answered, go to results
        if ($answeredQuestionIds->count() >= $totalQuestions) {
            return redirect()->route('results.show', $team->id);
        }

        // get another unanswered question
        $randomNextQuestion = Question::whereNotIn('id', $answeredQuestionIds)
            ->where('id', '!=', $question->id)
            ->inRandomOrder()
            ->first();

        // if no other question exists, go to results
        if (!$randomNextQuestion) {
            return redirect()->route('results.show', $team->id);
        }

        return redirect()->route('game.question', [$team->id, $randomNextQuestion->id])
            ->with('error', 'انتهى الوقت، لم يتم احتساب أي نقطة.');
    }

    $request->validate([
        'answer_id' => 'required|exists:answers,id',
    ]);

    // already answered guard
    $alreadyAnswered = TeamAnswer::where('team_id', $team->id)
        ->where('question_id', $question->id)
        ->exists();

    if ($alreadyAnswered) {
        $answeredQuestionIds = TeamAnswer::where('team_id', $team->id)
            ->pluck('question_id');

        $randomNextQuestion = Question::whereNotIn('id', $answeredQuestionIds)
            ->inRandomOrder()
            ->first();

        if (!$randomNextQuestion) {
            return redirect()->route('results.show', $team->id);
        }

        return redirect()->route('game.question', [$team->id, $randomNextQuestion->id])
            ->with('error', 'لا يمكن تغيير الإجابة بعد حفظها.');
    }

    // save the answer only if one was selected
    $answer = Answer::where('id', $request->answer_id)
        ->where('question_id', $question->id)
        ->firstOrFail();

    TeamAnswer::create([
        'team_id'     => $team->id,
        'question_id' => $question->id,
        'answer_id'   => $answer->id,
        'is_correct'  => $answer->is_correct,
    ]);

    $answeredQuestionIds = TeamAnswer::where('team_id', $team->id)
        ->pluck('question_id');

    $totalQuestions = Question::count();

    if ($answeredQuestionIds->count() >= $totalQuestions) {
        return redirect()->route('results.show', $team->id);
    }

    $randomNextQuestion = Question::whereNotIn('id', $answeredQuestionIds)
        ->inRandomOrder()
        ->first();

    if (!$randomNextQuestion) {
        return redirect()->route('results.show', $team->id);
    }

    return redirect()->route('game.question', [$team->id, $randomNextQuestion->id]);
}
}