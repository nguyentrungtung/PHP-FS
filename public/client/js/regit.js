document.addEventListener('DOMContentLoaded', function () {
    var nameInput = document.getElementById('name');
    var phoneInput = document.getElementById('phone');
    var passwordInput = document.getElementById('password');
    var dobInput = document.getElementById('date-of-birth');

    // Gán sự kiện blur để kiểm tra validate
    nameInput.addEventListener('blur', function () {
        validateName();
    });

    phoneInput.addEventListener('blur', function () {
        validatePhone();
    });

    passwordInput.addEventListener('blur', function () {
        validatePassword();
    });

    dobInput.addEventListener('blur', function () {
        validateDOB();
    });
});

// Hàm kiểm tra Họ và Tên
function validateName() {
    var name = document.getElementById('name').value;
    var nameError = document.getElementById('name-error');

    if (name === '') {
        nameError.innerText = 'Vui lòng nhập họ và tên';
        return false;
    } else if (name.length < 3) {
        nameError.innerText = 'Họ và tên phải có ít nhất 3 ký tự';
        return false;
    } else {
        nameError.innerText = '';
        return true;
    }
}

// Hàm kiểm tra Số điện thoại
function validatePhone() {
    var phone = document.getElementById('phone').value;
    var phoneError = document.getElementById('phone-error');
    var phonePattern = /^[0-9]{10,11}$/; // Chỉ chấp nhận số với 10-11 chữ số

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

// Hàm kiểm tra Mật khẩu
function validatePassword() {
    var password = document.getElementById('password').value;
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

// Hàm kiểm tra Ngày sinh
function validateDOB() {
    var dob = document.getElementById('date-of-birth').value;
    var dobError = document.getElementById('dob-error');

    if (dob === '') {
        dobError.innerText = 'Vui lòng chọn ngày sinh';
        return false;
    } else {
        dobError.innerText = '';
        return true;
    }
}

// Validate form trước khi submit
document.getElementById('register-form').addEventListener('submit', function (event) {
    if (!validateName() || !validatePhone() || !validatePassword() || !validateDOB()) {
        event.preventDefault(); // Dừng việc submit form nếu có lỗi
    }
});
