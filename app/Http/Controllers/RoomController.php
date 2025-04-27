<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->role === 'admin' || $user->role === 'owner') {
            $users = User::all();  
            return view('rooms.create', compact('users'));
        }

        abort(403, 'Only Admin or Owner can add rooms.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price_per_night' => 'required|numeric',
            'description' => 'nullable',
            'image_url' => 'nullable|url', 
        ]);

        Room::create([
            'user_id' => Auth::id(),  
            'owner_id' => $request->owner_id ?? Auth::id(), 
            'name' => $request->name,
            'price_per_night' => $request->price_per_night,
            'description' => $request->description,
            'image_url' => $request->image_url,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room added successfully!');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        $user = auth()->user();
        if ($user->role === 'admin' || $user->id === $room->user_id) {
            return view('rooms.edit', compact('room'));
        }

        abort(403, 'Unauthorized');
    }

    public function update(Request $request, Room $room)
    {
        if (auth()->user()->id !== $room->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_night' => 'required|numeric',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url', 
        ]);

        $room->update([
            'name' => $request->name,
            'price_per_night' => $request->price_per_night,
            'description' => $request->description,
            'image_url' => $request->image_url,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully!');
    }

    public function destroy(Room $room)
    {
        $user = auth()->user();

        if ($user->role !== 'admin' && $user->id !== $room->user_id) {
            abort(403, 'Unauthorized action.');
        }

        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully!');
    }
}
