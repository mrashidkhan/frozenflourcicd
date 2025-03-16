@extends('admin.layout.layout')

@section('content')

<div class="container">
    <h1>Edit Coupon</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- This is important for PUT requests -->

        <div class="form-group">
            <label for="coupon_name">Coupon Name</label>
            <input type="text" name="coupon_name" id="coupon_name" class="form-control" value="{{ old('coupon_name', $coupon->coupon_name) }}" required>
        </div>

        <div class="form-group">
            <label for="coupon_discount">Coupon Discount (in Rs)</label>
            <input type="number" name="coupon_discount" id="coupon_discount" class="form-control" step="0.01" value="{{ old('coupon_discount', $coupon->coupon_discount) }}" required>
        </div>

        <div class="form-group">
            <label for="coupon_start_date">Start Date</label>
            <input type="date" name="coupon_start_date" id="coupon_start_date" class="form-control" value="{{ old('coupon_start_date', $coupon->coupon_start_date) }}" required>
        </div>

        <div class="form-group">
            <label for="coupon_end_date">End Date</label>
            <input type="date" name="coupon_end_date" id="coupon_end_date" class="form-control" value="{{ old('coupon_end_date', $coupon->coupon_end_date) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Coupon</button>
        <a href="{{ route('coupon.list') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
