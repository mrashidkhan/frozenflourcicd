<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectOrderController extends Controller
{
    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'billing_address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'postal_code' => 'nullable|string|max:20',
        'country' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
    ]);

    // Get the authenticated user
    $user = $request->user();

    // Check if the user is authenticated
    if (!$user) {
        return redirect()->back()->withErrors(['success' => 'You must be logged in to complete an order.']);
    }

    // Check if the customer already exists
    $customer = $user->customer; // Assuming the relationship is defined in the User model

    if ($customer) {
        // Update the existing customer record
        $customer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'billing_address' => $request->billing_address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'phone' => $request->phone,
        ]);
    } else {
        // Create a new customer if it doesn't exist
        $customer = Customer::create([
            'user_id' => $user->id, // Assign the authenticated user's ID
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'billing_address' => $request->billing_address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'phone' => $request->phone,
        ]);
    }

    // Create the order
    $order = Order::create([
        'customer_id' => $customer->id, // Use the existing or newly created customer ID
        'payment_method' => 'Cash on Delivery',
        'billing_address' => $request->billing_address,
        'shipping_address' => $request->billing_address,
    ]);

    // Assuming you have a cart stored in the session
    $cartItems = session()->get('cart', []);

    foreach ($cartItems as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'discount_id' => $item['discount_id'], // Assuming you have discount_id in the cart
            'quantity' => $item['quantity'],
            'price' => $item['price'], // Assuming you have price in the cart
        ]);
    }

    // Optionally, clear the cart after the order is placed
    session()->forget('cart');

    // Generate order slip
    $this->generateOrderSlip($order);

    return redirect()->route('cart.view', ['order' => $order->id])
                     ->with('success', 'Order placed successfully!');
}
}
