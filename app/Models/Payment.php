<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Payment extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'room_id',
        'amount',
        'payment_method',
        'paid_at',
        'start_date',
        'end_date', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
