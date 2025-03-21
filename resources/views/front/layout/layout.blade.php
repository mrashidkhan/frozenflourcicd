<!-- Main Layout -->
@include('front.layout.header')
@yield('slider')
@yield('content')
@include('front.layout.footer')

<!-- Back to Top Button -->
{{-- <a href="https://wa.me/923158274326" class="btn btn-lg btn-primary btn-lg-square rounded-circle" aria-label="Chat on WhatsApp" target="_blank" style="background-color: #25D366; color: #fff;">
    <i class="fab fa-whatsapp"></i>
</a> --}}
<a href="https://wa.me/923158274326" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top" target="_blank" aria-label="WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('admin_themelib/wow/wow.min.js') }}"></script>
<script src="{{ asset('admin_themelib/easing/easing.min.js') }}"></script>
<script src="{{ asset('admin_themelib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('admin_themelib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('admin_theme/js/main.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle the plus button click
        document.querySelectorAll('.btn-plus').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');
                const quantityInput = this.closest('.input-group').querySelector('.quantity-input');
                let quantity = parseInt(quantityInput.value) || 0;
                quantity++;
                quantityInput.value = quantity;

                // Update the cart session via AJAX
                updateCart(itemId, quantity);
                // Reload the page
        location.reload();
            });
        });

        // Handle the minus button click
        document.querySelectorAll('.btn-minus').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');
                const quantityInput = this.closest('.input-group').querySelector('.quantity-input');
                let quantity = parseInt(quantityInput.value) || 0;

                // Check if quantity is greater than 1 before decrementing
                if (quantity > 1) {
                    quantity--;
                    quantityInput.value = quantity;

                    // Update the cart session via AJAX
                    updateCart(itemId, quantity);
                    // Reload the page
        location.reload();
                } else {
                    // Optionally, you can show a message to the user
                    alert("Quantity cannot be less than 1.");
                }
            });
        });
    });

    function updateCart(itemId, quantity) {
    fetch(`/cart/update/${itemId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for security
        },
        body: JSON.stringify({
            quantity: quantity
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data.message); // Log success message if needed

        // Update the cart item quantity and price in the DOM
        document.querySelector(`#item-quantity-${itemId}`).innerText = data.updatedQuantity;
        document.querySelector(`#item-total-${itemId}`).innerText = data.itemTotal;

        // Update the cart total price
        document.querySelector('#cart-total').innerText = data.cartTotal;

    })
   // .catch(error => {
   //     console.error('Error updating cart:', error);
   //     alert('An error occurred while updating the item. Please try again.');
   // });
}

</script>

@stack('footer-script')
</body>

</html>
