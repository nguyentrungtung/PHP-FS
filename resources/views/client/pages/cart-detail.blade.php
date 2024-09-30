@extends('client.master-layout') <!-- Kế thừa layout chính -->

@section('title', 'Chi tiết giỏ hàng')

@section('link')
    <link rel="stylesheet" href="{{ url('client') }}/css/cart.css">
@endsection

@section('content')
    <div class="cart">
        <!-- <h2 class="cart__title mb-4">Giỏ Hàng Của Bạn</h2> -->
        <div class="cart__content row">
            <!-- Danh sách sản phẩm trong giỏ -->
            <div class="cart__products col-md-8">
                <div class="cart__header mb-4">
                    <h4 class="cart__header-title">Sản phẩm trong giỏ</h4>
                </div>
                <div class="cart__body">
                    @if(count($carts))
                        <div class="row g-2" id="cart-list">
                            @include('client.components.cart-list')
                            <a href="#" class="mt-3 btn btn-outline-danger text-decoration-underline"
                               data-url="{{ route('cart.clear') }}" id="btn_cart--clear" style="width: max-content">Xóa
                                giỏ hàng</a>
                        </div>
                    @endif
                    <div class="text-center" id="cart_empty--text" style="display:none">
                        <p class="text-muted">Trong giỏ hàng không có sản phẩm nào.</p>
                        <a href="{{ route('web.home') }}" class="btn btn-outline-danger text-decoration-underline">Tiếp
                            tục mua sắm</a>
                    </div>
                </div>

                <div class="cart__footer mt-3" style="opacity:0">
                </div>
            </div>

            <!-- Tóm tắt giỏ hàng -->
            <div class="cart__summary col-md-4">
                <div class="cart__summary-card">
                    <div class="cart__summary-header mb-4">
                        <h4 class="cart__summary-header-title">Tóm tắt Giỏ Hàng</h4>
                    </div>
                    <div class="cart__summary-body">
                        <p class="cart__summary-total-products d-none">
                            Tổng sản phẩm: <span class="float-end">{{$totalCart}}</span>
                        </p>
                        <p class="cart__summary-total-price-estimated">
                            Tạm tính giỏ hàng: <span class="float-end" id="cart__summary-subtotal">{{number_format($subtotal)}}₫</span>
                        </p>
                        <p class="cart__summary-total-price-saving">
                            Tiết kiệm được: <span class="float-end" id="cart__summary-totalsaving">{{number_format($totalSaving)}}₫</span>
                        </p>
                        <p class="cart__summary-shopping-fee d-none">
                            Phí vận chuyển: <span class="float-end">20.000₫</span>
                        </p>
                        <p class="cart__summary-coupon"></p>
                        Khuyến mại: <span class="float-end" id="cart__summary-discount">10.000₫</span>
                        </p>
                        <hr/>
                        <h5 class="cart__summary-total mb-4" style="font-size:18px">
                            Tổng cộng: <span class="text-danger" id="cart__summary-totalprice"
                                             style="font-size:18px; float: right">{{number_format($totalPrice)}}₫</span>
                        </h5>
                        {{--Chọn voucher--}}
                        <div class="cart__summary-actions text-center">
                            <div class="cart__summary-actions__top">
                                <div class="cart__discount-code">
                                    <a href="#" class="btn cart__discount-code__left"><i
                                            class="fa-solid fa-ticket me-1"></i> Khuyến mại</a>
                                    <a href="#" class="btn btn-danger cart__discount-code__btn" data-bs-toggle="modal"
                                       data-bs-target="#exampleModal">Chọn mã Voucher</a>

                                    <!-- Modal chọn mã khuyễn mại-->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header"
                                                     style="background-color: rgb(235, 31, 58) !important; padding: 8px 7px !important;">
                                                    <button
                                                        style="width: 20px; margin-right: 10px; color: rgb(255, 255, 255)!important"
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ></button>
                                                    <div class="form-search_coupon">
                                                        <input
                                                            type="email"
                                                            class="form-control"
                                                            id="exampleInputEmail1"
                                                            aria-describedby="emailHelp"
                                                            placeholder="Nhập mã khuyến mại"
                                                            style="padding:6px 6px 6px 10px;
                                                                    border:none;
                                                                    "
                                                        />
                                                        <button type="button" class="btn btn-light"
                                                                style="width: 110px; margin-left: 10px; padding:0">
                                                            Tìm kiếm
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="modal-body coupon-list">
                                                    <!-- Coupon item  -->
                                                    @foreach($coupons as $coupon)
                                                        <div class="coupon-list__item coupon-item__after-active">
                                                            <div class="coupon-list__logo">
                                                                <img
                                                                    src="https://hcm.fstorage.vn/images/2024/08/logo-unilever-20240828093508.png"
                                                                    alt="logo coupon">
                                                            </div>
                                                            <div class="coupon-list__content ">
                                                                @if($coupon->discount_type == 'percentage')
                                                                    <h5 class="coupon-list__title">Giảm
                                                                        giá {{number_format($coupon->discount_value)}}
                                                                        %</h5>
                                                                @endif
                                                                <p class="coupon-list__description">Áp dụng cho đơn hàng
                                                                    từ
                                                                    {{number_format($coupon->min_order_value)}}đ</p>
                                                                <p class="coupon-list__expiration-date text-center"
                                                                   style="background-color: rgb(253, 151, 1);padding: 3px; width: 150px;border-radius: 4px;">
                                                                    HSD : <span>{{$coupon->end_date}}</span></p>
                                                                <a class="coupon-list__promotional-terms d-none"
                                                                   href="#">Điều
                                                                    kiện
                                                                    khuyến mại</a>
                                                            </div>
                                                            <div class="coupon-list__actions">
                                                                <button
                                                                    class="coupon-list__btn btn btn-danger coupon-list__btn--apply">
                                                                    Áp dụng
                                                                </button>
                                                                <!-- <button class="coupon-list__btn btn btn-danger coupon-list__btn--save">Lưu mã</button> -->
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="modal-footer d-none">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cart__summary-actions__bottom mt-2">
                                <a href="{{ route('web.home') }}"
                                   class="btn btn-primary cart__continue-shopping translate--y">Tiếp tục mua
                                    sắm</a>
                                <a href="#" class="btn btn-danger cart__checkout translate--y"
                                   id="btn-checkout_cart-detail" data-url_save_summary="{{route('cart.saveSummary')}}">Thanh
                                    toán</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Ưu đãi sản phẩm--}}
                <div class="row g-2 product-special-offer mt-5">
                    <div class="product-special-offer__title">
                        <hr/>
                        <div class="product-special-offer__position-title">
                            <p class="product-special-offer__title-heading">
                                <span class="d-inline-block"><i class="fa-solid fa-gift"></i></span>Ưu đãi đặc biệt danh
                                cho bạn
                            </p>
                        </div>
                    </div>

                    @foreach($specialOffers as $specialOffer)
                        <div class="col-md-6 product__item">
                            <div class="card product-item">
                                <div class="product-item__discount-wrap">
                                    <p class="product-item__discount-product">-30%</p>
                                    <img src="" alt="" class="product-item__discount-ship d-none">
                                </div>
                                <div class="product-item__img-wrap">
                                    @foreach($specialOffer->productImage as $product_image)
                                        @if($product_image->image_type == 'main')
                                            <!-- Main Product Image -->
                                            <img
                                                id="mainImage"
                                                src="{{ asset($product_image->image_url) }}"
                                                class="product-info__image product-item__img card-img-top"
                                                alt="Main Product Image"
                                            />
                                        @endif
                                    @endforeach
                                    <div class="d-none product-item__frame"></div>

                                </div>
                                <div class="card-body text-muted product-item__info">
                                    <p class="card-title product-item__name">{{$specialOffer->product_name}}</p>
                                    <p class="card-text mb-1">
                                        ĐVT: {{$specialOffer->unitValues->first()->unit->unit_name}}</p>
                                    <p class="card-text text-danger fw-bold">{{ number_format($specialOffer->product_price) }}
                                        ₫</p>
                                </div>
                                <!-- Product action -->
                                <div class="product-item__action">
                                    <a href="#" class="d-block btn__add-cart btn_add-cart"
                                       data-url="{{ route('cart.store',['id' => $specialOffer->id]) }}">
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
    {{--    <script src="{{ url('client') }}/js/product.js"></script>--}}
    <script src="{{ url('client') }}/js/cart.js"></script>
@endsection

@push('custom-script')
@endpush
