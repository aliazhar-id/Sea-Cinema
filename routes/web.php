<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardScheduleController;
use App\Http\Controllers\DashboardUpcomingController;

// MAIN PAGE
Route::name('main.')->group(function () {
  Route::get('/', [MovieController::class, 'index'])->name('home');
  Route::get('/movies', [MovieController::class, 'movies'])->name('movies');
  Route::get('/movie/{id}', [MovieController::class, 'movieDetails']);
  Route::get('/booking/{id}', [MovieController::class, 'booking']);
  Route::get('/schedule', [MovieController::class, 'schedule'])->name('schedule');
  Route::get('/upcoming', [MovieController::class, 'upcoming'])->name('upcoming');
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
  Route::get('dashboard/upcoming', [DashboardUpcomingController::class, 'index'])->name('upcoming.index')->middleware('admin');
  Route::get('dashboard/upcoming/create', [DashboardUpcomingController::class, 'create'])->name('upcoming.create')->middleware('admin');
  Route::post('dashboard/upcoming', [DashboardUpcomingController::class, 'store'])->name('upcoming.store')->middleware('admin');

  // SCHEDULE
  Route::get('dashboard/schedule', [DashboardScheduleController::class, 'index'])->name('schedule.index')->middleware('admin');
  Route::get('dashboard/schedule/create', [DashboardScheduleController::class, 'create'])->name('schedule.create')->middleware('admin');
  Route::post('dashboard/schedule', [DashboardScheduleController::class, 'store'])->name('schedule.store')->middleware('admin');
});

// PROFILE
Route::get('/profile', function () {
  return view('profile');
});

Route::resource('dashboard/profile', UserController::class)->parameters(['profile' => 'user'])->only(['index', 'update'])->middleware('admin');
Route::resource('dashboard/users', AdminUserController::class, ['as' => 'dashboard'])->middleware('admin');

// Route::resource('/dashboard/posts', UserPostController::class)->middleware('auth');
