<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Room;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Admin Dashboard
        if ($user->isAdmin()) {
            $totalUsers = User::count();
            $totalCars = Car::count();
            $totalRooms = Room::count();
            $totalPayments = Payment::sum('amount');
            $adminCommission = $totalPayments * 0.10; 

            return view('dashboard', compact(
                'user',
                'totalUsers',
                'totalCars',
                'totalRooms',
                'totalPayments',
                'adminCommission'
            ));
        }

        // Owner Dashboard
        if ($user->isOwner()) {
            $myCars = Car::where('owner_id', $user->id)->count();
            $myRooms = Room::where('owner_id', $user->id)->count();

            $myEarnings = Payment::whereHas('car', function ($query) use ($user) {
                    $query->where('owner_id', $user->id);
                })
                ->orWhereHas('room', function ($query) use ($user) {
                    $query->where('owner_id', $user->id);
                })
                ->sum('amount') * 0.90; 

            $carEarnings = Payment::whereHas('car', fn($q) => $q->where('owner_id', $user->id))
                ->with('car')
                ->get()
                ->groupBy('car_id');

            $roomEarnings = Payment::whereHas('room', fn($q) => $q->where('owner_id', $user->id))
                ->with('room')
                ->get()
                ->groupBy('room_id');

            return view('dashboard', compact(
                'user',
                'myCars',
                'myRooms',
                'myEarnings',
                'carEarnings',
                'roomEarnings'
            ));
        }

        // Renter Dashboard
        return view('dashboard', compact('user'));
    }
}
