@extends('front.layout.layout')

{{-- @section('slider')
<div id="carouselExampleDark" class="carousel carousel-dark slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="container-fluid p-0">
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="10000">
        <img id="carousel-img-1" src="img/caraousel-1.png" class="d-block w-100" alt="..." style="max-width: 100%; height: auto;">
      </div>
      <div class="carousel-item" data-bs-interval="2000">
        <img id="carousel-img-2" src="img/carousel-2.png" class="d-block w-100" alt="..." style="max-width: 100%; height: auto;">
      </div>
    </div>
  </div>


  <style>

    #carousel-img-1, #carousel-img-2 {
      max-width: 100%;
      height: auto;
    }


    @media (max-width: 768px) {
      .carousel-inner {
        margin-top: 50px; /* Increased margin-top for small screens */
      }

      #carousel-img-1, #carousel-img-2 {
        height: 250px; /* Adjust image height for mobile */
      }
    }

    @media (min-width: 769px) and (max-width: 992px) {
      .carousel-inner {
        margin-top: 70px; /* Adjust margin-top for tablets */
      }

      #carousel-img-1, #carousel-img-2 {
        height: 350px; /* Adjust image height for tablets */
      }
    }

    @media (min-width: 993px) {
      .carousel-inner {
        margin-top: 0; /* No extra margin for large screens */
      }

      #carousel-img-1, #carousel-img-2 {
        height: 500px; /* Adjust image height for larger screens */
      }
    }
  </style>
  <script>
    // No additional JavaScript required for responsive behavior
  </script>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
@endsection --}}

@section('slider')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="5000">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="container-fluid p-0">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img id="carousel-img-1" src="{{ asset('img/caraousel-1.png') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img id="carousel-img-2" src="{{ asset('img/carousel-1.jpg') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img id="carousel-img-3" src="{{ asset('img/carousel-3.png') }}" class="d-block w-100" alt="...">
        </div>
    </div>
  </div>

  <style>
    #carousel-img-1, #carousel-img-2, #carousel-img-3 {
      max-width: 100%;
      height: auto;
    }

    @media (max-width: 768px) {
      .carousel-inner {
        margin-top: 50px; /* Increased margin-top for small screens */
      }

      #carousel-img-1, #carousel-img-2, #carousel-img-3 {
        height: 250px; /* Adjust image height for mobile */
      }
    }

    @media (min-width: 769px) and (max-width: 992px) {
      .carousel-inner {
        margin-top: 70px; /* Adjust margin-top for tablets */
      }

      #carousel-img-1, #carousel-img-2, #carousel-img-3 {
        height: 350px; /* Adjust image height for tablets */
      }
    }

    @media (min-width: 993px) {
      .carousel-inner {
        margin-top: 0; /* No extra margin for large screens */
      }

      #carousel-img-1, #carousel-img-2, #carousel-img-3 {
        height: 500px; /* Adjust image height for larger screens */
      }
    }
  </style>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
@endsection

@section('content')
<!-- Blog Start -->
<div class="container-xl py-5" style="margin-top: 1px;"> <!-- Adjusted top margin -->
  <div class="section-header text-center mx-auto mb-5 mt-100 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
    <h1 class="display-6 mb-2 text-success"><i>Featured Products</i></h1>
  </div>

  @php $i = 0; @endphp
  @foreach($products->chunk(4) as $product)
    <div class="row g-4 mb-4 @if($i == 0) active @endif">
      @php $i = 1; @endphp
      @foreach($product as $value)
        <div class="col-lg-3 col-md-6 col-12 wow fadeInUp" data-wow-delay="0.1s">
          <a href="{{ route('productview', $value->id) }}">
            <img class="img-fluid" src="{{ asset('uploads/'.$value->image) }}" alt="" style="width: 100%; height: 200px; object-fit: cover;">
            <div class="bg-light p-4">
              <a class="d-block h5 lh-base mb-4" href="{{ route('productview', $value->id) }}">{{ $value->name }}</a>
              <i class="fa fa-tag text-primary me-2"></i><small class="text-dark">Rs. {{ number_format($value->price) }}</small>
              <i class="fa fa-calendar text-primary me-2"></i><small>{{ $value->updated_at->format('d M Y') }}</small>
              <div class="text-muted border-top pt-4">
                <div class="d-flex border-top">
                  <small class="w-50 text-center border-end py-2">
                    <a class="text-body" href="{{ route('productview', $value->id) }}">
                      <i class="fa fa-eye text-secondary me-2"></i>Details
                    </a>
                  </small>
                  <small class="w-50 text-center py-2">
                    <a class="text-body" href="#">
                      <i class="fa fa-shopping-bag text-secondary me-2"></i>Add to cart
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
    <a class="btn btn-primary rounded-pill py-3 px-5" href="#">Load More</a>
  </div>
</div>
<!-- Blog End -->
@endsection

@section('navbar')
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Brand</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- Navbar End -->
@endsection
