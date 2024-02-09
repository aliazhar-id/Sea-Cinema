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
        // for($i=0; $i < count($schedule); $i++)  
        foreach($schedule as $movie)  
        {
            for($x=0; $x< count($hour); $x++)
            {
                DetailSchedule::create([
                    'id_movie' => $movie['id_movie'],
                    'date' => '2024-01-01',
                    'start_at' => $hour[$x],
                    'studio' => 'Sea 1',
                    'price' => 50000,
                    'format' => '5D',
                ]);
            }
        }
    }
}
