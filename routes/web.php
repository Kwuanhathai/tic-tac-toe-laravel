<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/login/google', [GoogleController::class, 'redirect'])->name('login.google');
Route::get('/login/google/callback', [GoogleController::class, 'callback']);

Route::middleware('auth')->group(function () {
    Route::get('/game', [GameController::class, 'index']);
    Route::post('/game/play', [GameController::class, 'play']);
    Route::post('/game/score', [GameController::class, 'updateScore']);
    Route::get('/scoreboard', [ScoreController::class, 'index']);
});
