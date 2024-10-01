let check=false;
let footerVisible = false; 
document.addEventListener("DOMContentLoaded",()=>{
    const title_btn=document.getElementById("title_btn");
    const list_subcat=document.getElementById("list_subcat");
    const sublist=document.getElementById('sublits');
    const brand_btn=document.getElementById("brand_btn");
    const brand_list_logo=document.getElementById("brand_list_logo");
    const list_content=document.getElementById("list_content");
    // if(sublist){}
    drop(title_btn,list_subcat,sublist,count1);
    drop(brand_btn,brand_list_logo,list_content,count2);
    fillter();
    brandFillter();
    changeCat();
    // lang nghe su kien scroll toi cuoi trang
    window.addEventListener('scroll', function() {
        const footer = document.querySelector('.footer');
        const footerTop = footer.getBoundingClientRect().top; // Vị trí trên cùng của footer
        // Kiểm tra nếu cuộn đến đầu footer
        if (footerTop <= window.innerHeight && !footerVisible) {
            footerVisible = true; // Đánh dấu footer đã hiển thị
            if(!check){
                fetchData(ajax,true);
            }
        } 
        // Kiểm tra nếu cuộn lên khỏi footer
        else if (footerTop > window.innerHeight && footerVisible) {
            footerVisible = false; // Đánh dấu footer đã ẩn
        }
    });
});
// 
// 
function changeData(response){
    const products=(response.products);
    const remain=(response.remain);
    if(remain===0){
        check=true;
    }
    let newArr=[];
    products.forEach(product => {
        newArr.push(productItem(product));
    });
    start+=8;
    return newArr.join('');
}
// 
let start=8;
let value='';
function fetchData(callback,add=false) {
    // Giả sử đây là phần logic để lấy dữ liệu sản phẩm từ server
    const element=document.querySelector('.products_list');
    const remain=element.getAttribute('data-remain');
    if(add){
        if(remain<=0){
            check=true;
            return;
        }
    }
    callback(element,add);
}
// 
function ajax(element,add=false){
    const id=element.getAttribute('data-id');
    let data=[]
    const list=document.querySelectorAll('.brand_fill');
    list.forEach(item=>{
        data.push(item.getAttribute('data-id'));
    })
    $.ajax({
        url: '/client/products/fillter',
        type: 'GET',
        data: {
            _token: '{{ csrf_token() }}',
            brands: data,
            catId:id,
            start:start,
            limit:8,
            sort:value
        },
        success: function(response) {
            const html=changeData(response);
            console.log(html);
            if(add){
                element.innerHTML+=html;
            }else{
                element.innerHTML=html;
            }
            showToast('.liveToast', '.liveToastBtn', 'Đã thêm vào giỏ hàng thành công');
        },
        error: function(error) {
            console.error('Error:', error); // Bắt lỗi và in ra lỗi
        }
    });
}
// 
// 
function productItem(product){
    return `<div class="col-lg-1-5">
        <div data-id="${product.id}" class="card product-item">
            
            ${product.sale!==0?
                `<div class="product-item__discount-wrap">
                    <p class="product-item__discount-product">- ${product.sale}%</p>
                    <img src="" alt="" class="product-item__discount-ship d-none">
                </div>`:''}
                <a href="${product.detail_url}" class="detail_link">
                        <div class="product-item__img-wrap">
                            <div class="product-item__img-wrap">
                                <img
                                    src="${product.product_image}"
                                    class="product-item__img card-img-top"
                                    alt="..."
                                />
                                <div class="product-item__frame d-none"></div>
                                <div class="product-item__frame d-none"></div>
                            </div>
                        </div>
                    </a>
                <div class="card-body text-muted product-item__info">
                    <p class="card-title product-item__name">${product.product_name}</p>

                        <p class="card-text mb-1">ĐVT: <span class="product-details__unit-item"
                            data-value="${Number(product.product_price).toLocaleString('en-US')}">${product.product_unit}</span>
                        </p>
                    <p class="card-text text-danger fw-bold">${Number(product.product_price).toLocaleString('en-US')}
                            đ</p>
                </div>

            <!-- Product action -->
            <div class="product-item__action">
                <a href="#" class="d-block btn__add-cart btn_add-cart liveToastBtn"
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
    </div>`;
}
// 
function count1(list){
    return list.childElementCount*50+'px'
}
function count2(list){
    console.log(Array.from(list.children)[0].childElementCount);
    return Math.ceil((Array.from(list.children)[0].childElementCount)/2)*80+50+'px'
}
// hien thi thong tin hide menu
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
// bat su kien loc theo sale hoac order
function fillter(){
    const list=document.querySelectorAll('.fillter_detai');
    list.forEach(fill => {
        fill.addEventListener("click",(e)=>{
            start=0;
            const check=removeFill(e.target);
            if(!check){
                fill.classList.add("active");
                value=fill.getAttribute('data-value');
            }
            
            fetchData(ajax);
        });
    });
}
// loai bo fill va kiem tra phan tu duoc kick co phai phan tu dang duoc chon hay khong
function removeFill(current){
    let check=false;
    value='';
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
// bat su kien thay doi khi chon loc theo cac brand
function brandFillter(){
    const fill=document.querySelector('.content_fillter_brand');
    const brand_logos=document.querySelectorAll('.brand_logo');
    brand_logos.forEach(element => {
        element.addEventListener('click',(e)=>{
            start=0;
            let brand_list=document.getElementById("brand_list");
            // kiem tra xem hien tai list co rong hay khong 
            // neu rong thi them khung cho phan brand fillter
            if(brand_list===null){
                fill.innerHTML=`<h5 class="text fillter_title">Bộ lọc: </h5>
                <div class="d-flex align-items-center fillter_lits">
                    <h6 class="text"> Thương hiệu:</h6>
                    <div id="brand_list" class="d-flex align-items-center flex-wrap list_brand">
                        
                    </div>
                    <div id="delete" class="d-flex align-items-center justify-content-around delete_fillter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                          </svg>
                          Xóa bộ lọc
                    </div>
                </div>`;
                deleteFillBrand(fill,brand_logos);
                brand_list=document.getElementById("brand_list");
                
            }
            // lay ra danh sach cac brand dang duoc chon de fill
            let list=Array.from(brand_list.children);
            // check de kiem tra phan tu duoc click da duoc trong truoc do hay chua
            let check = true;
            e.target.classList.toggle('active');
            const html=`<div data-id=\"${e.target.getAttribute('data-id')}\" class=\"brand_fill\"\>${e.target.getAttribute('data-value')} x</div>`
            // neu phan tu duoc click khong co active (tuc la no vua duoc loai bo truoc do) thi khong them lai vao list
            if(!e.target.classList.contains("active")){
                list=list.filter(item=>item.getAttribute('data-id')!==e.target.getAttribute('data-id'));
                if(list.length===0){
                    fill.innerHTML='';
                    fetchData(ajax);
                    return;
                }
                check=false;
            }
            const arr=list.map(item=>item.outerHTML);
            if(check) arr.push(html);
            brand_list.innerHTML=arr.join('');
            brandItems()
            fetchData(ajax);
        })    
    });
}
// 
function brandItems(){
    const brand_fills=document.querySelectorAll('.brand_fill');
    const brand_logos=document.querySelectorAll('.brand_logo');
    const fill=document.querySelector('.content_fillter_brand');
    const brand_list=document.getElementById("brand_list");
    brand_fills.forEach(item=>{
        item.addEventListener('click',()=>{
            start=0;
            item.setAttribute('data-click',true);
            brand_logos.forEach(logo=>{
                if(logo.getAttribute('data-id')===item.getAttribute('data-id')){
                    logo.classList.remove('active');
                }
            })
            let newArr=[];
            brand_fills.forEach(value=>{
                if(!value.hasAttribute('data-click')){
                    newArr.push(value.outerHTML);
                }
            })
            // console.log(newArr);
            // return;
            if(newArr.length===0){
                brand_list.innerHTML='';
                fill.innerHTML='';
            }else{
                brand_list.innerHTML=newArr.join('');
            }
            brandItems();
            fetchData(ajax);
        })
    })
}
// loai bo toan bo brand duoc chon va load lai du lieu
function deleteFillBrand(fill,logos){
    const d_bnt=document.getElementById("delete");
    d_bnt.addEventListener('click',()=>{
        logos.forEach(element => {
            if(element.classList.contains('active')){
                element.classList.remove('active');
            }

        });
        fill.innerHTML='';
        start=0;
        fetchData(ajax);
    });
}
//loai bo active khoi sub cat va tra ve tru neu doi tuong loai bo la doi tuong duoc click
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
 
} 
// su kien thay doi muc sub cat
function changeCat(){
    const url=document.getElementById('category_url');
    const list=document.querySelectorAll('.subcat_title');
    const product_list=document.querySelector('.products_list');
    let chooseArr=url.innerHTML.split(' / ');
    list.forEach(item=>{
        item.addEventListener('click',(e)=>{
            // loai bo active va khiem tra phan tu loai bo co phai phan tu hien tai duoc click hay khong
            const [arr,check]=remove(list,chooseArr,e.target);
            const id=item.getAttribute('data-id');
            chooseArr=arr;
            // neu click la phan tu moi thi thay doi id của list de render san pham theo id cua phan tu duoc chon
            if(!check){
                product_list.setAttribute('data-id',id);
                e.target.classList.add('active');
                chooseArr.push(e.target.getAttribute('data-value'));
            }else{
                product_list.setAttribute('data-id',product_list.getAttribute('data-main'));
            }
            url.innerHTML=chooseArr.join(' / ');
            // thay doi lai start ve 0
            start=0;
            fetchData(ajax);

        })
    })
}
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
            delay: 1000
        });

        toastBootstrap.show();
    });
}