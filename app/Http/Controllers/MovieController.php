<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
  public function index()
  {
    // Max movie trends to show
    $MAX_TREND = 7;
    $trending = [];
    $topMovies = [];
    $topTvShows = [];

    $baseURL = env('MOVIE_DB_BASE_URL');
    $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
    $apiKey = env('MOVIE_DB_API_KEY');

    // Do request api to get trends movie
    $trendingResponse = Http::get("{$baseURL}/trending/movie/week", [
      'api_key' => $apiKey,
    ]);

    if ($trendingResponse->successful()) {
      $result = $trendingResponse->object()->results;

      if (isset($result)) $trending = array_slice($result, 0, $MAX_TREND);
    }

    // Do request api to get top movies [10]
    $topMovieResponse = Http::get("{$baseURL}/movie/top_rated", [
      'api_key' => $apiKey,
    ]);

    if ($topMovieResponse->successful()) {
      $result = $topMovieResponse->object()->results;

      if (isset($result)) $topMovies = array_slice($result, 0, 10);
    }

    // Do request api to get top tv shows [10]
    $topTvShowResponse = Http::get("{$baseURL}/tv/top_rated", [
      'api_key' => $apiKey,
    ]);

    if ($topTvShowResponse->successful()) {
      $result = $topTvShowResponse->object()->results;

      if (isset($result)) $topTvShows = array_slice($result, 0, 10);
    }


    return view('home', [
      'baseURL' => $baseURL,
      'imageBaseURL' => $imageBaseURL,
      'apiKey' => $apiKey,
      'trending' => $trending,
      'topMovies' => $topMovies,
      'topTvShows' => $topTvShows
    ]);
  }
}
