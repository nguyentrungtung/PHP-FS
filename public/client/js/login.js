document.addEventListener('DOMContentLoaded', function () {
    // Lấy các input cần kiểm tra
    var phoneInput = document.getElementById('phone');
    var passwordInput = document.getElementById('password');

    // Sự kiện blur (khi người dùng rời khỏi input)
    phoneInput.addEventListener('blur', function () {
        validatePhone();
    });

    passwordInput.addEventListener('blur', function () {
        validatePassword();
    });

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

    // Kiểm tra mật khẩu
    function validatePassword() {
        var password = passwordInput.value;
        var passwordError = document.getElementById('password-error');

        if (password === '') {
            passwordError.innerText = 'Vui lòng nhập mật khẩu';
            return false;
        } else if (password.length < 6) {
            passwordError.innerText = 'Mật khẩu phải có ít nhất 6 ký tự';
            return false;
        } else {
            passwordError.innerText = '';
            return true;
        }
    }

    // Kiểm tra form trước khi submit
    document.getElementById('login-form').addEventListener('submit', function (event) {
        if (!validatePhone() || !validatePassword()) {
            event.preventDefault(); // Dừng việc submit form nếu có lỗi
        }
    });
});