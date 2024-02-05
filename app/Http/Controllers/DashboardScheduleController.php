<?php

namespace App\Http\Controllers;

use App\Models\DetailSchedule;
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
      'schedules' => Schedules::latest()->get()
    ]);
  }

  public function create()
  {
    $baseURL = env('MOVIE_DB_BASE_URL');
    $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
    $apiKey = env('MOVIE_DB_API_KEY');

    $searchKeyword = request('search');

    $movies = [];
    $status = true;

    if ($searchKeyword) {
      // Do request api to get movie by filter
      $movieResponse = Http::get("{$baseURL}/search/movie", [
        'query' => $searchKeyword,
        'api_key' => $apiKey,
        'page' => 1
      ]);

      if ($movieResponse->successful()) {
        $result = $movieResponse->object()->results;
        $movies = $result;

        if (!$movies) {
          $status = false;
        }
      }
    }

    return view('dashboard.main.schedule-create', [
      'title' => 'Create Schedule',
      'movies' => $movies,
      'status' => $status,
      'imageBaseURL' => $imageBaseURL
    ]);
  }

  public function store(Request $request)
  {
    $baseURL = env('MOVIE_DB_BASE_URL');
    $apiKey = env('MOVIE_DB_API_KEY');

    $movieData = null;
    $movieId = $request['id-movie'];
    $trailerID = null;

    $movieDetailResponse = Http::get("{$baseURL}/movie/{$movieId}", [
      'api_key' => $apiKey,
      'append_to_response' => 'videos'
    ]);

    if ($movieDetailResponse->successful()) {
      $movieData = $movieDetailResponse->object();
    }

    if (isset($movieData->videos->results)) {
      foreach ($movieData->videos->results as $movie) {
        if (strtolower($movie->type) == 'trailer') {
          $trailerID = $movie->key;
        }
      }
    }

    // dd($movieData->release_date);

    Schedules::updateOrCreate(
      ['id_movie' => $movieId],
      [
        'poster_path' => $movieData->poster_path,
        'trailer_id' => $trailerID,
        'title' => $movieData->title,
        'release_date' => $movieData->release_date ?: null,
        'rating' => $movieData->vote_average * 10,
        'price' => $request['price']
      ]
    );

    DetailSchedule::create([
      'id_movie' => $movieId,
      'datetime' => $request['time'],
    ]);

    return back();
  }
}
