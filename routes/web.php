<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RegisterController;

// MAIN PAGE
Route::name('main.')->group(function () {
  Route::get('/', [MovieController::class, 'index'])->name('home');
  Route::get('/movies', [MovieController::class, 'movies'])->name('movies');
  Route::get('/movie/{id}', [MovieController::class, 'movieDetails']);
  Route::get('/schedule', [MovieController::class, 'schedule'])->name('schedule');
});


// AUTH PAGE
Route::name('auth.')->group(function () {
  Route::get('/auth/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
  Route::post('/auth/login', [LoginController::class, 'login'])->name('actionLogin')->middleware('guest');
  Route::get('/auth/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
  Route::post('/auth/register', [RegisterController::class, 'register'])->name('actionRegister')->middleware('guest');
  Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
});
