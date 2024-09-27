const countCats=[];
document.addEventListener("DOMContentLoaded",()=>{
    countdown();
    hoverPartner();
    bannerSlider();
    partnerSlide();
    const targets = document.querySelectorAll('.home_cat_list');
    targets.forEach(target => {
        observer.observe(target); // Theo dõi từng phần tử
    });
    LoadMore();
    addCart();
    // 
})
// 
function countdown(){
    const sec=document.getElementById("countdown_sec");
    const hour=document.getElementById("countdown_hours");
    const min=document.getElementById("countdown_minutes");
    setInterval(()=>{
        secValue=parseInt(sec.innerText);
        minValue=parseInt(min.innerText);
        hourValue=parseInt(hour.innerText);
        if(secValue>0){
            secValue-=1;
            if(secValue===0){
                if(hour===0&&minValue===0){
                    secValue=-1;
                    return;
                }
                minValue-=1;
                if(minValue<0){
                    hourValue-=1;
                    if(hourValue<0){
                        secValue=-1;
                        return; 
                    }
                    hour.innerHTML=hourValue;
                    minValue=59;
                    
                }
                min.innerHTML=minValue;
                secValue=60;
            }
            sec.innerHTML=secValue;
        }
        
    },1000);
}
// 
function hoverPartner(){
    const listFartner=document.querySelectorAll(".partner_logo");
    listFartner.forEach(partner => {
        partner.addEventListener("mouseenter",()=>{
            partner.classList.remove('filler');
        })
        partner.addEventListener("mouseleave",()=>{
            partner.classList.add('filler');
        })
    });
}
// 
function bannerSlider(){
    const slides = document.querySelectorAll('.banners_slide_img');
    const dots = document.querySelectorAll('.switch_dot');
    const btnLeft = document.querySelector('.buttons_left');
    const btnRight = document.querySelector('.buttons_right');

    let currentSlide = 0;
    const totalSlides = slides.length;
    let slideInterval;
    const slideIntervalTime = 3000;
    function autoSlide(){
        slideInterval =setInterval(()=>{
            currentSlide++;
            if(currentSlide===totalSlides){
                currentSlide = 0;
            }
            updateSlidePosition();
        },slideIntervalTime);
    }
    // Hàm cập nhật vị trí của ảnh
    function updateSlidePosition() {
      slides.forEach((slide) => {
        slide.style.transform = `translateX(${(-currentSlide) * 100}%)`;
      });
      
      dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
      });
    }

    // Chuyển đến slide kế tiếp
    btnRight.addEventListener('click', () => {
        clearInterval(slideInterval);
      currentSlide = (currentSlide + 1) % totalSlides;
      updateSlidePosition();
      autoSlide();
    });

    // Quay về slide trước đó
    btnLeft.addEventListener('click', () => {
        clearInterval(slideInterval);
      currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
      updateSlidePosition();
      autoSlide();
    });

    // Chuyển slide khi nhấp vào các dot
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        currentSlide = index;
        clearInterval(slideInterval);
        updateSlidePosition();
        autoSlide();
      });
    });
    // Khởi tạo vị trí ban đầu
    updateSlidePosition();
    autoSlide();
}

function partnerSlide(){
    const slide=document.getElementById('list_partner');
    const left=document.getElementById('partner_left');
    const partners=document.querySelectorAll('.partner_logo');
    const right=document.getElementById('partner_right');
    const total=Math.ceil(partners.length/5);
    let current=0;
    right.addEventListener('click', () => {
        if(current<total-1){
            current++;
            slide.style.transform=`translateX(-${current*100}%)`;
            if(left.classList.contains('hidden')){
                left.classList.remove('hidden');
            }
        }
        if(current===total-1){
            right.classList.add('hidden');
        }
    });
    left.addEventListener('click', () => {
        if(current>0){
            current--;
            slide.style.transform=`translateX(-${current*100}%)`;
            if(right.classList.contains('hidden')){
                right.classList.remove('hidden');
            }
        }
        if(current===0){
            left.classList.add('hidden');
        }
    });
}
// 
function fetchData(element) {
    // Giả sử đây là phần logic để lấy dữ liệu sản phẩm từ server
    const id=element.getAttribute('data-id');
    const list_products=element.querySelector('.list_products');
    const count=element.querySelector('.count');
    $.ajax({
        url: 'client/products/' + id + '/' + 0 + '/' + 10,
        type: 'GET',
        success: function(response) {
            const products=(response.products);
            const remain=(response.remain);
            let newArr=[];
            products.forEach(product => {
                newArr.push(getProduct(product));
            });
            if((countCats[id])){
                countCats[id]['remain']-=10;
                countCats[id]['start']+=10;
            }else{
                countCats[id]={'remain':remain,'start':10};
            }
            console.log(countCats);
            const html=newArr.join('');
            list_products.innerHTML=html;
            count.innerHTML=remain;
            addCart();
        },
        error: function(xhr) {
            // Xử lý lỗi nếu có
            alert('False to loading data.');
        }
    });
}
// 
function getProduct(product){
    const price = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    }).format(product.price);
    const old = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
    }).format(product.old);
    return `
        <div class="d-flex flex-column justify-content-between align-items-center product">
            ${product.sale!==0?`<div class="d-flex justify-content-center align-items-center product_pin">
                ${product.sale}%
            </div>`:''}
            <div class="d-flex justify-content-center align-items-center product_img">
                <img src="${product.img_url}" class="product_img_content">
            </div>
            <div class="d-flex flex-column justify-content-end product_content">
                <div class="d-flex flex-column content_text">
                    <p class="product_content_text">${product.name}</p>
                    <p class="product_content_text">ĐVT: Cuộn</p>
                    <div class="d-flex product_content_price">
                        <p class="content_price price_sale">${price}</p>
                        ${product.old!==0?`<p class="text-decoration-line-through content_price price_old">${old}</p>`:''}
                    </div>
                </div>
                <div data-id="${product.id}" class="d-flex justify-content-between align-items-center content_add">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                        <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                      </svg>
                      <p class="cart_add">Thêm vào giỏ hàng</p>
                </div>
            </div>
        </div>
    `;
}
// 
function LoadMore(){
    const listLoad=document.querySelectorAll('.list_load_more');
    listLoad.forEach(load=>{
        const id=load.getAttribute('data-id');
        
        load.addEventListener('click',()=>{
            const parent = load.parentElement;
            // console.log(parent);
            const count=parent.querySelector('.count');
            const list_products=parent.querySelector('.list_products');
            $.ajax({
                url: 'client/products/' + id + '/' + countCats[id]['start'] + '/' + 10,
                type: 'GET',
                success: function(response) {
                    const products=(response.products);
                    const remain=(response.remain);
                    let newArr=[];
                    products.forEach(product => {
                        newArr.push(getProduct(product));
                    });
                    countCats[id]['remain']-=10;
                    countCats[id]['start']+=10;
                    console.log(countCats);
                    const html=newArr.join('');
                    list_products.innerHTML+=html;
                    if(remain<=0){
                        load.classList.add('hidden');
                    }else{
                        count.innerHTML=remain;
                    }
                    addCart();
                },
                error: function(xhr) {
                    // Xử lý lỗi nếu có
                    alert('False to loading data.');
                }
            });
        })
    })
}
// Tạo IntersectionObserver để theo dõi nhiều phần tử với class home_cat_list
const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // Khi một element home_cat_list xuất hiện trong viewport, lấy dữ liệu
            fetchData(entry.target);
            // Ngừng theo dõi element này sau khi đã tải dữ liệu
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.3 }); // Chạy khi 10% element đã vào khung nhìn
// 
function addCart(){
    const btns=document.querySelectorAll('.content_add');
    console.log(btns);
    btns.forEach(btn=>{
        const id=btn.getAttribute('data-id');
        btn.addEventListener('click',()=>{
            $.ajax({
                url: 'client/products/add/' + id,
                type: 'GET',
                success: function(response) {
                    const cart=document.getElementById('cart_count');
                    const count = parseInt(cart.innerHTML)+1;
                    cart.innerHTML= count;
                },
                error: function(xhr) {
                    // Xử lý lỗi nếu có
                    alert('False to loading data.');
                }
            });
        })
    })
}