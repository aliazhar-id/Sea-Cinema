<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Upcoming;
use Illuminate\Http\Request;
use App\Models\DetailSchedule;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
  public function index()
  {
    return view('dashboard.page.dashboard', [
      'title' => 'Dashboard',
      'upcomings' => Upcoming::all(),
      'schedules' => DetailSchedule::all(),
      'users' => User::all(),
    ]);
  }
}
