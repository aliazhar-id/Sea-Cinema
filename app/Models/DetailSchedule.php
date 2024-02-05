<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSchedule extends Model
{
  use HasFactory;

  protected $guarded = [];
  protected $primaryKey = 'id_schedule';

  public function movie()
  {
    return $this->belongsTo(Schedules::class, 'id_movie');
  }
}
