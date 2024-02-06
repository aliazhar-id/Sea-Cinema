<?php

namespace App\Models;

use App\Models\Schedules;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movies extends Model
{
  use HasFactory;

  protected $guarded = [];
  protected $primaryKey = 'id_movie';

  protected $fillable = [
    'image_path',
    'trailer_id',
    'title',
    'rating',
    'release_date',
    'price',
  ];
  public function schedules()
  {
    return $this->hasMany(Schedules::class, 'id_movie');
  }
}
