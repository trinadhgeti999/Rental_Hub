@extends('layouts.app')

@section('content')
    <div class="room-index-wrapper">
        <div class="room-index-header">
            <h1>Room Listings</h1>
            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'owner')
                <a href="{{ route('rooms.create') }}" class="add-room-btn">+ Add New Room</a>
            @endif
        </div>

        <div class="room-grid">
            @foreach ($rooms as $room)
                <div class="room-card">
                    <img src="{{ $room->image_url }}" alt="{{ $room->name }}" class="room-image">
                    <div class="room-content">
                        <h3 class="room-name">{{ $room->name }}</h3>
                        <p class="room-price">₹{{ number_format($room->price_per_night, 2) }} per night</p>
                        <a href="{{ route('rooms.show', $room) }}" class="btn btn-info">View</a>

                        @if(auth()->user()->role === 'admin' || auth()->user()->id === $room->user_id)
                            <a href="{{ route('rooms.edit', $room) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif

                        @if(auth()->user()->role === 'renter')
                            <a href="{{ route('book.room', $room->id) }}" class="btn btn-success mt-2">Book Room</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
