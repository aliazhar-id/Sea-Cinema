<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upcoming extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'id_movie';
    protected $keyType = 'string';
    public $incrementing = false;

    public function scopeFilter($query, array $filters)
    {
      if ($filters['search'] ?? false) {
        $query->when($filters['search'] ?? false, function ($query, $search) {
          return $query->where(function ($query) use ($search) {
            $query->where('title', 'like', "%$search%");
          });
        });
      }
    }
}
