<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardNowPlayingController;
use App\Http\Controllers\DashboardUpcomingController;

// MAIN PAGE
Route::name('main.')->group(function () {
  Route::get('/', [MovieController::class, 'index'])->name('home');
  Route::get('/movies', [MovieController::class, 'movies'])->name('movies');
  Route::get('/movie/{id}', [MovieController::class, 'movieDetails'])->name('movie.details');
  Route::get('/booking/{id}', [MovieController::class, 'booking']);
  Route::get('/booking/seats/{id}', [MovieController::class, 'seatsSelection'])->name('seats.selection');
  Route::get('/nowplaying', [MovieController::class, 'nowPlaying'])->name('nowplaying');
  Route::get('/upcoming', [MovieController::class, 'upcoming'])->name('upcoming');
  Route::get('/profile', [MovieController::class, 'profile'])->name('profile');
});

// AUTH PAGE
Route::name('auth.')->group(function () {
  Route::get('/auth/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
  Route::post('/auth/login', [LoginController::class, 'login'])->name('actionLogin')->middleware('guest');
  Route::get('/auth/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
  Route::post('/auth/register', [RegisterController::class, 'register'])->name('actionRegister')->middleware('guest');
  Route::get('/auth/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');
});

// DASHBOARD
Route::name('dashboard.')->group(function () {
  Route::get('dashboard', [DashboardController::class, 'index'])->name('index')->middleware('admin');
  Route::post('dashboard/search', [DashboardController::class, 'search'])->name('search')->middleware('admin');

  // UPCOMING
  Route::resource('dashboard/upcoming', DashboardUpcomingController::class)->only(['index', 'create', 'store', 'destroy'])->middleware('admin');


  // SCHEDULE
  Route::get('dashboard/nowplaying', [DashboardNowPlayingController::class, 'index'])->name('nowplaying.index')->middleware('admin');
  Route::get('dashboard/nowplaying/create', [DashboardNowPlayingController::class, 'create'])->name('nowplaying.create')->middleware('admin');
  Route::post('dashboard/nowplaying', [DashboardNowPlayingController::class, 'store'])->name('nowplaying.store')->middleware('admin');
  Route::post('dashboard/nowplaying/update', [DashboardNowPlayingController::class, 'update'])->name('nowplaying.update')->middleware('admin');
  Route::post('dashboard/nowplaying/delete', [DashboardNowPlayingController::class, 'destroy'])->name('nowplaying.destroy')->middleware('admin');
});

Route::resource('dashboard/profile', UserController::class)->parameters(['profile' => 'user'])->only(['index', 'update'])->middleware('admin');
Route::resource('dashboard/users', AdminUserController::class, ['as' => 'dashboard'])->middleware('admin');
