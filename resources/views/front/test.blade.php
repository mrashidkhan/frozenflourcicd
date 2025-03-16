@extends('front.layout.layout')


@section('content')
    <!-- Blog Start -->
    <div class="container-xl py-5" style="margin-top: 5px;"> <!-- Adjusted top margin -->
        <div class="section-header text-center mx-auto mb-5 mt-100 wow fadeInUp" data-wow-delay="0.1s"
            style="max-width: 500px;">
            <h1 style="color: #7F0000" class="display-6 mb-2 "><i>Featured Products</i></h1>
        </div>

        @php $i = 0; @endphp
        @foreach ($products->chunk(4) as $productChunk)
    <div class="row g-4 mb-4 @if ($i == 0) active @endif">
        @php $i = 1; @endphp
        @foreach ($productChunk as $value)
            <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay="0.1s">
                <a href="{{ route('productview', $value->id) }}">
                    @php
                        // Get the first image URL for the product
                        $firstImage = $value->images->first(); // Assuming 'images' is the relationship name
                    @endphp
                    <img class="img-fluid" src="{{ asset('uploads/' . ($firstImage ? $firstImage->image_url : 'default-image.jpg')) }}" alt=""
                        style="width: 100%; height: 200px; object-fit: cover;">
                    <div class="bg-light p-4">
                        <a class="d-block h5 lh-base mb-4"
                            href="{{ route('productview', $value->id) }}">{{ $value->product_name }}</a>
                        <i class="fa fa-tag text-primary me-2"></i><small class="text-dark">Rs.
                            {{ number_format($value->base_price) }} ( {{ number_format($value->weight) }} pieces )</small>
                        <div class="text-muted border-top pt-4">
                            <div class="d-flex border-top">
                                <small class="w-50 text-center border-end py-2">
                                    <a class="text-body" href="{{ route('cart.view') }}">
                                        <i class="fa fa-eye text-secondary me-2"></i>View Cart
                                    </a>
                                </small>
                                <small class="w-50 text-center py-2">
                                    <a class="text-body" href="{{ route('productview', $value->id) }}">
                                        <i class="fa fa-shopping-bag text-secondary me-2"></i>Shop Now
                                    </a>
                                </small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endforeach

        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
            {{-- <a class="btn btn-primary rounded-pill py-3 px-5" href="#">Load More</a> --}}
            <a class="btn rounded-pill py-3 px-5" href="{{ route('shop') }}" style="background-color: #7F0000; color: #fff; border: none;">
                Browse More Products
            </a>
        </div>
    </div>
    <!-- Blog End -->
@endsection
