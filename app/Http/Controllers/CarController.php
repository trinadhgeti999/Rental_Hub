<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('car.list', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
    if ($user->role === 'admin' || $user->role === 'owner') {
        $users = User::all(); 
        return view('car.add', compact('users'));
    }

    abort(403, 'Only Admin or Owner can add cars.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|numeric',
            'price_per_day' => 'required|numeric',
            'description' => 'nullable',
            'owner_id' => 'nullable|exists:users,id', 
            'image' => 'nullable|string',
        ]);

        // If no owner is selected, set the logged-in user as the owner
        $ownerId = $request->owner_id ?? Auth::id(); 

        Car::create([
            'user_id' => Auth::id(), 
            'owner_id' => $ownerId,   
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'image' => $request->image,
            'price_per_day' => $request->price_per_day,
            'description' => $request->description,
        ]);

        return redirect()->route('cars.index')->with('success', 'Car added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $user = auth()->user();

        if ($user->role === 'admin' || $user->id === $car->user_id) {
            return view('car.edit', compact('car'));
        }

        abort(403, 'Unauthorized');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        if (auth()->user()->id !== $car->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|numeric',
            'price_per_day' => 'required|numeric',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $car->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'price_per_day' => $request->price_per_day,
            'description' => $request->description,
            'image' => $request->image,
        ]);

        return redirect()->route('cars.index')->with('success', 'Car updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $user = auth()->user();

        if ($user->role !== 'admin' && $user->id !== $car->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully!');
    }
}
