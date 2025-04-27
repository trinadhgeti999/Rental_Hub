<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Razorpay</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 30px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        #rzp-button {
            background-color: #528FF0;
            color: white;
            padding: 12px 25px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #rzp-button:hover {
            background-color: #3f73c0;
        }
    </style>

</head>
<body>

    <h2>Razorpay Payment</h2>
    <p>Amount to Pay: ₹{{ $amount }}</p>

    <button id="rzp-button">Pay with Razorpay</button>

    <form id="payment-success-form" action="{{ route('razorpay.payment.success') }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="item_type" value="{{ $item_type }}">
        <input type="hidden" name="item_id" value="{{ $item_id }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="start_date" value="{{ $start_date }}">
        <input type="hidden" name="end_date" value="{{ $end_date }}">
    </form>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": "{{ $amount * 100 }}", // converting amount to paise
            "currency": "INR",
            "name": "Rental Management",
            "description": "Payment for booking",
            "order_id": "{{ $order_id }}",
            "handler": function (response) {
                document.getElementById('payment-success-form').submit();
            },
            "prefill": {
                "name": "{{ Auth::user()->name }}",
                "email": "{{ Auth::user()->email }}"
            },
            "theme": {
                "color": "#528FF0"
            }
        };

        var rzp = new Razorpay(options);
        document.getElementById('rzp-button').onclick = function(e) {
            rzp.open();
            e.preventDefault();
        };
    </script>
</body>
</html>
