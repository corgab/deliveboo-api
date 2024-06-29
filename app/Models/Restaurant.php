<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    public function orders(){
        return $this->hasMany(Order::class);
    }

    protected $fillable = [
        'name',
        'slug',
        'address',
        'vat',
        'thumb',
    ];
    
    // Many-to-many
    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    // One-to-one
    public function user()
    {
        return $this->hasOne(User::class);
    }

    // One-to-many
    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}
