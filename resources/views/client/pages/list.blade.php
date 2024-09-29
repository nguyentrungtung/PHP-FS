@extends('.client.master-layout')
@section('title', 'Home Page')
@section('link')
    <link rel="stylesheet" href="{{ asset('client/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/search/category.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/product.css') }}">
@endsection
@php
    $thisCat;
    foreach ($categories as $cat )
        if($cat['id']==$id){
            $thisCat=$cat;
        }
        if(!empty($cat['child'])){
            foreach ($cat['child'] as $child) {
                if($child['id']==$id){
                    $thisCat=$child;
                }
            }
        }
@endphp
@section('content')
<div class="d-flex category">
    <div class="categoty_detai">
        <div class="d-flex flex-column detail_list">
            <div class="d-flex justify-content-between align-items-center list_title">
                <h5 class="list_title_text">{{$thisCat['name']}}</h5>
                <svg id="title_btn" class="btn_drop" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </div>
            <div id="list_subcat" class="align-items-start list_subcat">
                <div id="sublits" class="d-flex flex-column sublits  hidden">
                    @foreach ($thisCat['child'] as $cat )
                        <div data-value="{{$cat['name']}}" data-id="{{$cat['id']}}"  class="align-items-center subcat_title">{{$cat['name']}}</div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="detail_brand">
            <div class="d-flex justify-content-between align-items-center list_title">
                <h5 class="list_title_text">Thương hiệu</h5>
                <svg id="brand_btn" class="btn_drop" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </div>
            <div id="brand_list_logo" class="d-flex flex-column brand_list">
                <div id="list_content" class="brandlist hidden">
                    <div class="d-flex flex-wrap justify-content-around brands">
                        @foreach ($brands as $brand )
                            <img data-value="{{$brand->brand_name}}" data-id="{{$brand->id}}" class="brand_logo" src="{{asset($brand->brand_logo)}}" alt="">
                        @endforeach  
                    </div>
                    <div class="d-flex justify-content-center align-items-center loadmore">
                        Xem thêm
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="categoty_content">
        <div class="d-flex flex-column content_fillter">
            <div class="d-flex flex-wrap justify-content-start align-items-center content_fillter_sale">
                <div data-value="sale" class="d-flex align-items-center justify-content-center fillter_detai">Khuyến mại tốt nhất</div>
                <div data-value="order" class="d-flex align-items-center justify-content-center fillter_detai">Bán chạy</div>
            </div> 
            <div class="d-flex justify-content-start align-items-center content_fillter_brand">
                
            </div>           
        </div>
        <div class="category_content_products">
            <div id="category_url" class="products_url">{{$thisCat['name']}}</div>
            <div data-id={{$id}} data-main="{{$id}}" data-remain="{{$remain}}" class="products_list">
                @foreach ($products as $product )
                <div class="col-lg-1-5">
                    <div data-id="{{$product['id']}}" class="card product-item">
                        @if ($product['sale']!==0)
                        <div class="product-item__discount-wrap">
                            <p class="product-item__discount-product">- {{$product['sale']}}%</p>
                            <img src="" alt="" class="product-item__discount-ship d-none">
                        </div>
                        @endif
                        <div class="product-item__img-wrap">
                            <img
                                src="{{asset($product['product_image'])}}"
                                class="product-item__img card-img-top"
                                alt="..."
                            />
                            <div class="product-item__frame d-none"></div>
                        </div>
                        <div class="card-body text-muted product-item__info">
                            <p class="card-title product-item__name">{{$product['product_name']}}</p>
                            <p class="card-text mb-1">ĐVT: {{$product['product_unit']}}</p>
                            <div class="product-item__info-price d-flex">
                                <p class="card-text text-danger fw-bold product-item__price-new m-0">{{$product['product_price']}}</p>
                                @if ($product['product_old_price']!==0)
                                <span class="product-item__price-old ms-4 text-decoration-line-through">{{$product['product_old_price']}}</span>
                                @endif
                            </div>
                        </div>
                        <!-- Product action -->
                        <div class="product-item__action">
                            <i data-id="{{$product['id']}}" class="d-block btn-cart--add fa-solid fa-cart-shopping cart_add"></i>
                            <a href="#" class="d-block btn-cart--add" >
                                <i class="fa-regular fa-heart"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{asset('client/js/category.js')}}"></script>
    <script src="{{asset('client/js/layout.js')}}"></script>
@endsection