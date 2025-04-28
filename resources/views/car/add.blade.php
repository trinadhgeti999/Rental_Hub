@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/car_add.css') }}">
@endpush


@section('content')
    <div class="container mt-4">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Add New Car
        </h2>

        <form method="POST" action="{{ route('cars.store') }}">
            @csrf

            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" name="brand" id="brand" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" name="model" id="model" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Year</label>
                <input type="number" name="year" id="year" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="price_per_day" class="form-label">Price per Day (₹)</label>
                <input type="number" name="price_per_day" id="price_per_day" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                    <label for="image">Image URL</label>
                    <input type="text" name="image" id="image" class="input-field">
                </div>

            <div class="mb-3">
                <label for="owner_id" class="form-label">Select Owner</label>
                <select name="owner_id" id="owner_id" class="form-control">
                    <option value="">Select Owner (Optional)</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ auth()->id() === $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">If no owner is selected, your account will be set as the default owner.</small>
            </div>

            <button type="submit" class="btn btn-success">Add Car</button>
        </form>
    </div>
@endsection
