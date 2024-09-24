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
    const item=document.querySelector(".sub");
    item.addEventListener("mouseenter",showSubMenu);
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
    const cart=document.getElementById("cart");
    cart.addEventListener("mouseenter",showCart);
    cart.addEventListener("mouseleave",hiddenCart);
    userMenu();
    selectShipping();
});

function showCart(){
    const cart=document.getElementById("cart_list");
    if(cart.classList.contains("hidden")){
        cart.classList.remove("hidden");
    }
}

function hiddenCart(){
    const cart=document.getElementById("cart_list");
    if(!cart.classList.contains("hidden")){
        cart.classList.add("hidden");
    }
}

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
// 
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