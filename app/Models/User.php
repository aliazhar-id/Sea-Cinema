<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  protected $guarded = ['id_user'];
  protected $primaryKey = 'id_user';

  protected $hidden = [
    'password',
    // 'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  public function getRouteKeyName()
  {
    return 'username';
  }

  public function topUps()
  {
    return $this->hasMany(TopUp::class, 'id_user');
  }
}
