@extends('admin.master-layout')

@section('content')
    <div class="row" style="background-color:white; border-radius:5px; padding:20px; overflow: auto">
        <div class="d-block justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Coupons List</h2>
            <a href="{{route('coupons.create')}}" class="btn btn-success mt-3 mb-0">Create New Coupon</a>
        </div>

        <table class="table table-striped table-bordered">
            <thead class="">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Code</th>
                <th scope="col">Discount Type</th>
                <th scope="col">Discount Value</th>
                <th scope="col">Max Discount</th>
                <th scope="col">Min Order Value</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Usage Limit</th>
                <th scope="col">Used Times</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach($coupons as $key => $coupon)
                    <td class="text-center">{{$key + 1}}</td>
                    <td class="text-center">{{$coupon->code ?? null}}</td>
                    <td class="text-center">{{$coupon->discount_type ?? null}}</td>
                    @if($coupon->discount_type == 'percentage')
                        <td class="text-center">{{ number_format($coupon->discount_value) }}%</td>
                    @else
                        <td class="text-center">{{number_format($coupon->discount_value) }}₫</td>
                    @endif

                    <td class="text-center">{{number_format($coupon->max_discount) ?? null}}</td>
                    <td class="text-center">{{number_format($coupon->min_order_value) ?? null}}</td>
                    <td class="text-center">{{$coupon->start_date ?? null}}</td>
                    <td class="text-center">{{$coupon->end_date ?? null}}</td>
                    <td class="text-center">{{$coupon->usage_limit ?? null}}</td>
                    <td class="text-center">{{$coupon->used_times ?? null}}</td>
                    <td class="text-center text-danger">{{$coupon->status ?? null}}</td>
                    <td class="text-center">
                        <div class="dropdown-center">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('coupons.edit', $coupon->id) }}">Edit</a>
                                </li>
                                <li>
                                    <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE') <!-- Sử dụng phương thức DELETE -->
                                        <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Bạn có muốn xoá mục này?');">Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="footer">
            {{ $coupons->links() }}
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
    </script>
@endpush