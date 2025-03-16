@extends('front.layout.layout')
@section('content')

    <!-- Contact Start -->
    <div class="container-xxl py-6 mt-8" style="margin-top: 100px;">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">My Orders</h1>
                {{-- <p>Whether you have a question about our products, your order, or our policies, our support team is just a
                    message away.</p> --}}
            </div>
            <div class="row g-5 justify-content-center">
                <div class="col-lg-5 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-primary text-white d-flex flex-column justify-content-center h-100 p-5">
                        <h5 class="text-white">Call Us</h5>
                        <p class="mb-5"><i class="fa fa-phone-alt me-3"></i>+92 304 76 71 316</p>
                        <h5 class="text-white">Email Us</h5>
                        <p class="mb-5"><i class="fa fa-envelope me-3"></i>pattokinaturals@gmail.com</p>
                        <h5 class="text-white">Office Address</h5>
                        <p class="mb-5"><i class="fa fa-map-marker-alt me-3"></i>Rosa Tibba Pattoki 55300, Kasure,
                            Pakistan</p>
                        <h5 class="text-white">Follow Us</h5>
                        <div class="d-flex pt-2">
                            <a class="btn btn-square btn-outline-light rounded-circle me-1"
                                href="https://x.com/Pattokinaturals"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-1"
                                href="https://www.facebook.com/pattokinaturals"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-1"
                                href="https://youtube.com/@pattokinaturals?si=rkQd2nz-r_kM814V"><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-1"
                                href="https://www.tiktok.com/@pattokinaturalas?_t=8r74b3CBuOT&_r=1"><i
                                    class="fab fa-tiktok"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-0"
                                href="https://wa.me/+9203047671316?text=Welcome to %20Pattoki%20Naturals!%20I%20am%20interested%20in%20your%20products."target="_blank"><i
                                    class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">

                    <div class="container">
                        <h1>Order Details</h1>

                        <div class="order-details">
                            <h2>Order ID: {{ $order->id }}</h2>
                            <p><strong>Billing Address:</strong> {{ $order->billing_address }}</p>
                            <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                            <p><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                            <p><strong>Grand Total:</strong> ${{ $order->grand_total }}</p>
                        </div>

                        <h3>Order Items</h3>
                        @if($order->items->isEmpty())
                            <p>No items found for this order.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
<tr>
    <td>{{ $item->discount->product->product_name }}</td> <!-- Accessing product_name through discount -->
    <td>${{ number_format($item->price, 2) }}</td>
    <td>{{ $item->quantity }}</td>
    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
</tr>
@endforeach
                                </tbody>
                            </table>
                        @endif

                        <a href="{{ route('my.orders') }}" class="btn btn-primary">Back to My Orders</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


@endsection
