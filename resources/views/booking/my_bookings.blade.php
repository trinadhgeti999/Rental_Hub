@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/my_bookings.css') }}">
@endpush

@section('content')
    <div class="container mt-4">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">My Bookings</h2>

        @if($bookings->isEmpty())
            <p>You have no bookings yet.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered bg-white">
                    <thead class="thead-light">
                        <tr>
                            <th>Type</th>
                            <th>Item</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Amount Paid (₹)</th>
                            <th>Booked On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->car ? 'Car' : 'Room' }}</td>
                                <td>
                                    @if($booking->car)
                                        {{ $booking->car->brand }} - {{ $booking->car->model }}
                                    @elseif($booking->room)
                                        {{ $booking->room->name }}
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($booking->start_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}</td>
                                <td>₹{{ number_format($booking->amount, 2) }}</td>
                                <td>{{ $booking->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
