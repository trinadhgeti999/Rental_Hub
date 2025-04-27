<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price_per_night',
        'is_available',
        'user_id',
        'owner_id', 
        'image_url',
    ];

    // Define the relationship with the User model for owner
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
