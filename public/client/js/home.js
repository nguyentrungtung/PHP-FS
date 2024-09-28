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
// loading san pham
// tao html de render
function getProduct(product){
    return `<div class="col-lg-1-5">
        <div class="card product-item">
            ${product.sale!==0?`
            <div class="product-item__discount-wrap">
                <p class="product-item__discount-product">- ${product.sale}%</p>
                <img src="" alt="" class="product-item__discount-ship d-none">
            </div>`:''}
            <div class="product-item__img-wrap">
                <img
                    src="${product.img_url}"
                    class="product-item__img card-img-top"
                    alt="..."
                />
                <div class="product-item__frame d-none"></div>
            </div>
            <div class="card-body text-muted product-item__info">
                <p class="card-title product-item__name">${product.name}</p>
                <p class="card-text mb-1">ĐVT: ${product.unit}</p>
                <div class="product-item__info-price d-flex">
                    <p class="card-text text-danger fw-bold product-item__price-new m-0">${product.price}</p>
                    ${product.old_price!=0?`<span class="product-item__price-old ms-4 text-decoration-line-through">${product.old_price}</span>`:''}
                </div>
            </div>
            <!-- Product action -->
            <div class="product-item__action">
                <a href="#" class="d-block btn-cart--add" data-url="">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
                <a href="#" class="d-block btn-cart--add" >
                    <i class="fa-regular fa-heart"></i>
                </a>
            </div>
        </div>
    </div>`;
}
// lay them san pham neu san pham do con
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
}, { threshold: 0.3 });
