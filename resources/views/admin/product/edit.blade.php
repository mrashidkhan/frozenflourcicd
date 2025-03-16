@extends('admin.layout.layout')
@section('content')
<div class="row">
    <h2>Edit Product</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            
            <div class="x_content">
                <br>
                <form id="demo-form2" action="{{route('product.update', $product->id)}}" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="subcategory">
                            Category <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <select name="category_id" id="subcategory" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($product->category_id==$category->id) selected @endif>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="product_name">
                            Product Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" name="product_name" value="{{ old('product_name', $product->product_name) }}" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="weight">
                            Product Weight <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" name="weight" value="{{ old('weight', $product->weight) }}" required>
                        </div>
                    </div>


                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="base_price">
                            Product Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="number" class="form-control" name="base_price" value="{{ old('base_price', $product->base_price) }}" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">
                            Product Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <textarea class="form-control" name="description" id="description" rows="10" required>{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>

                    <!-- Include CKEditor or TinyMCE -->
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description'); // Initialize CKEditor on the textarea
</script>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="image_url">
                            Product Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-sm-12">
                            @if(isset($product->image_url) && $product->image_url)
                                <div class="mb-2">
                                    <img src="{{ asset('uploads/' . $product->image_url) }}" alt="Current Image" class="img-thumbnail" style="max-width: 30%; height: auto;">
                                </div>
                            @endif
                            <input type="file" class="form-control" name="image_url">
                        </div>
                    </div>

                    {{-- <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="image_url">
                            Product Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-sm-12">
                            <input type="file" class="form-control" name="image_url">
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12"></div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <!-- Display the product image if it exists -->
                            @if($product->image)
                                <img style="height: 80px; width: 80px;" src="{{ asset('uploads/' .$product->image_url) }}" alt="Product Image">
                            @endif
                        </div>
                    </div>

                    <div class="ln_solid"></div>

                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <input type="submit" class="btn btn-success" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
