<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RegisterController;

// MAIN PAGE
Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('/movies', [MovieController::class, 'movies']);
Route::get('/search', [MovieController::class, 'search']);
Route::get('/movie/{id}', [MovieController::class, 'movieDetails']);
Route::get('/schedule', [MovieController::class, 'schedule'])->name('schedule');

// AUTH PAGE
Route::get('/auth/login', [LoginController::class, 'index'])->name('auth.login')->middleware('guest');
Route::post('/auth/login', [LoginController::class, 'login'])->name('auth.actionLogin')->middleware('guest');
Route::get('/auth/register', [RegisterController::class, 'index'])->name('auth.register')->middleware('guest');
Route::post('/auth/register', [RegisterController::class, 'register'])->name('auth.actionRegister')->middleware('guest');
Route::get('/auth/logout', [LoginController::class, 'logout'])->name('auth.logout')->middleware('auth');
