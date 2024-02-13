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
    return view('dashboard.main.dashboard', [
      'title' => 'Dashboard',
      'upcomings' => Upcoming::all(),
      'schedules' => DetailSchedule::all(),
      'users' => User::all(),
    ]);
  }

  public function search(Request $request)
  {
    $baseURL = env('MOVIE_DB_BASE_URL');
    $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
    $apiKey = env('MOVIE_DB_API_KEY');

    $searchKeyword = $request['query'];

    $movies = [];

    // Do request api to get movie by filter
    $movieResponse = Http::get("{$baseURL}/search/movie", [
      'api_key' => $apiKey,
      'page' => 1,
      'query' => $searchKeyword
    ]);

    if ($movieResponse->successful()) {
      $result = $movieResponse->object()->results;

      if (isset($result)) $movies = $result;
    }


    return view('dashboard.index', [
      'title' => 'Dashboard',
      'imageBaseURL' => $imageBaseURL,
      'movies' => $movies
    ]);
  }
}
