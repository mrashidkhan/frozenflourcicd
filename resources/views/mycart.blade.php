<!-- resources/views/cart.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
</head>
<body>
    <h1>Your Cart</h1>

    <script>
        // Pass the cart session data to JavaScript
        var cart = @json($cart); // Convert the cart session to a JavaScript object

        // Log the cart to the console
        console.log(cart);
    </script>
</body>
</html>
