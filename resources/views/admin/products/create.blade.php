@extends('admin.master-layout')

@section('content')
    <div class="row" style="background-color:white; border-radius:5px; padding:20px">
        <div class="col-md-12">
            <h2 class="mb-4 text-left">Tạo Sản Phẩm</h2>
            <hr>
            <form id="product-create-form" action="{{ route('products.store') }}" enctype="multipart/form-data"
                  method="POST">
                @csrf
                <div class="row">
                    <!-- Category ID -->
                    <div class="mb-3 col-md-4">
                        <label for="category_id" class="col-form-label">Danh Mục (Category)</label>
                        <div class="">
                            <select class="form-select select2" id="category_id" name="category_id">
                                <option value="">Chọn danh mục</option> <!-- Tùy chọn mặc định -->
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->categories_name }}</option>
                                    <!-- Thay 'name' bằng thuộc tính thích hợp -->
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
                            <select class="form-select" id="brand_id" name="brand_id">
                                <!-- Danh sách thương hiệu sẽ được điền vào đây -->
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
                                   placeholder="Nhập tên sản phẩm">
                            @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Product Price -->
                    <div class="mb-3 col-md-4">
                        <label for="product_price" class="col-form-label">Giá Sản Phẩm</label>
                        <div class="">
                            <input type="number" class="form-control" id="product_price" name="product_price">
                            @error('product_price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Product Price Old -->
                    <div class="mb-3 col-md-4">
                        <label for="product_price_old" class="col-form-label">Giá Cũ</label>
                        <div class="">
                            <input type="number" class="form-control" id="product_price_old" name="product_price_old">
                            @error('product_price_old')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Product SKU -->
                    <div class="mb-3 col-md-4">
                        <label for="product_sku" class="col-form-label">SKU Sản Phẩm</label>
                        <div class="">
                            <input type="text" class="form-control" id="product_sku" name="product_sku"
                                   placeholder="Nhập SKU sản phẩm">
                            @error('product_sku')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- Product Description -->
                    <div class="mb-3 col-md-12">
                        <label for="product_description" class="col-form-label">Mô Tả Sản Phẩm</label>
                        <div class="">
                            <textarea class="form-control" id="product_description" name="product_description"
                                      rows="3" placeholder="Nhập mô tả sản phẩm"></textarea>
                            <span id="product_description-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="row">
                    <div class="mt-5">
                        <button type="submit" class="btn btn-danger">Tạo Sản Phẩm</button>
                        <a class="btn btn-primary" href="{{ route('products.index') }}">Trở về trang danh sách sản
                            phẩm</a>
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
    });
    </script>

@endpush
