@extends('front.layout.layout')
@section('content')

{{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif --}}

    <!-- Contact Start -->
    <div class="container-xxl py-6 mt-8" style="margin-top: 100px;">
        <div class="container">
            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">

                <h1 class="display-5 mb-3">Get in Touch with Us!</h1>
                <p>Whether you have a question about our products, your order, or our policies, our support team is just a message away.</p>
            </div>
            <div class="row g-5 justify-content-center">
                <div class="col-lg-5 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="text-white d-flex flex-column justify-content-center h-100 p-5" style="background-color: #7F0000">
                        <h5 class="text-white">Call Us</h5>
                        <p class="mb-3"><i class="fa fa-phone-alt me-3"></i>+92 315 8274326</p>

                        <h5 class="text-white">WhatsApp Us</h5>
                        <a href="https://wa.me/923158274326" target="_blank" class="mb-3" style="display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 5px; background-color: #25D366; color: #fff; text-decoration: none; max-width: 150px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                            <i class="fab fa-whatsapp" style="margin-right: 4px;"></i> Open WhatsApp
                        </a>
                        <h5 class="text-white">Email Us</h5>
                        <p class="mb-3"><i class="fa fa-envelope me-3"></i>sales@frozenflour.com</p>
                        <h5 class="text-white">Office Address</h5>
                        <p class="mb-3"><i class="fa fa-map-marker-alt me-3"></i>172/Y/2 PECHS Karachi </p>
                        <h5 class="text-white">Follow Us</h5>
                        <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="https://x.com"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="https://youtube.com"><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href="https://www.tiktok.com"><i class="fab fa-tiktok"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-0 ml-2" href="https://wa.me/923158274326?text=Welcome to %20Pattoki%20Naturals!%20I%20am%20interested%20in%20your%20products."target="_blank"><i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <p class="mb-4" text-blue> <h3><strong>Contact Us for Any Assistance!</h3></p>
                        <form action="{{ route('send.email') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required>
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" required>
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea name="message" class="form-control" placeholder="Leave a message here" id="message" style="height: 200px" required></textarea>
                                        <label for="message">Message</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn rounded-pill py-3 px-5" type="submit" style="background-color: #7F0000; color: #fff; border: none;">
                                        Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


@endsection
