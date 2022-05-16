<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replay extends Model
{

    protected $fillable = [
        'content'
    ];


    public function reviews() {

        return $this->belongsTo('App\Models\Reviews');
    }

    public function products() {

        return $this->belongsTo('App\Models\Products');
    }
    use HasFactory;
}
