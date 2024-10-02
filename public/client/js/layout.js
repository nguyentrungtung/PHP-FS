document.addEventListener("DOMContentLoaded", () => {
    window.addEventListener('scroll', function () {
        const header = document.querySelector('.header'); // Chọn phần tử header
        if (window.scrollY > 100) {
            header.classList.add('fix'); // Thêm class 'fix' nếu cuộn quá 100px
        } else {
            header.classList.remove('fix'); // Loại bỏ class 'fix' nếu cuộn dưới 100px
        }
    });
    const menu = document.getElementById("menu");
    menu.addEventListener("mouseenter", showMenu);
    menu.addEventListener("mouseleave", hiddenMenu);
    const host = document.getElementById("hostline");
    host.addEventListener("mouseenter", showHostline);
    host.addEventListener("mouseleave", hiddenHostline);
    //
    const formSearch = document.getElementById("form_search");
    const search = document.getElementById("search_input");
    formSearch.addEventListener('click', () => {
        search.focus();
    })
    // Bắt sự kiện click ra ngoài form
    document.addEventListener('click', (event) => {
        if (!formSearch.contains(event.target)) {
            // Nếu click không nằm trong form, thực hiện hành động tương ứng
            hiddenEx(); // Ẩn danh sách tìm kiếm (nếu có)
        }
    });
    search.addEventListener("focus", showEx);
    // search.addEventListener("blur",hiddenEx);
    //
    // const cart = document.getElementById("cart");
    // cart.addEventListener("mouseenter", showCart);
    // cart.addEventListener("mouseleave", hiddenCart);
    userMenu();
    selectShipping();
    const items = document.querySelectorAll(".sub");
    hoverParentCat(items);
    searchValue();
});

// function showCart() {
//     const cart = document.getElementById("cart_list");
//     console.log(cart);
//     if (cart.classList.contains("hidden")) {
//         // $.ajax({
//         //     url: 'client/cart/show',
//         //     type: 'GET',
//         //     success: function(response) {
//         //         console.log('check');
//         //         let newArr=[];
//         //         Object.values(response).forEach(product => {
//         //             newArr.push(changeCartData(product));
//         //         });
//         //         const list=document.querySelector('.cart_list_items');
//         //         list.innerHTML=newArr.join('');
//         //     }
//         // });
//         cart.classList.remove("hidden");
//     }
// }

function changeCartData(product) {
    let price = product.product_price * product.product_quantity;
    price = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    }).format(price);
    return `<div class="d-flex list_items_item">
        <img src="${product.product_image}" alt="" class="item_img">
        <div class="d-flex flex-wrap flex-column item_content">
            <p class="item_content_text">${product.product_name}</p>
            <div class="d-flex justify-content-between content_dv">
                <p class="item_content_text">DVT:</p>
                <p class="item_content_text">${product.product_unit}</p>
            </div>
            <div class="d-flex justify-content-between item_content_price">
                <p class="item_content_text">x ${product.product_quantity}</p>
                <p class="item_price">${price}</p>
            </div>
        </div>
    </div>`;
}

// function hiddenCart() {
//     const cart = document.getElementById("cart_list");
//     if (!cart.classList.contains("hidden")) {
//         cart.classList.add("hidden");
//     }
// }

function showEx() {
    const ex = document.getElementById("search_ex");
    if (ex.classList.contains("hidden")) {
        ex.classList.remove("hidden");
    }
}

//
function search() {
    const values = document.querySelectorAll('.current_value');
    values.forEach(value => {
        value.addEventListener('click', () => {
            $.ajax({
                url: '/search',
                type: 'GET',
                data: {
                    'search': value.innerHTML
                },
                success: function (response) {
                    $('.main-content').html(response); // Cập nhật nội dung trang bằng phản hồi
                    window.history.pushState({path: '/search'}, '', '/search');
                }
            })
        })
    })
}

//
function hiddenEx() {
    const ex = document.getElementById("search_ex");
    if (!ex.classList.contains("hidden")) {
        ex.classList.add("hidden");
    }
}

function showHostline() {
    const hostline = document.getElementById("hostline_infor");
    if (hostline.classList.contains("hidden")) {
        hostline.classList.remove("hidden");
    }
}

function hiddenHostline() {
    const hostline = document.getElementById("hostline_infor");
    if (!hostline.classList.contains("hidden")) {
        hostline.classList.add("hidden");
    }
}

function showMenu() {
    const menu = document.getElementById("menu_list");
    if (menu.classList.contains("hidden")) {
        menu.classList.remove("hidden");
    }
}

function showSubMenu() {
    const menu = document.getElementById("sub_list");
    if (menu.classList.contains("hidden")) {
        menu.classList.remove("hidden");
    }
}

//
function hiddenMenu() {
    const menu = document.getElementById("menu_list");
    const sub_menu = document.getElementById("sub_list");
    if (!menu.classList.contains("hidden")) {
        menu.classList.add("hidden");
    }
    if (!sub_menu.classList.contains("hidden")) {
        sub_menu.classList.add("hidden");
    }

}

function hoverParentCat(list) {
    const menu = document.getElementById("sub_list");
    const ul = document.getElementById('child_cat');
    if (menu.classList.contains("hidden")) {
        menu.classList.remove("hidden");
    }
    list.forEach(cat => {
        cat.addEventListener('mouseenter', () => {
            menu.classList.remove("hidden");
            const sublist = JSON.parse(cat.getAttribute('data-child'));
            const newList = [];
            sublist.forEach(item => {
                newList.push(`<a data-parent_id='${item['parent_id']}' href="${item['route']}"><li class="menu_list_ul_li text-capitalize">${item['name']}</li></a>`)
            })
            ul.innerHTML = newList.join('');
        })
    });
}

//
function userMenu() {
    const user = document.getElementById('user_zone');
    const menu = document.getElementById('user_menu');
    user.addEventListener("mouseenter", () => {
        menu.classList.remove('hidden');
    })
    user.addEventListener("mouseleave", () => {
        menu.classList.add('hidden');
    })
}

//
function selectShipping() {
    const close = document.getElementById('close_shipping');
    const shipping = document.getElementById('shipping_select');
    const btn = document.getElementById('ship_zone');
    btn.addEventListener("click", () => {
        shipping.classList.remove('hidden');
    });
    close.addEventListener("click", () => {
        shipping.classList.add('hidden');
    });
}

// bat su kien an cac search value
function searchValue() {
    const values = document.querySelectorAll('.current_value');
    const input = document.getElementById('search_input');
    const form = document.getElementById('form_search');
    console.log(values);
    values.forEach(item => {
        item.addEventListener('click', (e) => {
            input.focus();
            console.log('check');
            input.value = item.getAttribute('data-value');
            form.submit();
        })
    })
}


//Toast Message
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
                delay: 500
            });

            toastBootstrap.show();
        });
    }

    // Gọi hàm showToast để hiển thị toast với thông báo
    showToast('.liveToast', '.liveToastBtn', 'Đã thêm vào giỏ hàng thành công');
    showToast('.live-toast--remove-cart', '.live-toast__btn--remove-cart', 'Xóa thành công');
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



