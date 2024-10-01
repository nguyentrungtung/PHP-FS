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
     detail();
    // detail();
    //
})
// dem nguoc thoi gian
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
// hover brand
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
// banner slide
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
// lay du lieu cua san pham qua ajax va render ra man hinh
function fetchData(element) {
    const id=element.getAttribute('data-id');
    const name=element.getAttribute('data-name');
    const content=element.querySelector('.list_content');
    const list_products=element.querySelector('.list_products');
    ajax([id,list_products,content,name,element],addProducts)
}
//
function ajax(elements,callback){
    const [id]=elements;
    $.ajax({
        url: '/client/products/fillter',
        type: 'GET',
        data:{
            _token: '{{ csrf_token() }}',
            catId:id,
            start:countCats[id]?countCats[id]['start']:0,
            limit:10
        },
        success: function(response) {
            callback(elements,response);
        }
    });
}
// chuyen doi du lieu truoc khi render ra man hinh
function changeData(id,response){
    const products=(response.products);
    const remain=(response.remain);
    let newArr=[];
    products.forEach(product => {
        newArr.push(productItem(product));
    });
    if((countCats[id])){
        countCats[id]['remain']-=10;
        countCats[id]['start']+=10;
    }else{
        countCats[id]={'remain':remain,'start':10};
    }
    return newArr.join('');
}
// them san pham va loai bo phan loading
function addProducts(elements,response){
    const[id,list_products,content,name,element]=elements;
    list_products.innerHTML=changeData(id,response);
    if(countCats[id]['remain']>0){
        content.innerHTML+=`<div data-id="${id}" class="list_load_more">
            <p class="more_text">Xem Thêm <p class="more_text count">${countCats[id]['remain']}</p> sản phẩm </p>
            <p class="more_text cat_name">${name}</p>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
              </svg>
        </div>`;
        const load =content.querySelector('.list_load_more');
        LoadMore(load,id,element);
    }
    //  detail();
}
// load them san pham vao danh sach
function loadProducts(element,response){
    const [id,load,list_products,count]=element;
    const html=changeData(id,response);
    list_products.innerHTML+=html;
    //  detail();
    if(countCats[id]['remain']<=0){
        load.classList.add('hidden');
    }else{
        count.innerHTML=countCats[id]['remain'];
    }
}
// loading san pham
// lay them san pham neu san pham do con
function LoadMore(load,id,element){
    load.addEventListener('click',()=>{
        const count=load.querySelector('.count');
        const list_products=element.querySelector('.list_products');
        ajax([id,load,list_products,count],loadProducts)
    })
}
// tao html de render
function productItem(product){
    console.log(product);
    return `
        <div class="col-lg-1-5">
            <div data-id="${product.id}" class="card product-item">
                <a href="${product.detail_url}" class="detail_link">
                    ${product.sale!==0?
                        `<div class="product-item__discount-wrap">
                            <p class="product-item__discount-product">- ${product.sale}%</p>
                            <img src="" alt="" class="product-item__discount-ship d-none">
                        </div>`:''}
                    <div class="product-item__img-wrap">
                        <div class="product-item__img-wrap">
                            <img
                                src="${product.product_image}"
                                class="product-item__img card-img-top"
                                alt="..."
                            />
                            <div class="product-item__frame d-none"></div>
                        </div>
                        <div class="product-item__frame d-none"></div>
                    </div>
                    <div class="card-body text-muted product-item__info">
                        <p class="card-title product-item__name">${product.product_name}</p>

                        <p class="card-text mb-1">ĐVT: <span class="product-details__unit-item"
                            data-value="${Number(product.product_price).toLocaleString('en-US')}">${product.product_unit}</span>
                        </p>
                        <p class="card-text text-danger fw-bold">${Number(product.product_price).toLocaleString('en-US')}
                            đ</p>
                    </div>
                </a>
                
                <!-- Product action -->
                <div class="product-item__action">
                    <a href="#" class="d-block btn__add-cart btn_add-cart"
                        data-product_id = "${product.id}"
                        data-available_stock = "1"
                        data-unit_name="${product.product_unit}"
                        data-product_price="${product.product_price}"
                       data-url="${product.add_url}">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    <a href="#" class="d-block btn__add-cart btn_add-cart">
                        <i class="fa-regular fa-heart"></i>
                    </a>
                </div>
            </div>
        </div>
    `;
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
}, { threshold: 0.3 });

