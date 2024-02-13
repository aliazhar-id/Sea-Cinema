<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedules extends Model
{
  use HasFactory;

  protected $guarded = [];
  protected $primaryKey = 'id_movie';

  public function detail()
  {
    return $this->hasMany(DetailSchedule::class, 'id_movie');
  }
}
