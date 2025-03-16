<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnregisteredCustomer;
use App\Models\UnregisteredOrder;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class SelectionController extends Controller
{
    public function handleProductSelection(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // dd($product);
        // $product = $request->input('product');
        // $id = $product->id;

        // $request->validate([
        //     'weight' => 'required',
        //     'discount_id' => 'required|exists:discounts,id', // Assuming you have a discounts table
        // ]);
        $action = $request->input('action');

        if ($action === 'add_to_cart') {
            if (Auth::check()) {
                $discountId = $request->input('discount_id');

                $discount = Discount::find($discountId);
                // dd($discount);
                // Redirect to cart page for authenticated users
                return redirect()->route('cart.add', [
                    'product' => $product->id,
                    'discount' => $discountId // Include the discount ID here
                ])->with('success', 'Product added to cart successfully.');
                // return redirect()->route('cart.add', [$discountId]);
            } else {
                // Redirect to login page for unauthenticated users
                return redirect()->route('user_login');
            }
        } elseif ($action === 'purchase_now') {

            if (Auth::check()) {
                $discountId = $request->input('discount_id');

                $discount = Discount::find($discountId);

                // Redirect to checkout page for authenticated users
                return redirect()->route('cart.add', [
                    'product' => $product->id,
                    'discount' => $discountId // Include the discount ID here
                ])->with('success', 'Product added to cart successfully.');
            } else {
                // Get the discount ID and weight from the request
    $discountId = $request->input('discount_id');
    $weight = $request->input('weight');

    // Retrieve the discount instance
    $discount = Discount::findOrFail($discountId);

    // Get the associated product
    $product = $discount->product;
    $quantity = 1;
    // Calculate the total price for the current product
    $productTotalPrice = $discount->discounted_price * $quantity;

    // Initialize subtotal
    $subtotal = $productTotalPrice; // Start with the product total price

    // Determine shipment cost based on subtotal
    $shipment = ($subtotal > 5000) ? 0 : 250;

    // Calculate total
    $total = $subtotal + $shipment;

    // Render the checkout form for unregistered users
    return view('front.checkoutunregister', [
        'discount' => $discount,
        'product' => $product,
        'total' => $total,
        'shipment' => $shipment,
    ]);
            }
        }
    }

    public function storeDirect(Request $request)
{
    // Validate the incoming request data
    // $request->validate([
    //     'product' => 'required|string|max:255',
    //     'quantity' => 'required|numeric|gt:0',
    //     'weight' => 'required|numeric|gt:0',
    //     'discounted_price' => 'required|numeric|gt:0',
    //     'shipment' => 'required|numeric',
    //     'total_amount' => 'required|numeric|gt:0',
    //     'first_name' => 'required|string|max:255',
    //     'last_name' => 'required|string|max:255',
    //     'billing_address' => 'required|string|max:255',
    //     'email' => 'required|email',
    //     'phone' => 'required|string|max:20',
    // ]);

    // Retrieve input values
    $product = $request->input('product');
    $quantity = $request->input('quantity');
    $weight = $request->input('weight');
    $discounted_price = $request->input('discounted_price');
    $shipment = $request->input('shipment');
    $total_amount = $request->input('total_amount');
    $firstName = $request->input('first_name');
    $lastName = $request->input('last_name');
    $billingAddress = $request->input('billing_address');
    $email = $request->input('email');
    $phone = $request->input('phone');

    // Check if customer already exists or create a new one
    $directCustomer = UnregisteredCustomer::firstOrCreate(
        [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'billing_address' => $billingAddress,
            'phone' => $phone, // Include phone if needed
            'email' => $email,
        ]
    );

    // Create a new order for the customer
    $order = new UnregisteredOrder([
        'unregistered_customer_id' => $directCustomer->id,
        'product' => $product,
        'weight' => $weight,
        'quantity' => $quantity,
        'price' => $discounted_price,
        'delivered' => 0,
        'delivery_date' => null,
        'paid' => 0,
        'shipping' => $shipment,
        'total_amount' => $total_amount,
    ]);

    // Save the order associated with the customer
    $directCustomer->directorders()->save($order);

    // Send a confirmation response
    return redirect()->route('user_login')
                     ->with('success', 'Order placed successfully! We will contact you soon');
}
}
