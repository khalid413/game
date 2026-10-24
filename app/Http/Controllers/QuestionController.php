<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('answers')->get();
        return view('questions.index', compact('questions'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array|size:4',
            'answers.*' => 'required|string',
            'correct_answer' => 'required|integer|between:0,3',
        ]);

        $question = Question::create([
            'question_text' => $request->question_text,
        ]);

        foreach ($request->answers as $index => $answerText) {
            $question->answers()->create([
                'answer_text' => $answerText,
                'is_correct' => $index == $request->correct_answer,
            ]);
        }

        return redirect()->route('questions.index')->with('success', 'Question added successfully.');
    }
}