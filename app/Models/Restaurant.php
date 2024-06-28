<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

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
}
