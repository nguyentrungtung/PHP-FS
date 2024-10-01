@extends('admin.master-layout')

@section('content')
    <div class="row" style="background-color:white; border-radius:5px; padding:20px">
        <div class="col-md-12">
            <h2 class="mb-4 text-left">Chỉnh sửa mã giảm giá</h2>
            <hr>
            <form id="edit-coupon-form" action="{{ route('coupons.update', $coupon->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Coupon Code -->
                    <div class="mb-3 col-md-4">
                        <label for="code" class="col-form-label">Coupon Code(Mã coupon)</label>
                        <div class="">
                            <input type="text" class="form-control" id="code" name="code"
                                   value="{{ old('code', $coupon->code) }}" placeholder="Nhập coupon code (e.g., SAVE10)">
                            <span id="code-error" class="error-message text-danger"></span>
                        </div>
                    </div>

                    <!-- Discount Type -->
                    <div class="mb-3 col-md-4">
                        <label for="discount_type" class="col-form-label">Discount Type(Loại giảm giá)</label>
                        <div class="">
                            <select class="form-select" id="discount_type" name="discount_type">
                                <option value="fixed" {{ old('discount_type', $coupon->discount_type) == 'fixed' ? 'selected' : '' }}>Fixed Amount (Cố định)</option>
                                <option value="percentage" {{ old('discount_type', $coupon->discount_type) == 'percentage' ? 'selected' : '' }}>Percentage (Phần trăm)</option>
                            </select>
                            <span id="discount_type-error" class="error-message text-danger"></span>
                        </div>
                    </div>

                    <!-- Discount Value -->
                    <div class="mb-3 col-md-4">
                        <label for="discount_value" class="col-form-label">Discount Value (Giá trị giảm)</label>
                        <div class="">
                            <input type="text" class="form-control" id="discount_value" name="discount_value"
                                   value="{{ old('discount_value', $coupon->discount_type == 'percentage' ? number_format($coupon->discount_value) : number_format($coupon->discount_value)) }}">
                            <span id="discount_value-error" class="error-message text-danger"></span>
                        </div>
                    </div>

                    <!-- Max Discount -->
                    <div class="mb-3 col-md-4">
                        <label for="max_discount" class="col-form-label">Max Discount (Giá trị giảm tối đa)</label>
                        <div class="">
                            <input type="number" class="form-control" id="max_discount" name="max_discount"
                                   value="{{ old('max_discount', number_format($coupon->max_discount)) }}">
                            <span id="max_discount-error" class="error-message text-danger"></span>
                        </div>
                    </div>

                    <!-- Min Order Value -->
                    <div class="mb-3 col-md-4">
                        <label for="min_order_value" class="col-form-label">Min Order Value (Giá trị đơn hàng tối thiểu)</label>
                        <div class="">
                            <input type="number" class="form-control" id="min_order_value" name="min_order_value"
                                   value="{{ old('min_order_value', number_format($coupon->min_order_value)) }}">
                            <span id="min_order_value-error" class="error-message text-danger"></span>
                        </div>
                    </div>

                    <!-- Start Date -->
                    <div class="mb-3 col-md-3">
                        <label for="start_date" class="col-form-label">Start Date</label>
                        <div class="">
                            <input type="date" class="form-control" id="start_date" name="start_date"
                                   value="{{ old('start_date', $coupon->start_date) }}">
                            <span id="start_date-error" class="error-message text-danger"></span>
                        </div>
                    </div>

                    <!-- End Date -->
                    <div class="mb-3 col-md-3">
                        <label for="end_date" class="col-form-label">End Date</label>
                        <div class="">
                            <input type="date" class="form-control" id="end_date" name="end_date"
                                   value="{{ old('end_date', $coupon->end_date) }}">
                            <span id="end_date-error" class="error-message text-danger"></span>
                        </div>
                    </div>

                    <!-- Usage Limit -->
                    <div class="mb-3 col-md-3">
                        <label for="usage_limit" class="col-form-label">Usage Limit (Giới hạn sử dụng)</label>
                        <div class="">
                            <input type="number" class="form-control" id="usage_limit" name="usage_limit"
                                   value="{{ old('usage_limit', $coupon->usage_limit) }}">
                            <span id="usage_limit-error" class="error-message text-danger"></span>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-3 col-md-3">
                        <label for="status" class="col-form-label">Status (Trạng thái)</label>
                        <div class="">
                            <select class="form-select" id="status" name="status">
                                <option value="active" {{ old('status', $coupon->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $coupon->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <span id="status-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row">
                    <div class="mt-5">
                        <button type="submit" class="btn btn-danger">Cập nhật mã giảm giá</button>
                        <a class ="btn btn-primary" href="{{route('coupons.index')}}">Trở về trang chủ</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
