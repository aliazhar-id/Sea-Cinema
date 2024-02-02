@extends('movies.layouts.main')

@section('body')
  <div class="w-full h-auto min-h-screen flex flex-col">
    {{-- Header Section --}}
    @include('movies.partials.header')

    {{-- Sort Section --}}
    <div class="ml-28 mt-8 flex flex-row items-center">
      <span class="font-inter font-bold text-xl">Sort</span>

      <div class="relative ml-4">
        <select
          class="block appearance-none bg-white drop-shadow-[0_0px_4px_rgba(0,0,0,0.25)] text-black font-inter py-3 pl-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white"
          onchange="changeSort(this)">

          <option value="popularity.desc">Popularity (Descending)</option>
          <option value="popularity.asc">Popularity (Ascending)</option>
          <option value="vote_average.desc">Top Rated (Descending)</option>
          <option value="vote_average.asc">Top Rated (Ascending)</option>

        </select>

        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
          </svg>
        </div>

      </div>
    </div>

    {{-- Content Section --}}
    <div class="w-auto pl-28 pr-10 pt-6 pb-10 grid grid-cols-3 lg:grid-cols-5 gap-5" id="dataWrapper">
      @foreach ($movies as $movie)
        @php
          $releaseYear = date('Y', strtotime($movie->release_date));
          $movieImageURL = "{$imageBaseURL}/w500/{$movie->poster_path}";
          $rating = round($movie->vote_average * 10, 0);
        @endphp

        <a href="movie/{{ $movie->id }}" class="group">
          <div
            class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
            <div class="overflow-hidden rounded-[32px]">
              <img src="{{ $movieImageURL }}" alt="{{ $movie->title }}"
                class="w-full h-[300px] rounded-[32px] group-hover:scale-125 duration-200">
            </div>

            <span
              class="font-inter font-bold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none">{{ $movie->title }}</span>
            <span class="font-inter text-sm mt-1">{{ $releaseYear }}</span>

            <div class="flex flex-row mt-1 items-center">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M18 21H8V8L15 1L16.25 2.25C16.3667 2.36667 16.4627 2.525 16.538 2.725C16.6127 2.925 16.65 3.11667 16.65 3.3V3.65L15.55 8H21C21.5333 8 22 8.2 22.4 8.6C22.8 9 23 9.46667 23 10V12C23 12.1167 22.9873 12.2417 22.962 12.375C22.9373 12.5083 22.9 12.6333 22.85 12.75L19.85 19.8C19.7 20.1333 19.45 20.4167 19.1 20.65C18.75 20.8833 18.3833 21 18 21ZM6 8V21H2V8H6Z"
                  fill="#38B6FF"></path>
              </svg>

              <span class="font-inter text-sm ml-1">{{ $rating }}%</span>
            </div>
          </div>
        </a>
      @endforeach

    </div>

    {{-- Data Loader --}}
    <div class="w-full pl-28 pr-10 flex justify-center mb-5" id="autoLoad">
      <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
        <path fill="#000"
          d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
          <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50"
            to="360 50 50" repeatCount="indefinite"></animateTransform>
        </path>
      </svg>
    </div>

    {{-- Error Notification --}}
    <div id="notification"
      class="min-w-[250px] p-4 bg-red-700 text-white text-center rounded-lg fixed z-10 top-0 right-0 mr-10 mt-5 drop-shadow-lg">
      <span id="notificationMessage"></span>
    </div>

    {{-- Load More --}}
    <div class="w-full pl-28 pr-10" id="loadMore">
      <button class="w-full mb-10 bg-movieapp-500 text-white p-4 font-inter font-bold rounded-xl uppercase drop-shadow-lg"
        onClick="loadMore()">Load More</button>
    </div>

    {{-- Footer Section --}}
    @include('movies.partials.footer')
  </div>
@endsection

@section('script')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <script>
    const baseURL = '{{ $baseURL }}';
    const imageBaseURL = '{{ $imageBaseURL }}';
    const apiKey = '{{ $apiKey }}';
    let sortBy = '{{ $sortBy }}';
    let page = '{{ $page }}';
    const minimalVoter = '{{ $minimalVoter }}';

    // Hide loader
    $('#autoLoad').hide();

    // Hide notification
    $('#notification').hide();

    function loadMore() {
      $.ajax({
        url: `${baseURL}/discover/movie?page=${++page}&sort_by=${sortBy}&api_key=${apiKey}&vote_count.gte=${minimalVoter}`,
        type: 'get',
        beforeSend: function() {
          // Show Loader
          $('#autoLoad').show();
        }
      }).done(function(res) {
        // Hide Loader
        $('#autoLoad').hide();

        if (res.results) {
          const htmlData = [];

          res.results.forEach((movie) => {
            const releaseYear = new Date(movie.release_date).getFullYear();
            const id = movie.id;
            const title = movie.title;
            const movieImageURL = `${imageBaseURL}/w500/${movie.poster_path}`;
            const rating = movie.vote_average * 10;

            htmlData.push(`
            <a href="movie/${id}" class="group">
              <div
                class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
                <div class="overflow-hidden rounded-[32px]">
                  <img src="${movieImageURL}" alt="${title}"
                    class="w-full h-[300px] rounded-[32px] group-hover:scale-125 duration-200">
                </div>

                <span
                  class="font-inter font-bold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none">${title}</span>
                <span class="font-inter text-sm mt-1">${releaseYear }</span>

                <div class="flex flex-row mt-1 items-center">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M18 21H8V8L15 1L16.25 2.25C16.3667 2.36667 16.4627 2.525 16.538 2.725C16.6127 2.925 16.65 3.11667 16.65 3.3V3.65L15.55 8H21C21.5333 8 22 8.2 22.4 8.6C22.8 9 23 9.46667 23 10V12C23 12.1167 22.9873 12.2417 22.962 12.375C22.9373 12.5083 22.9 12.6333 22.85 12.75L19.85 19.8C19.7 20.1333 19.45 20.4167 19.1 20.65C18.75 20.8833 18.3833 21 18 21ZM6 8V21H2V8H6Z"
                      fill="#38B6FF"></path>
                  </svg>

                  <span class="font-inter text-sm ml-1">${rating }%</span>
                </div>
              </div>
            </a>
            `);
          });

          $('#dataWrapper').append(htmlData.join(''));
        }
      }).fail(function(jqHXR, ajaxOptions, thrownError) {
        // Hide Loader
        $('#autoLoad').hide();

        // Show notification
        $('#notificationMessage').text('Terjadi kendala, coba beberapa saat lagi');
        $('#notification').show();

        // Set timeout
        setTimeout(() => {
          $('#notification').hide();
        }, 3000);
      });
    }

    function changeSort(component) {
      if (component.value) {
        // Set new value
        sortBy = component.value;

        // Clear data
        $('#dataWrapper').html('');

        // Reset page value
        page = 0;

        // Get data
        loadMore();
      }
    }
  </script>
@endsection
