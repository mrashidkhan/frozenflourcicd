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
                    <form id="demo-form2" action="{{ route('category.update', $category->id) }}"
                        class="form-horizontal form-label-left" method="post" novalidate>
                        @csrf
                        @method('PUT') <!-- Specify the PUT method for updates -->

                        <!-- Hidden Field for Category ID -->
                        {{-- <input type="hidden" name="id" value="{{ $category->id }}"> --}}

                        <!-- Category Name Field -->
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="category-name">
                                Category Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input type="text" id="category-name" value="{{ $category->category_name }}"
                                    name="category_name" required="required" class="form-control">
                            </div>
                        </div>

                        <br>

                        <!-- Sub Category Field -->
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="subcategory">
                                Sub Category of <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <select required="required" name="category_id" id="subcategory" class="form-control">
                                    <option value="" @if ($category->category_id == null) selected @endif>No Subcategory
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if ($category->category_id != null && $category->category_id == $category->id) selected @endif>
                                            {{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Description Field -->
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">
                                Description
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <textarea id="description" name="description" class="form-control">{{ $category->description }}</textarea>
                            </div>
                        </div>

                        <!-- Status Field -->
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">
                                Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <select required="required" name="status" id="status" class="form-control">
                                    <option value="active" @if ($category->status == 'active') selected @endif>Active</option>
                                    <option value="inactive" @if ($category->status == 'inactive') selected @endif>Inactive
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <!-- Submit Button -->
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
