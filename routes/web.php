<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\VotesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/** Project Routes */
Route::resource('/questions',QuestionsController::class)->except('show');
Route::get('/questions/{slug}',[QuestionsController::class,'show'])->name('questions.show');
Route::resource('questions.answers',\App\Http\Controllers\AnswersController::class)->except('create');
Route::put('questions/{question}/answers/{answer}/markAsBest',[AnswersController::class,'markAsBest'])->name('questions.answers.markAsBest');
Route::post('/questions/{question}/mark-as-fav',[FavoritesController::class,'store'])->name('questions.favorite');

Route::delete('/questions/{question}/mark-as-unfav',[FavoritesController::class,'destroy'])->name('questions.unfavorite');
Route::post('/questions/{question}/vote/{vote}',[VotesController::class,'voteQuestion'])->name('questions.vote');
