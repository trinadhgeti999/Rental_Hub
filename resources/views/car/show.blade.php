@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/car_show.css') }}">
@endpush

@section('content')
    <div class="container mt-4">
        <div class="car-details">
            <h1 class="car-title">{{ $car->brand }} {{ $car->model }}</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="car-image">
                        <img src="{{ $car->image }}" class="img-fluid" alt="{{ $car->brand }} {{ $car->model }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="car-info">
                       {{-- <h3>₹{{ number_format($car->price_per_day, 2) }} per day</h3>
                        <p><strong>Year:</strong> {{ $car->year }}</p>
                        <p><strong>Description:</strong> {{ $car->description }}</p>
                        <p><strong>Added by User ID:</strong> {{ $car->user_id }}</p> --}}

                        @if(auth()->user()->role === 'admin' || auth()->user()->id === $car->owner_id)
                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="d-inline">
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
