@extends('front.layout.layout')

@section('content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-1 bg-white" style="margin-top: 150px;">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('shop') }}">Shop</a></li>
                        <li class="breadcrumb-item">Checkout</li>
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

        @php
            $subtotal = 0; // Initialize subtotal variable
            $couponDiscount = 0; // Initialize coupon discount variable
            $shipping = 0; // Initialize shipping variable
            $grandTotal = 0; // Initialize grand total variable
        @endphp

        <section class="section-9 pt-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="table-responsive">
                            @if (session('cart') && count(session('cart')) > 0)
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product</th>
                                            <th>Weight</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach (session('cart') as $item) --}}
                                        @foreach (session('cart', []) as $key => $item)
                                            <!-- Use $key to access the array key -->
                                            <tr>
                                                @php
                                                    $itemTotalPrice = $item['price'] * $item['quantity']; // Calculate total price for the current item
                                                    $subtotal += $itemTotalPrice; // Add to subtotal
                                                @endphp
                                                <td>
                                                    {{ number_format($item['id']) }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-left">
                                                        <h6 class="ml-2">{{ $item['name'] }}</h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ number_format($item['weight']) }} G
                                                </td>
                                                <td>Rs{{ number_format($item['price'], 0) }}</td>
                                                <td>
                                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1"
                                                                data-id="{{ $item['id'] }}">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </div>
                                                        <input type="text"
                                                            class="form-control form-control-sm border-0 text-center quantity-input"
                                                            value="{{ $item['quantity'] }}" data-id="{{ $item['id'] }}"
                                                            readonly>
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1"
                                                                data-id="{{ $item['id'] }}">
                                                                <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="total-price" data-price="{{ $item['price'] }}">
                                                    Rs{{ number_format($item['price'] * $item['quantity'], 2) }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger"
                                                        onclick="removeFromCart({{ $key }})">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h1> Your cart is empty. </h1>

                            @endif
                        </div>
                        <h2>Checkout</h2>


                        <form action="{{ route('order.complete') }}" method="POST">
                            @csrf

                            <h4>Shipping Information</h4>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $customerData->first_name ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $customerData->last_name ?? '') }}" required>
                            </div>



                            <div class="form-group">
                                <label for="billing_address">Billing Address</label>
                                <input type="text" class="form-control" id="billing_address" name="billing_address" value="{{ old('billing_address', $customerData->billing_address ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $customerData->city ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="postal_code">Postal Code (optional)</label>
                                <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code', $customerData->postal_code ?? '') }}">
                            </div>



                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $customerData->phone ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $customerData->country ?? '') }}" required>
                            </div>

                            <h4 class="mt-5">Payment Method</h4>
                            <div class="form-group">
                                <label>Payment Method</label>
                                <select class="form-control" name="payment_method" required>
                                    <option value="cod">Cash on Delivery (COD)</option>
                                </select>
                            </div>

                            <button type="submit" class="btn-dark btn btn-block mt-3">Complete Order</button>
                        </form>

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="card cart-summery">
                            <div class="sub-title">
                                <h2 class="bg-white">Order Summary</h2>
                            </div>
                            @php
                                    // Initialize variables
                                    $subtotal = 0; // Initialize subtotal variable
                                    $couponDiscount = 0; // Initialize coupon discount variable
                                    $shipping = 0; // Initialize shipping variable
                                    $grandTotal = 0; // Initialize grand total variable

                                    // Check if the cart is not empty
                                    if (session('cart') && count(session('cart')) > 0) {
                                        // Calculate subtotal
                                        foreach (session('cart') as $item) {
                                            $itemTotalPrice = $item['price'] * $item['quantity']; // Calculate total price for the current item
                                            $subtotal += $itemTotalPrice; // Add to subtotal
                                        }

                                        // Determine shipping cost based on subtotal
                                        $shipping = $subtotal > 5000 ? 0 : 250;
                                    }

                                    // Calculate the grand total
                                    $grandTotal = $subtotal + $shipping - $couponDiscount;
                                    session(['newTotal' => $grandTotal]);
                                    // Store grandTotal in the session
                                    session(['grantTotal' => $grandTotal]);
                                @endphp

                            <div class="table-responsive">
                                @if (session('cart') && count(session('cart')) > 0)
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $subtotal = 0; // Initialize subtotal variable
                                            @endphp
                                            @foreach (session('cart', []) as $key => $item)
                                                <tr>
                                                    @php
                                                        $itemTotalPrice = $item['price'] * $item['quantity']; // Calculate total price for the current item
                                                        $subtotal += $itemTotalPrice; // Add to subtotal
                                                    @endphp
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-left">
                                                            <h6 class="ml-2">{{ $item['name'] }} Gram {{ number_format($item['weight']) }}</h6>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ number_format($item['quantity']) }}
                                                    </td>
                                                    <td>
                                                        Rs{{ number_format($itemTotalPrice, 2) }} <!-- Display item total price -->
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="d-flex justify-content-between summery-end">
                                        <div><strong>Subtotal</strong></div>
                                        <div>Rs{{ number_format($subtotal, 2) }}</div>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <div>Shipping</div>
                                        <div>Rs {{ number_format($shipping, 2) }}</div>
                                    </div>

                                    <div class="d-flex justify-content-between summery-end">
                                        <div><strong>Grand Total</strong></div>
                                        <div>Rs{{ number_format($grandTotal, 2) }}</div> <!-- Ensure $grandTotal is calculated correctly -->
                                    </div>

                                    <div class="input-group apply-coupon mt-4">
                                        <input type="text" id="coupon_code" name="coupon" placeholder="Coupon Code" class="form-control">
                                        <button class="btn btn-dark" type="button" id="apply_coupon_button">Apply Coupon</button>
                                    </div>
                                    <div id="coupon_message" class="mt-2"></div>
                                    {{-- <div class="pt-5">
                                        <a href="{{ route('order.complete') }}" class="btn-dark btn btn-block w-100">Order Now</a>
                                    </div> --}}

                                    <div class="pt-2">
                                        <a href="{{ route('shop') }}" class="btn-dark btn btn-block w-100">Continue Shopping</a>
                                    </div>
                                @else
                                    <h3>Your cart is empty.</h3> <!-- Changed to h3 for better semantics -->
                                @endif
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        function removeFromCart(itemId) {
            // const newItemId = Number(itemId) - 1;
            // fetch(`/cart/remove/${itemId}`, {
            // itemId = 2;
            fetch(`/cart/remove/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    // console.log(response);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data.message); // Log success message if needed
                    location.reload(); // Refresh the page to show updated cart
                })
                .catch(error => {
                    console.error('Error removing item from cart:', error);
                    alert('An error occurred while removing the item. Please try again.');
                });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#apply_coupon_button').click(function() {
                var couponCode = $('#coupon_code').val();

                $.ajax({
                    url: '{{ route('apply.coupon') }}',
                    type: 'POST',
                    data: {
                        coupon_code: couponCode,
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    success: function(response) {
                        $('#coupon_message').text(response.message);

                    },
                    error: function(xhr) {
                        $('#coupon_message').text(xhr.responseJSON.message);
                    }
                });

            });
        });
    </script>

<script>
    // JavaScript to copy billing address to shipping address
    document.getElementById('shipping_address').addEventListener('input', function() {
        document.getElementById('billing_address').value = this.value;
    });
</script>
@endsection
