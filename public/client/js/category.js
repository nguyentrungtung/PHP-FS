let check=false;
document.addEventListener("DOMContentLoaded",()=>{
    const title_btn=document.getElementById("title_btn");
    const list_subcat=document.getElementById("list_subcat");
    const sublist=document.getElementById('sublits');
    const brand_btn=document.getElementById("brand_btn");
    const brand_list_logo=document.getElementById("brand_list_logo");
    const list_content=document.getElementById("list_content");
    drop(title_btn,list_subcat,sublist,count1);
    drop(brand_btn,brand_list_logo,list_content,count2);
    fillter();
    brandFillter();
    changeCat();
    addCart();
    let footerVisible = false; 
    window.addEventListener('scroll', function() {
        const footer = document.querySelector('.footer');
        const footerTop = footer.getBoundingClientRect().top; // Vị trí trên cùng của footer

        // Kiểm tra nếu cuộn đến đầu footer
        if (footerTop <= window.innerHeight && !footerVisible) {
            footerVisible = true; // Đánh dấu footer đã hiển thị
            if(!check){
                fetchData();
            }
        } 
        // Kiểm tra nếu cuộn lên khỏi footer
        else if (footerTop > window.innerHeight && footerVisible) {
            footerVisible = false; // Đánh dấu footer đã ẩn
        }
    });
});
// 
let start=8;
function fetchData() {
    // Giả sử đây là phần logic để lấy dữ liệu sản phẩm từ server
    const element=document.querySelector('.products_list');
    const id=element.getAttribute('data-id');
    console.log(id);
    $.ajax({
        url: '/client/products/' + id + '/' +start + '/' + 8,
        type: 'GET',
        success: function(response) {
            const products=(response.products);
            const remain=(response.remain);
            if(remain===0){
                check=true;
            }
            let newArr=[];
            products.forEach(product => {
                newArr.push(getProduct(product));
            });
            start+=8;
            const html=newArr.join('');
            element.innerHTML+=html;
            addCart();
        },
        error: function(xhr) {
        }
    });
}
// 
function getProduct(product){
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
                        <p class="content_price price_sale">${product.price}</p>
                        ${product.old!==0?`<p class="text-decoration-line-through content_price price_old">${product.old}</p>`:''}
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
function addCart(){
    const btns=document.querySelectorAll('.content_add');
    console.log(btns);
    btns.forEach(btn=>{
        const id=btn.getAttribute('data-id');
        if (!btn.dataset.hasClickEvent) {
            btn.addEventListener('click', function() {
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
            });
    
            // Đánh dấu đã có sự kiện click
            btn.dataset.hasClickEvent = 'true';
        }
    })
}
// 
function count1(list){
    return list.childElementCount*50+'px'
}
function count2(list){
    console.log(Array.from(list.children)[0].childElementCount);
    return Math.ceil((Array.from(list.children)[0].childElementCount)/2)*80+50+'px'
}
function drop(btn,element,list,cb){
    btn.addEventListener("click",()=>{
        btn.classList.toggle("dropdown");
        list.classList.toggle("hidden");
        if(btn.classList.contains("dropdown")){
            element.style.height= cb(list);
            return;
        }
        element.style.height='0px';
    })
}
// 
function fillter(){
    const list=document.querySelectorAll('.fillter_detai');
    list.forEach(fill => {
        fill.addEventListener("click",(e)=>{
            const check=removeFill(e.target);
            if(!check){
                fill.classList.add("active");
            }
        });
    });
}
function removeFill(current){
    let check=false;
    const list=document.querySelectorAll('.fillter_detai');
    list.forEach(fill => {
        if(fill.classList.contains("active")){
            check=fill===current?true:false;
        }
        fill.classList.remove("active");
    });
    return check;
}
// 
function reload(){
    const brand_list=document.getElementById("brand_list");
    return Array.from(brand_list.children);
}
// 
function brandFillter(){
    const brand_fills=document.querySelectorAll('.brand_fill');
    const brand_logos=document.querySelectorAll('.brand_logo');
    const d_bnt=document.getElementById("delete");
    let list=reload();
    brand_logos.forEach(element => {
        // console.log(element.getAttribute('data-value'));
        element.addEventListener('click',(e)=>{
            let check = true;
            e.target.classList.toggle('active');
            const html=`<div data-id=\"${e.target.getAttribute('data-id')}\" class=\"brand_fill\"\>${e.target.getAttribute('data-value')} x</div>`
            if(!e.target.classList.contains("active")){
                list=list.filter(item=>item.getAttribute('data-id')!==e.target.getAttribute('data-id'));
                check=false;
            }
            const arr=list.map(item=>item.outerHTML);
            if(check) arr.push(html);
            brand_list.innerHTML=arr.join('');
            list=reload();
        })    
    });
    d_bnt.addEventListener('click',()=>{
        brand_logos.forEach(element => {
            if(element.classList.contains('active')){
                element.classList.remove('active');
            }
            
        });
        brand_list.innerHTML='';
        list=reload();
    });
}
//
function remove(list,arr,current){
    let check=false;
    list.forEach(item=>{
        if(item.classList.contains("active")){
            check=item===current?true:false;
            arr=arr.filter(value=>value!=item.getAttribute('data-value'));
        }
        
        item.classList.remove("active");
    })
    console.log(arr);
    return [arr,check];
    // console.log(list);
 
} 
// 

function changeCat(){
    const url=document.getElementById('category_url');
    const list=document.querySelectorAll('.subcat_title');
    let chooseArr=url.innerHTML.split(' / ');
    console.log(list);
    list.forEach(item=>{
        item.addEventListener('click',(e)=>{
            const [arr,check]=remove(list,chooseArr,e.target);
            chooseArr=arr;
            if(!check){
                e.target.classList.add('active');
                chooseArr.push(e.target.getAttribute('data-value'));
            }
            url.innerHTML=chooseArr.join(' / ');
        })
    })
}