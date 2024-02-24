@extends('movies.layouts.main')

@section('body')
  <div class="w-full h-screen flex flex-col relative">
    @php
      $backDropPath = $movieData ? "{$imageBaseURL}/original{$movieData->backdrop_path}" : '';
    @endphp

    {{-- Background Image --}}
    <img src="{{ $backDropPath }}" alt="" class="w-full h-screen absolute object-cover lg:object-fill">
    <div class="w-full h-screen absolute bg-black bg-opacity-60 z-10"></div>

    {{-- Menu Section --}}
    <div class="w-full bg-transparent h-[96px] drop-shadow-lg flex row items-center z-10" 96px="">
      <div class="w-2/12 text-center">
        <a href="{{ route('main.home') }}" class="uppercase text-base mx-5 text-white opacity-80 hover:text-movieapp-500 duration-200 font-inter">
          Top Movies
        </a>
      </div>
      <div class="w-2/12 text-center">
        <a href="{{ route('main.movies') }}"
          class="uppercase text-base mx-5 text-white opacity-80 hover:text-movieapp-500 duration-200 font-inter">Movies</a>
      </div>
      <div class="w-6/12 flex items-center justify-center">
        <a href="{{ route('main.home') }}" class="font-bold text-4xl font-quicksand text-white opacity-80 hover:text-movieapp-500 duration-200">
          Sea Cinema
        </a>
      </div>
      <div class="w-2/12 text-center">
        <a href="{{ route('main.upcoming') }}"
          class="uppercase text-base mx-5 text-white opacity-80 hover:text-movieapp-500 duration-200 font-inter">Upcoming</a>
      </div>
      <div class="w-2/12 text-center">
        <a href="{{ route('main.nowplaying') }}" class="uppercase text-base mx-5 text-white opacity-80 hover:text-movieapp-500 duration-200 font-inter">
          Now Playing
        </a>
      </div>
    </div>

    @php
      $title = '';
      $tagline = '';
      $year = '';
      $duration = '';
      $rating = 0;

      if ($movieData) {
          $year = date('Y', strtotime($movieData->release_date));
          $rating = (int) ($movieData->vote_average * 10);
          $title = $movieData->title;

          if ($movieData->tagline) {
              $tagline = $movieData->tagline;
          } else {
              $tagline = $movieData->overview;
          }

          if ($movieData->runtime) {
              $hour = (int) ($movieData->runtime / 60);
              $minute = $movieData->runtime % 60;
              $duration = "{$hour}h {$minute}m";
          }
      }

      // 2 * phi * r; r = 32px
      $circumference = ((2 * 22) / 7) * 32;
      $progressRating = $circumference - ($rating / 100) * $circumference;

      $trailerID = '';

      if (isset($movieData->videos->results)) {
          foreach ($movieData->videos->results as $movie) {
              if (strtolower($movie->type) == 'trailer') {
                  $trailerID = $movie->key;
              }
          }
      }
    @endphp

    {{-- Content Section --}}
    <div class="w-full h-full z-10 flex flex-col justify-center px-20">
      <span class="font-quicksand font-bold text-6xl mt-4 text-white">{{ $title }}</span>
      <span class="font-inter italic text-2xl mt-4 text-white max-w-3xl line-clamp-5">{{ $tagline }}</span>

      <div class="flex flex-row mt-4 items-center">
        {{-- Rating --}}
        <div class="w-20 h-20 rounded-full flex items-center justify-center mr-4" style="background: #00304D ">
          <svg class="-rotate-90 w-20 h-20">
            <circle style="color: #004F80;" stroke-width="8" stroke="currentColor" fill="transparent" r="32"
              cx="40" cy="40" />

            <circle style="color: #6FCF97;" stroke-width="8" stroke-dasharray="{{ $circumference }}"
              stroke-linecap="round" stroke-dashoffset="{{ $progressRating }}" stroke="currentColor" fill="transparent"
              r="32" cx="40" cy="40" />
          </svg>

          <span class="absolute font-inter font-bold text-xl text-white">{{ $rating }}%</span>
        </div>

        <span class="font-inter text-xl text-white bg-transparent rounded-md border border-white p-2 mr-4">
          {{ $year }}
        </span>

        @if ($duration)
          <span class="font-inter text-xl text-white bg-transparent rounded-md border border-white p-2">
            {{ $duration }}
          </span>
        @endif

      </div>

      @if ($trailerID)
        <button
          class="w-fit bg-movieapp-500 text-white pl-4 pr-6 py-3 mt-5 font-inter text-xl flex flex-row rounded-2xl items-center hover:drop-shadow-lg duration-200"
          onclick="showTrailer(true)">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M9.525 18.025C9.19167 18.2417 8.854 18.254 8.512 18.062C8.17067 17.8707 8 17.575 8 17.175V6.82499C8 6.42499 8.17067 6.12899 8.512 5.93699C8.854 5.74566 9.19167 5.75832 9.525 5.97499L17.675 11.15C17.975 11.35 18.125 11.6333 18.125 12C18.125 12.3667 17.975 12.65 17.675 12.85L9.525 18.025Z"
              fill="white"></path>
          </svg>

          <span>Play Trailer<span>
        </button>
      @endif
    </div>

    {{-- Trailer Section --}}
    <div id="trailerWrapper" class="absolute z-10 w-full h-screen p-20 flex flex-col">
      <img src="{{ $backDropPath }}" alt="{{ $movieData->title }}"
        class="w-full h-screen fixed top-0 left-0 object-cover lg:object-fill">
      <div class="w-full h-screen bg-black bg-opacity-85 fixed top-0 left-0"></div>

      <button class="ml-auto group mb-4 z-10" onclick="showTrailer(false)">
        <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48">
          <path
            d="m12.45 37.65-2.1-2.1L21.9 24 10.35 12.45l2.1-2.1L24 21.9l11.55-11.55 2.1 2.1L26.1 24l11.55 11.55-2.1 2.1L24 26.1Z"
            class="fill-white group-hover:fill-develobe-500 duration-200"></path>
        </svg>
      </button>

      <iframe id="youtubeVideo" class="w-full h-full z-10"
        src="https://www.youtube.com/embed/{{ $trailerID }}?enablejsapi=1" title="{{ $movieData->title }}"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen></iframe>
    </div>

  </div>
@endsection

@section('script')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <script>
    // Hide trailer by default
    $('#trailerWrapper').hide();

    function showTrailer(isVisible) {
      if (isVisible) {
        $('#trailerWrapper').show();
      } else {
        // Stop youtube video
        $('#youtubeVideo')[0].contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', '*');

        $('#trailerWrapper').hide();
      }
    }
  </script>
@endsection
