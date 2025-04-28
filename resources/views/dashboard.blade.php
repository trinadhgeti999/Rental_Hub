
@extends('layouts.app')

@section('scripts')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection

@section('styles')
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection

@section('header')
    <h2 class="page-heading">Dashboard</h2>
@endsection

@section('content')
    <div class="dashboard-wrapper">
        <div class="dashboard-container">

            @if($user->isAdmin())
                <h2 class="dashboard-title">Welcome, Admin!</h2>
                <p class="dashboard-description">Manage cars, rooms, users, and track payments & commissions.</p>
                <div class="dashboard-actions">
    <a href="{{ route('cars.index') }}" class="action-button">Browse Cars</a>
    <a href="{{ route('rooms.index') }}" class="action-button">Browse Rooms</a>
</div>


                <div class="stats-grid">
                    <div class="stat-card blue">
                        <div class="stat-number">{{ $totalUsers }}</div>
                        <div class="stat-label">Users</div>
                    </div>
                    <div class="stat-card green">
                        <div class="stat-number">{{ $totalCars }}</div>
                        <div class="stat-label">Cars</div>
                    </div>
                    <div class="stat-card yellow">
                        <div class="stat-number">{{ $totalRooms }}</div>
                        <div class="stat-label">Rooms</div>
                    </div>
                    <div class="stat-card purple">
                        <div class="stat-number">₹{{ number_format($totalPayments, 2) }}</div>
                        <div class="stat-label">Total Payments</div>
                    </div>
                    <div class="stat-card red">
                        <div class="stat-number">₹{{ number_format($adminCommission, 2) }}</div>
                        <div class="stat-label">Admin Commission</div>
                    </div>
                </div>

            @elseif($user->isOwner())
                <h2 class="dashboard-title">Welcome, Owner!</h2>
                <p class="dashboard-description">View your rental stats and earnings.</p>

                <div class="dashboard-actions">
                    <a href="{{ route('cars.index') }}" class="action-button">Browse Cars</a>
                    <a href="{{ route('rooms.index') }}" class="action-button">Browse Rooms</a>
                </div>

                <div class="stats-grid">
                    <div class="stat-card light">
                        <div class="stat-number">{{ $myCars }}</div>
                        <div class="stat-label">My Cars</div>
                    </div>
                    <div class="stat-card light">
                        <div class="stat-number">{{ $myRooms }}</div>
                        <div class="stat-label">My Rooms</div>
                    </div>
                    <div class="stat-card green">
                        <div class="stat-number">₹{{ number_format($myEarnings, 2) }}</div>
                        <div class="stat-label">My Earnings</div>
                    </div>
                </div>

                @if($carEarnings->count())
                    <h4 class="section-heading">Earnings from Cars</h4>
                    <ul class="earnings-list">
                        @foreach($carEarnings as $carId => $payments)
                            <li>
                                <span>{{ optional($payments->first()->car)->brand ?? 'Unknown Car' }}</span>
                                <strong>₹{{ number_format($payments->sum('amount') * 0.90, 2) }}</strong>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if($roomEarnings->count())
                    <h4 class="section-heading">Earnings from Rooms</h4>
                    <ul class="earnings-list">
                        @foreach($roomEarnings as $roomId => $payments)
                            <li>
                                <span>{{ optional($payments->first()->room)->name ?? 'Unknown Room' }}</span>
                                <strong>₹{{ number_format($payments->sum('amount') * 0.90, 2) }}</strong>
                            </li>
                        @endforeach
                    </ul>
                @endif

            @else
                <h2 class="dashboard-title">Welcome, Renter!</h2>
                <p class="dashboard-description">Browse and book your favorite rides and rooms with ease.</p>
                <div class="dashboard-actions">
                    <a href="{{ route('cars.index') }}" class="action-button">Browse Cars</a>
                    <a href="{{ route('rooms.index') }}" class="action-button">Browse Rooms</a>
                    <a href="{{ route('bookings.my') }}" class="action-button">MyBookings</a>
                </div>

            @endif

        </div>
    </div>
@endsection
