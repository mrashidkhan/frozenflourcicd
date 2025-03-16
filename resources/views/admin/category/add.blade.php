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
                <br>
                <form id="demo-form2" action="{{route('category.store')}}" class="form-horizontal form-label-left" method="post" novalidate>
                    @csrf
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="category_name">
                            Category Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" id="first-name" name="category_name" required="required" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">
                            Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" id="first-name" name="description" required="required" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">
                            Status <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <select id="status" name="status" required="required" class="form-control">
                                <option value="" disabled selected>Select status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="subcategory">
                            Sub Category of <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <select required="required" name="category_id" id="subcategory" required class="form-control">
                                <option value="">No Subcategory</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <input type="submit" class="btn btn-success" value="Submit"></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
