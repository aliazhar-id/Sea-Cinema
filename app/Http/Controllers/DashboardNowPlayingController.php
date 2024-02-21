<?php

namespace App\Http\Controllers;

use App\Models\NowPlayingSchedule;
use App\Models\NowPlaying;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardNowPlayingController extends Controller
{
  public function index()
  {
    return view('dashboard.page.main.now-playing.index', [
      'title' => 'Now Playing',
      'schedules' => NowPlayingSchedule::latest()->get()
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

    return view('dashboard.page.main.now-playing.create', [
      'title' => 'Create Now Playing',
      'movies' => $movies,
      'status' => $status,
      'imageBaseURL' => $imageBaseURL
    ]);
  }

  public function store(Request $request)
  {
    $datetimes = $request->datetime;
    $prices = $request->price;

    $baseURL = env('MOVIE_DB_BASE_URL');
    $apiKey = env('MOVIE_DB_API_KEY');

    $movie = null;
    $movieId = $request['id-movie'];
    $trailerID = null;

    $movieDetailResponse = Http::get("{$baseURL}/movie/{$movieId}", [
      'api_key' => $apiKey,
      'append_to_response' => 'videos'
    ]);

    if ($movieDetailResponse->successful()) {
      $movie = $movieDetailResponse->object();
    }

    if (isset($movie->videos->results)) {
      foreach ($movie->videos->results as $videos) {
        if (strtolower($videos->type) == 'trailer') {
          $trailerID = $videos->key;
        }
      }
    }

    NowPlaying::updateOrCreate(
      ['id_movie' => $movieId],
      [
        'poster_path' => $movie->poster_path,
        'trailer_id' => $trailerID,
        'title' => $movie->title,
        'tagline' => $movie->tagline,
        'overview' => $movie->overview,
        // 'rating' => $movie->rating,
        'score' => $movie->vote_average,
        'release_date' => $movie->release_date ?: null,
      ]
    );

    $newSchedules = [];

    foreach ($datetimes as $key => $datetime) {
      $dateISO = strtotime($datetime);

      $date = date('Y-m-d', $dateISO);
      $time = date('H:i', $dateISO);

      $newSchedules[$key] = [
        'id_movie' => $movieId,
        'date' => $date,
        'start_at' => $time,
        'studio' => 'Sea 1',
        'price' => $prices[$key]
      ];
    }

    NowPlayingSchedule::upsert($newSchedules, ['date', 'start_at']);

    return back();
  }

  public function update(Request $request)
  {
    $validatedData = $request->validate([
      'id-schedule' => 'required|exists:detail_schedules,id_schedule',
      'datetime' => 'required',
      'price' => 'required|numeric|min:0',
    ]);

    $id_schedule = $validatedData['id-schedule'];
    $datetime = $validatedData['datetime'];
    $price = $validatedData['price'];

    $dateISO = strtotime($datetime);
    $date = date('Y-m-d', $dateISO);
    $time = date('H:i', $dateISO);

    NowPlayingSchedule::find($id_schedule)->update([
      'date' => $date,
      'start_at' => $time,
      'price' => $price,
    ]);

    return back()->with('success', 'Schedule has been updated');
  }

  public function destroy(Request $request)
  {
    $validatedData = $request->validate([
      'id-schedule' => 'required|exists:detail_schedules,id_schedule',
    ]);

    NowPlayingSchedule::destroy($validatedData['id-schedule']);
    return back()->with('success', 'Schedule has been deleted successfully.');
  }
}
