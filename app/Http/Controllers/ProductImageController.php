<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function index()
    {
        $images = ProductImage::all();
        return view('admin.productimage.index', compact('images'));
        // $images = ProductImage::with('product')->get(); // Eager load the product relationship
        // return view('admin.productimage.index', compact('images'));
    }

    public function create()
    {
        $products=Product::get();
        return view('admin.productimage.add', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
            'product_id' => 'required|exists:products,id',
        ]);

        $data = [
            'product_id' => $request->product_id,
            'image_url' => $request->image_url,

        ];

        // Handle image upload
        if ($request->hasFile('image_url')) {
            $image_url = $request->file('image_url');
            $fileName = date('dmY').time().'.'.$image_url->getClientOriginalExtension();
            $image_url->move(public_path('/uploads'), $fileName);
            $data['image_url'] = $fileName;

        }

        // Create new product
        $create = ProductImage::create($data);
        return redirect()->route('productimages.index')->with('success', 'Product Image created successfully!');

        // $image = new ProductImage();
        // $image->image_url = $request->file('image_url')->store('uploads', 'public');
        // $image->product_id = $request->product_id;
        // $image->save();

        // return redirect()->route('productimages.index')->with('success', 'Image uploaded successfully.');
    }

    public function edit(Request $request, ProductImage $productimage)
    {
        // $id = $request->id;
        // $productimage = ProductImage::findOrFail($id);
        $products = Product::all();
        return view('admin.productimage.edit', compact('products', 'productimage'));

    }

    // public function update(Request $request, ProductImage $productimage)
    // {
    //     $request->validate([
    //         'image_url' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:20048',
    //     ]);


    //     if ($request->hasFile('image_url')) {
    //         $image_url = $request->file('image_url');
    //         $fileName = date('dmY').time().'.'.$image_url->getClientOriginalExtension();
    //         $image_url->move(public_path('/uploads'), $fileName);
    //         $data['image_url'] = $fileName;

    //     }
    //     $productimage->save();

    //     return redirect()->route('productimages.index')->with('success', 'Image updated successfully.');
    // }

    public function update(Request $request, ProductImage $productimage)
{
    // Validate the request
    $request->validate([
        'image_url' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:20480', // Max file size is 20MB
    ]);

    // Handle image upload
    if ($request->hasFile('image_url')) {
        try {
            // Delete the old image if it exists
            if ($productimage->image_url && Storage::exists('public/uploads/' . $productimage->image_url)) {
                Storage::delete('public/uploads/' . $productimage->image_url);
            }

            // Upload the new image
            $image_url = $request->file('image_url');
            $fileName = date('dmY') . time() . '.' . $image_url->getClientOriginalExtension();
            $image_url->move(public_path('uploads'), $fileName);

            // Update the image_url field in the model
            $productimage->image_url = $fileName;
        } catch (\Exception $e) {
            // Handle any errors during file upload
            return redirect()->back()->with('error', 'Failed to upload image: ' . $e->getMessage());
        }
    }

    // Save the changes to the database
    $productimage->save();

    // Redirect with a success message
    return redirect()->route('productimages.index')->with('success', 'Image updated successfully.');
}

    public function destroy(ProductImage $productimage)
{

    $productImage->forceDelete();

    // Return a success response
    return back()->with('success', 'Product Image has been deleted');

}
    // public function destroy(ProductImage $productImage)
    // {
    //     // Delete the product image
    //     $productImage->delete();

    //     // Redirect to a specific route with a success message
    //     return redirect()->route('productimages.index')->with('success', 'Product image deleted successfully.');
    // }

    public function show(products $products)
    {
        //
    }
}
