<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product; // Assuming you have a Product model
use Illuminate\Support\Facades\Session; // For session management

class CartController extends Controller
{
    public function viewCart()
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        return view('front.cart', compact('cart'));
    }

    public function addToCart(Request $request, $productId)
    {
        // Validate the incoming request data
        $request->validate([
            'weight' => 'required|numeric',
            'discount_id' => 'required|exists:discounts,id', // Assuming you have a discounts table
        ]);

        // Find the product by ID
        $product = Product::findOrFail($productId);

        // Find the selected discount
        $discount = $product->discounts()->findOrFail($request->discount_id);


        // Prepare the cart item
    $cartItem = [
        'id' => $product->id,
        'name' => $product->product_name, // Assuming the product has a product_name attribute
        'weight' => $request->weight,
        'discount_id' => $discount->id,
        'price' => is_numeric($discount->discounted_price) ? (float)$discount->discounted_price : 0.0, // Ensure price is numeric
        'quantity' => is_numeric(1) ? (int)1 : 1, // Ensure quantity is numeric (default to 1)
    ];

        // Add the item to the cart stored in the session
        $cart = Session::get('cart', []);
        $cart[] = $cartItem; // Add the new item to the cart array
        Session::put('cart', $cart); // Save the updated cart back to the session

        // Optionally, you can return a response or redirect
        return redirect()->route('cart.view')->with('success', 'Product added to cart successfully!');
    }

    // public function removeFromCart(Request $request)
    // {
    //     // Get the current cart from the session
    //     $cart = session()->get('cart', []);

    //     // Remove the item from the cart
    //     if (isset($cart[$request->id])) {
    //         unset($cart[$request->id]);
    //     }

    //     // Save the cart back to the session
    //     session()->put('cart', $cart);

    //     return redirect()->route('cart.view')->with('success', 'Item removed from cart successfully!');
    // }

    public function removeItemFromCart($itemId)
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // Check if the item exists in the cart
        if (isset($cart[$itemId])) {
            // Remove the item from the cart
            unset($cart[$itemId]);

            // Update the session with the modified cart
            session()->put('cart', $cart);

            // Return a success response
            return response()->json(['message' => 'Item removed successfully']);
        }

        // Return an error response if the item was not found
        return response()->json(['message' => 'Item not found'], 404);
    }

    public function checkout(Request $request)
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Please add items to your cart before checking out.');
        }

        // Calculate the total amount
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Here you can process the order, e.g., save it to the database
        // For demonstration, we'll save the order details
        $order = new Order();
        $order->customer_name = $request->input('customer_name'); // Assuming you have this input
        $order->customer_email = $request->input('customer_email'); // Assuming you have this input
        $order->cart = json_encode($cart); // Store cart items as JSON
        $order->total = $total; // Total amount
        $order->save();

        // Clear the cart
        session()->forget('cart');

        // Redirect to a confirmation page or show a success message
        return redirect()->route('cart.index')->with('success', 'Thank you for your order! Your items have been successfully checked out.');
    }

    public function updateCart(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'quantity' => 'required|integer|min:0', // Ensure quantity is a non-negative integer
        ]);

        // Retrieve the current cart from the session
        $cart = Session::get('cart', []);

        // Find the item in the cart by ID
        foreach ($cart as &$item) {
            if ($item['id'] == $id) {
                // Update the quantity
                $item['quantity'] = $request->quantity;
                break;
            }
        }

        // Save the updated cart back to the session
        Session::put('cart', $cart);

        // Return a response indicating success
        return response()->json(['success' => true, 'message' => 'Cart updated successfully!']);
    }
}
