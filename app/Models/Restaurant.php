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
        'thumb'
    ];
}
