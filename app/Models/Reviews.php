<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = [
        'review'
    ];

    public function products() {
        return $this->belongsTo('App\Models\Products');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function replay() {

        return $this->hasMany('App\Models\Replay');
    }

 

    use HasFactory;
}
