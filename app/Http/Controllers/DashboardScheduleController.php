<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use App\Models\Schedules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardScheduleController extends Controller
{
  public function index()
  {
    return view('dashboard.main.schedule', [
      'title' => 'Schedule',
      'schedules' => Schedules::orderBy('id_movie')->orderBy('created_at')->get()
    ]);
  }

  public function create()
  {
    return view('dashboard.main.schedule-create', [
      'title' => 'Create Schedule',
      'movies' => Movies::latest()->get()
    ]);
  }

  public function store(Request $request)
  {
    
    $id_movie = $request['id_movie'];
    $time = $request['time'];
    $price = $request['price'];

    Schedules::create([
      'id_movie' => $id_movie,
      'time' => $time,
      'price' => $price
    ]);

    return back();
  }
}
