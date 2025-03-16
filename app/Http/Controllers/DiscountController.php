<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class DiscountController extends Controller
{
    // Display a listing of the discounts
    public function index()
    {
        $discounts = Discount::with('product')->get();
        return view('admin.discount.index', compact('discounts'));
    }

    // Show the form for creating a new discount
    public function create()
    {
        $products = Product::all();
        return view('admin.discount.add', compact('products'));

    }

    // Store a newly created discount in storage
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'weight' => 'required|numeric',
            'original_price' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'is_most_bought' => 'boolean',
        ]);

        // If the discount is marked as "most bought", unset the flag for other discounts
        if ($request->is_most_bought) {
            Discount::where('product_id', $request->product_id)
                ->update(['is_most_bought' => false]);
        }

        // Create the discount
        Discount::create($request->all());

        return redirect()->route('discount.list')->with('success', 'Discount created successfully.');
    }

    // Show the form for editing the specified discount
    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        $products = Product::all();
        return view('admin.discount.edit', compact('discount','products'));
    }

    // Update the specified discount in storage
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'weight' => 'required|numeric',
            'original_price' => 'required|numeric',
            'discounted_price' => 'required|numeric',
            'is_most_bought' => 'boolean',
        ]);

        // Find the discount being updated
        $discount = Discount::findOrFail($id);

        // If the discount is being marked as "most bought"
        if ($request->is_most_bought && !$discount->is_most_bought) {
            // Unset the flag for other discounts of the same product
            Discount::where('product_id', $request->product_id)
                ->where('id', '!=', $id) // Exclude the current discount
                ->update(['is_most_bought' => false]);
        }

        // Update the discount with the new data
        $discount->update($request->all());

        return redirect()->route('discount.list')->with('success', 'Discount updated successfully.');
    }

    // Remove the specified discount from storage
    // public function destroy($id)
    // {
    //     $discount = Discount::findOrFail($id);
    //     $discount->delete();

    //     return redirect()->route('discount.list')->with('success', 'Discount deleted successfully.');
    // }

    // public function destroy(Request $request, Products $product)
    // {
    // // Check if the product exists and delete it
    // if ($discount) {
    //     $discount->delete();
    //     return response()->json('success');
    // } else {
    //     return response()->json(['error' => 'Discount not found'], 404);
    // }
    // }

    // public function destroy(Request $request, Discount $discount)
    // {
    //     $id = $request->id;
    //     $discount = Discount::find($id);

    //     if ($discunt) {
    //         $discount->delete();
    //         return response()->json('success');
    //     } else {
    //         return response()->json('Discount not found', 404);
    //     }
    // }

    public function discountDelete(Request $request, $id)
     {
        //  $discountCategories = PhotoCategory::with('photoGalleries')->get(); // Eager load photo galleries if needed

         $discount = Discount::findOrFail($id);

         if ($request->isMethod('post')) {
             $discount->delete();
             Session::flash('success', "You have successfully deleted Discount.");
             return Redirect::route('discount.list');
         }

        //  return view('admin.discount.discount_delete', ['discount' => $discount]);
        return view('admin.discount.delete', compact('discount'));
     }
}
