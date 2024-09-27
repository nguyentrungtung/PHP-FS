@extends('.client.master-layout')
@section('title', 'Home Page')
@section('link')
    <link rel="stylesheet" href="{{ asset('client/css/home.css') }}">
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
                {{-- <div class="list_products">
                    <div class="d-flex flex-column justify-content-between align-items-center product">
                        <div class="d-flex justify-content-center align-items-center product_pin">
                            <img src="../public/imgs/gif.png" alt="" class="pin_img">
                        </div>
                        <div class="d-flex justify-content-center align-items-center product_img">
                            <img src="../public/imgs/product-1.png" class="product_img_content">
                        </div>
                        <div class="d-flex flex-column justify-content-end product_content">
                            <div class="d-flex flex-column content_text">
                                <p class="product_content_text">Túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                <p class="product_content_text">ĐVT: Cuộn</p>
                                <div class="d-flex align-items-center content_grif">
                                    <img src="../public/imgs/product-1.png" class="content_grif_img">
                                    <p class="content_grif_text">Mua 1 Cái được tặng 1 túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                </div>
                                <div class="d-flex product_content_price">
                                    <p class="content_price price_sale">39.000 VND</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center content_add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                  </svg>
                                  <p class="cart_add">Thêm vào giỏ hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-between align-items-center product">
                        <div class="d-flex justify-content-center align-items-center product_pin">
                            35%
                        </div>
                        <div class="d-flex justify-content-center align-items-center product_img">
                            <img src="../public/imgs/product-1.png" class="product_img_content">
                        </div>
                        <div class="d-flex flex-column justify-content-end product_content">
                            <div class="d-flex flex-column content_text">
                                <p class="product_content_text">Túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                <p class="product_content_text">ĐVT: Cuộn</p>
                                <div class="d-flex product_content_price">
                                    <p class="content_price price_sale">39.000 VND</p>
                                    <p class="text-decoration-line-through content_price price_old">39.000 VND</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center content_add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                  </svg>
                                  <p class="cart_add">Thêm vào giỏ hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-between align-items-center product">
                        <div class="d-flex justify-content-center align-items-center product_pin">
                            <img src="../public/imgs/gif.png" alt="" class="pin_img">
                        </div>
                        <div class="d-flex justify-content-center align-items-center product_img">
                            <img src="../public/imgs/product-1.png" class="product_img_content">
                        </div>
                        <div class="d-flex flex-column justify-content-end product_content">
                            <div class="d-flex flex-column content_text">
                                <p class="product_content_text">Túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                <p class="product_content_text">ĐVT: Cuộn</p>
                                <div class="d-flex align-items-center content_grif">
                                    <img src="../public/imgs/product-1.png" class="content_grif_img">
                                    <p class="content_grif_text">Mua 1 Cái được tặng 1 túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                </div>
                                <div class="d-flex product_content_price">
                                    <p class="content_price price_sale">39.000 VND</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center content_add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                  </svg>
                                  <p class="cart_add">Thêm vào giỏ hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-between align-items-center product">
                        <div class="d-flex justify-content-center align-items-center product_pin">
                            35%
                        </div>
                        <div class="d-flex justify-content-center align-items-center product_img">
                            <img src="../public/imgs/product-1.png" class="product_img_content">
                        </div>
                        <div class="d-flex flex-column justify-content-end product_content">
                            <div class="d-flex flex-column content_text">
                                <p class="product_content_text">Túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                <p class="product_content_text">ĐVT: Cuộn</p>
                                <div class="d-flex product_content_price">
                                    <p class="content_price price_sale">39.000 VND</p>
                                    <p class="text-decoration-line-through content_price price_old">39.000 VND</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center content_add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                  </svg>
                                  <p class="cart_add">Thêm vào giỏ hàng</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="d-flex flex-column justify-content-between align-items-center product">
                        <div class="d-flex justify-content-center align-items-center product_pin">
                            <img src="../public/imgs/gif.png" alt="" class="pin_img">
                        </div>
                        <div class="d-flex justify-content-center align-items-center product_img">
                            <img src="../public/imgs/product-1.png" class="product_img_content">
                        </div>
                        <div class="d-flex flex-column justify-content-end product_content">
                            <div class="d-flex flex-column content_text">
                                <p class="product_content_text">Túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                <p class="product_content_text">ĐVT: Cuộn</p>
                                <div class="d-flex align-items-center content_grif">
                                    <img src="../public/imgs/product-1.png" class="content_grif_img">
                                    <p class="content_grif_text">Mua 1 Cái được tặng 1 túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                </div>
                                <div class="d-flex product_content_price">
                                    <p class="content_price price_sale">39.000 VND</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center content_add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                  </svg>
                                  <p class="cart_add">Thêm vào giỏ hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-between align-items-center product">
                        <div class="d-flex justify-content-center align-items-center product_pin">
                            35%
                        </div>
                        <div class="d-flex justify-content-center align-items-center product_img">
                            <img src="../public/imgs/product-1.png" class="product_img_content">
                        </div>
                        <div class="d-flex flex-column justify-content-end product_content">
                            <div class="d-flex flex-column content_text">
                                <p class="product_content_text">Túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                <p class="product_content_text">ĐVT: Cuộn</p>
                                <div class="d-flex product_content_price">
                                    <p class="content_price price_sale">39.000 VND</p>
                                    <p class="text-decoration-line-through content_price price_old">39.000 VND</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center content_add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                  </svg>
                                  <p class="cart_add">Thêm vào giỏ hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-between align-items-center product">
                        <div class="d-flex justify-content-center align-items-center product_pin">
                            <img src="../public/imgs/gif.png" alt="" class="pin_img">
                        </div>
                        <div class="d-flex justify-content-center align-items-center product_img">
                            <img src="../public/imgs/product-1.png" class="product_img_content">
                        </div>
                        <div class="d-flex flex-column justify-content-end product_content">
                            <div class="d-flex flex-column content_text">
                                <p class="product_content_text">Túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                <p class="product_content_text">ĐVT: Cuộn</p>
                                <div class="d-flex align-items-center content_grif">
                                    <img src="../public/imgs/product-1.png" class="content_grif_img">
                                    <p class="content_grif_text">Mua 1 Cái được tặng 1 túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                </div>
                                <div class="d-flex product_content_price">
                                    <p class="content_price price_sale">39.000 VND</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center content_add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                  </svg>
                                  <p class="cart_add">Thêm vào giỏ hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-between align-items-center product">
                        <div class="d-flex justify-content-center align-items-center product_pin">
                            35%
                        </div>
                        <div class="d-flex justify-content-center align-items-center product_img">
                            <img src="../public/imgs/product-1.png" class="product_img_content">
                        </div>
                        <div class="d-flex flex-column justify-content-end product_content">
                            <div class="d-flex flex-column content_text">
                                <p class="product_content_text">Túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                <p class="product_content_text">ĐVT: Cuộn</p>
                                <div class="d-flex product_content_price">
                                    <p class="content_price price_sale">39.000 VND</p>
                                    <p class="text-decoration-line-through content_price price_old">39.000 VND</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center content_add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                  </svg>
                                  <p class="cart_add">Thêm vào giỏ hàng</p>
                            </div>
                        </div>
                        
                    </div>
                    <div class="d-flex flex-column justify-content-between align-items-center product">
                        
                        <div class="d-flex justify-content-center align-items-center product_img">
                            <img src="../public/imgs/product-1.png" class="product_img_content">
                        </div>
                        <div class="d-flex flex-column justify-content-end product_content">
                            <div class="d-flex flex-column content_text">
                                <p class="product_content_text">Túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                <p class="product_content_text">ĐVT: Cuộn</p>
                                <div class="d-flex product_content_price">
                                    <p class="content_price price_sale">39.000 VND</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center content_add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                  </svg>
                                  <p class="cart_add">Thêm vào giỏ hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column justify-content-between align-items-center product">
                        <div class="d-flex justify-content-center align-items-center product_img">
                            <img src="../public/imgs/product-1.png" class="product_img_content">
                        </div>
                        <div class="d-flex flex-column justify-content-end product_content">
                            <div class="d-flex flex-column content_text">
                                <p class="product_content_text">Túi rác tự hủy sinh hoạt WinMart Home màu đen 55x65-500gr</p>
                                <p class="product_content_text">ĐVT: Cuộn</p>
                                <div class="d-flex product_content_price">
                                    <p class="content_price price_sale">39.000 VND</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center content_add">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                  </svg>
                                  <p class="cart_add">Thêm vào giỏ hàng</p>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div  class="list_products">
                    @include('client.home.loading')
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
                        <img src="{{asset('img/brands/omo.jpg')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/cocacola.jpg')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/pepsi.png')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/omo.jpg')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/cocacola.jpg')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/pepsi.png')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/omo.jpg')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/cocacola.jpg')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/pepsi.png')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/omo.jpg')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/cocacola.jpg')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/pepsi.png')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/omo.jpg')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/cocacola.jpg')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/pepsi.png')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/omo.jpg')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/cocacola.jpg')}}" alt="" class="partner_logo filler">
                        <img src="{{asset('img/brands/pepsi.png')}}" alt="" class="partner_logo filler">
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
                            <p class="more_text">Xem Thêm <p class="more_text count">15</p> sản phẩm </p>
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