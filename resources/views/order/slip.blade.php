<!DOCTYPE html>
<html>
<head>
    <title>Order Slip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .order-details {
            margin-bottom: 20px;
        }
        .order-items {
            width: 100%;
            border-collapse: collapse;
        }
        .order-items th, .order-items td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Order Slip</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Date: {{ $order->created_at->format('Y-m-d') }}</p>
</div>

<div class="order-details">
    <h2>Customer Details</h2>
    <p>Name: {{ $order->customer->first_name }} {{ $order->customer->last_name }}</p>
    <p>Email: {{ $order->customer->email }}</p>
    <p>Shipping Address: {{ $order->shipping_address }}</p>
    <p>Billing Address: {{ $order->billing_address }}</p>
</div>

<h2>Order Items</h2>
<table class="order-items">
    <thead>
        <tr>
            <th>Product</th>
            <th>Weight</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach ($orderItems as $item)
    <tr>
        <td>{{ $item->discount->product->product_name }}</td> <!-- Display product name -->
        <td>{{ $item->discount->weight }}</td> <!-- Display weight from Discount model -->
        <td>{{ $item->quantity }}</td>
        <td>Rs {{ number_format($item->price, 2) }}</td>
        <td>Rs {{ number_format($item->price * $item->quantity, 2) }}</td>
    </tr>
@endforeach
    </tbody>
</table>

<div class="total">
    <p>Grand Total: ${{ number_format($orderItems->sum(function($item) {
        return $item->price * $item->quantity;
    }), 2) }}</p>
</div>

</body>
</html>
