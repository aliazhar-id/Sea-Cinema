<!DOCTYPE html>
<html>
<head>
    <title>Ticket PDF</title>
    <style>
        /* Internal CSS */
        .max-w-lg {
            max-width: 32rem; /* Equivalent to Tailwind's max-w-lg */
        }

        .mx-auto {
            margin-left: auto; /* Equivalent to Tailwind's mx-auto */
            margin-right: auto; /* Equivalent to Tailwind's mx-auto */
        }

        .bg-white {
            background-color: #ffffff; /* Equivalent to Tailwind's bg-white */
        }

        .shadow-md {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Equivalent to Tailwind's shadow-md */
        }

        .p-8 {
            padding: 2rem; /* Equivalent to Tailwind's p-8 */
        }

        .my-8 {
            margin-top: 2rem; /* Equivalent to Tailwind's my-8 */
            margin-bottom: 2rem; /* Equivalent to Tailwind's my-8 */
        }

        .text-3xl {
            font-size: 1.875rem; /* Equivalent to Tailwind's text-3xl */
            font-weight: 700; /* Equivalent to Tailwind's font-bold */
        }

        /* Add more styles as needed */
    </style>
</head>
<body>
   
    <h1 class="text-3xl font-bold text-center mb-4">Ticket Details</h1>
    <div class="ticket-details bg-gray-200 p-4 rounded-lg shadow md:flex md:flex-col md:justify-center md:items-center">
        <h2 class="text-2xl font-semibold mb-4 md:text-center">{{ $ticket_details['movie_title'] }}</h2>
        @php
            $movieImageURL = "{$imageBaseURL}/w300{$ticket_details['poster_path']}"
        @endphp
        <img src="{{ $movieImageURL }}" alt="{{ $ticket_details['movie_title'] }} Poster" class="w-full max-h-64 mx-auto rounded md:w-1/2">
         {{-- @dd( $movieImageURL) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <p class="text-gray-700">Date: {{ $ticket_details['date'] }}</p>
            <p class="text-gray-700">Start Time: {{ $ticket_details['start_at'] }}</p>
            <p class="text-gray-700">Total Price: {{ $ticket_details['total_price'] }}</p>
            <p class="text-gray-700">Seats: {{ $ticket_details['seats'] }}</p>
            <p class="text-gray-700">Ticket Code: {{ $ticket_details['ticket_code'] }}</p>
            <p class="text-gray-700">Studio: {{ $ticket_details['studio'] }}</p>
        </div>
    </div>
</body>
</html>
