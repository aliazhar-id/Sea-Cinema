<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardUpcomingController extends Controller
{
  public function index()
  {
    return view('dashboard.main.upcoming', [
      'title' => 'Upcomming',
      'movies' => Movies::doesntHave('schedules')->get()
    ]);
  }

  public function create()
  {

    $baseURL = env('MOVIE_DB_BASE_URL');
    $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
    $apiKey = env('MOVIE_DB_API_KEY');

    $searchKeyword = request('search');

    $movies = ['Not Found'];

    if ($searchKeyword) {

      // Do request api to get movie by filter
      $movieResponse = Http::get("{$baseURL}/search/movie", [
        'query' => $searchKeyword,
        'api_key' => $apiKey,
        'page' => 1
      ]);

      if ($movieResponse->successful()) {
        $result = $movieResponse->object()->results;

        if (isset($result)) {
          $movies = $result;
        } else {
          $movies = $result;
        }; 

      }
    }

    return view('dashboard.main.upcoming-create', [
      'title' => 'Create Upcoming',
      'movies' => $movies,
      'imageBaseURL' => $imageBaseURL
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
