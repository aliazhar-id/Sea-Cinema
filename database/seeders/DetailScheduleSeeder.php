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
        $schedule = Schedules::all();

        $hour = ['10:00', '12:00', '13:00', '14:00', '15:00'];
        $date = ['2024-01-01', '2024-01-02', '2024-01-03', '2024-01-04', '2024-01-05'];
        // for($i=0; $i < count($schedule); $i++)  
        foreach($schedule as $movie)  
        {
            for($y=0; $y< count($date); $y++)
            {
                for($x=0; $x< count($hour); $x++)
                {
                    DetailSchedule::create([
                    'id_movie' => $movie['id_movie'],
                    'date' => $date[$y],
                    'start_at' => $hour[$x],
                    'studio' => 'Sea 1',
                    'price' => 50000,
                    'format' => '5D',
                    ]);
                }
            }
            

            
        }
    }
}
