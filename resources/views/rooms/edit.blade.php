@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/room_edit.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1 class="my-4">Edit Room</h1>
        <form action="{{ route('rooms.update', $room) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Room Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $room->name) }}" required>
            </div>
            <div class="form-group">
                <label for="price_per_night">Price Per night</label>
                <input type="number" name="price_per_night" id="price_per_night" class="form-control" value="{{ old('price_per_night', $room->price_per_night) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $room->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="image_url">Image URL</label>
                <input type="text" name="image_url" id="image_url" class="form-control" value="{{ old('image_url', $room->image_url) }}">
            </div>
            <button type="submit" class="btn btn-warning mt-3">Update Room</button>
        </form>
    </div>
@endsection
