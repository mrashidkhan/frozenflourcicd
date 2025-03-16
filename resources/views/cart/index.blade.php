<!-- resources/views/cart/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Cart</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (session('cart') && count(session('cart')) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                        @foreach ($cart as $id => $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>Rs{{ number_format($item['price'], 2) }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>Rs{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                </tbody>
            </table>

            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="customer_name">Name:</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="customer_email">Email:</label>
                    <input type="email" name="customer_email" id="customer_email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Checkout</button>
            </form>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
