@extends('admin.layout.layout')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th><b>S.No</b></th>
        <th><b>Product Name</b></th>
        <th><b>Product Weight</b></th>
        <th><b>Category Name</b></th>
        <th><b>Price</b></th>
        <th><b>Image</b></th>
        <th><b>Extra Details</b></th>
        <th><b>Actions</b></th>
      </tr>
    </thead>
    <tbody>
        @foreach($products as $key => $product)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->weight }}</td>
            <td>
                @if($product->category_id)
                    {{ $product->category->category_name }}
                @endif
            </td>
            <td>{{ $product->base_price }}</td>
            <td>
                <img style="height: 40px; width: 40px;" src="{{ asset('uploads/' . $product->image_url) }}" alt="Product Image">
            </td>
            {{-- <td>
                @if($isDisabled) <!-- Replace with your condition -->
                    <button disabled>Add</button>
                @else
                    <button>
                        <a href="{{ route('product.extraDetails', $product->id) }}">Add</a>
                    </button>
                @endif
            </td> --}}
            <td>{{ $product->description }}</td>
            <td>
                <a href="{{ route('product.edit', $product->id) }}" style="font-size:17px; padding:5px;">
                    <i class="fa fa-edit"></i>
                </a>
                {{-- <a href="javascript:void(0);" style="font-size:17px;padding:5px;" data-id="{{ $product->id }}" class="delete">
                    <i class="fa fa-trash"></i>
                </a> --}}
                <a href="{{ route('product.delete.get', $product->id) }}" style="font-size:17px;padding:5px;" class="btn-sm mr-1 small btn-danger"> <i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

{{-- @push('footer-script')
<script>
    $('.delete').on('click', function() {
        if (confirm('Are you sure to delete this product?')) {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route("product.delete") }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(data) {
                    location.reload();
                },
            });
        }
    });
</script>
@endpush --}}

