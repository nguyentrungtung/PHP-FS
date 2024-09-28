$(document).ready(function () {
    // Thêm sản phẩm vào giỏ hàng
    function addToCart(event) {
        event.preventDefault();
        let urlCart = $(this).data("url");
        let quantity = $('#input-quantity').val();
        let initItem = $('.product-details__unit-item');
        let unitName = initItem.text();
        let price = initItem.data("value");
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            method: "POST",
            url: urlCart,
            dataType: "json",
            data: {
                quantity,
                unitName,
                price
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken // Gửi CSRF token
            },
            success: function (response) {
                if (response.status) {
                    alert(response.message);
                    $('#cart_count').text(response.data.count_number);
                    $('#count_cart--icon').html(response.data.cartListIcon);
                    $('#cart-list').html(response.data.cartList);
                } else {
                    alert("Không thể thêm sản phẩm vào giỏ hàng");
                }
            },
            error: function () {
                alert("Lỗi khi thêm vào giỏ hàng");
            },
        });
    }

    // Xóa tất cả sản phẩm trong giỏ hàng
    function clearCart(event) {
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
                    alert(response.message);
                    $('#count_cart--icon').empty();
                    $('#cart-list').empty();
                    $('#cart_empty--text').css('display', 'block');
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
    function updateCartQuantity() {
        var newQuantity = $(this).val();
        var cartItemId = $(this).closest('.cart__item').data('id');
        let urlUpdateCart = $(this).data("url_update_cart");

        $.ajax({
            type: 'GET',
            url: urlUpdateCart,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id: cartItemId,
                quantity: newQuantity
            },
            success: function(response) {
                $('#cart_count').text(response.data.count_number);
                $('#count_cart--icon').html(response.data.cartListIcon);
                $('#cart-list').html(response.data.cartList);
            },
            error: function(error) {
                console.error('Đã có lỗi xảy ra:', error);
                alert('Cập nhật giỏ hàng thất bại. Vui lòng thử lại.');
            }
        });
    }

    // Đăng ký sự kiện click cho nút thêm vào giỏ hàng
    $(document).on("click", ".btn_add-cart", addToCart);

    // Đăng ký sự kiện click cho nút xóa giỏ hàng
    $(document).on('click', '#btn_cart--clear', clearCart);

    // Đăng ký sự kiện thay đổi số lượng sản phẩm trong giỏ hàng
    $(document).on('change', '.cart__item-quantity', updateCartQuantity);
});
