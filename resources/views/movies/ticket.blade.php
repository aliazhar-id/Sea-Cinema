@extends('movies.layouts.main')

@section('body')
  <div class="w-full h-auto min-h-screen flex flex-col">
    {{-- Header Section --}}
    {{-- @dd($tickets) --}}
    @include('movies.partials.header')
   
    {{-- Top Up Section --}}
    <div class="flex justify-center">
        <div class="container mx-auto text-black flex flex-col items-center">
            <div class="text-center my-5">
                <h1 class="text-2xl font-bold mb-2">Your Ticket History</h1>
                <h2 class="">This is your list of transaction orders. Please confirm or cancel them before the timer runs out</h2>
            </div>
            @foreach($data   as $ticket)
                @php
                    $movieImageURL = "{$imageBaseURL}/w300{$ticket['poster_path']}"
                @endphp
            <div class="p-1 grid grid-cols-4 gap-4 items-center m-3 border border-black">
                <div>
                    <div class="flex items-center">
                        <img class="object-cover h-80" src="{{ $movieImageURL }}" alt="Movie Poster" />
                    </div>
                </div>

                <div class="my-4">
                    <h1 class="text-xl font-bold mb-2">{{ $ticket['movie_title']}}</h1>

                    <h1 class="text-2xl my-3" style="max-width: 200px">{{ $ticket['ticket_code'] }}</h1>
                    <div class="my-4">
                        <h1> Booked Seats: </h1>
                        <h1> {{$ticket['seats']}} </h1>
                    </div>
                    <h1> Total Price: Rp. {{number_format($ticket['total_price'])  }}</h1>
                </div>
                <div class="col-span-2">
                    <div class="flex flex-col items-center justify-center">
                        <div>
                            <h1 class="text-xl">Date: {{ $ticket['date'] }}</h1>
                            <h1 class="text-lg">Hour: {{ $ticket['start_at'] }}</h1>
                            <h1 class="text-lg">Studio: {{ $ticket['studio'] }}</h1>
                        </div>
                        <div class="flex ">
                            <a href="{{ route('main.ticket.pdf', $ticket['ticket_id'])}}">
                                <button class="bg-green-500 text-white py-2 px-4 my-4 rounded w-full hover:bg-green-700 hover:text-white transition-colors duration-500">
                                    Download Ticket
                                </button>
                            </a>
                            {{-- <form method="POST" >
                                @csrf
                                <button type="submit" class="bg-red-500 text-white py-2 px-4 m-4 rounded w-full hover:bg-red-700 hover:text-white transition-colors duration-500">
                                    Cancel
                                </button>
                            </form> --}}
                        </div>
                        <div></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{-- Footer Section --}}
    @include('movies.partials.footer')
  </div>
@endsection
