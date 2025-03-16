@extends('front.layout.layout')

@section('content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container" style="margin-top: 200px;">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="{{route('shop')}}">Shop</a></li>
                    <li class="breadcrumb-item"><strong>{{$product->ProductDetails->title}}</strong></li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-7 pt-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-5">
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light">
                            <div class="carousel-item">
                                <img class="w-100 h-100" src="{{asset('uploads/'.$product->image)}}" alt="Image">
                            </div>
                            <div class="carousel-item active">
                                <img class="w-100 h-100" src="{{asset('uploads/'.$product->image)}}" alt="Image">
                            </div>

                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="bg-light right">
                        <h1>{{$product->ProductDetails->title}}</h1>
                        <div class="d-flex mb-3">
                            <div class="text-primary mr-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star-half-alt"></small>
                                <small class="far fa-star"></small>
                            </div>
                            <small class="pt-1">(99 Reviews)</small>
                        </div>

                        <h2 class="price text-danger ">Rs.{{number_format($product->price)}}</h2>

                        <p>{{$product->ProductDetails->description}}.</p>
                        <a href="cart.php" class="btn btn-dark"><i class="fas fa-shopping-cart"></i> &nbsp;ADD TO CART</a>
                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="bg-light">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div container bg-white p-6>
<section class="pt-5 section-8">
    <div class="container">
        <div class="section-title text-center mb-4">
            <h2 class="text-warning">Related Products</h2>
            <h6 class="text-success">Check out these similar items you might like.</h6>
        </div>

<div class="carousel-inner">
    @foreach($related_products->chunk(3) as $index => $product_chunk)
    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
        <div class="row justify-content-center">
            @foreach($product_chunk as $related_product)
            <div class="col-md-4">
                <div class="card product-card shadow-sm border-0">
                    <div class="product-image position-relative">
                        <a href="#" class="product-img">
                            <img class="card-img-top" src="{{ asset('uploads/' . $related_product->image) }}" alt="{{ $related_product->name }}">
                        </a>
                        <a class="whishlist position-absolute top-0 end-0 p-3" href="#">
                            <i class="far fa-heart text-danger"></i>
                        </a>
                        <div class="product-action position-absolute bottom-0 start-0 w-100 p-3">
                            <a class="btn btn-warning txt-success w-100" href="#"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $related_product->name }}</h5>
                        <p class="card-text text-success">Rs.{{ number_format($related_product->price) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endforeach
</div>



        </div>
    </div>
</section>
</div>
<!-- Bootstrap JS (include this if not already added) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</main>

@endsection
