function changeImage(src) {
    document.getElementById('mainImage').src = src;
}

function showTab(tabId) {
    // Ẩn tất cả các tab trước
    document.getElementById('description-tab').classList.add('d-none');
    document.getElementById('info-tab').classList.add('d-none');

    // Hiển thị tab được chọn
    document.getElementById(tabId + '-tab').classList.remove('d-none');
}

function handleQuantityInput() {
    const minusBtn = $('.icon-minus');
    const plusBtn = $('.icon-flus');
    const quantityInput_ = $('.input-quantity');
    let stockProduct = $('#product-stock').attr('data-quantity');
    const addCartBtn = $('.btn-add-cart');
    let stock = 100; // Hoặc lấy giá trị từ data-quantity
    // let stock = $('#product-stock').data('quantity');

    minusBtn.on('click', function () {
        let quantity = parseInt(quantityInput_.val());
        if (quantity > 1) {
            quantity -= 1;
            quantityInput_.val(quantity);

            if (quantity > stock) {
                addCartBtn.prop('disabled', true);
            } else {
                addCartBtn.prop('disabled', false);
            }
        }
    });

    plusBtn.on('click', function () {
        let quantity = parseInt(quantityInput_.val());
        quantity += 1;
        quantityInput_.val(quantity);

        if (quantity > stock) {
            addCartBtn.prop('disabled', true);
        } else {
            addCartBtn.prop('disabled', false);
        }
    });
}

// Gọi hàm khi cần xử lý số lượng sản phẩm
handleQuantityInput();

// ---------------------------

$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 1500, // Thời gian dừng giữa các slide (1 giây)
        autoplaySpeed: 500, // Tốc độ chuyển đổi giữa các slide (0.5 giây)
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 3,
            },
            1000: {
                items: 5,
            },
        },
    });
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
