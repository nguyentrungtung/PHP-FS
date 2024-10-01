$(document).ready(function () {

    function debounce(func, wait) {
        let timeout;
        return function (...args) {
            const context = this;
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(context, args), wait);
        };
    }

    // Thêm sản phẩm vào giỏ hàng
    function addToCart(event) {
        event.preventDefault();
        var urlCart = $(this).data("url");
        var quantity = $('#input-quantity').val();
        var unitName = $(this).data("unit_name");
        var price = $(this).data("product_price");
        var availableStock = $(this).data("available_stock");
        var productId = $(this).data("product_id");

        if (!quantity) {
            quantity = 1;
        }

        // Kiểm tra tồn kho trước khi thêm vào giỏ hàng
        if (quantity > availableStock) {
            // alert("Sản phẩm đã hết hàng hoặc số lượng vượt quá tồn kho hiện tại.");
            return;
        }

        $.ajax({
            method: "POST",
            url: urlCart,
            dataType: "json",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                quantity,
                unitName,
                price
            },
            success: function (response) {
                if (response.status) {
                    // showToast('.liveToast', '.liveToastBtn', response.message);
                    // alert(response.message);
                    $('#cart_count').text(response.data.count_number);
                    $('#count_cart--icon').html(response.data.cartListIcon);
                    $('#cart-list').html(response.data.cartList);
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("Lỗi khi thêm vào giỏ hàng");
            },
        });
    }

    // Xóa tất cả sản phẩm trong giỏ hàng
    function clearCart(event) {
        event.preventDefault();
        let urlClearCart = $(this).data("url");

        $.ajax({
            method: 'POST',
            url: urlClearCart,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    // alert(response.message);
                    $('#count_cart--icon').empty();
                    $('#cart-list').empty();
                    $('#cart_empty--text').css('display', 'block');
                    $('.cart__summary').css('display', 'none');
                    $('#cart_count').text(0)
                    $('#cart_list').css('opacity', 0);
                }
            },
            error: function (error) {
                alert('Đã có lỗi xảy ra khi xóa giỏ hàng');
            }
        });
    }

    // Cập nhật giỏ hàng khi thay đổi số lượng
    function updateCartQuantity(event) {
        event.preventDefault();
        var newQuantity = $(this).val();
        var cartItemId = $(this).closest('.cart__item').data('id');
        let urlUpdateCart = $(this).data("url_update_cart");
        // số lượng sản phẩm còn
        let availableQuantity = parseInt($(this).data('available-quantity'));

        // Kiểm tra xem số lượng mới có lớn hơn số lượng có sẵn không
        if (newQuantity > availableQuantity) {
            alert('Số lượng không được vượt quá số lượng có sẵn: ' + availableQuantity);
            $(this).val(availableQuantity); // Đặt lại giá trị về số lượng tối đa có sẵn
            newQuantity = availableQuantity; // Cập nhật newQuantity về giá trị có sẵn
        }

        $.ajax({
            type: 'GET',
            url: urlUpdateCart,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: cartItemId,
                quantity: newQuantity
            },
            success: function (response) {
                $('#count_cart--icon').html(response.data.cartListIcon);
                // $('#cart-list').html(response.data.cartList);
                // var cartItem = $('.cart__item-' + response.data.productId);
                // cartItem.find('.cart__item-quantity').val(newQuantity);
                $('.cart__item-quantity-' + response.data.productId).val(newQuantity);

                // Cập nhật lại các thông số tổng
                $('#cart_count').text(response.data.count_number);
                $('#cart__summary-subtotal').text(response.data.cartSummary.subtotal.toLocaleString('vi-VN') + '₫')
                $('#cart__summary-totalsaving').text(response.data.cartSummary.totalSaving.toLocaleString('vi-VN') + '₫')
                $('#cart__summary-totalprice').text(response.data.cartSummary.totalPrice.toLocaleString('vi-VN') + '₫')
            },
            error: function (error) {
                console.error('Đã có lỗi xảy ra:', error);
                alert('Cập nhật giỏ hàng thất bại. Vui lòng thử lại.');
            }
        });
    }

    // Xóa từng sản phẩm trong giỏ hàng
    function removeCart(event) {
        event.preventDefault();
        let urlRemoveCart = $(this).data("url");

        $.ajax({
            url: urlRemoveCart,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                if (response.status) {
                    // alert(response.message);
                    // Cập nhật lại giao diện giỏ hàng sau khi xóa
                    $('.cart__item-' + response.data.productId).remove();
                    $('#count_cart--icon').html(response.data.cartListIcon);
                    // Cập nhật lại các thông số tổng
                    $('#cart_count').text(response.data.count_number);
                    $('#cart__summary-subtotal').text(response.data.cartSummary.subtotal.toLocaleString('vi-VN') + '₫');
                    $('#cart__summary-totalsaving').text(response.data.cartSummary.totalSaving.toLocaleString('vi-VN') + '₫');
                    $('#cart__summary-totalprice').text(response.data.cartSummary.totalPrice.toLocaleString('vi-VN') + '₫');
                    if (response.data.count_number <= 0) {
                        $('.cart__summary').css('display', 'none');
                        $('#btn_cart--clear').css('display', 'none');
                        $('#cart_empty--text').css('display', 'block');
                    }
                }
            },
            error: function (xhr) {
                console.error('Có lỗi xảy ra:', xhr);
            }
        });
    }

    // Lưu thông tin giá giỏ hàng
    function saveSummary(event) {
        event.preventDefault();
        let urlSaveSummary = $(this).data("url_save_summary");
        let subtotal = $('#cart__summary-subtotal').text().replace(/[^\d]/g, '');
        let totalSaving = $('#cart__summary-totalsaving').text().replace(/[^\d]/g, '');
        let totalPrice = $('#cart__summary-totalprice').text().replace(/[^\d]/g, '');
        let discount = $('#cart__summary-discount').text().replace(/[^\d]/g, '');

        $.ajax({
            url: urlSaveSummary,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                subtotal: subtotal,
                totalSaving: totalSaving,
                totalPrice: totalPrice,
                discount: discount
            },
            success: function (response) {
                if (response.status) {
                    // Chuyển hướng sang trang checkout sau khi lưu thành công
                    window.location.href = '/checkout';
                } else {
                    alert('Không thể lưu thông tin giỏ hàng. Vui lòng thử lại.');
                }
            },
            error: function (xhr) {
                console.error('Có lỗi xảy ra:', xhr);
            }
        });
    }

    // sử dụng coupon
    function applyCoupon(event) {
        event.preventDefault();
        var couponId = $(this).data('coupon-id');
        var url = $(this).data('url_coupon');

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                coupon_id: couponId,
            },
            success: function (response) {
                if (response.status) {
                    alert(response.message); // Thông báo thành công
                    // Cập nhật tổng giá trị đơn hàng
                    var discount = response.discount; // Giá trị giảm giá
                    var discountType = response.discount_type; // Loại giảm giá (phần trăm hoặc giá cố định)
                    var totalPriceElement = $('#cart__summary-totalprice'); // lấy giá đơn hàng
                    var currentTotal = parseFloat(totalPriceElement.text().replace(/[^0-9.-]+/g, ""));
                    var newTotal;

                    // Kiểm tra loại giảm giá
                    if (discountType == 'percentage') {
                        // Giảm giá theo phần trăm
                        newTotal = currentTotal - (currentTotal * (discount / 100));
                    } else if (discountType == 'fixed') {
                        // Giảm giá theo giá cố định
                        newTotal = currentTotal - discount;
                    }

                    // tổng không âm
                    newTotal = Math.max(newTotal, 0);

                    // Cập nhật giá trị mới
                    totalPriceElement.text(newTotal.toLocaleString('vi-VN') + '₫'); // Cập nhật giá trị mới
                    var discountAmount = currentTotal - newTotal; // Tính số tiền được giảm
                    $('#cart__summary-discount').text(discountAmount.toLocaleString('vi-VN') + '₫'); // Cập nhật giá trị khuyến mại
                } else {
                    alert(response.message); // Thông báo lỗi
                }
            },
            error: function (xhr) {
                alert('Đã xảy ra lỗi. Vui lòng thử lại sau.');
            }
        });
    }

    // Đăng ký sự kiện click cho nút thêm vào giỏ hàng
    $(document).on("click", ".btn_add-cart", addToCart);

    // Đăng ký sự kiện click cho nút xóa giỏ hàng
    $(document).on('click', '#btn_cart--clear', clearCart);

    // Đăng ký sự kiện click cho nút xóa item giỏ hàng
    $(document).on('click', '.cart__item-remove', removeCart);

    // Đăng ký sự kiện thay đổi số lượng sản phẩm trong giỏ hàng với debounce
    $(document).on('change', '.cart__item-quantity', debounce(updateCartQuantity, 700));

    //
    $(document).on("click", "#btn-checkout_cart-detail", saveSummary);

    // Đăng ký sự kiện click cho nút sử dụng coupon
    $(document).on("click", ".coupon-list__btn--apply", applyCoupon);
});
