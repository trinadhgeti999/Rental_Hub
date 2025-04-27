@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">My Payments</h2>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Type</th>
                <th>Item</th>
                <th>Amount</th>
                <th>Method</th>
                <th>Paid At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->car_id ? 'Car' : 'Room' }}</td>
                    <td>
                        @if($payment->car_id)
                            {{ optional($payment->car)->brand ?? 'N/A' }}
                        @else
                            {{ optional($payment->room)->name ?? 'N/A' }}
                        @endif
                    </td>
                    <td>₹{{ number_format($payment->amount, 2) }}</td>
                    <td>{{ ucfirst($payment->payment_method) }}</td>
                    <td>{{ $payment->paid_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
