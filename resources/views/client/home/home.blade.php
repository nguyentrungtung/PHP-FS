@extends('.client.master-layout')
@section('title', 'Home Page')
@section('link')
    <link rel="stylesheet" href="{{ asset('client/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/product.css') }}">
@endsection
@section('content')
    <div class="d-flex flex-column home">
        @include('client.home.banner')
        @include('client.home.voucher')
        <div class="d-flex flex-column home_today_deal">
            <div class="d-flex justify-content-between align-items-center today_deal_date">
                <h3 class="today_dead_date_title">Duy nhất hôm nay</h3>
                <div class="d-flex justify-content-center align-items-center today_dead_date_count">
                    <h5 class="today_dead_date_title">Kết thúc trong</h5>
                    <div class="d-flex justify-content-center align-items-center today_dead_date_countdown">
                        <div class="d-flex justify-content-center align-items-center date_countdowmn" id="countdown_hours">10</div>
                        <div class="d-flex justify-content-center align-items-center date_countdowmn" id="countdown_minutes">1</div>
                        <div class="d-flex justify-content-center align-items-center date_countdowmn" id="countdown_sec">2</div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column align-items-center list_content">
                <div class="list_products">
                    @foreach ($todays as $product )
                    <div class="col-lg-1-5">
                        <div class="card product-item">
                            @if ($product['sale']!==0)
                            <div class="product-item__discount-wrap">
                                <p class="product-item__discount-product">- {{$product['sale']}}%</p>
                                <img src="" alt="" class="product-item__discount-ship d-none">
                            </div>
                            @endif
                            <div class="product-item__img-wrap">
                                <img
                                    src="{{asset($product['img_url'])}}"
                                    class="product-item__img card-img-top"
                                    alt="..."
                                />
                                <div class="product-item__frame d-none"></div>
                            </div>
                            <div class="card-body text-muted product-item__info">
                                <p class="card-title product-item__name">{{$product['name']}}</p>
                                <p class="card-text mb-1">ĐVT: {{$product['unit']}}</p>
                                <div class="product-item__info-price d-flex">
                                    <p class="card-text text-danger fw-bold product-item__price-new m-0">{{$product['price']}}</p>
                                    @if ($product['old_price']!==0)
                                    <span class="product-item__price-old ms-4 text-decoration-line-through">{{$product['old_price']}}</span>
                                    @endif
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
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @for ($i=0;$i<2;$i++)
            <div data-id="{{$categories[$i]['id']}}" class="d-flex flex-column align-items-center home_cat_list">
                <div class="d-flex justify-content-between align-items-center home_cat_list_title">
                    <h3 class="home_cat_list_title_text">{{$categories[$i]['name']}}</h3>
                </div>
                <div class="d-flex flex-column align-items-center list_content">
                    <div class="list_products">
                        @include('client.home.loading')
                    </div>
                    <div data-id="{{$categories[$i]['id']}}" class="list_load_more">
                        <p class="more_text">Xem Thêm <p class="more_text count">15</p> sản phẩm </p>
                        <p class="more_text cat_name">{{$categories[$i]['name']}}</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                          </svg>
                    </div>
                </div>
            </div>                
        @endfor
        <div class="d-flex flex-column home_partner">
            <div class="partner_title">
                <img src="{{asset('img/partner_title.jpg')}}" alt="" class="partner_title_img">
            </div>
            <div class="partner_list_partner">
                <div id="list_partner" class="d-flex flex-nowarp list_partner">
                    @foreach ($brands as $brand )
                        <img src="{{asset($brand->brand_logo)}}" alt="" class="partner_logo filler">
                    @endforeach
                </div>
                <div id="partner_left" class="slide_button hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                    </svg>
                </div>
                <div id="partner_right" class="slide_button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                    </svg>
                </div>
            </div>
        </div>
        @for ($i=2;$i<count($categories);$i++)
            <div data-id="{{$categories[$i]['id']}}" class="d-flex flex-column align-items-center home_cat_list">
                <div class="d-flex justify-content-between align-items-center home_cat_list_title">
                    <h3 class="home_cat_list_title_text">{{$categories[$i]['name']}}</h3>
                </div>
                <div class="d-flex flex-column align-items-center list_content">
                    <div class="list_products">
                        @include('client.home.loading')
                    </div>
                    <div data-id="{{$categories[$i]['id']}}" class="list_load_more">
                        <p class="more_text">Xem Thêm <p class="more_text count"></p> sản phẩm </p>
                        <p class="more_text cat_name">{{$categories[$i]['name']}}</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>
                          </svg>
                    </div>
                </div>
            </div>                
        @endfor
    </div>
@endsection
@section('scripts')
    <script src="{{asset('client/js/home.js')}}"></script>
@endsection