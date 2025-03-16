@extends('admin.layout.layout')




@section('content')

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Form Design <small>Different form elements</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                <form id="demo-form2" action="{{ route('product.store') }}" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="subcategory">
                            Category <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <select name="category_id" id="subcategory" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="product-name">
                            Product Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="product-price">
                            Product Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="number" class="form-control" name="base_price" placeholder="Enter Product Price" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="product-weight">
                            Product Weight <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="number" class="form-control" name="weight" placeholder="Enter Product Weight" required>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="product-image">
                            Product Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="file" class="form-control" name="image_url" required>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">
                            Product Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <textarea class="form-control" name="description" id="description" rows="10" required placeholder="Enter product description with HTML formatting..."></textarea>
                        </div>
                    </div>

                    <!-- Include CKEditor or TinyMCE -->
                    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
                    <script>
                        CKEDITOR.replace('description'); // Initialize CKEditor on the textarea
                    </script>
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
