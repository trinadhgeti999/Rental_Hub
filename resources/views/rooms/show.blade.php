@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/room_show.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="room-details }}">
            <h1 class="room-title">{{ $room->name }}</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="room-image">
                        <img src="{{ $room->image_url }}" class="img-fluid" alt="{{ $room->name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="room-info">
                        <!-- <h3>₹{{ number_format($room->price_per_night, 2) }} per night</h3>
                        <p>{{ $room->description }}</p> -->
                        
                        @if(auth()->user()->role === 'admin' || auth()->user()->id === $room->user_id)
                            <a href="{{ route('rooms.edit', $room) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
