<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Customer;
use App\Models\Product; // Assuming you have a Product model
use App\Models\Discount;
use Illuminate\Support\Facades\Session; // For session management

class CartController extends Controller
{
    public function viewCart()
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);
        $products=Product::get();
        return view('front.cart', compact('cart','products'));
    }

    public function viewCheckout(Request $request)
    {
        // Retrieve the cart from the session
        $cart = session()->get('cart', []);
        // Check if the user is authenticated
        $customerData = null;

        // If the user is authenticated, retrieve their data
        // Check if the user is authenticated
        if ($request->user()) {
            // Attempt to retrieve the customer data based on the authenticated user's ID
            $customerData = Customer::where('user_id', $request->user()->id)->first();
        }

        // If customerData is still null, it means the customer does not exist
        // You can leave customerData as null, or initialize it with an empty object
        if (!$customerData) {
            $customerData = new Customer(); // Create a new instance of Customer with empty fields
        }

        return view('front.checkout', compact('cart', 'customerData'));
    }

    public function updateCustomer(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'shipping_address' => 'required|string|max:255',
            'billing_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'phone' => 'required|string|max:20',
            'country' => 'required|string|max:255',
        ]);

        // Update the customer information
        if ($request->user()) {
            $customer = Customer::where('email', $request->user()->email)->first();
            if ($customer) {
                $customer->update($request->only([
                    'first_name',
                    'last_name',
                    'shipping_address',
                    'billing_address',
                    'city',
                    'postal_code',
                    'phone',
                    'country',
                ]));
            }
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Customer information updated successfully.');
    }

    public function addToCart(Request $request)
    {
        // Validate the incoming request data
        // $request->validate([
        //     // 'weight' => 'required|numeric',
        //     'discount_id' => 'required|exists:discounts,id', // Assuming you have a discounts table
        // ]);

        // Retrieve the product ID and discount ID from the query parameters
        $productId = $request->query('product');
        $discountId = $request->query('discount');

        // Validate the product ID and discount ID
        $request->validate([
            'product' => 'required|exists:products,id', // Ensure the product exists
            'discount' => 'required|exists:discounts,id', // Ensure the discount exists
        ]);

        // Find the product by ID
        $product = Product::findOrFail($productId);
        $discount = Discount::findOrFail($discountId);
        // Find the selected discount
        // $discount = $product->discounts()->findOrFail($request->discount_id);

        // Retrieve the last used ID from the session, or initialize it if it doesn't exist
        $lastId = session('last_cart_item_id', 0);
        // Prepare the cart item
        $cartItem = [
            'id' => ++$lastId, // Increment the last ID and assign it
            'name' => $product->product_name, // Assuming the product has a product_name attribute
            'weight' => $discount->weight,
            'discount_id' => $discount->id,
            'price' => is_numeric($discount->discounted_price) ? (float) $discount->discounted_price : 0.0, // Ensure price is numeric
            'quantity' => is_numeric(1) ? (int) 1 : 1, // Ensure quantity is numeric (default to 1)
        ];
        // Store the updated last ID back in the session
        session(['last_cart_item_id' => $lastId]);

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

    // public function removeItemFromCart($itemId)
    // {
    //     // $itemId = 3;
    //     // console.log($itemId);
    //     $cart = session()->get('cart', []);
    //     unset($cart[$itemId]);
    //     // console.log($cart);
    //     // console.log ($cart[$itemId]);
    //     // Check if the item exists in the cart
    //     // if (isset($cart[$itemId])) {
    //     //     // Remove the item from the cart
    //     //     unset($cart[$itemId]);

    //     //     // Update the session with the modified cart
    //     //     session()->put('cart', $cart);

    //         // Return a success response
    //         return response()->json(['message' => 'Item removed successfully']);
    //     }

    //     // Return an error response if the item was not found
    //     return response()->json(['message' => 'Item not found'], 404);
    // }
    public function removeItemFromCart($itemId)
    {
        // Retrieve the current cart from the session
        $cart = session('cart', []);

        // Check if the item exists in the cart
        if (isset($cart[$itemId])) {
            // Remove the item from the cart
            unset($cart[$itemId]);

            // Update the session with the modified cart
            session(['cart' => $cart]);

            // Return a success response
            return response()->json(['message' => 'Item removed successfully.']);
        }

        // If the item was not found, return a not found response
        return response()->json(['message' => 'Item not found in cart kya hai yar.'], 404);
    }

    public function order(Request $request)
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

    public function showCart()
    {
        // Retrieve the cart from the session
        $cart = session('cart', []);

        // Return the view with the cart data
        return view('mycart', compact('cart'));
    }
}
