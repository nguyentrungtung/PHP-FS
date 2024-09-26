@extends('admin.master-layout')

@section('content')
    <div class="row" style="background-color:white; border-radius:5px; padding:20px; overflow: auto">
        <div class="d-block justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Danh sách sản phẩm</h2>
            <a href="{{route('products.create')}}" class="btn btn-success mt-3 mb-0">Tạo sản phẩm mới</a>
        </div>
        <hr>
        <table class="table table-striped table-bordered" id ="myProductTable">
            <thead>
            <tr>
                <th class ="text-center" scope="col">ID</th>
                <th class ="text-center" scope="col">Tên sản phẩm</th>
                <th class ="text-center" scope="col">Hình ảnh</th>
                <th class ="text-center" scope="col">Giá sản phẩm</th>
                <th class ="text-center" scope="col">Giá cũ</th>
                <th class ="text-center" scope="col">Số lượng</th>
                <th class ="text-center" scope="col">Mô tả</th>
                <th class ="text-center" scope="col">Danh mục</th>
                <th class ="text-center" scope="col">Thương hiệu</th>
                <th class ="text-center" scope="col">Hành động</th>
            </tr>
            </thead>
            <tbody>

            @foreach($products as $key => $product)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-center">
                        <div class="text-truncate" style="max-width: 200px;">{{ $product->product_name ?? null }}</div>
                    </td>
                    @foreach($product->productImage as $product_image)
                        <td class="text-center">
                            @if($product_image->image_type == 'main')
                                <img src="{{ asset($product_image->image_url) }}" alt="Main Image" style="max-width: 100px; max-height: 100px;">
                            @endif
                        </td>
                    @endforeach
                    <td class="text-center">{{ number_format($product->product_price) }}₫</td>
                    <td class="text-center">{{ number_format($product->product_price_old) }}₫</td>
                    <td class="text-center">{{ $product->product_quantity ?? null }}</td>
                    <td class="text-center">{{ Str::limit($product->product_description, 50) ?? null }}</td>
                    <td class="text-center">{{ $product->category->categories_name ?? null }}</td>
                    <td class="text-center">{{ $product->brand->brand_name ?? null }}</td>
                    <td class="text-center">
                        <div class="dropdown-center">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('products.edit', $product->id) }}">Chỉnh sửa</a>
                                </li>
                                <li>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Bạn có muốn xoá sản phẩm này?');">Xoá
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
{{--            {!! $products->links("pagination::bootstrap-5") !!}--}}
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
    </script>
@endpush

