$(document).ready(function () {

    function updateStatusOrder(event) {
        // const orderId = $(this).data('order_id');
        var newStatus = $(this).data('value');
        var url = $(this).data('url');

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                newStatus: newStatus,
            },
            success: function (data) {
                if (data.status) {
                    // alert('Cập nhật trạng thái đơn hàng thành công');
                    $('.status-order-'+data.order_id).text(data.order_status);
                } else {
                    alert('Có lỗi xảy ra, vui lòng thử lại');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

// Đăng ký sự kiện click cho nút thêm vào giỏ hàng
    $(document).on("click", ".order-status", updateStatusOrder);
});

