<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    // Many-to-many
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
