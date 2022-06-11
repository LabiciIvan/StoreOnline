<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    protected $fillable = [
        'name', 
        'price',
        'stock',
        'description'
    ];

    public function reviews() {
        return $this->hasMany('App\Models\Reviews');
    }

    public function replay() {
        
        return $this->hasMany('App\Models\Replay');
    }

    public function imag() {
        return $this->hasOne('App\Models\Imag');
    }

    use HasFactory;
}
