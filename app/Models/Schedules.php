<?php

namespace App\Models;

use App\Models\Movies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedules extends Model
{
  use HasFactory;

  protected $guarded = [];
  protected $primaryKey = 'id_schedule';

  public function schedules()
  {
    return $this->belongsTo(Movies::class, 'id_movie');
  }
}
