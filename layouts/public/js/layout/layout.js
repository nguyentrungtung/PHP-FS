document.addEventListener("DOMContentLoaded",()=>{
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