@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->product_name }}</h1>
    <p>{{ $product->description }}</p>
    <p>Price: ${{ $product->base_price }}</p>

    <form action="{{ route('cart.add', $product->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" required>
        </div>
        <button type="submit" class="btn btn-success">Add to Cart</button>
    </form>
</div>
@endsection
