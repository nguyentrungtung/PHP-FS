@extends('admin.master-layout')

@section('content')
    <div class="row" style="background-color:white; border-radius:5px; padding:20px">
        <div class="col-md-12">
            <h2 class="mb-4 text-left">Tạo mã giảm giá</h2>
            <hr>
            <form id="register-form" action="{{ route('coupons.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <!-- Coupon Code -->
                    <div class="mb-3 col-md-4">
                        <label for="code" class="col-form-label">Coupon Code(Mã coupon)</label>
                        <div class="">
                            <input type="text" class="form-control" id="code" name="code"
                                   placeholder="Nhập coupon code (e.g., SAVE10)">
                            <span id="code-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                    <!-- Discount Type -->
                    <div class="mb-3 col-md-4">
                        <label for="discount_type" class="col-sm-3 col-form-label w-100 fs-6">Discount Type(Loại giảm
                            giá)</label>
                        <div class="">
                            <select class="form-select" id="discount_type" name="discount_type">
                                <option value="fixed">Fixed Amount (Cố định)</option>
                                <option value="percentage">Percentage (Phần trăm)</option>
                            </select>
                            <span id="discount_type-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                    <!-- Discount Value -->
                    <div class="mb-3 col-md-4">
                        <label for="discount_value" class="col-form-label w-100 fs-6">Discount Value (Giá trị
                            giảm)</label>
                        <div class="">
                            <input type="number" class="form-control" id="discount_value" name="discount_value">
                            <span id="discount_value-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                    <!-- Max Discount -->
                    <div class="mb-3 col-md-4">
                        <label for="max_discount" class="col-form-label w-100 fs-6">Max Discount (Giá trị giảm tối đa
                            cho %)</label>
                        <div class="">
                            <input type="number" class="form-control" id="max_discount" name="max_discount">
                            <span id="max_discount-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                    <!-- Min Order Value -->
                    <div class="mb-3 col-md-4">
                        <label for="min_order_value" class="col-form-label w-100 fs-6">Min Order Value(Giá trị đơn để áp
                            dụng coupon)</label>
                        <div class="">
                            <input type="number" class="form-control" id="min_order_value" name="min_order_value">
                            <span id="min_order_value-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                    <!-- Used Times -->
                    <div class="mb-3 col-md-4">
                        <label for="used_times" class="col-form-label w-100 fs-6">Used Times(Số lần đã được sử
                            dụng)</label>
                        <div class="">
                            <input disabled type="number" class="form-control" id="used_times" name="used_times"
                                   value="0">
                            <span id="used_times-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                    <!-- Start Date -->
                    <div class="mb-3 col-md-3">
                        <label for="start_date" class="col-form-label w-100 fs-6">Start Date</label>
                        <div class="">
                            <input type="date" class="form-control" id="start_date" name="start_date">
                            <span id="start_date-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                    <!-- End Date -->
                    <div class="mb-3 col-md-3">
                        <label for="end_date" class="col-form-label w-100 fs-6">End Date</label>
                        <div class="">
                            <input type="date" class="form-control" id="end_date" name="end_date">
                            <span id="end_date-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                    <!-- Usage Limit -->
                    <div class="mb-3 col-md-3">
                        <label for="usage_limit" class="col-form-label w-100 fs-6">Usage Limit(Giới hạn số lần(nếu
                            có))</label>
                        <div class="">
                            <input type="number" class="form-control" id="usage_limit" name="usage_limit">
                            <span id="usage_limit-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                    <!-- Status -->
                    <div class="mb-3 col-md-3">
                        <label for="status" class="col-form-label w-100 fs-6">Status(Trạng thái của coupon)</label>
                        <div class="">
                            <select class="form-select" id="status" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <span id="code-error" class="error-message text-danger"></span>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="row">
                    <div class="mt-5">
                        <button type="submit" class="btn btn-danger">Create Coupon</button>
                        <a class ="btn btn-primary" href="{{route('coupons.index')}}">Trở về trang chủ</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection

@push('custom-script')
    <script>
        // Khi document đã sẵn sàng
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy các giá trị từ form (sử dụng .getElementById cho input, không lấy .value trực tiếp tại đây)
            var codeInput = document.getElementById('code');
            var discountTypeInput = document.getElementById('discount_type');
            var discountValueInput = document.getElementById('discount_value');
            var maxDiscountInput = document.getElementById('max_discount');
            var minOrderValueInput = document.getElementById('min_order_value');
            var usedTimesInput = document.getElementById('used_times');
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');
            var usageLimitInput = document.getElementById('usage_limit');

            // Gán sự kiện blur để kiểm tra validate
            codeInput.addEventListener('blur', function () {
                validateCode();
            });

            discountTypeInput.addEventListener('blur', function () {
                validateDiscountType();
            });

            discountValueInput.addEventListener('blur', function () {
                validateDiscountValue();
            });

            maxDiscountInput.addEventListener('blur', function () {
                validateMaxDiscount();
            });

            minOrderValueInput.addEventListener('blur', function () {
                validateMinOrderValue();
            });

            usedTimesInput.addEventListener('blur', function () {
                validateUsedTimes();
            });

            startDateInput.addEventListener('blur', function () {
                validateStartDate();
            });

            endDateInput.addEventListener('blur', function () {
                validateEndDate();
            });

            usageLimitInput.addEventListener('blur', function () {
                validateUsageLimit();
            });
        });

        // Hàm kiểm tra mã giảm giá
        function validateCode() {
            var code = document.getElementById('code').value;
            var codeError = document.getElementById('code-error');

            if (code === '') {
                codeError.innerText = 'Vui lòng nhập mã giảm giá';
                return false;
            } else {
                codeError.innerText = '';
                return true;
            }
        }

        // Hàm kiểm tra loại giảm giá
        function validateDiscountType() {
            var discountType = document.getElementById('discount_type').value;
            var discountTypeError = document.getElementById('discount_type-error');

            if (discountType === '') {
                discountTypeError.innerText = 'Vui lòng chọn loại giảm giá';
                return false;
            } else {
                discountTypeError.innerText = '';
                return true;
            }
        }

        // Hàm kiểm tra giá trị giảm giá
        function validateDiscountValue() {
            var discountValue = document.getElementById('discount_value').value;
            var discountValueError = document.getElementById('discount_value-error');

            if (discountValue === '' || isNaN(discountValue)) {
                discountValueError.innerText = 'Vui lòng nhập giá trị giảm giá hợp lệ';
                return false;
            } else if (parseFloat(maxDiscount) < 0) {
                discountValueError.innerText = 'Vui lòng nhập giá trị giảm giá hợp lệ';
                return false;
            } else {
                discountValueError.innerText = '';
                return true;
            }
        }

        // Hàm kiểm tra giảm giá tối đa
        function validateMaxDiscount() {
            var maxDiscount = document.getElementById('max_discount').value;
            var maxDiscountError = document.getElementById('max_discount-error');

            if (isNaN(maxDiscount)) {
                maxDiscountError.innerText = 'Vui lòng nhập mức giảm giá tối đa hợp lệ';
                return false;
            } else if (parseFloat(maxDiscount) < 0) {
                maxDiscountError.innerText = 'Vui lòng nhập mức giảm giá tối đa hợp lệ';
                return false;
            } else {
                maxDiscountError.innerText = '';
                return true;
            }
        }

        // Hàm kiểm tra giá trị đơn hàng tối thiểu
        function validateMinOrderValue() {
            var minOrderValue = document.getElementById('min_order_value').value;
            var minOrderValueError = document.getElementById('min_order_value-error');

            if (isNaN(minOrderValue)) {
                minOrderValueError.innerText = 'Vui lòng nhập giá trị đơn hàng tối thiểu hợp lệ';
                return false;
            } else if (parseFloat(minOrderValue) < 0) {
                maxDiscountError.innerText = 'Vui lòng nhập giá trị đơn hàng tối thiểu hợp lệ';
                return false;
            } else {
                minOrderValueError.innerText = '';
                return true;
            }
        }

        // Hàm kiểm tra số lần sử dụng
        function validateUsedTimes() {
            var usedTimes = document.getElementById('used_times').value;
            var usedTimesError = document.getElementById('used_times-error');

            if (isNaN(usedTimes)) {
                usedTimesError.innerText = 'Vui lòng nhập số lần sử dụng hợp lệ';
                return false;
            } else if (parseFloat(usedTimes) < 0) {
                usedTimesError.innerText = 'Vui lòng nhập số lần sử dụng hợp lệ';
                return false;
            } else {
                usedTimesError.innerText = '';
                return true;
            }
        }

        // Hàm kiểm tra ngày bắt đầu
        function validateStartDate() {
            var startDate = document.getElementById('start_date').value;
            var startDateError = document.getElementById('start_date-error');

            if (startDate === '') {
                startDateError.innerText = 'Vui lòng chọn ngày bắt đầu';
                return false;
            } else {
                startDateError.innerText = '';
                return true;
            }
        }

        // Hàm kiểm tra ngày kết thúc
        function validateEndDate() {
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;
            var endDateError = document.getElementById('end_date-error');

            if (endDate === '') {
                endDateError.innerText = 'Vui lòng chọn ngày kết thúc';
                return false;
            } else if (startDate !== '' && new Date(endDate) < new Date(startDate)) {
                endDateError.innerText = 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu';
                return false;
            } else {
                endDateError.innerText = '';
                return true;
            }
        }

        // Hàm kiểm tra giới hạn sử dụng
        function validateUsageLimit() {
            var usageLimit = document.getElementById('usage_limit').value;
            var usageLimitError = document.getElementById('usage_limit-error');

            if (isNaN(usageLimit)) {
                usageLimitError.innerText = 'Vui lòng nhập giới hạn sử dụng hợp lệ';
                return false;
            } else if (parseFloat(usageLimit) < 0) {
                usageLimitError.innerText = 'Vui lòng nhập giới hạn sử dụng hợp lệ';
                return false;
            } else {
                usageLimitError.innerText = '';
                return true;
            }
        }

        // kiểm tra maxDiscount disable tag
        function toggleMaxDiscount() {
            var discountType = document.getElementById('discount_type').value;
            var maxDiscount = document.getElementById('max_discount');

            if (discountType === 'percentage') {
                // Nếu discount_type là "percentage", enable max_discount
                maxDiscount.disabled = false;
            } else if (discountType === 'fixed') {
                // Nếu discount_type là "fixed", disable max_discount
                maxDiscount.disabled = true;
                maxDiscount.value = ''; // Reset giá trị của max_discount khi bị disable
            }
        }

        // Gán sự kiện change cho discount_type
        document.getElementById('discount_type').addEventListener('change', toggleMaxDiscount);

        // Gọi hàm toggleMaxDiscount khi trang được tải để đảm bảo max_discount được set đúng
        document.addEventListener('DOMContentLoaded', function () {
            toggleMaxDiscount();
        });

        // Validate form trước khi submit
        document.getElementById('register-form').addEventListener('submit', function (event) {
            if (!validateCode() || !validateDiscountType() || !validateDiscountValue() || !validateMaxDiscount() || !validateMinOrderValue() ||
                !validateUsedTimes() || !validateStartDate() || !validateEndDate() || !validateUsageLimit()) {
                event.preventDefault(); // Dừng việc submit form nếu có lỗi
            }
        });

    </script>
@endpush
