@extends('admin.master-layout')

@section('content')
    <div class="row" style="background-color:white; border-radius:5px; padding:20px">
        <div class="col-md-12">
            <h2 class="mb-4 text-left">Chỉnh Sửa Sản Phẩm</h2>
            <hr>
            <form id="product-edit-form" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data"
                  method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Category ID -->
                    <div class="mb-3 col-md-4">
                        <label for="category_id" class="col-form-label">Danh Mục (Category)</label>
                        <div class="">
                            <select class="form-select select2" id="category_id" name="category_id">
                                <option value="">Chọn danh mục</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                    @if(isset($category['child']) && count($category['child']) > 0)
                                        @foreach($category['child'] as $child)
                                            <option value="{{ $child['id'] }}">-- {{ $child['name'] }}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Brand ID -->
                    <div class="mb-3 col-md-4">
                        <label for="brand_id" class="col-form-label">Thương Hiệu (Brand)</label>
                        <div class="">
                            <select class="form-select select2" id="brand_id" name="brand_id">
                                <option value="">Chọn thương hiệu</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                        {{ $brand->brand_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Product Name -->
                    <div class="mb-3 col-md-4">
                        <label for="product_name" class="col-form-label">Tên Sản Phẩm</label>
                        <div class="">
                            <input type="text" class="form-control" id="product_name" name="product_name"
                                   value="{{ old('product_name', $product->product_name) }}" placeholder="Nhập tên sản phẩm">
                            @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Product Price -->
                    <div class="mb-3 col-md-4">
                        <label for="product_price" class="col-form-label">Giá Sản Phẩm</label>
                        <div class="">
                            <input type="number" class="form-control" id="product_price" name="product_price"
                                   value="{{ old('product_price', $product->product_price) }}">
                            @error('product_price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Product Price Old -->
                    <div class="mb-3 col-md-4">
                        <label for="product_price_old" class="col-form-label">Giá Cũ</label>
                        <div class="">
                            <input type="number" class="form-control" id="product_price_old" name="product_price_old"
                                   value="{{ old('product_price_old', $product->product_price_old) }}">
                            @error('product_price_old')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Product Quantity -->
                    <div class="mb-3 col-md-4">
                        <label for="product_quantity" class="col-form-label">Số lượng</label>
                        <div class="">
                            <input type="number" class="form-control" id="product_quantity" name="product_quantity"
                                   value="{{ old('product_quantity', $product->product_quantity) }}">
                            @error('product_quantity')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Product Description -->
                    <div class="mb-3 col-md-12">
                        <label for="product_description" class="col-form-label">Mô Tả Sản Phẩm</label>
                        <div class="">
                            <textarea class="form-control" id="product_description" name="product_description"
                                      rows="3" placeholder="Nhập mô tả sản phẩm">{{ old('product_description', $product->product_description) }}</textarea>
                            <span id="product_description-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="row">
                    <div class="mt-5">
                        <button type="submit" class="btn btn-danger">Cập nhật Sản Phẩm</button>
                        <a class="btn btn-primary" href="{{ route('products.index') }}">Trở về trang danh sách sản phẩm</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
        $(document).ready(function() {
            // Khởi tạo Select2 cho trường Category ID
            $('#category_id').select2({
                placeholder: "Chọn danh mục",
                allowClear: true // Cho phép xóa lựa chọn
            });

            $('#brand_id').select2({
                placeholder: "Chọn thương hiệu",
                allowClear: true // Cho phép xóa lựa chọn
            });
        });
    </script>
@endpush

