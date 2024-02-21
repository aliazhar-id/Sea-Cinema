<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NowPlaying extends Model
{
  use HasFactory;

  protected $guarded = [];
  protected $primaryKey = 'id_movie';

  public function schedule()
  {
    return $this->hasMany(NowPlayingSchedule::class, 'id_movie');
  }
}
