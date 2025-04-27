@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/car_list.css') }}">
@endpush

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'owner')
            <a href="{{ route('cars.create') }}" class="btn mb-4">+ Add New Car</a>
        @endif

        @if($cars->count())
            <div class="grid">
            @foreach($cars as $car)
    <div class="card">
        <div class="card-image">
            <img src="{{ $car->image }}" alt="{{ $car->brand }} {{ $car->model }}" class="car-image">
        </div>
        <h3>{{ $car->brand }} {{ $car->model }}</h3>
        <p><strong>Year:</strong> {{ $car->year }}</p>
        <p><strong>Price/Day:</strong> ₹{{ $car->price_per_day }}</p>
        <p class="description">{{ $car->description }}</p>
        <p><strong>Added by User ID:</strong> {{ $car->user_id }}</p>

        
        <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info btn-sm mt-2">View Details</a>

        @php $user = auth()->user(); @endphp
        @if($user->role === 'admin' || $user->id === $car->user_id)
            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning btn-sm mt-2">Edit</a>

            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="mt-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this car?')">
                    Delete
                </button>
            </form>
        @endif

        @if(auth()->user()->role === 'renter')
            <a href="{{ route('book.car', $car->id) }}" class="btn btn-success mt-2">Book Car</a>
        @endif
    </div>
@endforeach

            </div>
        @else
            <p>No cars found.</p>
        @endif
    </div>
@endsection
