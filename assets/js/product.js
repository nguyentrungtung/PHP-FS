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

//tăng giảm số lượng sản phẩm trang product detail
// function quantityInput() {
const minusBtn = $('.icon-minus');
const plusBtn = $('.icon-flus');
const quantityInput_ = $('.input-quantity');
let stockProduct = $('#product-stock').attr('data-quantity');
const addCartBtn = $('.btn-add-cart');
let stock = 100;
// let stock = $('#product-stock').data('quantity');

minusBtn.on('click', function () {
    let quantity = parseInt(quantityInput_.val());
    // console.log(quantity)

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
    // if (quantity < 10 || quantity < 0) {
    quantity += 1;
    quantityInput_.val(quantity);
    if (quantity > stock) {
        addCartBtn.prop('disabled', true);
    } else {
        addCartBtn.prop('disabled', false);
    }
    // }
});

//     if (stockProduct < 1) {
//         addCartBtn.prop('disabled', true);
//     }
// }

// ---------------------------

$(document).ready(function () {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: true,
        // autoplay: true,
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
