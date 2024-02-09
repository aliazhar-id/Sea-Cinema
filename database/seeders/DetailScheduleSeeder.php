<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedules;
use App\Models\DetailSchedule;

class DetailScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $seats = [];
        // Loop through each row (A-F)
        for ($row = 'A'; $row <= 'F'; $row++) {
            // Loop through each seat number (1-12)
            for ($seatNumber = 1; $seatNumber <= 12; $seatNumber++) {
                // Pad the seat number with leading zeros
                $paddedSeatNumber = str_pad($seatNumber, 2, "0", STR_PAD_LEFT);
                // Combine the row and seat number into a unique seat code
                $seatCode = $row . $paddedSeatNumber;
                // Initialize the seat availabilin jjkty to false (assuming available by default)
                $seats[$seatCode] = false;
            }
        }

        $seats = json_encode($seats);
        $schedule = Schedules::all();

        $hour = ['10:00', '12:00', '13:00', '14:00', '15:00'];
        // for($i=0; $i < count($schedule); $i++)  
        foreach($schedule as $movie)  
        {
            for($x=0; $x< count($hour); $x++)
            {
                DetailSchedule::create([
                    'id_movie' => $movie['id_movie'],
                    'date' => '2024-01-01',
                    'start_at' => $hour[$x],
                    'seats' => $seats,
                    'studio' => 'sea 1',
                    'price' => 50000,
                    'format' => '5D',
                ]);
            }
        }
    }
}
