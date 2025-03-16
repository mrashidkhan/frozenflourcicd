@extends('admin.layout.layout')

@section('content')

<div class="container">
    <h1>Create Coupon</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('coupon.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="coupon_name">Coupon Name</label>
            <input type="text" name="coupon_name" id="coupon_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="coupon_discount">Coupon Discount (in Rs)</label>
            <input type="number" name="coupon_discount" id="coupon_discount" class="form-control" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="coupon_start_date">Start Date</label>
            <input type="date" name="coupon_start_date" id="coupon_start_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="coupon_end_date">End Date</label>
            <input type="date" name="coupon_end_date" id="coupon_end_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Create Coupon</button>
        <a href="{{ route('coupon.list') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
