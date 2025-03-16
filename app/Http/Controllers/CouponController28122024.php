<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function create()
    {
        return view('admin.coupon.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required|string|unique:coupons,coupon_name',
            'coupon_discount' => 'required|numeric|min:0',
            'coupon_start_date' => 'required|date',
            'coupon_end_date' => 'required|date|after_or_equal:coupon_start_date',
        ]);

        Coupon::create($request->all());

        return redirect()->route('coupon.list')->with('success', 'Coupon created successfully!');
    }

    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function edit($id)
{
    // Find the coupon by ID or fail if not found
    $coupon = Coupon::findOrFail($id);

    // Return the edit view with the coupon data
    return view('admin.coupon.edit', compact('coupon'));
}

public function update(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'coupon_name' => 'required|string|unique:coupons,coupon_name,' . $id,
        'coupon_discount' => 'required|numeric|min:0',
        'coupon_start_date' => 'required|date',
        'coupon_end_date' => 'required|date|after_or_equal:coupon_start_date', // Ensure end date is after start date
    ]);

    // Find the coupon by ID or fail if not found
    $coupon = Coupon::findOrFail($id);

    // Update the coupon with the validated data
    $coupon->update([
        'coupon_name' => $request->coupon_name,
        'coupon_discount' => $request->coupon_discount,
        'coupon_start_date' => $request->coupon_start_date,
        'coupon_end_date' => $request->coupon_end_date,
    ]);

    // Redirect back to the coupon list with a success message
    return redirect()->route('coupon.list')->with('success', 'Coupon updated successfully!');
}

// public function removeItemFromCart(Request $request)
// {
//     $id = $request->id; // Get the ID from the request
//     $coupon = Coupon::find($id); // Find the coupon by ID

//     if ($coupon) {
//         $coupon->delete(); // Delete the coupon
//         // return response()->json('success'); // Return a success response
//         return redirect()->route('coupon.list')->with('success', 'Coupon deleted successfully!');
//     } else {
//         // return response()->json('Coupon not found', 404); // Return a not found response
//         return redirect()->route('coupon.list')->with('sucess', 'Coupon not found!');
//     }
// }

public function applyCoupon(Request $request)
{
    $grantTotal = session('grantTotal', 0);
    
    if ($grantTotal > 2000) {
        // Validate the incoming request
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $couponCode = $request->input('coupon_code');
        $coupon = Coupon::where('coupon_name', $couponCode)->first();

        // Check if the coupon exists
        if (!$coupon) {
            return response()->json(['message' => 'Coupon is not valid.'], 400);
        }

        // Check if the coupon is already applied
        if (session()->has('applied_coupon')) {
            return response()->json(['message' => 'Only one coupon can be applied.'], 400);
        }

        // Check if the coupon is still valid
        $currentDate = now();
        if ($currentDate->lt($coupon->coupon_start_date) || $currentDate->gt($coupon->coupon_end_date)) {
            return response()->json(['message' => 'Coupon is not valid.'], 400);
        }

        // Initialize newTotal with grantTotal
        $newTotal = $grantTotal;

        // Perform your calculation for newTotal here
        if ($grantTotal >= 0) {
            $newTotal = $grantTotal - $coupon->coupon_discount; // Example calculation

        }

        // Store newTotal in the session
        session(['newTotal' => $newTotal]);
        session(['applied_coupon' => $couponCode]); // Store applied coupon in session

        return response()->json(['message' => 'Coupon applied successfully!', 'new_total' => $newTotal]);
    } else {
        return response()->json(['message' => 'Grant total is less than 2000.'], 400);
    }
}

}
