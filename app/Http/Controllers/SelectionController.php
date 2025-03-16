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

        $action = $request->input('action');


                $discountId = $request->input('discount_id');

                $discount = Discount::find($discountId);
                // dd($discount);
                // Redirect to cart page for authenticated users
                return redirect()->route('cart.add', [
                    'product' => $product->id,
                    'discount' => $discountId // Include the discount ID here
                ])->with('success', 'Product added to cart successfully.');
    }

}
