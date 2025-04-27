<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Car;
use App\Models\Room;
use Carbon\Carbon;

class RazorpayController extends Controller
{
    public function checkout(Request $request)
{
    $request->validate([
        'item_type' => 'required|in:car,room',
        'item_id' => 'required|integer',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $startDate = Carbon::parse($request->start_date);
    $endDate = Carbon::parse($request->end_date);
    $days = $startDate->diffInDays($endDate) + 1;

    $amount = 0;

    if ($request->item_type === 'car') {
        $car = Car::findOrFail($request->item_id);

        // Check for overlapping bookings
        $conflict = Payment::where('car_id', $car->id)
            ->where(function ($query) use ($request) {
                $query->where('start_date', '<=', $request->end_date)
                      ->where('end_date', '>=', $request->start_date);
            })->first();

        if ($conflict) {
            $conflictStart = Carbon::parse($conflict->start_date)->format('F j, Y');
            $conflictEnd = Carbon::parse($conflict->end_date)->format('F j, Y');
            return back()->withErrors([
                "This car is already booked from $conflictStart to $conflictEnd. Please select different dates."
            ]);
        }

        $amount = $car->price_per_day * $days;

    } elseif ($request->item_type === 'room') {
        $room = Room::findOrFail($request->item_id);

        // Check for overlapping bookings
        $conflict = Payment::where('room_id', $room->id)
            ->where(function ($query) use ($request) {
                $query->where('start_date', '<=', $request->end_date)
                      ->where('end_date', '>=', $request->start_date);
            })->first();

        if ($conflict) {
            $conflictStart = Carbon::parse($conflict->start_date)->format('F j, Y');
            $conflictEnd = Carbon::parse($conflict->end_date)->format('F j, Y');
            return back()->withErrors([
                "This room is already booked from $conflictStart to $conflictEnd. Please select different dates."
            ]);
        }

        $amount = $room->price_per_night * $days;
    }

    // Create Razorpay order
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    $razorpayOrder = $api->order->create([
        'receipt' => 'RZP_' . uniqid(),
        'amount' => $amount * 100,
        'currency' => 'INR',
    ]);

    return view('payments.razorpay', [
        'order_id' => $razorpayOrder['id'],
        'amount' => $amount,
        'item_type' => $request->item_type,
        'item_id' => $request->item_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);
}



    public function paymentSuccess(Request $request)
    {
        // Save payment after success
        $data = [
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'payment_method' => 'razorpay',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'paid_at' => now(),
        ];

        if ($request->item_type === 'car') {
            $data['car_id'] = $request->item_id;
        } elseif ($request->item_type === 'room') {
            $data['room_id'] = $request->item_id;
        }

        Payment::create($data);

        return redirect()->route('dashboard')->with('success', 'Payment done via Razorpay!');
    }
}
