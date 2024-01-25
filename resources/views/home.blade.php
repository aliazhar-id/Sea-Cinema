<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Movies App</title>

  @vite('resources/css/app.css')
</head>

<body>
  <div class="w-full h-auto min-h-screen flex flex-col">

    {{-- Header Section --}}
    @include('partials.header')

    {{-- Banner Section --}}
    <div class="w-full h-[512px] flex flex-col relative bg-black">
      {{-- Banner Data --}}
      @foreach ($trending as $movie)
        @php
          $movieImageURL = "{$imageBaseURL}/original/{$movie->backdrop_path}";
        @endphp

        <div class="flex flex-row items-center w-full h-full relative slide">
          {{-- Image --}}
          <img src="{{ $movieImageURL }}" alt="{{ $movie->title }}" class="absolute w-full h-full object-cover">

          {{-- Image Overlay --}}
          <div class="w-full h-full absolute bg-black bg-opacity-40"></div>

          <div class="w-10/12 flex flex-col col ml-28 z-10 ">
            <span class="font-bold font-inter text-4xl text-white">{{ $movie->title }}</span>
            <span class="font-inter text-xl text-white w-1/2 line-clamp-2">{{ $movie->overview }}</span>
            <a href="/movie/{{ $movie->id }}"
              class="w-fit bg-movieapp-500 text-white pl-2 pr-4 py-2 mt-5 font-inter text-sm flex flex-row rounded-full items-center hover:drop-shadow-lg duration-200">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M9.525 18.025C9.19167 18.2417 8.854 18.254 8.512 18.062C8.17067 17.8707 8 17.575 8 17.175V6.82499C8 6.42499 8.17067 6.12899 8.512 5.93699C8.854 5.74566 9.19167 5.75832 9.525 5.97499L17.675 11.15C17.975 11.35 18.125 11.6333 18.125 12C18.125 12.3667 17.975 12.65 17.675 12.85L9.525 18.025Z"
                  fill="white"></path>
              </svg>
              <span>Detail</span>
            </a>
          </div>
        </div>
      @endforeach

      {{-- Prev Button --}}
      <div class="z-10 absolute left-0 top-1/2 -translate-y-1/2 w-1/12 flex justify-center">
        <button onclick="moveSlide(-1)" class="bg-white p-3 rounded-full opacity-20 hover:opacity-100 duration-200">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <mask id="mask0_203_62" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="25"
              height="25">
              <rect x="0.244917" y="0.839897" width="24" height="24" fill="#D9D9D9" />
            </mask>
            <g mask="url(#mask0_203_62)">
              <path
                d="M10.2699 12.8149L17.5949 20.1399C17.8949 20.4399 18.0449 20.8066 18.0449 21.2399C18.0449 21.6732 17.8949 22.0399 17.5949 22.3399C17.2949 22.6399 16.9283 22.7899 16.4949 22.7899C16.0616 22.7899 15.6949 22.6399 15.3949 22.3399L7.74492 14.6899C7.47825 14.4232 7.28242 14.1274 7.15742 13.8024C7.03242 13.4774 6.96992 13.1482 6.96992 12.8149C6.96992 12.4816 7.03242 12.1524 7.15742 11.8274C7.28242 11.5024 7.47825 11.2066 7.74492 10.9399L15.3949 3.2899C15.6949 2.9899 16.0616 2.8399 16.4949 2.8399C16.9283 2.8399 17.2949 2.9899 17.5949 3.2899C17.8949 3.5899 18.0449 3.95656 18.0449 4.3899C18.0449 4.82323 17.8949 5.1899 17.5949 5.4899L10.2699 12.8149Z"
                fill="#1C1B1F" />
            </g>
          </svg>

        </button>
      </div>

      {{-- Next Button --}}
      <div class="z-10 rotate-180 absolute right-0 top-1/2 -translate-y-1/2 w-1/12 flex justify-center">
        <button onclick="moveSlide(1)" class="bg-white p-3 rounded-full opacity-20 hover:opacity-100 duration-200">
          <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <mask id="mask0_203_62" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="25"
              height="25">
              <rect x="0.244917" y="0.839897" width="24" height="24" fill="#D9D9D9" />
            </mask>
            <g mask="url(#mask0_203_62)">
              <path
                d="M10.2699 12.8149L17.5949 20.1399C17.8949 20.4399 18.0449 20.8066 18.0449 21.2399C18.0449 21.6732 17.8949 22.0399 17.5949 22.3399C17.2949 22.6399 16.9283 22.7899 16.4949 22.7899C16.0616 22.7899 15.6949 22.6399 15.3949 22.3399L7.74492 14.6899C7.47825 14.4232 7.28242 14.1274 7.15742 13.8024C7.03242 13.4774 6.96992 13.1482 6.96992 12.8149C6.96992 12.4816 7.03242 12.1524 7.15742 11.8274C7.28242 11.5024 7.47825 11.2066 7.74492 10.9399L15.3949 3.2899C15.6949 2.9899 16.0616 2.8399 16.4949 2.8399C16.9283 2.8399 17.2949 2.9899 17.5949 3.2899C17.8949 3.5899 18.0449 3.95656 18.0449 4.3899C18.0449 4.82323 17.8949 5.1899 17.5949 5.4899L10.2699 12.8149Z"
                fill="#1C1B1F" />
            </g>
          </svg>

        </button>
      </div>

      {{-- Indicator --}}
      <div class="absolute bottom-0 w-full mb-8">
        <div class="w-full flex flex-row items-center justify-center">
          @for ($pos = 1; $pos <= count($trending); $pos++)
            <div class="w-2.5 h-2.5 rounded-full mx-1 cursor-pointer dot" onclick="currentSlide($pos)"></div>
          @endfor
        </div>
      </div>
    </div>

    {{-- Top 10 Movies Section --}}
    <div class="mt-12">
      <span class="ml-28 font-inter font-bold text-xl">Top 10 Movies</span>

      <div class="w-auto flex flex-row overflow-x-auto pl-28 pt-6 pb-10">
        @foreach ($topMovies as $movie)
          @php
            $releaseYear = date('Y', strtotime($movie->release_date));
            $movieImageURL = "{$imageBaseURL}/w500/{$movie->poster_path}";
            $rating = $movie->vote_average * 10;
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
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
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
    </div>

    {{-- Top 10 TV Shows Section --}}
    <div>
      <span class="ml-28 font-inter font-bold text-xl">Top 10 TV Shows</span>

      <div class="w-auto flex flex-row overflow-x-auto pl-28 pt-6 pb-10">
        @foreach ($topTvShows as $movie)
          @php
            $releaseYear = date('Y', strtotime($movie->first_air_date));
            $movieImageURL = "{$imageBaseURL}/w500/{$movie->poster_path}";
            $rating = $movie->vote_average * 10;
          @endphp

          <a href="tv/{{ $movie->id }}" class="group">
            <div
              class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
              <div class="overflow-hidden rounded-[32px]">
                <img src="{{ $movieImageURL }}" alt="{{ $movie->original_name }}"
                  class="w-full h-[300px] rounded-[32px] group-hover:scale-125 duration-200">
              </div>

              <span
                class="font-inter font-bold text-xl mt-4 line-clamp-1 group-hover:line-clamp-none">{{ $movie->original_name }}</span>
              <span class="font-inter text-sm mt-1">{{ $releaseYear }}</span>

              <div class="flex flex-row mt-1 items-center">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                  xmlns="http://www.w3.org/2000/svg">
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
    </div>

    {{-- Footer Section --}}
    @include('partials.footer')

    <script>
      // Default active slide
      let slideIndex = 1;
      showSlide(slideIndex);

      function showSlide(position) {
        const slides = document.getElementsByClassName('slide');
        const dots = document.getElementsByClassName('dot');

        // Looping effect
        if (position > slides.length) {
          slideIndex = 1;
        }

        if (position < 1) {
          slideIndex = slides.length
        }

        // Hide all slides
        for (let i = 0; i < slides.length; i++) {
          slides[i].classList.add('hidden');
        }

        // Show active slide
        slides[slideIndex - 1].classList.remove('hidden');

        // Remove active status
        for (let i = 0; i < dots.length; i++) {
          dots[i].classList.remove('bg-movieapp-500');
          dots[i].classList.add('bg-white');
        }

        // Set active status
        dots[slideIndex - 1].classList.remove('bg-white');
        dots[slideIndex - 1].classList.add('bg-movieapp-500');
      }

      function moveSlide(moveStep) {
        showSlide(slideIndex += moveStep);
      }

      function currentSlide(position) {
        showSlide(slideIndex = position);
      }

      setInterval(() => {
        showSlide(slideIndex += 1)
      }, 10000);
    </script>
</body>

</html>
