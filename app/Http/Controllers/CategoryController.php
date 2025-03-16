<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories=Category::where('status','inactive')->get();
        $categories=Category::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::whereNull('category_id')->get();
        return view('admin.category.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive', // Ensure status is either 'active' or 'inactive'
            'category_id' => 'nullable|exists:categories,id', // Ensure category_id exists in the categories table
        ]);

        // Create a new category using the validated data
        $category = Category::create([
            'category_name' => $request->input('category_name'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id'), // This is for the parent category
        ]);

        // Flash a success message to the session
        session()->flash('success', 'Category created successfully.');

        // Redirect to the category list route
        return redirect()->route('category.list');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Retrieve the category by ID or fail if not found
        $category = Category::findOrFail($id);

        // Retrieve all categories for the subcategory dropdown
        $categories = Category::all();

        // Return the edit view with the category and all categories
        return view('admin.category.edit', compact('category', 'categories'));
    }



    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'category_name' => 'required|string|max:255', // Required field
            'description' => 'nullable|string', // Optional field
            'status' => 'required|in:active,inactive', // Assuming status can be 'active' or 'inactive'
            'category_id' => 'required|integer|exists:categories,id', // Ensure category_id exists in the categories table
        ]);

        // Find the category by ID
        $category = Category::findOrFail($id);

        // Update the category with the validated data
        $category->category_name = $request->input('category_name');
        $category->description = $request->input('description');
        $category->status = $request->input('status');
        $category->category_id = $request->input('category_id'); // This may not be necessary if it's the same as $id

        // Save the changes to the database
        $category->save();

        // Redirect or return a response
        return redirect()->route('category.list')->with('success', 'Category updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Category $category)
    // {
    //     $id=$request->id;
    //     $data=array(
    //         'name'=>$request->name,
    //         'category_id'=>$request->category_id,
    //     );
    //     $category=Category::find($id);
    //     $category->update($data);
    //     return redirect()->route('category.list');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Category $category)
    {
        $id = $request->id;
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return response()->json('success');
        } else {
            return response()->json('Category not found', 404);
        }
    }

}
