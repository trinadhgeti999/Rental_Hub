@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/car_edit.css') }}">
@endpush

@section('content')
    <div class="container mt-4">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Edit Car') }}
        </h2>

        <form method="POST" action="{{ route('cars.update', $car->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" name="brand" id="brand" class="form-control" value="{{ $car->brand }}" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" name="model" id="model" class="form-control" value="{{ $car->model }}" required autocomplete="off">
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" name="year" id="year" class="form-control" value="{{ $car->year }}" required>
            </div>

            <div class="mb-3">
                <label for="price_per_day" class="form-label">Price per Day (₹)</label>
                <input type="number" name="price_per_day" id="price_per_day" class="form-control" value="{{ $car->price_per_day }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ $car->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image URL</label>
                <input type="text" name="image" id="image" class="form-control" value="{{ old('image', $car->image) }}" autocomplete="off">
            </div>

            <button type="submit" class="btn btn-success mt-3">Update Car</button>
        </form>
    </div>
@endsection
