@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/booking_car.css') }}">
@endpush

@section('content')
<div class="container">
    <h1 class="my-4">Book Car: {{ $car->brand }} {{ $car->model }}</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('razorpay.checkout') }}" method="POST" id="booking-form">
        @csrf
        <input type="hidden" name="item_type" value="car">
        <input type="hidden" name="item_id" value="{{ $car->id }}">

        <div class="form-group mb-3">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <input type="hidden" name="amount" id="calculated-amount">

        <div class="alert alert-info" id="total-amount-info" style="display:none;">
            Total Amount: ₹<span id="total-amount"></span> ({{ $car->price_per_day }} per day)
        </div>

        <button type="submit" class="btn btn-success">Pay with Razorpay</button>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
    const pricePerDay = {{ $car->price_per_day }};
    const startInput = document.querySelector('[name="start_date"]');
    const endInput = document.querySelector('[name="end_date"]');
    const amountInput = document.getElementById('calculated-amount');
    const amountInfo = document.getElementById('total-amount-info');
    const totalSpan = document.getElementById('total-amount');

    function calculateAmount() {
        const start = new Date(startInput.value);
        const end = new Date(endInput.value);
        const days = (end - start) / (1000 * 60 * 60 * 24) + 1;

        if (startInput.value && endInput.value && days > 0) {
            const total = pricePerDay * days;
            amountInput.value = total;
            totalSpan.textContent = total.toFixed(2);
            amountInfo.style.display = 'block';
        } else {
            amountInput.value = '';
            amountInfo.style.display = 'none';
        }
    }

    startInput.addEventListener('change', calculateAmount);
    endInput.addEventListener('change', calculateAmount);
</script>
@endsection
