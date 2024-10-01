$(document).ready(function () {
    function showToast(toastSelector, buttonSelector, message) {
        $(buttonSelector).on('click', function () {
            // alert(message);
            const toastElement = $(toastSelector);
            // Tùy chỉnh vị trí của toast
            toastElement.css({
                'position': 'fixed',
                'top': '130px',
                'right': '20px'
            });

            // Thay đổi nội dung thông báo
            toastElement.find('.toast-body').text(message);
            console.log([toastElement.find('.toast-body').text(message)])
            // Tạo toast với thời gian delay tùy chỉnh
            const toastBootstrap = new bootstrap.Toast(toastElement[0], {
                delay: 1000
            });

            toastBootstrap.show();
        });
    }

    // Gọi hàm showToast để hiển thị toast với thông báo
    showToast('.liveToast', '.liveToastBtn', 'Cập nhật trạng thái thành công!');
});
