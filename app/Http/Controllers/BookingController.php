<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Room;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function bookRoom(Room $room)
    {
        return view('booking.room', compact('room'));
    }

    public function bookCar(Car $car)
    {
        return view('booking.car', compact('car'));
    }

//     public function storeCarBooking(Request $request, Car $car)
// {
//     $request->validate([
//         'start_date' => 'required|date|after_or_equal:today',
//         'end_date' => 'required|date|after:start_date',
//         'payment_method' => 'required|string',
//     ]);

//     $conflict = Payment::where('car_id', $car->id)
//         ->where(function ($query) use ($request) {
//             $query->where('start_date', '<=', $request->end_date)
//                   ->where('end_date', '>=', $request->start_date);
//         })->first();

//     if ($conflict) {
//         $conflictStart = Carbon::parse($conflict->start_date)->format('F j, Y');
//         $conflictEnd = Carbon::parse($conflict->end_date)->format('F j, Y');
//         return back()->withErrors([
//             "This car is already booked from $conflictStart to $conflictEnd. Please select different dates."
//         ]);
//     }

//     $days = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date)) + 1;
//     $totalAmount = $car->price_per_day * $days;

//     return view('payments.checkout', [
//         'item_type' => 'car',
//         'item_id' => $car->id,
//         'amount' => $totalAmount,
//         'payment_method' => $request->payment_method,
//         'start_date' => $request->start_date,
//         'end_date' => $request->end_date,
//     ]);
// }

// public function storeRoomBooking(Request $request, Room $room)
// {
//     $request->validate([
//         'start_date' => 'required|date|after_or_equal:today',
//         'end_date' => 'required|date|after:start_date',
//         'payment_method' => 'required|string',
//     ]);

//     $conflict = Payment::where('room_id', $room->id)
//         ->where(function ($query) use ($request) {
//             $query->where('start_date', '<=', $request->end_date)
//                   ->where('end_date', '>=', $request->start_date);
//         })->first();

//     if ($conflict) {
//         $conflictStart = Carbon::parse($conflict->start_date)->format('F j, Y');
//         $conflictEnd = Carbon::parse($conflict->end_date)->format('F j, Y');
//         return back()->withErrors([
//             "This room is already booked from $conflictStart to $conflictEnd. Please select different dates."
//         ]);
//     }

//     $nights = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date)) + 1;
//     $totalAmount = $room->price_per_night * $nights;

//     return view('payments.checkout', [
//         'item_type' => 'room',
//         'item_id' => $room->id,
//         'amount' => $totalAmount,
//         'payment_method' => $request->payment_method,
//         'start_date' => $request->start_date,
//         'end_date' => $request->end_date,
//     ]);
// }


    public function pay(Request $request)
    {
        $request->validate([
            'item_type' => 'required|in:car,room',
            'item_id' => 'required|integer',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $totalAmount = $request->amount;
        $adminCommission = $totalAmount * 0.10;
        $ownerEarnings = $totalAmount - $adminCommission;

        $data = [
            'user_id' => Auth::id(),
            'amount' => $totalAmount,
            'payment_method' => $request->payment_method,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'paid_at' => now(),
        ];

        if ($request->item_type === 'car') {
            $car = Car::findOrFail($request->item_id);
            $data['car_id'] = $car->id;
        } elseif ($request->item_type === 'room') {
            $room = Room::findOrFail($request->item_id);
            $data['room_id'] = $room->id;
        }

        Payment::create($data);

        return redirect()->route('dashboard')->with('success', 'Payment Successful!');
    }

    public function listPayments()
    {
        $user = Auth::user();

        $payments = $user->role === 'admin'
            ? Payment::with('car', 'room', 'user')->orderByDesc('paid_at')->get()
            : $user->payments()->with('car', 'room')->orderByDesc('paid_at')->get();

        return view('payments.index', compact('payments'));
    }

    public function myBookings()
    {
        $user = Auth::user();

        $bookings = Payment::with(['car', 'room'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('booking.my_bookings', compact('bookings'));
    }
}
