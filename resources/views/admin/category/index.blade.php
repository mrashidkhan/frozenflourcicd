@extends('admin.layout.layout')




@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


<table class="table">
    <thead>
        <tr>
            <th><b>S.No</b></th>
            <th><b>ID</b></th>
            <th><b>Category Name</b></th>
            <th><b>Parent Category Name</b></th>
            <th><b>Description</b></th>
            <th><b>Status</b></th>
            <th><b>Created Date</b></th>
            <th><b>Actions</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $key => $category)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $category->id }}</td>
            <td>{{ $category->category_name }}</td>
            <td>
                @if($category->category_id)
                    {{ $category->parent->category_name }}
                @else
                    No Parent Category
                @endif
            </td>
            <td>{{ $category->description }}</td>
            <td>{{ $category->status }}</td>
            <td>{{ $category->created_at }}</td>
            <td>
                <a href="{{ route('category.edit', $category->id) }}" style="font-size:17px;padding:5px;">
                    <i class="fa fa-edit"></i>
                </a>
                <a href="javascript:void(0)" style="font-size:17px;padding:5px;" data-id="{{ $category->id }}" class="category_delete">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



@endsection

@push('footer-script')
<script>
    $('.category_delete').on('click', function() {
        if (confirm('Are you sure you want to delete this category?')) {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ route("category.delete") }}',
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
