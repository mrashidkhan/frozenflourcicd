@extends('admin.layout.layout')
@section('content')
<div class="row">
    <h2>Edit Product Image</h2>

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
                <form id="demo-form2" action="{{route('productimages.update', $productimage->id)}}" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="subcategory">
                            Product <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <select name="category_id" id="subcategory" class="form-control" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" @if($productimage->product_id==$product->id) selected @endif>
                                        {{ $product->product_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 col-xs-12" for="image_url">
                            Product Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-sm-12">
                            @if(isset($productimage->image_url) && $productimage->image_url)
                                <div class="mb-2">
                                    <img src="{{ asset('uploads/' . $productimage->image_url) }}" alt="Current Image" class="img-thumbnail" style="max-width: 30%; height: auto;">
                                </div>
                            @endif
                            <input type="file" class="form-control" name="image_url">
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
