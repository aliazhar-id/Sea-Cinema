@extends('movies.layouts.main')

@section('body')
<div class="w-full h-screen flex flex-col relative">
    
    @include('movies.partials.header')

    @php
     $seatsData = json_decode($data->seats, true); // Decode JSON string into an array
     $selectedSeats = [];
    @endphp
    {{-- Background Image --}}
   {{-- resources/views/seats_selection.blade.php --}}
   
   @if (session()->has('message'))
   <div class="alert alert-success">
       {{ session('message') }}
   </div>
   @endif
   <h1 class="text-black text-xl text-center p-8">Layout </h1>
    <div class="w-full h-50% bg-gray-900 overflow-hidden mt-10">
    <!-- Movie title -->
        <div class="text-white text-center p-8">
            <h1>Screen</h1>
        </div>
    </div>
    <div style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 1px; margin: 16px 0;">
        {{-- @foreach(array_slice(array_keys($seatsData), 0, 60) as $seat) --}}
        @foreach($seatsData as $seat => $isAvailable)
        <div
            style="
                width: calc(8.666% - 15px);
                height: 60px;
                border: 2px solid #999;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 7px;
                margin-bottom: 6px;
                padding: 10px;
                background-color: {{ $isAvailable ? '#888' : (in_array($seat, $selectedSeats) ? '#005bb5' : '#fff') }};
                color: {{ $isAvailable ? '#606c7a' : (in_array($seat, $selectedSeats) ? '#fff' : '#000') }};
                cursor: {{ $isAvailable ? 'not-allowed' : 'pointer' }};
            }}" onclick="handleSeatSelection('{{ $seat }}')"  >
            {{ $seat }}
        </div>
    @endforeach
    <form action="{{ route('main.seats.buyticket', ['id' => $id]) }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
    
        <div style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 1px; margin: 16px 0;">
            @php $iterationCount = 0; @endphp
            <div style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 1px;">
                @foreach($seatsData as $seat => $isAvailable)
                    @if($iterationCount % 12 === 0 && $iterationCount !== 0)
                        </div><div style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap; gap: 1px;">
                    @endif
                    @if(!$isAvailable)
                        <div class="seat-box" onclick="handleSeatSelection('{{ $seat }}')">
                            <input type="checkbox" id="{{ $seat }}" name="seats[]" value="{{ $seat }}">
                            <label for="{{ $seat }}">{{ $seat }}</label>
                        </div>
                    @endif
                    @php $iterationCount++; @endphp
                @endforeach
            </div>
        </div>
        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-1/2 items-center">BUY TICKET</button>
        </div>
    </form>
    
    
    
    
    
  {{-- <div style="display: flex; justify-content: center; align-items: center;">
    @foreach(array_slice(array_keys($seatsData), -4) as $seat)
    <div
      style=" width: 8.333%; height: 40px; border: 1px solid #999; border-radius: 4px; display: flex; align-items: center; justify-content: center; margin-right: 2px; margin-bottom: 2px; background-color: {{ $seatsData[$seat] ? '#888' : (in_array($seat, $selectedSeats) ? '#005bb5' : '#fff') }}; color: {{ $seatsData[$seat] ? '#606c7a' : (in_array($seat, $selectedSeats) ? '#fff' : '#000') }};  cursor: {{ $seatsData[$seat] ? 'not-allowed' : 'pointer' }}; }}"
      onclick="handleSeatSelection('{{ $seat }}')">
      {{ $seat }}
    </div>
    @endforeach
  </div> --}}
</div>
@endsection

@section('script')
<script>
    let selectedSeats = @json($selectedSeats);

    // Function to render the seat layout
    function renderSeatLayout() {
        const seatLayout = document.getElementById("seat-layout");
        seatLayout.innerHTML = ""; // Clear previous content

        Object.keys(seatsData).forEach(seat => {
            const seatElement = document.createElement("div");
            seatElement.textContent = seat;
            seatElement.classList.add("seat");
            if (seatsData[seat]) {
                seatElement.classList.add("available");
                seatElement.addEventListener("click", () => handleSeatSelection(seat));
            } else {
                seatElement.classList.add("booked");
            }
            seatLayout.appendChild(seatElement);
        });
    }

    // Function to handle seat selection
    function handleSeatSelection(seat) {
        // Toggle seat selection
        if (!selectedSeats.includes(seat)) {
            selectedSeats.push(seat);
        } else {
            selectedSeats = selectedSeats.filter(s => s !== seat);
        }

        // Update UI
        renderSeatLayout();
        displaySelectedSeats();
    }

    // Function to display selected seats
    function displaySelectedSeats() {
        const selectedSeatsContainer = document.getElementById("selected-seats");
        selectedSeatsContainer.textContent = selectedSeats.join(", ");
    }
    // Initial rendering of seat layout
    renderSeatLayout();
</script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection
