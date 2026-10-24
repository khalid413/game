<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamAnswer;

class ResultController extends Controller
{
    public function index()
    {
        $teams = Team::withCount([
            'teamAnswers as score' => function ($query) {
                $query->where('is_correct', true);
            }
        ])->orderByDesc('score')->get();

        return view('results.index', compact('teams'));
    }

    public function show(Team $team)
    {
        $score = TeamAnswer::where('team_id', $team->id)
            ->where('is_correct', true)
            ->count();

        $totalQuestions = \App\Models\Question::count();

        return view('results.show', compact('team', 'score', 'totalQuestions'));
    }
}