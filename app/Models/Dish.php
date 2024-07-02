<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description_ingredients',
        'price',
        'visible',
        'thumb',
        'slug',
        'restaurant_id'
    ];

    // Many-to-many
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    // One-to-many
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
