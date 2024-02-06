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
        // $topMovieResponse = Http::get("{$baseURL}/movie/popular", [
        //     'api_key' => $apiKey,
        //     'append_to_response' => 'videos'
        // ]);    
        // dd($topMovieResponse->json());
        for($x=0; $x <= 5; $x++){
            $topMovieResponse = Http::get("{$baseURL}/movie/popular?page={$x}", [
                'api_key' => $apiKey,
                'append_to_response' => 'videos'
            ]);    
            if ($topMovieResponse->successful()) {
                $result = $topMovieResponse->object()->results;
                $movies = $topMovieResponse->json();
                $randomNumber = random_int(50000, 600000);
    
                foreach($movies['results'] as $movie) {
                    Movies::create([
                        'id_movie' => $movie['id'],
                        'poster_path' => $movie['poster_path'],
                        'trailer_id' => $movie['id'],
                        'title' => $movie['original_title'],
                        'overview' => $movie['overview'],
                        'rating' => $movie['vote_average'],
                        'release_date' => $movie['release_date'],
                    ]);
                };
                if (isset($result)) $topMovies = array_slice($result, 0, 10);
            }
        }
        
    }
}
