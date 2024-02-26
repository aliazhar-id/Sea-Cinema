<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NowPlayingSchedule;
use App\Models\NowPlaying;
use App\Models\Transaction;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user_data = auth()->user()->id_user;
        $ticket_data = Ticket::where('id_user', $user_data)->get();
        // dd($ticket_data);

        $data = [];
        foreach ($ticket_data as $ticket) {
            // Fetch transaction data for each ticket
            $transaction = Transaction::where('id_transactions', $ticket->id_transaction)->first();
            $nowplaying_data = NowPlayingSchedule::where('id_schedule', $transaction->id_schedule)->first();
            $movie_data = NowPlaying::where('id_movie', $nowplaying_data->id_movie)->first();

            $ticket_details = [
                'movie_title' => $movie_data->title,
                'poster_path' => $movie_data->poster_path,
                'date' => $nowplaying_data->date,
                'start_at' => $nowplaying_data->start_at,
                'total_price' => $transaction->total_price,
                'seats' => $ticket->seats,
                'ticket_code' => $ticket->ticket_code,
                'studio' => $ticket->studio,
            ];
            $data[] = $ticket_details;
            // If transaction data is found, add it to the array
            // if ($transaction) {
            //     $transaction_data[] = $transaction;
            // }
        }

        // dd($data);

        return view('movies.ticket', ['title' => 'Ticket',
        'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
          ]);
        $validatedData['id_user'] = auth()->user()->id_user;
        $id_user = auth()->user()->id_user;
        $validatedData['status'] = 'success';

        $seats = $request->input('seats');
        $validatedData['booked_seats'] = implode(', ', $seats);

        $id_schedule = $request->input('id');
        $validatedData['id_schedule'] = $id_schedule;
        $schedule = NowPlayingSchedule::find($id_schedule);

        $price = $schedule->price;
        $numSeats = count($seats);
        $total_price = $price * $numSeats;
      
        $validatedData['total_price'] = $total_price;

        //check user balance
        try {
            $user = User::findOrFail($id_user);
            if ($user->balance < $total_price) {
                throw ValidationException::withMessages(['balance' => 'Insufficient balance.']);
            }
            $user->update([
                'balance' => $user->balance - $total_price,
            ]);
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors($e->validator->errors());
        }
         // Decode the existing seats JSON data
        $scheduleSeats = json_decode($schedule->seats, true);

        // Merge the existing seats with the selected seats array
        foreach ($seats as $seat) {
            $scheduleSeats[$seat] = true;
        }
        $schedule->seats = json_encode($scheduleSeats);
        $schedule->save();

       
        
        $transaction = Transaction::create($validatedData);
        $transactionId = $transaction->id_transactions;

        
        $studio = rand(1, 4);
        $currentDateTime = date('H:i:s');

        // Prepend "txt-" to the current time
        $txt = "txt-" . $currentDateTime;
        $ticket = Ticket::create([
            'id_transaction' => $transactionId,
            'ticket_code' => $txt,
            'seats' =>  $validatedData['booked_seats'],
            'studio' => $studio,
            'id_user' => $id_user,
        ]);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
