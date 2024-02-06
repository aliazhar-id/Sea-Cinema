<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Movies;
class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');

        // Do request api to get top movies [10]

        for($x=0; $x <= 5; $x++){
            $topMovieResponse = Http::get("{$baseURL}/movie/popular?page={$x}", [
                'api_key' => $apiKey,
            ]);    
        }
        $topMovieResponse = Http::get("{$baseURL}/movie/popular?page=$", [
        'api_key' => $apiKey,
        ]);
        // dd($topMovieResponse->json());

        if ($topMovieResponse->successful()) {
            $result = $topMovieResponse->object()->results;
            $movies = $topMovieResponse->json();
            $randomNumber = random_int(50000, 600000);

            foreach($movies['results'] as $movie) {
                Movies::create([
                    'id_movie' => $movie['id'],
                    'image_path' => $movie['poster_path'],
                    'trailer_id' => $movie['id'],
                    'title' => $movie['original_title'],
                    'rating' => $movie['vote_average'],
                    'release_date' => $movie['release_date'],
                    'price' => $randomNumber,
                ]);
            };
            if (isset($result)) $topMovies = array_slice($result, 0, 10);
        }
    }
}
