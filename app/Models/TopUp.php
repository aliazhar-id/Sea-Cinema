<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopUp extends Model
{
  use HasFactory, HasUlids;

  protected $primaryKey = 'id_topup';
  protected $guarded = [];

  public function user()
  {
    return $this->belongsTo(User::class, 'id_user');
  }

  public function admin()
  {
    return $this->belongsTo(User::class, 'id_admin');
  }
}
