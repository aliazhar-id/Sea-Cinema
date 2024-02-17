@extends('movies.layouts.main')

@section('body')
  <div class="w-full h-auto min-h-screen flex flex-col">
    {{-- Header Section --}}
    @include('movies.partials.header')
    <div class="w-auto pl-28 pr-10 pt-6 pb-10 grid grid-cols-3 lg:grid-cols-5 gap-5">
      @foreach ($movies as $movie)
        @php
          $movieImageURL = "{$imageBaseURL}/w300{$movie->poster_path}";
          $score = round($movie->score / 2, 2);
          $maxPrice = collect($movie->detail)
              ->flatten()
              ->max('price');
          $minPrice = collect($movie->detail)
              ->flatten()
              ->min('price');

          $price = $maxPrice === $minPrice ? 'Rp' . number_format($maxPrice, 0, '.') : 'Rp' . number_format($minPrice, 0, '.') . ' - ' . 'Rp' . number_format($maxPrice, 0, '.');
        @endphp

        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow">
          <a href="{{ route('main.movie.details', $movie->id_movie) }}">
            <img class="p-8" src="{{ $movieImageURL }}" alt="Movie Poster" />
          </a>
          <div class="px-5 pb-5">
            <a href="{{ route('main.movie.details', $movie->id_movie) }}">
              <h5 class="text-xl font-semibold tracking-tight text-gray-900">{{ $movie->title }}</h5>
            </a>
            <div class="flex items-center mt-2.5 mb-5">
              <div class="flex items-center space-x-1 rtl:space-x-reverse">
                @for ($i = 1; $i <= 5; $i++)
                  @if ($score > $i)
                    <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor" viewBox="0 0 22 20">
                      <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                  @else
                    <svg class="w-4 h-4 text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor" viewBox="0 0 22 20">
                      <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                    </svg>
                  @endif
                @endfor
              </div>
              <span
                class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded ms-3">{{ $score }}</span>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-xl text-gray-800">{{ $price }}</span>
              <a class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                href="booking/{{ $movie->id_movie }}">
                Buy Ticket
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    @if ($movies->count() == 0)
      <div class="w-full my-auto text-center text-gray-600 h text-xl font-bold">No Now Playing Movies Found :(</div>
    @endif

    {{-- Footer Section --}}
    @include('movies.partials.footer')
  </div>
@endsection
