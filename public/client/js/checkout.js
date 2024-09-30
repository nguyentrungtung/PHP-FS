$(document).ready(function () {
    $('.checkout__method-cod, .checkout__method-online').on('click', function () {
        $('.checkout__method-cod').css('border', '2px solid rgb(230, 221, 221)');
        $('.checkout__method-online').css('border', '2px solid rgb(230, 221, 221)');
        $(this).css('border', '2px solid red');
    });

    $('.delivery-modal__store-item').on('click', function () {
        $('.delivery-modal__store-item').removeClass('active');
        $(this).addClass('active');
    });
});

// Validate form checkout
document.addEventListener('DOMContentLoaded', function () {
    // Lấy các input cần kiểm tra
    var nameInput = document.getElementById('name');
    var phoneInput = document.getElementById('phone');
    var addressInput = document.getElementById('address'); // Thêm trường địa chỉ

    // Sự kiện blur (khi người dùng rời khỏi input)
    nameInput.addEventListener('blur', function () {
        validateName();
    });

    phoneInput.addEventListener('blur', function () {
        validatePhone();
    });

    addressInput.addEventListener('blur', function () { // Thêm sự kiện cho địa chỉ
        validateAddress();
    });

    // Kiểm tra tên
    function validateName() {
        var name = nameInput.value;
        var nameError = document.getElementById('name-error');

        if (name === '') {
            nameError.innerText = 'Vui lòng nhập họ tên';
            return false;
        } else {
            nameError.innerText = '';
            return true;
        }
    }

    // Kiểm tra số điện thoại
    function validatePhone() {
        var phone = phoneInput.value;
        var phoneError = document.getElementById('phone-error');
        var phonePattern = /^[0-9]{10,11}$/; // Chấp nhận số điện thoại 10-11 chữ số

        if (phone === '') {
            phoneError.innerText = 'Vui lòng nhập số điện thoại';
            return false;
        } else if (!phone.match(phonePattern)) {
            phoneError.innerText = 'Số điện thoại không hợp lệ';
            return false;
        } else {
            phoneError.innerText = '';
            return true;
        }
    }

    // Kiểm tra địa chỉ
    function validateAddress() {
        var address = addressInput.value;
        var addressError = document.getElementById('address-error');

        if (address === '') {
            addressError.innerText = 'Vui lòng nhập địa chỉ';
            return false;
        } else {
            addressError.innerText = '';
            return true;
        }
    }

    // Kiểm tra form trước khi submit
    document.querySelector('.checkout__customer-form').addEventListener('submit', function (event) {
        if (!validateName() || !validatePhone() || !validateAddress()) {
            event.preventDefault(); // Dừng việc submit form nếu có lỗi
        }
    });
});

