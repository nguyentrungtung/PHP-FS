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
                    <div class="row g-3">
                        @foreach($carts as $cart)
                            <!-- Sản phẩm 1 -->
                            <div class="cart__item col-12">
                                <div
                                    class="cart__item-wrapper d-flex justify-content-between align-items-center border-bottom py-2 hover--box-shadow"
                                >
                                    <div class="cart__item-info d-flex align-items-center">
                                        <img
                                            src="{{$cart['product_image']}}"
                                            class="cart__item-image"
                                            alt="Sản phẩm 1"
                                        />
                                        <div class="cart__item-produt_info">
                                            <h5 class="cart__item-name">
                                               {{$cart['product_name']}}
                                            </h5>
                                            <p class="cart__item-price">
                                                Giá : <span class="text-danger">{{$cart['product_price']}}</span>
                                            </p>
                                            <p class="cart__item-unit">
                                                ĐVT : <span class="text-danger">{{$cart['product_unit']}}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="cart__item-actions">
                                        <input
                                            type="number"
                                            class="form-control cart__item-quantity"
                                            value="1"
                                            style="width: 80px"
                                        />
                                        <button class="btn btn-danger btn-sm mt-2 cart__item-remove">Xóa</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="cart__footer mt-3">
                    <a href="#" class="text-decoration-underline btn btn-danger">Xóa giỏ hàng</a>
                </div>
            </div>

            <!-- Tóm tắt giỏ hàng -->
            <div class="cart__summary col-md-4">
                <div class="cart__summary-card">
                    <div class="cart__summary-header mb-4">
                        <h4 class="cart__summary-header-title">Tóm tắt Giỏ Hàng</h4>
                    </div>
                    <div class="cart__summary-body">
                        <p class="cart__summary-total-products">
                            Tổng sản phẩm: <span class="text-danger float-end">2</span>
                        </p>
                        <p class="cart__summary-total-price-estimated">
                            Tạm tính giỏ hàng: <span class="text-danger float-end">30.000đ</span>
                        </p>
                        <p class="cart__summary-total-price-saving">
                            Tiết kiệm được: <span class="text-danger float-end">700.000đ</span>
                        </p>
                        <p class="cart__summary-shopping-fee">
                            Phí vận chuyển: <span class="text-danger float-end">20.000đ</span>
                        </p>
                        <p class="cart__summary-coupon"></p>
                        Khuyến mại: <span class="text-danger float-end">10.000đ</span>
                        </p>
                        <hr/>
                        <h5 class="cart__summary-total mb-4">
                            Tổng cộng: <span class="text-danger">900.000đ</span>
                        </h5>
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
                                                    <!-- Coupon item 1 -->
                                                    <div class="coupon-list__item coupon-item__after-active">
                                                        <div class="coupon-list__logo">
                                                            <img
                                                                src="https://hcm.fstorage.vn/images/2024/08/logo-unilever-20240828093508.png"
                                                                alt="logo coupon">
                                                        </div>
                                                        <div class="coupon-list__content ">
                                                            <h5 class="coupon-list__title">Giảm giá 20%</h5>
                                                            <p class="coupon-list__description">Áp dụng cho đơn hàng từ
                                                                500.000đ</p>
                                                            <p class="coupon-list__expiration-date"
                                                               style="background-color: rgb(253, 151, 1);padding: 3px; width: 150px;border-radius: 4px;">
                                                                HSD : <span>30.09.2024</span></p>
                                                            <a class="coupon-list__promotional-terms" href="#">Điều kiện
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

                                                    <!-- Coupon item 2 -->
                                                    <div class="coupon-list__item coupon-item__after-active">
                                                        <div class="coupon-list__logo">
                                                            <img
                                                                src="https://hcm.fstorage.vn/images/2024/08/logo-unilever-20240828093508.png"
                                                                alt="logo coupon">
                                                        </div>
                                                        <div class="coupon-list__content ">
                                                            <h5 class="coupon-list__title">Giảm giá 20%</h5>
                                                            <p class="coupon-list__description">Áp dụng cho đơn hàng từ
                                                                500.000đ</p>
                                                            <p class="coupon-list__expiration-date"
                                                               style="background-color: rgb(253, 151, 1);padding: 3px; width: 150px;border-radius: 4px;">
                                                                HSD : <span>30.09.2024</span></p>
                                                            <a class="coupon-list__promotional-terms" href="#">Điều kiện
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
                                                    <div class="coupon-list__item coupon-item__after-active">
                                                        <div class="coupon-list__logo">
                                                            <img
                                                                src="https://hcm.fstorage.vn/images/2024/08/logo-unilever-20240828093508.png"
                                                                alt="logo coupon">
                                                        </div>
                                                        <div class="coupon-list__content ">
                                                            <h5 class="coupon-list__title">Giảm giá 20%</h5>
                                                            <p class="coupon-list__description">Áp dụng cho đơn hàng từ
                                                                500.000đ</p>
                                                            <p class="coupon-list__expiration-date"
                                                               style="background-color: rgb(253, 151, 1);padding: 3px; width: 150px;border-radius: 4px;">
                                                                HSD : <span>30.09.2024</span></p>
                                                            <a class="coupon-list__promotional-terms" href="#">Điều kiện
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

                                                    <div class="coupon-list__item coupon-item__after-active">
                                                        <div class="coupon-list__logo">
                                                            <img
                                                                src="https://hcm.fstorage.vn/images/2024/08/logo-unilever-20240828093508.png"
                                                                alt="logo coupon">
                                                        </div>
                                                        <div class="coupon-list__content ">
                                                            <h5 class="coupon-list__title">Giảm giá 20%</h5>
                                                            <p class="coupon-list__description">Áp dụng cho đơn hàng từ
                                                                500.000đ</p>
                                                            <p class="coupon-list__expiration-date"
                                                               style="background-color: rgb(253, 151, 1);padding: 3px; width: 150px;border-radius: 4px;">
                                                                HSD : <span>30.09.2024</span></p>
                                                            <a class="coupon-list__promotional-terms" href="#">Điều kiện
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
                                <a href="#" class="btn btn-primary cart__continue-shopping translate--y">Tiếp tục mua
                                    sắm</a>
                                <a href="#" class="btn btn-danger cart__checkout translate--y">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <div class="col-md-6 product__item">
                        <div class="card product-item">
                            <div class="product-item__discount-wrap">
                                <p class="product-item__discount-product">-30%</p>
                                <img src="" alt="" class="product-item__discount-ship d-none">
                            </div>
                            <div class="product-item__img-wrap">
                                <img
                                    src="https://hcm.fstorage.vn/images/2022/thach-trai-cay-vfoods-tong-hop-1kg.jpg"
                                    class="product-item__img card-img-top"
                                    alt="..."
                                />
                                <div class="d-none product-item__frame"></div>
                            </div>
                            <div class="card-body text-muted product-item__info">
                                <p class="card-title product-item__name">CHERISH Thạch vị thơm gói 405G Mô tả ngắn về
                                    sản phẩm này. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                                    pretium lectus nec urna consequat, a feugiat lectus aliquet.</p>
                                <p class="card-text mb-1">ĐVT: Gói</p>
                                <div class="product-item__promotion-info d-none">
                                    <img class="product-item__promotion-info-image"
                                         src="https://hcm.fstorage.vn/images/2024/09/10170556-20240911031445.png"
                                         alt="">
                                    <p class="product-item__promotion-info-text">Mua 2 Chai được tặng 1 chai Nước lau
                                        sàn MaxKleen ngàn hoa ngọt ngào chai 1kg</p>
                                </div>
                                <div class="product-item__info-price d-flex">
                                    <p class="card-text text-danger fw-bold product-item__price-new m-0">30.000đ</p>
                                    <span
                                        class="product-item__price-old ms-4 text-decoration-line-through">49.000đ</span>
                                </div>
                            </div>
                            <!-- Product action -->
                            <div class="product-item__action">
                                <a href="#" class="d-block btn-cart--add" data-url="">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                                <a href="#" class="d-block btn-cart--add">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 product__item">
                        <div class="card product-item">
                            <div class="product-item__discount-wrap">
                                <p class="product-item__discount-product">-30%</p>
                                <img src="" alt="" class="product-item__discount-ship d-none">
                            </div>
                            <div class="product-item__img-wrap">
                                <img
                                    src="https://hcm.fstorage.vn/images/2022/thach-trai-cay-vfoods-tong-hop-1kg.jpg"
                                    class="product-item__img card-img-top"
                                    alt="..."
                                />
                                <div class="d-none product-item__frame"></div>
                            </div>
                            <div class="card-body text-muted product-item__info">
                                <p class="card-title product-item__name">CHERISH Thạch vị thơm gói 405G Mô tả ngắn về
                                    sản phẩm này. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                                    pretium lectus nec urna consequat, a feugiat lectus aliquet.</p>
                                <p class="card-text mb-1">ĐVT: Gói</p>
                                <div class="product-item__promotion-info d-none">
                                    <img class="product-item__promotion-info-image"
                                         src="https://hcm.fstorage.vn/images/2024/09/10170556-20240911031445.png"
                                         alt="">
                                    <p class="product-item__promotion-info-text">Mua 2 Chai được tặng 1 chai Nước lau
                                        sàn MaxKleen ngàn hoa ngọt ngào chai 1kg</p>
                                </div>
                                <div class="product-item__info-price d-flex">
                                    <p class="card-text text-danger fw-bold product-item__price-new m-0">30.000đ</p>
                                    <span
                                        class="product-item__price-old ms-4 text-decoration-line-through">49.000đ</span>
                                </div>
                            </div>
                            <!-- Product action -->
                            <div class="product-item__action">
                                <a href="#" class="d-block btn-cart--add" data-url="">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                                <a href="#" class="d-block btn-cart--add">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 product__item">
                        <div class="card product-item">
                            <div class="product-item__discount-wrap">
                                <p class="product-item__discount-product">-30%</p>
                                <img src="" alt="" class="product-item__discount-ship d-none">
                            </div>
                            <div class="product-item__img-wrap">
                                <img
                                    src="https://hcm.fstorage.vn/images/2022/thach-trai-cay-vfoods-tong-hop-1kg.jpg"
                                    class="product-item__img card-img-top"
                                    alt="..."
                                />
                                <div class="d-none product-item__frame"></div>
                            </div>
                            <div class="card-body text-muted product-item__info">
                                <p class="card-title product-item__name">CHERISH Thạch vị thơm gói 405G Mô tả ngắn về
                                    sản phẩm này. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                                    pretium lectus nec urna consequat, a feugiat lectus aliquet.</p>
                                <p class="card-text mb-1">ĐVT: Gói</p>
                                <div class="product-item__promotion-info d-none">
                                    <img class="product-item__promotion-info-image"
                                         src="https://hcm.fstorage.vn/images/2024/09/10170556-20240911031445.png"
                                         alt="">
                                    <p class="product-item__promotion-info-text">Mua 2 Chai được tặng 1 chai Nước lau
                                        sàn MaxKleen ngàn hoa ngọt ngào chai 1kg</p>
                                </div>
                                <div class="product-item__info-price d-flex">
                                    <p class="card-text text-danger fw-bold product-item__price-new m-0">30.000đ</p>
                                    <span
                                        class="product-item__price-old ms-4 text-decoration-line-through">49.000đ</span>
                                </div>
                            </div>
                            <!-- Product action -->
                            <div class="product-item__action">
                                <a href="#" class="d-block btn-cart--add" data-url="">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                                <a href="#" class="d-block btn-cart--add">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 product__item">
                        <div class="card product-item">
                            <div class="product-item__discount-wrap">
                                <p class="product-item__discount-product">-30%</p>
                                <img src="" alt="" class="product-item__discount-ship d-none">
                            </div>
                            <div class="product-item__img-wrap">
                                <img
                                    src="https://hcm.fstorage.vn/images/2022/thach-trai-cay-vfoods-tong-hop-1kg.jpg"
                                    class="product-item__img card-img-top"
                                    alt="..."
                                />
                                <div class="d-none product-item__frame"></div>
                            </div>
                            <div class="card-body text-muted product-item__info">
                                <p class="card-title product-item__name">CHERISH Thạch vị thơm gói 405G Mô tả ngắn về
                                    sản phẩm này. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                                    pretium lectus nec urna consequat, a feugiat lectus aliquet.</p>
                                <p class="card-text mb-1">ĐVT: Gói</p>
                                <div class="product-item__promotion-info d-none">
                                    <img class="product-item__promotion-info-image"
                                         src="https://hcm.fstorage.vn/images/2024/09/10170556-20240911031445.png"
                                         alt="">
                                    <p class="product-item__promotion-info-text">Mua 2 Chai được tặng 1 chai Nước lau
                                        sàn MaxKleen ngàn hoa ngọt ngào chai 1kg</p>
                                </div>
                                <div class="product-item__info-price d-flex">
                                    <p class="card-text text-danger fw-bold product-item__price-new m-0">30.000đ</p>
                                    <span
                                        class="product-item__price-old ms-4 text-decoration-line-through">49.000đ</span>
                                </div>
                            </div>
                            <!-- Product action -->
                            <div class="product-item__action">
                                <a href="#" class="d-block btn-cart--add" data-url="">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                                <a href="#" class="d-block btn-cart--add">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('client') }}/js/product.js"></script>
@endsection
