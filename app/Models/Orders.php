<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'order',
        'totalPrice', 
        'payment'
    ];

    public function user() {
        
        return $this->belongsTo('App\Models\User');
    }

    use HasFactory;
}
