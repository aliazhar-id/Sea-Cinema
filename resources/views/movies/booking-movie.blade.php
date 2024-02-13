@extends('movies.layouts.main')

@section('body')
<div class="w-full flex flex-col relative">
  @php
    $backDropPath = $movieData ? "{$imageBaseURL}/original{$movieData->backdrop_path}" : '';
    $posterPath = $movieData ? "{$imageBaseURL}/original{$movieData->poster_path}" : '';
  @endphp
    @include('movies.partials.header')

    {{-- @dd($movieData) --}}
  {{-- Background Image --}}
  <img src="{{ $backDropPath }}" alt="" class="w-full h-3/5 absolute object-cover lg:object-fill">

  <div class="w-full h-3/5 absolute bg-black bg-opacity-60 z-10"></div>

  @php
    $title = '';
    $tagline = '';
    $year = '';
    $duration = '';
    $rating = 0;

    if ($movieData) {
        $year = date('Y', strtotime($movieData->release_date));
        $rating = (int) ($movieData->score * 10);
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

  {{-- <div class="w-full overflow-y-auto"> --}}
    {{-- Poster path and overveiw --}}
    <div class="flex flex-row mx-auto justify-center items-center h-1/2 mt-20">
      <div class="w-1/3 relative z-10 ml-5">
        <img src="{{ $posterPath }}" alt="{{ $title }}" class=" h-1/2 w-80">
      </div>
      <div class="w-2/3 z-10 flex flex-col justify-center px-10">
        <span class="font-quicksand font-bold text-6xl mt-4 text-white">{{ $title }}</span>
        <span class="font-inter italic text-lg mt-4 text-white max-w-3xl">{{ $tagline }}</span>
        @if ($trailerID)
          <button
            class="w-fit bg-movieapp-500 text-white pl-4 pr-6 py-3 mt-5 font-inter text-xl flex flex-row rounded-2xl items-center hover:drop-shadow-lg duration-200"
            onclick="showTrailer(true)">
          </button>
        @endif
        <div class="grid grid-flow-col auto-cols-max m-5 gap-4"> 
          <div class="w-20 h-20 rounded-full flex items-center justify-center" style="background: #00304D ">
            <svg class="-rotate-90 w-20 h-20">
              <circle style="color: #004F80;" stroke-width="8" stroke="currentColor" fill="transparent" r="32"
                cx="40" cy="40" />
              <circle style="color: #6FCF97;" stroke-width="8" stroke-dasharray="{{ $circumference }}"
                stroke-linecap="round" stroke-dashoffset="{{ $progressRating }}" stroke="currentColor" fill="transparent"
                r="32" cx="40" cy="40" />
            </svg>
            <span class="absolute font-inter font-bold text-xl text-white">{{ $rating }}%</span>
          </div>
          <div> 
            <button class="w-50 bg-movieapp-500 hover:bg-movieapp-600 text-white pl-4 pr-6 py-3 font-inter text-xl flex flex-row rounded-2xl items-center hover:drop-shadow-lg duration-200">
            see schedule
            </button>
          </div>
        </div>
      </div>
      
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
      </div>
    </div>
    {{-- Trailer Section --}}

    <div class="flex mx-auto justify-center items-center flex-col my-10">
      <div class="">
        <h1 class="font-inter font-bold text-3xl text-black my-4">Pick Your Date </h1>
      </div>

        @php
          $selectedDates = "";
        @endphp
      <div class="flex gap-4 mb-10">
        @foreach($uniqueDates as $dates)
        <div class="flex flex-col relative"> 
          <div class="mb-5"> 
            <button class="w-50 bg-red-500 hover:bg-movieapp-600 text-white pl-4 pr-6 py-3 font-inter text-sm flex flex-row rounded-2xl items-center hover:drop-shadow-lg duration-200" onclick="toggleHours('{{ $dates }}')">
              {{$dates}}
              </button>
          </div>
          <div class="flex absolute top-full left-0 hidden" id="{{ $dates }}-hours"> <!-- Add absolute class to hours container -->
            @foreach($scheduleData as $schedule)
                @if($schedule->date === $dates)
                <button  class="mb-10 mx-2 bg-slate-200 hover:bg-slate-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center"><a href="seats/{{$schedule->id_schedule}}"> {{ $schedule->start_at }}</a>
                </button>                
                @endif
            @endforeach
          </div>
        </div>
       
        @endforeach
      </div>
      <div class="mt-4 items-center"> 
        {{-- Rating --}}
       
      </div>
    </div>
  {{-- </div --}}

</div>
@include('movies.partials.footer')

@endsection

@section('script')
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">
  </script>
  <script>
    function toggleHours(date) {
      const allHours = document.querySelectorAll('[id$="-hours"]');
    allHours.forEach(hours => {
      if (hours.id !== `${date}-hours`) {
        hours.classList.add('hidden'); // Hide all hours except for the one corresponding to the clicked date
      }
    });
    const hoursList = document.getElementById(`${date}-hours`);
    hoursList.classList.toggle('hidden');
    }
  </script>
@endsection
