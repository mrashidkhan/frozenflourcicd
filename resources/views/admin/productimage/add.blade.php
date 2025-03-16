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
                <form id="demo-form2" action="{{ route('productimages.store') }}" class="form-horizontal form-label-left" method="post" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="subcategory">
                            Product <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <select name="product_id" id="subcategory" class="form-control" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                @endforeach
                            </select>
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
