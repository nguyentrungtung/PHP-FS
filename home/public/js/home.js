document.addEventListener("DOMContentLoaded",()=>{
    countdown();
    hoverPartner();
    bannerSlider();
    partnerSlide();
    // 
    
})
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