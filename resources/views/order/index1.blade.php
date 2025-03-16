@extends('front.layout.layout')


@section('content')
<div class="container">
    <h1>My Orders</h1>

    @if($orders->isEmpty())
        <p>You have no orders yet.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Billing Address</th>
                    <th>Payment Method</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->billing_address }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>${{ $order->grand_total }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('order.show', $order->id) }}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection



