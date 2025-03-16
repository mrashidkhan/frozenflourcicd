<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products=Product::get();
        $isDisabled = true;
        return view('admin.product.index', compact('products','isDisabled'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        // $categories=Category::whereNotNull('category_id')->get();
        $categories = Category::where('status', 'active')->get();
        return view('admin.product.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'base_price' => $request->base_price,
            'weight' => $request->weight,
        ];

        // Handle image upload
        if ($request->hasFile('image_url')) {
            $image_url = $request->file('image_url');
            $fileName = date('dmY').time().'.'.$image_url->getClientOriginalExtension();
            $image_url->move(public_path('/uploads'), $fileName);
            $data['image_url'] = $fileName;

        }

        // Create new product
        $create = Product::create($data);
        return redirect()->route('product.list')->with('success', 'Product created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Category $category)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        $categories = Category::whereNotNull('category_id')->get();
        return view('admin.product.edit', compact('product', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the product by id
        $product = Product::findOrFail($id);

        // Validate the incoming request
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'base_price' => 'required|numeric',
            'weight' => 'required|numeric',
            'image_url' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string|max:16384',
        ]);

        // Prepare the data for updating the product
        $data = [
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'base_price' => $request->base_price,
            'weight' => $request->weight,
            'image_url' => $request->image_url,
            'description' => $request->description,
        ];

        // Handle image upload if an image is provided
        // Check if a new image has been uploaded
    if ($request->hasFile('image_url')) {
        // Handle the new image upload
        $image = $request->file('image_url');
        $fileName = date('dmY') . time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('/uploads/'), $fileName);
        $data['image_url'] = $fileName; // Update the image_url in the data array
    } else {
        // If no new image is uploaded, keep the existing image_url
        $data['image_url'] = $product->image_url; // Retain the existing image_url
    }

        // Update the product with the provided data
        $product->update($data);

        // Redirect to the product list page with a success message
        return redirect()->route('product.list')->with('success', 'Product updated successfully!');
    }

// public function destroy(Request $request, Products $product)
// {
//     // Check if the product exists and delete it
//     if ($product) {
//         $product->delete();
//         return response()->json('success');
//     } else {
//         return response()->json(['error' => 'Product not found'], 404);
//     }
// }

public function productDelete(Request $request, $id)
     {

         $product = Product::findOrFail($id);

         if ($request->isMethod('post')) {
             $product->delete();
             Session::flash('success', "You have successfully deleted Product.");
             return Redirect::route('product.list');
         }


        return view('admin.product.delete', compact('product'));
     }

public function extraDetails(Request $request)
{
    $id = $request->id;
    // Retrieve the product with its related details
    $product = Products::where('id', $id)->with('productDetails')->first();

    return view('admin.product.extraDetails', compact('id', 'product'));
}

public function extraDetailsStore(Request $request)//, Products $product)
{
    $id = $request->id;
    $data = array(
        'title' => $request->title,
        'product_id' => $id,
        'total_items' => $request->total_items,
        'description' => $request->description
    );
    $details = ProductDetails::updateOrCreate(
        ['product_id' => $id],
        $data
        );
    return redirect()->route('product.list');
}

}
