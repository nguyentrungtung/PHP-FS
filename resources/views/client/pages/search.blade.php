@extends('.client.master-layout')
@section('title', 'Home Page')
@section('link')
    <link rel="stylesheet" href="{{ asset('client/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/search/search.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/product.css') }}">
@endsection
@section('content')
<div class="d-flex align-items-center search_banner">
    <img src="img/search/banner.png" alt="" class="search_banner_img">
    <img src="img/search/banner.png" alt="" class="search_banner_img">
    <img src="img/search/banner.png" alt="" class="search_banner_img">
    <div class="d-flex justify-content-between align-items-center banners_slide_buttons">
        <div class="d-flex justify-content-end align-items-center
         buttons_left">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
            </svg>
        </div>
        <div class="d-flex justify-content-start align-items-center
         buttons_right">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
            </svg>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center banners_slide_switch">
        <div class="switch_dot active"></div>
        <div class="switch_dot"></div>
        <div class="switch_dot"></div>
    </div>
</div>
<div class="d-flex search_detail">
    <div class="d-flex flex-column search_detail_ex">
        <div class="d-flex flex-column  detail_ex_content">
            <h5 class="detail_ex_content_text">Từ khóa gợi ý</h5>
            <div class="d-flex flex-wrap detail_ex_content_value">
                <div class="value_ex_search">Sữa bột</div>
                <div class="value_ex_search">Sữa hộp</div>
                <div class="value_ex_search">Sữa vỉ</div>
                <div class="value_ex_search">Sữa bịch</div>
            </div>
        </div>
    </div>
    <div class="search_detail_list">
        <div class="category_content_products">
            <div id="category_url" class="products_url">Trang chủ / Rau - Củ - Trái cây</div>
            <div class="products_list">
                @foreach ($products as $product )
                <div class="col-lg-1-5">
                    <div data-id="{{$product['id']}}" class="card product-item">
                        <a href="{{$product['detail_url']}}" class="detail_link">
                            @if ($product['sale']!==0)
                                <div class="product-item__discount-wrap">
                                    <p class="product-item__discount-product">- {{$product['sale']}}%</p>
                                    <img src="" alt="" class="product-item__discount-ship d-none">
                                </div>
                            @endif
                            <div class="product-item__img-wrap">
                                <div class="product-item__img-wrap">
                                    <img
                                        src="{{asset($product['product_image'])}}"
                                        class="product-item__img card-img-top"
                                        alt="..."
                                    />
                                    <div class="product-item__frame d-none"></div>
                                </div>
                                <div class="product-item__frame d-none"></div>
                            </div>
                            <div class="card-body text-muted product-item__info">
                                <p class="card-title product-item__name">{{ $product['product_name'] }}</p>

                                <p class="card-text mb-1">ĐVT: <span class="product-details__unit-item"
                                                                     data-value="{{ $product['product_price'] }}">{{ $product['product_unit'] }}</span>
                                </p>
                                <p class="card-text text-danger fw-bold">{{ number_format($product['product_price']) }}
                                    đ</p>
                            </div>
                        </a>
                        
                        <!-- Product action -->
                        <div class="product-item__action">
                            <a href="#" class="d-block btn__add-cart btn_add-cart"
                               data-url="{{ $product['add_url'] }}">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                            <a href="#" class="d-block btn__add-cart btn_add-cart">
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
    <script src="{{asset('client/js/search.js')}}"></script>
    <script src="{{asset('client/js/layout.js')}}"></script>
    <script src="{{ url('client') }}/js/cart.js"></script>
@endsection