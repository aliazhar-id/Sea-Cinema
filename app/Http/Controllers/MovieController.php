<?php

namespace App\Http\Controllers;

use App\Models\Schedules;
use App\Models\Upcoming;
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


    return view('movies.home', [
      'title' => 'Home',
      'baseURL' => $baseURL,
      'imageBaseURL' => $imageBaseURL,
      'apiKey' => $apiKey,
      'trending' => $trending,
      'topMovies' => $topMovies,
      'topTvShows' => $topTvShows
    ]);
  }

  public function movies()
  {
    $baseURL = env('MOVIE_DB_BASE_URL');
    $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
    $apiKey = env('MOVIE_DB_API_KEY');

    $movies = [];
    $sortBy = 'popularity.desc';
    $page = 1;
    $minimalVoter = 100;

    // Do request api to get movie by filter
    $movieResponse = Http::get("{$baseURL}/discover/movie", [
      'api_key' => $apiKey,
      'sort_by' => $sortBy,
      'vote_count.gte' => $minimalVoter,
      'page' => $page
    ]);

    if ($movieResponse->successful()) {
      $result = $movieResponse->object()->results;

      if (isset($result)) $movies = $result;
    }

    // return json_decode($movieResponse);

    return view('movies.movie', [
      'title' => 'Movies',
      'baseURL' => $baseURL,
      'imageBaseURL' => $imageBaseURL,
      'apiKey' => $apiKey,
      'movies' => $movies,
      'sortBy' => $sortBy,
      'minimalVoter' => $minimalVoter,
      'page' => $page
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
    $movieResponse = Http::get("{$baseURL}/search/multi?page=1&api_key={$apiKey}&query={$searchKeyword}", [
      'api_key' => $apiKey,
      'page' => 1
    ]);

    if ($movieResponse->successful()) {
      $result = $movieResponse->object()->results;

      if (isset($result)) $movies = $result;
    }

    return view('movies.search', [
      'title' => 'Search',
      'imageBaseURL' => $imageBaseURL,
      'apiKey' => $apiKey,
    ]);
  }

  public function movieDetails($id)
  {
    $baseURL = env('MOVIE_DB_BASE_URL');
    $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
    $apiKey = env('MOVIE_DB_API_KEY');

    $movieData = null;

    $movieDetailResponse = Http::get("{$baseURL}/movie/{$id}", [
      'api_key' => $apiKey,
      'append_to_response' => 'videos'
    ]);

    if ($movieDetailResponse->successful()) {
      $movieData = $movieDetailResponse->object();
    }

    return view('movies.movie-details', [
      'baseURL' => $baseURL,
      'imageBaseURL' => $imageBaseURL,
      'apiKey' => $apiKey,
      'movieData' => $movieData
    ]);
  }

  public function schedule() {
    $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');

    return view('movies.schedule', [
      'title' => 'Shcedule',
      'movies' => Schedules::latest()->get(),
      'imageBaseURL' => $imageBaseURL
    ]);
  }

  public function upcoming() {
    $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');

    return view('movies.upcoming', [
      'title' => 'Upcoming',
      'movies' => Upcoming::latest()->get(),
      'imageBaseURL' => $imageBaseURL
    ]);
  }
}
