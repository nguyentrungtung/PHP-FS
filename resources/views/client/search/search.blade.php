@extends('.client.master-layout')
@section('title', 'Home Page')
@section('link')
    <link rel="stylesheet" href="{{ asset('client/css/search/category.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/search/product.css') }}">
@endsection
@php
    $thisCat;
    foreach ($categories as $cat )
        if($cat['id']==$id){
            $thisCat=$cat;
        }
@endphp
@section('content')
<div class="search">
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
                            <img data-value="Wineco" data-id="1" class="brand_logo active" src="../public/imgs/brand.png" alt="">
                            <img data-value="Wineco-2" data-id="2" class="brand_logo" src="../public/imgs/brand.png" alt="">
                            <img data-value="Wineco-3" data-id="3" class="brand_logo" src="../public/imgs/brand.png" alt="">
                            <img data-value="Wineco-4" data-id="4" class="brand_logo" src="../public/imgs/brand.png" alt="">
                            <img data-value="Wineco-5" data-id="5" class="brand_logo" src="../public/imgs/brand.png" alt="">
                            <img data-value="Wineco-6" data-id="6" class="brand_logo" src="../public/imgs/brand.png" alt="">
                            <img data-value="Wineco-7" data-id="7" class="brand_logo" src="../public/imgs/brand.png" alt="">
                            <img data-value="Wineco-8" data-id="8" class="brand_logo" src="../public/imgs/brand.png" alt="">     
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
                    <div class="d-flex align-items-center justify-content-center fillter_detai active">Khuyến mại tốt nhất</div>
                    <div class="d-flex align-items-center justify-content-center fillter_detai">Bán chạy</div>
                </div> 
                <div class="d-flex justify-content-start align-items-center content_fillter_brand">
                    <h5 class="text fillter_title">Bộ lọc: </h5>
                    <div class="d-flex align-items-center fillter_lits">
                        <h6 class="text"> Thương hiệu:</h6>
                        <div id="brand_list" class="d-flex align-items-center flex-wrap list_brand">
                            <div data-id="1" class="brand_fill">
                                Wineco x
                            </div>
                        </div>
                        <div id="delete" class="d-flex align-items-center justify-content-around delete_fillter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                              </svg>
                              Xóa bộ lọc
                        </div>
                    </div>
                </div>           
            </div>
            
            <div class="category_content_products">
                <div id="category_url" class="products_url">Trang chủ / Rau - Củ - Trái cây</div>
                <div data-id={{$id}} class="products_list">
                    @foreach ($products as $product )
                    <div class="d-flex flex-column justify-content-between align-items-center product">
                        @if ($product['sale']!=0)
                            <div class="d-flex justify-content-center align-items-center product_pin">
                                {{$product['sale']}} %
                            </div>
                        @endif
                        <div class="d-flex justify-content-center align-items-center product_img">
                            <img src="{{asset($product['img_url'])}}" class="product_img_content">
                        </div>
                        <div class="d-flex flex-column justify-content-end product_content">
                            <div class="d-flex flex-column content_text">
                                <p class="product_content_text">{{$product['name']}}</p>
                                <p class="product_content_text">ĐVT: Cuộn</p>
                                <div class="d-flex product_content_price">
                                    <p class="content_price price_sale">{{$product['price']}}</p>
                                    @if ($product['old']!==0)
                                    <p class="text-decoration-line-through content_price price_old">{{$product['old']}}</p>
                                    @endif
                                </div>
                            </div>
                            <div data-id="{{$product['id']}}" class="d-flex justify-content-between align-items-center content_add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                  </svg>
                                  <p class="cart_add">Thêm vào giỏ hàng</p>
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
        
@endsection
@section('scripts')
    <script src="{{asset('client/js/category.js')}}"></script>
    <script src="{{asset('client/js/layout.js')}}"></script>
@endsection