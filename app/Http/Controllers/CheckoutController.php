<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        // Get the authenticated customer
        $customer = Auth::user(); // Assuming you are using Laravel's built-in Auth

        return view('checkout', compact('customer'));
    }

//     public function store(Request $request)
// {
//     // Validate the incoming request data
//     $request->validate([
//         'first_name' => 'required|string|max:255',
//             'last_name' => 'required|string|max:255',
//             'billing_address' => 'required|string|max:255',
//             'city' => 'required|string|max:255',
//             'postal_code' => 'nullable|string|max:20',
//             'country' => 'required|string|max:255',
//             'phone' => 'required|string|max:20',
//     ]);

// // Get the authenticated user
// $user = $request->user();

// // Check if the user is authenticated
// if (!$user) {
//     return redirect()->back()->withErrors(['error' => 'You must be logged in to complete an order.']);
// }

//     // Create the customer
//     $customer = Customer::create([
//         'user_id' => $user->id, // Assign the authenticated user's ID
//         'first_name' => $request->first_name,
//         'last_name' => $request->last_name,
//         'billing_address' => $request->billing_address,
//         'city' => $request->city, // Assuming you have a city field
//         'postal_code' => $request->postal_code, // Assuming you have a postal_code field
//         'country' => $request->country, // Assuming you have a country field
//         'phone' => $request->phone, // Assuming you have a phone field

//     ]);



//     // Create the order
//     $order = Order::create([
//         'customer_id' => $customer->id, // Use the newly created customer ID
//         'payment_method' => 'Cash on Delivery',
//         'billing_address' => $request->billing_address,
//         'shipping_address' => $request->billing_address,
//     ]);

//     // Assuming you have a cart stored in the session
//     $cartItems = session()->get('cart', []);

//     foreach ($cartItems as $item) {
//         OrderItem::create([
//             'order_id' => $order->id,
//             'discount_id' => $item['discount_id'], // Assuming you have discount_id in the cart
//             'quantity' => $item['quantity'],
//             'price' => $item['price'], // Assuming you have price in the cart
//         ]);
//     }

//     // Optionally, clear the cart after the order is placed
//     session()->forget('cart');

//     // Generate order slip
//     $this->generateOrderSlip($order);

//     return redirect()->route('cart.view', ['order' => $order->id])
//                      ->with('success', 'Order placed successfully!');
// }

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

    // Initialize customer data
    $customerData = [
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'billing_address' => $request->billing_address,
        'city' => $request->city,
        'postal_code' => $request->postal_code,
        'country' => $request->country,
        'phone' => $request->phone,
    ];

    // Check if the cart is empty
    $cartItems = session()->get('cart', []);
    if (empty($cartItems)) {
        return redirect()->route('home')->with('success', 'Your cart is empty.');
    }

    // Check if the user is authenticated
    if ($user) {
        // Check if the customer already exists
        $customer = $user->customer; // Assuming the relationship is defined in the User model

        if ($customer) {
            // Update the existing customer record
            $customer->update($customerData);
        } else {
            // Create a new customer if it doesn't exist
            $customerData['user_id'] = $user->id; // Assign the authenticated user's ID
            $customer = Customer::create($customerData);
        }
    } else {
        // If the user is not authenticated, create a customer without user_id
        $customerData['user_id'] = 18; // Assign a default user ID or handle accordingly
        $customer = Customer::create($customerData);
    }

    // Create the order
    $order = Order::create([
        'customer_id' => $customer->id, // Use the existing or newly created customer ID
        'payment_method' => 'Cash on Delivery',
        'billing_address' => $request->billing_address,
        'shipping_address' => $request->billing_address,
        'paid' => false,
        'delivered' => false,
        'delivery_date' => null,
    ]);

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
    // $this->generateOrderSlip($order);

    // Set the success message based on user authentication
    $successMessage = $user
        ? 'Order placed successfully! We will contact you soon. View your order in My Orders Menu'
        : 'Order placed successfully! We will contact you soon.';

    return redirect()->route('cart.view', ['order' => $order->id])
                     ->with('success', $successMessage);
}

    private function generateOrderSlip(Order $order)
{
    // Load the order items
    $orderItems = $order->items;

    // Prepare data for the view
    $data = [
        'order' => $order,
        'orderItems' => $orderItems,
    ];

    // Load the view and pass the data
    $pdf = \PDF::loadView('order.slip', $data);

    // Save the PDF to a file (optional)
    $pdf->save(storage_path('app/public/orders/order_' . $order->id . '.pdf'));

    // Stream the PDF to the browser
    return $pdf->stream('order_slip_' . $order->id . '.pdf');
}
}
