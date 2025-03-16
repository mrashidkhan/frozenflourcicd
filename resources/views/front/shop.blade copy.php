@extends('front.layout.layout')
@section('content')

<!-- Product Start -->
<div class="container-xxl py-6" style="margin-top: 100px;">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <!-- Section Header -->
            <div class="col-lg-6">
                <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h6 class="display-5 mb-3 text-dark">Our Brands</h6>
                </div>
            </div>
            <!-- Tabs (Commented Out) -->
            <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                    <!--
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary border-2 active" data-bs-toggle="pill" href="#tab-1">Vegetable</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-2">Fruits</a>
                    </li>
                    <li class="nav-item me-0">
                        <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-3">Fresh</a>
                    </li>
                    -->
                </ul>
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
                    <img class="img-fluid" src="{{ asset('uploads/' . $value->image_url) }}" alt=""
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
                    <span class="text-primary fw-bold">Rs.{{ number_format($value->base_price) }}</span>
                    <!--<span class="text-muted text-decoration-line-through ms-2">{{ $value->original_price }}</span>-->
                </p>
            </div>
            <!-- Product Actions -->
             <div class="d-flex border-top bg-dark">
                  <small class="w-50 text-center border-end py-2">
                    <a class="text-white" href="{{ route('productview', $value->id) }}">
                      <i class="fa fa-eye text-success me-2"></i>Details
                    </a>
                  </small>
                  <small class="w-50 text-center py-2">
                    <a class="text-white" href="{{ route('productview', $value->id) }}">
                      <i class="fa fa-shopping-bag text-secondary me-2"></i>Add to cart
                    </a>
                  </small>
                </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Browse More Button -->
<div class="col-12 text-center">
    <a class="btn btn-primary rounded-pill py-3 px-5" href="#">Browse More Products</a>
</div>

@endsection
