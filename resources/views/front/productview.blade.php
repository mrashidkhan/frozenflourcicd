@extends('front.layout.layout')

@section('content')


    <main>


        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container" style="margin-top: 200px;">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('shop') }}">Shop</a></li>
                        <li class="breadcrumb-item"><strong>{{ $product->product_name }}</strong></li>
                    </ol>
                </div>
            </div>
        </section>

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

        <section class="section-7 pt-3 mb-3">
            <div class="container">
                <div class="row ">
                    <div class="col-md-5">
                        {{-- <div id="product-carousel" class="carousel slide" data-bs-ride="carousel" style="height: 400px;">
                            <!-- Set fixed height for the carousel -->
                            <div class="carousel-inner bg-light" style="height: 100%;">
                                <div class="carousel-item active" style="height: 100%;">
                                    <img class="d-block w-100" src="{{ asset('uploads/' . $product->image_url) }}"
                                        alt="Image" style="height: 100%; object-fit: cover;">
                                    <!-- Maintain aspect ratio -->
                                </div>
                                <div class="carousel-item" style="height: 100%;">
                                    <img class="d-block w-100" src="{{ asset('uploads/' . $product->image_url) }}"
                                        alt="Image" style="height: 100%; object-fit: cover;">
                                    <!-- Maintain aspect ratio -->
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                                <i class="fa fa-2x fa-angle-left text-dark"></i>
                            </a>
                            <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                                <i class="fa fa-2x fa-angle-right text-dark"></i>
                            </a>
                        </div> --}}

                        <div id="product-carousel" class="carousel slide" data-bs-ride="carousel" style="height: 400px;">
                            <!-- Set fixed height for the carousel -->
                            <div class="carousel-inner bg-light" style="height: 100%;">
                                @foreach ($product->images as $index => $image)
                                    <div class="carousel-item @if ($index === 0) active @endif" style="height: 100%;">
                                        <img class="d-block w-100" src="{{ asset('uploads/' . $image->image_url) }}" alt="Image" style="height: 100%; object-fit: cover;">
                                        <!-- Maintain aspect ratio -->
                                    </div>
                                @endforeach
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
                            <h1>{{ $product->product_name }}</h1>
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


                            <div class="price-selection">
                                <form action="{{ route('handleProductSelection', $product->id) }}" method="POST">
                                    @csrf

                                    <div class="product-options">
                                        <h3>Select the Product: </h3>

                                        <!-- Discounts -->
                                        @foreach ($product->discounts as $discount)
                                            <div class="form-check border border-dark p-3 mb-2 ml-5 mr-5 discount-option" style="border-radius: 5px;">
                                                <input class="form-check-input" type="radio" name="weight" id="quantity{{ $loop->index }}"
                                                       value="{{ $discount->weight }}" {{ $loop->first ? 'checked' : '' }}
                                                       onclick="document.getElementById('selected_discount_id').value = '{{ $discount->id }}';">
                                                <label class="form-check-label" for="quantity{{ $loop->index }}">
                                                    {{ number_format($discount->weight, 0) }} Gram -
                                                    <span class="discounted-rate" style="font-size: 1.2em; font-weight: bold;">Rs {{ number_format($discount->discounted_price, 2) }}</span>
                                                </label>
                                                <div class="stock-message" style="font-size: 0.9em; color: #dc3545;">
                                                    Only {{ $product->stock }} limited stock |
                                                    <span class="original-price" style="text-decoration: line-through; color: #6c757d;">
                                                        Rs {{ number_format($discount->original_price, 2) }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Hidden input to store the selected discount ID -->
                                    <input type="hidden" name="discount_id" id="selected_discount_id" value="{{ $product->discounts->first()->id }}">

                                    <button type="submit" class="btn btn-dark mt-3 ml-5" name="action" value="add_to_cart">Add to Cart</button>
                                    {{-- <button type="submit" class="btn btn-dark mt-3 ml-5" name="action" value="purchase_now">Buy Now</button> --}}

                                    <a class="btn btn-dark mt-3 ml-5" href="https://wa.me/923047671316" target="_blank" style="background-color: #198754; border: none; color: white; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; border-radius: 5px; cursor: pointer;">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="20" height="20" style="vertical-align: middle; margin-right: 8px;">
                                        Chat on WhatsApp
                                    </a>
                                </form>
                            </div>


                        </div>
                    </div>
                    <div class="product-details">
                        <h1>{{ $product->name }}</h1> <!-- Display the product name -->

                        <div class="product-description">
                            <h2>Description</h2>
                            {!! $product->description !!} <!-- Display the product description with HTML rendering -->
                        </div>

                        <!-- Additional product details can go here -->
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
        {{-- <div container bg-white p-6>
            <section class="pt-5 section-8">
                <div class="container">
                    <div class="section-title text-center mb-4">
                        <h2 class="text-warning">Related Products</h2>
                        <h6 class="text-success">Check out these similar items you might like.</h6>
                    </div>

                    <div class="carousel-inner">
                        @foreach ($related_products->chunk(3) as $index => $product_chunk)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="row justify-content-center">
                                    @foreach ($product_chunk as $related_product)
                                        <div class="col-md-4">
                                            <div class="card product-card shadow-sm border-0">
                                                <div class="product-image position-relative">
                                                    <a href="#" class="product-img">
                                                        <img class="card-img-top"
                                                            src="{{ asset('uploads/' . $related_product->image) }}"
                                                            alt="{{ $related_product->name }}">
                                                    </a>
                                                    <a class="whishlist position-absolute top-0 end-0 p-3" href="#">
                                                        <i class="far fa-heart text-danger"></i>
                                                    </a>
                                                    <div
                                                        class="product-action position-absolute bottom-0 start-0 w-100 p-3">
                                                        <a class="btn btn-warning txt-success w-100" href="#"><i
                                                                class="fa fa-shopping-cart"></i> Add To Cart</a>
                                                    </div>
                                                </div>
                                                <div class="card-body text-center">
                                                    <h5 class="card-title">{{ $related_product->name }}</h5>
                                                    <p class="card-text text-success">
                                                        Rs.{{ number_format($related_product->price) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>



                </div>
        </div> --}}
        </section>
        </div>
        <!-- Bootstrap JS (include this if not already added) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

        <!-- JavaScript to handle border highlighting -->
        <script>
            document.querySelectorAll('input[name="quantity"]').forEach(function(radio) {
                radio.addEventListener('change', function() {
                    // Remove highlight from all options
                    document.querySelectorAll('.discount-option').forEach(function(option) {
                        option.style.borderColor = 'black'; // Reset to default border color
                    });

                    // Highlight the selected option
                    if (this.checked) {
                        this.closest('.discount-option').style.borderColor = '#3CB815'; // Highlight color
                    }
                });
            });
        </script>

    </main>
@endsection
