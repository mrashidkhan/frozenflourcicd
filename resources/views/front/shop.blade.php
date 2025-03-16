@extends('front.layout.layout')
@section('content')

<!-- Product Start -->
<div class="container-xxl py-6" style="margin-top: 100px;">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success"
                style="color: black; background-color: #d4edda; border: 1px solid #c3e6cb; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger"
                style="color: black; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                <ul style="list-style-type: none; padding-left: 0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row g-0 gx-5 align-items-end">
            <!-- Section Header -->
            <div class="col-lg-12 text-center">
                <div class="section-header" style="max-width: 500px; margin: 0 auto;">
                    <h6 class="display-5 mb-3 text-dark">Our Brands</h6>
                </div>
            </div>
            <!-- Tabs (Commented Out) -->
            {{-- <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">

                </ul>
            </div> --}}
        </div>
    </div>
</div>
<!-- Products Grid -->
<div class="row">
    @foreach($products as $value)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <a href="{{ route('productview', $value->id) }}">
                <div class="position-relative">
                    {{-- <img class="card-img-top" src="{{ asset('uploads/' . $value->image) }}" alt="{{ $value->name }}" style="height: 200px; object-fit: cover;"> --}}
                    @php
                        // Get the first image URL for the product
                        $firstImage = $value->images->first(); // Assuming 'images' is the relationship name
                    @endphp

                    <img class="img-fluid" src="{{ asset('uploads/' . ($firstImage ? $firstImage->image_url : 'default-image.jpg')) }}" alt=""
                                style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="bg-secondary text-white position-absolute top-0 start-0 m-3 py-1 px-3 rounded">New</div>
                </div>
            </a>
            <!-- Product Info -->
            <div class="card-body text-center">
                <h5 class="card-title">
                    <a href="{{ route('productview', $value->id) }}" class="text-dark text-decoration-none">{{ $value->name }}</a>
                </h5>
                <p class="card-text">
                    <span style="color: #7F0000" class="fw-bold">Price: Rs.{{ number_format($value->base_price) }} ( {{ number_format($value->weight) }} pieces ) </span>
                    <!--<span class="text-muted text-decoration-line-through ms-2">{{ $value->original_price }}</span>-->
                </p>
            </div>
            <!-- Product Actions -->
<div class="d-flex border-top bg-dark">
    <small class="w-50 text-center border-end py-2">
        <a class="text-white" href="{{ route('cart.view') }}">
            <i class="fa fa-eye text-success me-2" aria-hidden="true"></i>View Cart
        </a>
    </small>
    <small class="w-50 text-center py-2">
        <form action="{{ route('productview', $value->id) }}" method="GET" class="d-inline">
            <button type="submit" class="btn btn-link text-white p-0">
                <i class="fa fa-shopping-bag text-secondary me-2" aria-hidden="true"></i>Shop Now
            </button>
        </form>
    </small>
</div> <!-- Closing the d-flex div -->
        </div>
    </div>
    @endforeach
    <!-- Browse More Button -->
    <div class="col-12 text-center">
        <a class="btn rounded-pill py-3 px-5" href="{{ route('home') }}" style="background-color: #7F0000; color: #fff; border: none;">
            Browse More Products
        </a>
</div>
</div>



@endsection
