<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        'image'
    ];

    use HasFactory;

    public function products() {
        
        return $this->belongsTo('App\Models\Products');
    }


    public function url($path) {

        return Storage::url($path);
    }
}

