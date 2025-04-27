<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BookingController;

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Auth routes (Breeze / Jetstream / Fortify)
require __DIR__ . '/auth.php';

// Group all authenticated routes
Route::middleware(['auth'])->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Car and Room resource controllers
     Route::resource('cars', CarController::class);
     Route::resource('rooms', RoomController::class);

    // Route::get('cars', [CarController::class, 'index'])->name('allcars');
    // Route::get('rooms', [RoomController::class, 'index'])->name('allrooms');

    // Booking routes
    Route::get('/book/car/{car}', [BookingController::class, 'bookCar'])->name('book.car');
    //Route::post('/book/car/{car}', [BookingController::class, 'storeCarBooking'])->name('booking.car.store');

    Route::get('/book/room/{room}', [BookingController::class, 'bookRoom'])->name('book.room');
    //Route::post('/book/room/{room}', [BookingController::class, 'storeRoomBooking'])->name('booking.room.store');

    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');

    // Payment routes
    Route::post('/pay', [BookingController::class, 'pay'])->name('payment.pay');
    Route::get('/payments', [BookingController::class, 'listPayments'])->name('payments.index');
});

use App\Http\Controllers\RazorpayController;

Route::post('/razorpay/checkout', [RazorpayController::class, 'checkout'])->name('razorpay.checkout');
Route::post('/razorpay/payment-success', [RazorpayController::class, 'paymentSuccess'])->name('razorpay.payment.success');
