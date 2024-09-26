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
                                <option value="">Chọn danh mục</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->categories_name }}</option>
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
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
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
                    <!-- Product quantity -->
                    <div class="mb-3 col-md-4">
                        <label for="product_quantity" class="col-form-label">Số lượng</label>
                        <div class="">
                            <input type="number" class="form-control" id="product_quantity" name="product_quantity">
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
                                      rows="3" placeholder="Nhập mô tả sản phẩm"></textarea>
                            <span id="product_description-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Product Images -->
                        <div class="mb-3 col-md-6">
                            <label for="product_images" class="col-form-label">Hình Ảnh Sản Phẩm</label>
                            <div id="image-upload-container">
                                <div class="image-upload-row">
                                    <input type="file" class="form-control mb-2" id="product_images"
                                           name="product_images[]" multiple>
                                    <select class="form-select mb-2" name="image_types[]">
                                        <option value="">Chọn loại ảnh</option>
                                        <option value="main">Ảnh Chính</option>
                                        <option value="thumbnail">Ảnh Phụ</option>
                                    </select>
                                    <!-- Hiển thị lỗi cho từng file hình ảnh -->
                                    @error('product_images.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <!-- Hiển thị lỗi cho từng loại ảnh -->
                                    @error('image_types.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="button" class="btn btn-success" id="add-image-row">Thêm ảnh khác</button>
                        </div>

                        <div class="mb-3 col-md-6">
                            <!-- Unit Value -->
                            <div class="mb-3 col-md-12">
                                <label for="units" class="col-form-label">Đơn Vị Sản Phẩm</label>
                                <div class="">
                                    <select class="form-select select2" id="units" name="units[]" multiple>
                                        <option value="">Chọn đơn vị</option>
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                        @endforeach
                                    </select>
                                    <!-- Hiển thị lỗi cho từng đơn vị -->
                                    @error('units.*')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Giá trị đơn vị -->
                            <div class="mb-3 col-md-12">
                                <label for="unit_values" class="col-form-label">Giá Trị Đơn Vị</label>
                                <div id="unit-values-container">
                                    <!-- Sẽ tự động tạo các input khi chọn đơn vị -->
                                </div>
                                <!-- Hiển thị lỗi cho giá trị đơn vị -->
                                @error('unit_values.*')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
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
        $(document).ready(function () {
            // Khởi tạo Select2 cho trường Category ID và Brand ID
            $('#category_id, #brand_id, #units').select2({
                placeholder: "Chọn",
                allowClear: true
            });

            //Khi chọn đơn vị thì tạo các trường input để nhập giá trị đơn vị
            $('#units').on('change', function () {
                let selectedUnits = $(this).val();
                let unitValuesContainer = $('#unit-values-container');
                unitValuesContainer.empty(); // Xóa các input cũ

                if (selectedUnits.length > 0) { //đảm bảo rằng chỉ khi người dùng chọn ít nhất một đơn vị thì các input tương ứng mới được tạo
                    selectedUnits.forEach(function (unitId) {
                        let unitName = $('#units option[value="' + unitId + '"]').text();
                        unitValuesContainer.append(`
                            <div class="mb-3 col-md-12">
                                <label for="unit_value_${unitId}" class="col-form-label">Giá Trị Cho ${unitName}</label>
                                <input type="number" class="form-control" id="unit_value_${unitId}" name="unit_values[${unitId}]"
                                       placeholder="Nhập giá trị cho ${unitName}">
                            </div>
                        `);
                    });
                }
            });

            // Thêm hàng upload ảnh mới
            $('#add-image-row').click(function () {
                const imageUploadRow = `
                <div class="image-upload-row">
                    <input type="file" class="form-control mb-2" name="product_images[]">
                    <select class="form-select mb-2" name="image_types[]">
                        <option value="">Chọn loại ảnh</option>
                        <option value="main">Ảnh Chính</option>
                        <option value="thumbnail">Ảnh Phụ</option>
                    </select>
                    <button type="button" class="btn btn-danger remove-image-row">Xóa</button>
                </div>`;
                $('#image-upload-container').append(imageUploadRow);
            });

            // Xóa hàng upload ảnh
            $(document).on('click', '.remove-image-row', function () {
                $(this).closest('.image-upload-row').remove();
            });
        });
    </script>
@endpush
