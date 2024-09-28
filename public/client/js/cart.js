// Thêm sản phẩm vào giỏ hàng
function addToCart(event) {
    event.preventDefault();
    let urlCart = $(this).data("url");
    // let urlCart = $(event.currentTarget).data("url");
    let quantity = $('#input-quantity').val();
    let initItem = $('.product-details__unit-item');
    let unitName = initItem.text();
    let price = initItem.data("value");
    // Lấy giá trị của CSRF token từ thẻ meta trong trang HTML
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
                // Hiển thị thông báo thành công
                alert(response.message);

                // Cập nhật số lượng sản phẩm trong giỏ hàng
                $('#cart_count').text(response.data.count_number);
                // Cập nhật danh sách giỏ hàng
                $('.cart_list_items').html(response.data.cartListIcon);
                $('#cart-list').html(response.data.cartList);
            } else {
                alert("Không thể thêm sản phẩm vào giỏ hàng");
            }
        },
        error: function () {
            // alert("Lỗi khi thêm vào giỏ hàng");
        },

    });
}

$(document).ready(function () {
    $(document).on("click", ".btn_add-cart", addToCart);
});
