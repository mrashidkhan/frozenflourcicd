<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\UnregisteredOrder;
use App\Models\UnregisteredCustomer;


class OrderController extends Controller
{
    // Display a listing of the discounts
    public function index()
    {
        // Fetch all orders with their customers and items
        $orders = Order::with(['customer', 'items'])->get();
        return view('admin.order.index', compact('orders'));
    }

    public function directorders()
    {
        $directorders = UnregisteredOrder::with('customer')->get();
        return view('admin.directorder.index', compact('directorders'));
    }

    public function myorders()
{
    // Get the authenticated user
    $user = Auth::user();

    // Check if the user is authenticated
    if (!$user) {
        return redirect()->route('login')->with('success', 'You must be logged in to view your orders.');
    }

    // Check if the customer exists
    $customer = $user->customer; // Assuming the relationship is set up correctly

    if (!$customer) {
        // Redirect to the cart.view route with a message if the customer does not exist
        return redirect()->route('cart.view')->with('success', 'Customer does not exist.');
    }

    // Get the customer ID
    $customerId = $customer->id;

    // Fetch orders for the customer
    $orders = Order::where('customer_id', $customerId)->get();

    // Return the view with the orders
    return view('front.myorders', compact('orders'));
}
public function show($id)
{
    // Retrieve the order by ID and ensure it belongs to the authenticated user
    $order = Order::with('items')->where('id', $id)->firstOrFail();

    return view('front.myorderitems', compact('order'));
}

public function update(Request $request, $id)
{
    // Log the incoming request data for debugging
    \Log::info('Update Order Request:', $request->all());

    // Validate the incoming request data
    $request->validate([
        'paid' => 'required|boolean',
        'delivered' => 'required|boolean',
        'delivery_date' => 'nullable|date',
    ]);

    // Find the order by ID
    $order = Order::findOrFail($id);

    // Log the order before updating
    \Log::info('Order before update:', $order->toArray());

    // Update the order with the new data
    $order->update([
        'paid' => $request->input('paid'),
        'delivered' => $request->input('delivered'),
        'delivery_date' => $request->input('delivery_date'),
    ]);

    // Log the order after updating
    \Log::info('Order after update:', $order->fresh()->toArray());

    // Return a JSON response indicating success
    return response()->json(['success' => true]);
}
}
