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

        <div class="flex flex-row items-center w-full h-full relative slide duration-200">
          {{-- Image --}}
          <img src="{{ $movieImageURL }}" alt="{{ $movie->title }}" class="absolute w-full h-full object-cover">

          {{-- Image Overlay --}}
          <div class="w-full h-full absolute bg-black bg-opacity-40"></div>

          <div class="w-10/12 flex flex-col col ml-28 z-10 ">
            <span class="font-bold font-inter text-4xl text-white">{{ $movie->title }}</span>
            <span class="font-inter text-xl text-white w-1/2 line-clamp-2">{{ $movie->overview }}</span>
            <a href="/movie/{{ $movie->id }}"
              class="w-fit bg-movieapp-500 text-white pl-4 pr-4 py-2 mt-5 font-inter text-sm flex flex-row rounded-full items-center hover:drop-shadow-lg duration-200">
              <svg width="11" height="14" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                  d="M0.5 12.175V1.825C0.5 1.54167 0.6 1.30417 0.8 1.1125C1 0.920833 1.23333 0.825 1.5 0.825C1.58333 0.825 1.67083 0.8375 1.7625 0.8625C1.85417 0.8875 1.94167 0.925 2.025 0.975L10.175 6.15C10.325 6.25 10.4375 6.375 10.5125 6.525C10.5875 6.675 10.625 6.83333 10.625 7C10.625 7.16667 10.5875 7.325 10.5125 7.475C10.4375 7.625 10.325 7.75 10.175 7.85L2.025 13.025C1.94167 13.075 1.85417 13.1125 1.7625 13.1375C1.67083 13.1625 1.58333 13.175 1.5 13.175C1.23333 13.175 1 13.0792 0.8 12.8875C0.6 12.6958 0.5 12.4583 0.5 12.175Z"
                  fill="#FFF" />
              </svg>
              <span class="pl-1">Detail</span>
            </a>
          </div>
        </div>
      @endforeach

      {{-- Prev Button --}}
      <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1/12 flex justify-center">
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
      <div class="rotate-180 absolute right-0 top-1/2 -translate-y-1/2 w-1/12 flex justify-center">
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
