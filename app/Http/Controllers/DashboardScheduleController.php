<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardScheduleController extends Controller
{
  public function index()
  {
    return view('dashboard.main.schedule', [
      'title' => 'Schedule',
      'movies' => Movies::latest()->get()
    ]);
  }

  public function create()
  {
    return view('dashboard.main.schedule-create', [
      'title' => 'Create Schedule',
    ]);
  }

  public function store()
  {
    // return view('dashboard.main.schedule', [
    //   'title' => 'Schedule',
    //   'movies' => Movies::latest()->get()
    // ]);
  }
}
