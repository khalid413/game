<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GameController::class, 'home'])->name('home');

Route::resource('teams', TeamController::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
]);

Route::resource('questions', QuestionController::class)->only([
    'index', 'create', 'store'
]);

Route::get('/play', [GameController::class, 'selectTeam'])->name('game.selectTeam');
Route::post('/play/start', [GameController::class, 'start'])->name('game.start');
Route::get('/play/{team}/{question}', [GameController::class, 'showQuestion'])->name('game.question');
Route::post('/play/{team}/{question}', [GameController::class, 'submitAnswer'])->name('game.submit');

Route::get('/results', [ResultController::class, 'index'])->name('results.index');
Route::get('/results/{team}', [ResultController::class, 'show'])->name('results.show');