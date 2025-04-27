<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    // Define the fillable fields for mass assignment
    protected $fillable = [
        'user_id', 
        'owner_id', 
        'brand', 
        'model', 
        'year', 
        'price_per_day', 
        'description',
        'image',
    ];

    // Define the relationship with the User model for owner
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
