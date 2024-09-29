document.addEventListener('DOMContentLoaded',()=>{
    bannerSlider();
})
function bannerSlider(){
    const slides = document.querySelectorAll('.search_banner_img');
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
    addCart();
    detail();
}
// 
function addCart(){
  const carts=document.querySelectorAll('.cart_add');
  carts.forEach(cart=>{
      if (!cart.dataset.hasClick) {
          cart.addEventListener('click', function(e) {
              e.stopPropagation(); 
              const id=cart.getAttribute('data-id');
          $.ajax({
              url: 'client/cart/add/' + id,
              type: 'GET',
              success: function(response) {
                  const counts=document.querySelectorAll('.cart_count');
                  counts.forEach(count=>{
                      count.innerHTML=parseInt(count.innerHTML)+1;
                  })
              }
          });
          });
          cart.dataset.hasClick = "true"; // Đánh dấu đã gán sự kiện
      }
  })
}
//  
// ham bat su kien xem thong tin san pham
// 
function detail(){
  const items=document.querySelectorAll('.product-item'); 
  items.forEach(item=>{
      if (!item.dataset.hasClick) {
          item.addEventListener('click', function() {
              const id=item.getAttribute('data-id');
              window.location.pathname = '/product/'+id;
          });
          item.dataset.hasClick = "true"; // Đánh dấu đã gán sự kiện
      }
  })
}