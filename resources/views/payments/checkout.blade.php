@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Confirm Payment</h2>

    <form action="{{ route('payment.pay') }}" method="POST">
        @csrf
        <input type="hidden" name="item_type" value="{{ $item_type }}">
        <input type="hidden" name="item_id" value="{{ $item_id }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="payment_method" value="{{ $payment_method }}">
        <input type="hidden" name="start_date" value="{{ $start_date }}">
        <input type="hidden" name="end_date" value="{{ $end_date }}">

        <p><strong>Amount:</strong> ₹{{ number_format($amount, 2) }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst($payment_method) }}</p>
        <p><strong>Booking From:</strong> {{ $start_date }}</p>
        <p><strong>Booking To:</strong> {{ $end_date }}</p>

        <button type="submit" class="btn btn-success">Confirm and Pay</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
