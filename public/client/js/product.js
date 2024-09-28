// Thay đổi hình ảnh chính
function changeImage(src) {
    document.getElementById('mainImage').src = src;
}

// Lưu tên sản phẩm ban đầu
let originalNameProduct = document.getElementById('product_name--detail').innerText;

// Thay đổi giá và tên sản phẩm khi chọn loại sản phẩm
function changePrice(value, ob) {
    const productNameDetail = document.getElementById('product_name--detail');
    productNameDetail.innerText = `${originalNameProduct} - ${ob.innerText}`;
    document.getElementById('product_price--detail').innerText = value.toLocaleString('vi-VN') + '₫';
}

// Hiển thị tab khi được chọn
function showTab(tabId) {
    // Ẩn tất cả các tab trước
    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('d-none'));

    // Hiển thị tab được chọn
    document.getElementById(`${tabId}-tab`).classList.remove('d-none');
}

// Xử lý thay đổi số lượng sản phẩm
function handleQuantityInput() {
    const minusBtn = $('.icon-minus');
    const plusBtn = $('.icon-flus');
    const quantityInput_ = $('.input-quantity');
    const addCartBtn = $('.btn-add-cart');
    let stock = $('#product-stock').data('quantity') || 100;

    minusBtn.on('click', function () {
        let quantity = parseInt(quantityInput_.val());
        if (quantity > 1) {
            quantityInput_.val(--quantity);
        }
        addCartBtn.prop('disabled', quantity > stock);
    });

    plusBtn.on('click', function () {
        let quantity = parseInt(quantityInput_.val());
        quantityInput_.val(++quantity);
        addCartBtn.prop('disabled', quantity > stock);
    });
}

// Gọi hàm khi cần xử lý số lượng sản phẩm
handleQuantityInput();

// Owl Carousel cấu hình và hover
$(document).ready(function () {
    const owl = $('.owl-carousel');
    owl.owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 1500,
        autoplaySpeed: 500,
        responsive: {
            0: {items: 1},
            600: {items: 3},
            1000: {items: 5}
        },
    });

    owl.on('mouseover', () => owl.trigger('stop.owl.autoplay'));
    owl.on('mouseleave', () => owl.trigger('play.owl.autoplay', [1500]));
});

// xét chiều cao cho các item bằng nhau
function setEqualHeightForItems() {
    let productItems = document.querySelectorAll('.product-item');
    let maxHeight = 0;

    // Tìm chiều cao lớn nhất của các item
    productItems.forEach(function (item) {
        let itemHeight = item.offsetHeight;
        if (itemHeight > maxHeight) {
            maxHeight = itemHeight;
        }
    });

    // Đặt chiều cao của tất cả các item theo chiều cao lớn nhất
    productItems.forEach(function (item) {
        item.style.height = maxHeight + 'px';
    });
}

// Gọi hàm khi trang được tải
window.onload = setEqualHeightForItems;

// Gọi hàm khi trang được tải
window.onload = setEqualHeightForItems;


