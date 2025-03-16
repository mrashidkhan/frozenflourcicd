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

        <th><b>Image</b></th>
        <th><b>Extra Details</b></th>
        <th><b>Actions</b></th>
      </tr>
    </thead>
    <tbody>
        @foreach($images as $key => $image)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $image->product->product_name }}</td>
        {{-- <td> {{ $image->product?->product_name ?? 'No Product Assigned' }} </td> --}}

        <td>
            <img style="height: 40px; width: 40px;" src="{{ asset('uploads/' . $image->image_url) }}" alt="Product Image">
        </td>
        <td>
            <a href="{{ route('productimages.edit', $image->id) }}" style="font-size:17px; padding:5px;">
                <i class="fa fa-edit"></i>
            </a>

            <form action="{{ route('productimages.destroy', $image->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" style="font-size:17px; padding:5px; background:none; border:none; color:red;">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
            {{-- <a href="javascript:void(0)" style="font-size:17px;padding:5px;" data-id="{{ $image->id }}" class="image_delete">
                <i class="fa fa-trash"></i>
            </a> --}}
        </td>
    </tr>
@endforeach
    </tbody>
</table>

@endsection

{{-- @push('footer-script')
<script>
    $('.image_delete').on('click', function() {
        if (confirm('Are you sure you want to delete this Product Image?')) {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route("productimages.destroy") }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function(data) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error here
                    console.log(error);
                }
            });
        }
    });
</script>

@endpush
 --}}
