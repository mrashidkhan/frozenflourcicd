@extends('admin.layout.layout')

@section('content')

@if(session('success'))
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

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th><b>S.No</b></th>
            <th><b>Coupon Name</b></th>
            <th><b>Coupon Discount (Rs)</b></th>
            <th><b>Start Date</b></th>
            <th><b>End Date</b></th>
            <th><b>Actions</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($coupons as $key => $coupon)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $coupon->coupon_name }}</td>
            <td>Rs {{ number_format($coupon->coupon_discount, 2) }}</td>
            <td>{{ \Carbon\Carbon::parse($coupon->coupon_start_date)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($coupon->coupon_end_date)->format('d-m-Y') }}</td>
            <td>
                <a href="{{ route('coupon.edit', $coupon->id) }}" style="font-size:17px; padding:5px;">
                    <i class="fa fa-edit"></i>
                </a>
                {{-- <a href="{{ route('coupon.delete', $coupon->id) }}" style="font-size:17px;padding:5px;" class="btn-sm mr-1 small btn-danger">
                    <i class="fa fa-trash"></i>
                </a> --}}
                <form action="{{ route('coupon.delete', $coupon->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE') <!-- This specifies that the form should be treated as a DELETE request -->
                    <button type="submit" style="font-size:17px;padding:5px;" class="btn-sm mr-1 small btn-danger" onclick="return confirm('Are you sure you want to delete this coupon?');">
                        <i class="fa fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

