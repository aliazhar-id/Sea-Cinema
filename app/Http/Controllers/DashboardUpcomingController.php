<?php

namespace App\Http\Controllers;

use App\Models\Upcoming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardUpcomingController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('dashboard.main.upcoming', [
      'title' => 'Upcomming',
      'movies' => Upcoming::latest()->filter(request(['search']))->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $baseURL = env('MOVIE_DB_BASE_URL');
    $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
    $apiKey = env('MOVIE_DB_API_KEY');
    $movies = [];

    $searchKeyword = request('search');

    if ($searchKeyword) {
      $movieResponse = Http::get("{$baseURL}/search/movie", [
        'query' => $searchKeyword,
        'api_key' => $apiKey,
        'page' => 1
      ]);

      if ($movieResponse->successful()) {
        $result = $movieResponse->object()->results;
        $movies = $result;
      }
    }

    return view('dashboard.main.upcoming-create', [
      'title' => 'Create Upcoming',
      'imageBaseURL' => $imageBaseURL,
      'movies' => $movies,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $baseURL = env('MOVIE_DB_BASE_URL');
    $apiKey = env('MOVIE_DB_API_KEY');

    $movieData = null;
    $id_movie = $request['id-movie'];
    $trailer_id = null;

    $movieDetailResponse = Http::get("{$baseURL}/movie/{$id_movie}", [
      'api_key' => $apiKey,
      'append_to_response' => 'videos'
    ]);

    if ($movieDetailResponse->successful()) {
      $movieData = $movieDetailResponse->object();
    }

    if (isset($movieData->videos->results)) {
      foreach ($movieData->videos->results as $movie) {
        if (strtolower($movie->type) == 'trailer') {
          $trailer_id = $movie->key;
        }
      }
    }

    Upcoming::create([
      'id_movie' => $id_movie,
      'poster_path' => $movieData->poster_path,
      'trailer_id' => $trailer_id,
      'title' => $movieData->title,
      'tagline' => $movieData->tagline,
      'overview' => $movieData->overview,
      'score' => $movieData->vote_average * 10,
      'release_date' => $movieData->release_date,
    ]);

    return redirect()->route('dashboard.upcoming.index')->with('success', 'Movie has been added to Upcoming!');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Upcoming $upcoming)
  {
    Upcoming::destroy($upcoming->id_movie);
    return back()->with('success', "Movie has been removed from Upcoming!");
  }
}
