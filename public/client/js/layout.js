document.addEventListener("DOMContentLoaded",()=>{
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.header'); // Chọn phần tử header
        if (window.scrollY > 100) {
            header.classList.add('fix'); // Thêm class 'fix' nếu cuộn quá 100px
        } else {
            header.classList.remove('fix'); // Loại bỏ class 'fix' nếu cuộn dưới 100px
        }
    });
    const menu=document.getElementById("menu");
    menu.addEventListener("mouseenter",showMenu);
    menu.addEventListener("mouseleave",hiddenMenu);
    const host=document.getElementById("hostline");
    host.addEventListener("mouseenter",showHostline);
    host.addEventListener("mouseleave",hiddenHostline);
    //
    const formSearch=document.getElementById("form_search");
    const search=document.getElementById("search_input");
    formSearch.addEventListener('click',()=>{
        search.focus();
    })

    search.addEventListener("focus",showEx);
    search.addEventListener("blur",hiddenEx);
    //
    // const cart=document.getElementById("cart");
    // cart.addEventListener("mouseenter",showCart);
    // cart.addEventListener("mouseleave",hiddenCart);
    userMenu();
    selectShipping();
    const items=document.querySelectorAll(".sub");
    hoverParentCat(items);
});

function showEx(){
    const ex=document.getElementById("search_ex");
    if(ex.classList.contains("hidden")){
        ex.classList.remove("hidden");
    }
}

function hiddenEx(){
    const ex=document.getElementById("search_ex");
    if(!ex.classList.contains("hidden")){
        ex.classList.add("hidden");
    }
}

function showHostline(){
    const hostline=document.getElementById("hostline_infor");
    if(hostline.classList.contains("hidden")){
        hostline.classList.remove("hidden");
    }
}

function hiddenHostline(){
    const hostline=document.getElementById("hostline_infor");
    if(!hostline.classList.contains("hidden")){
        hostline.classList.add("hidden");
    }
}
function showMenu(){
    const menu=document.getElementById("menu_list");
    if(menu.classList.contains("hidden")){
        menu.classList.remove("hidden");
    }
}

function showSubMenu(){
    const menu=document.getElementById("sub_list");
    if(menu.classList.contains("hidden")){
        menu.classList.remove("hidden");
    }
}
//
function hiddenMenu(){
    const menu=document.getElementById("menu_list");
    const sub_menu=document.getElementById("sub_list");
    if(!menu.classList.contains("hidden")){
        menu.classList.add("hidden");
    }
    if(!sub_menu.classList.contains("hidden")){
        sub_menu.classList.add("hidden");
    }

}
function hoverParentCat(list){
    const menu=document.getElementById("sub_list");
    const ul=document.getElementById('child_cat');
    let timeout;
    if(menu.classList.contains("hidden")){
        menu.classList.remove("hidden");
    }
    list.forEach(cat => {
        cat.addEventListener('mouseenter',()=>{
            clearTimeout(timeout);
            menu.classList.remove("hidden");
            const sublist =JSON.parse(cat.getAttribute('data-child'));
            const newList=[];
            sublist.forEach(item=>{
                newList.push(`<a data-parent_id='${item['parent_id']}' href=""><li class="menu_list_ul_li text-capitalize">${item['name']}</li></a>`)
            })
            html=newList.join('');
            ul.innerHTML=html;
        })
    });
}

function userMenu(){
    const user=document.getElementById('user_zone');
    const menu=document.getElementById('user_menu');
    user.addEventListener("mouseenter",()=>{
        menu.classList.remove('hidden');
    })
    user.addEventListener("mouseleave",()=>{
        menu.classList.add('hidden');
    })
}
//
function selectShipping() {
    const close=document.getElementById('close_shipping');
    const shipping=document.getElementById('shipping_select');
    const btn=document.getElementById('ship_zone');
    btn.addEventListener("click",()=>{
        shipping.classList.remove('hidden');
    });
    close.addEventListener("click",()=>{
        shipping.classList.add('hidden');
    });
}

// Hiển thị cart list
document.addEventListener('DOMContentLoaded', function () {
    const cartIconHeader = document.querySelector('.cart_icon-header');
    const cartList = document.getElementById('cart_list');

    // Khi hover vào `cart_icon-header` thì hiện `cart_list`
    cartIconHeader.addEventListener('mouseenter', function () {
        cartList.style.display = 'block';
    });

    // Khi rời chuột khỏi `cart_icon-header`
    cartIconHeader.addEventListener('mouseleave', function () {
        // Nếu không hover vào `cart_list` thì ẩn `cart_list`
        if (!cartList.matches(':hover')) {
            cartList.style.display = 'none';
        }
    });

    // Khi rời chuột khỏi `cart_list` thì ẩn `cart_list`
    cartList.addEventListener('mouseleave', function () {
        cartList.style.display = 'none';
    });
});







