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

    return view('dashboard.main.upcoming-create', [
      'title' => 'Create Upcoming',
      'movies' => $movies,
      'status' => $status,
      'imageBaseURL' => $imageBaseURL
    ]);
  }

  public function store(Request $request)
  {
    $baseURL = env('MOVIE_DB_BASE_URL');
    $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
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

    Movies::create([
      'id_movie' => $movieId,
      'image_path' => $movieData->poster_path,
      'trailer_id' => $trailerID,
      'title' => $movieData->title,
      'release_date' => $movieData->release_date,
      'rating' => $movieData->vote_average * 10
    ]);

    return view('dashboard.main.schedule', [
      'title' => 'Schedule',
      'movies' => Movies::latest()->get(),
    ]);
  }
}
