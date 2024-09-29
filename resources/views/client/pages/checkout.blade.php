@extends('client.master-layout') <!-- Kế thừa layout chính -->

@section('title', 'Thanh toán')

@section('link')
    <link rel="stylesheet" href="{{ url('client') }}/css/checkout.css">
@endsection

@section('content')
    <div class="checkout">
        <!-- Checkout Header -->
        <div class="checkout__header d-none">
            <h1 class="checkout__title">Checkout</h1>
        </div>
        <div class="row">
            <div class="col-md-7">
                <!-- Checkout Form -->
                <div class="checkout__form">
                    <!-- Thông tin người đặt -->
                    <div class="checkout__section checkout__section--customer">
                        <h2 class="checkout__section-title">Thông tin đặt hàng</h2>
                        <form class="checkout__customer-form">
                            <div class="checkout__input-group">
                                <label class="checkout__label" for="name"
                                >Họ tên người nhận<span class="text-danger">*</span></label
                                >
                                <input
                                    class="checkout__input"
                                    type="text"
                                    id="name"
                                    name="name"
                                    placeholder="Nhập họ tên đầy đủ"
                                    required
                                />
                            </div>
                            <div class="checkout__input-group">
                                <label class="checkout__label" for="phone"
                                >Số điện thoại<span class="text-danger">*</span></label
                                >
                                <input
                                    class="checkout__input"
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    placeholder="Nhập số điện thoại"
                                    required
                                />
                            </div>
                            <div
                                class="checkout__input-group d-flex"
                                style="justify-content: space-between; align-items: end"
                            >
                                <div style="flex: 1">
                                    <label class="checkout__label" for="area-ship"
                                    >Khu vực giao hàng<span class="text-danger">*</span></label
                                    >
                                    <input
                                        class="checkout__input"
                                        type="text"
                                        id="area-ship"
                                        name="area-ship"
                                        placeholder="Nhập khu vực giao hàng"
                                        required
                                    />
                                </div>
                                <button
                                    type="button"
                                    class="btn btn-danger"
                                    style="width: 110px; margin-left: 5px; transform: translateY(-3px)"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                >
                                    Đổi khu vực
                                </button>

                                <!-- Modal -->
                                <div
                                    class="modal fade"
                                    id="exampleModal"
                                    tabindex="-1"
                                    aria-labelledby="exampleModalLabel"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title fs-5" id="exampleModalLabel">
                                                    Khu vực giao dự kiến
                                                </h6>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"
                                                ></button>
                                            </div>
                                            <!-- Modal thay đổi khu vực -->
                                            <div class="modal-body delivery-modal__body">
                                                <div class="delivery-modal__body-wrap">
                                                    <div class="delivery-modal__description">
                                                                <span
                                                                ><i class="fa-solid fa-location-dot text-danger"></i
                                                                    ></span>
                                                        Cho phép hệ thống truy cập địa chỉ từ thiết bị và đề
                                                        xuất cửa hàng gần nhất
                                                    </div>
                                                    <div class="delivery-modal__address">
                                                                <span class="delivery-modal__address-label"
                                                                >Địa chỉ:</span
                                                                >
                                                        <span class="delivery-modal__address-text"
                                                        >P. Dịch Vọng Hậu, Q. Cầu Giấy, TP. Hà Nội</span
                                                        >
                                                        <a href="#" class="delivery-modal__change-address ms-3"
                                                        ><i class="fa-solid fa-pencil"></i> Thay đổi</a
                                                        >
                                                    </div>
                                                </div>
                                                <hr class="divider" />

                                                <div class="delivery-modal__store">
                                                    <h6 class="delivery-modal__store-title">
                                                        Quý khách vui lòng chọn cửa hàng giao hàng
                                                        <span class="text-danger">
                                                                    (CH hiện tại: WM HNI Vũ Trọng Phụng)</span
                                                        >
                                                    </h6>
                                                    <div class="delivery-modal__store-item active">
                                                        <div class="delivery-modal__item-warap-img">
                                                            <img
                                                                class="delivery-modal__item-img"
                                                                src="https://winmart.vn/_next/static/images/winmart-store-43c86497a3546993b51e6f86683e5234.png"
                                                                alt=""
                                                            />
                                                        </div>
                                                        <div class="delivery-modal__store-item-info">
                                                            <p class="delivery-modal__item-name">
                                                                WM HNI Cầu Giấy
                                                            </p>
                                                            <p class="delivery-modal__item-address">
                                                                Địa chỉ: Tòa nhà Skypark, Số 2 Tôn Thất Thuyết,
                                                                Phường Dịch Vọng Hậu, Quận Cầu Giấy, TP. Hà Nội
                                                                Việt Nam
                                                            </p>
                                                            <p class="delivery-modal__item-phone">
                                                                Số điện thoại: 0559701645
                                                            </p>
                                                        </div>
                                                        <div class="delivery-modal__item-hotline">
                                                            <img
                                                                src="https://winmart.vn/_next/static/images/2h-highlight-a72a7d04d45d544f710468f34432bd14.png"
                                                                alt=""
                                                                style="width: 80px"
                                                            />
                                                            <p>Khoảng cách</p>
                                                            <p>2.5 km</p>
                                                        </div>
                                                    </div>
                                                    <div class="delivery-modal__store-item">
                                                        <div class="delivery-modal__item-warap-img">
                                                            <img
                                                                class="delivery-modal__item-img"
                                                                src="https://winmart.vn/_next/static/images/winmart-store-43c86497a3546993b51e6f86683e5234.png"
                                                                alt=""
                                                            />
                                                        </div>
                                                        <div class="delivery-modal__store-item-info">
                                                            <p class="delivery-modal__item-name">
                                                                WM HNI Cầu Giấy
                                                            </p>
                                                            <p class="delivery-modal__item-address">
                                                                Địa chỉ: Tòa nhà Skypark, Số 2 Tôn Thất Thuyết,
                                                                Phường Dịch Vọng Hậu, Quận Cầu Giấy, TP. Hà Nội
                                                                Việt Nam
                                                            </p>
                                                            <p class="delivery-modal__item-phone">
                                                                Số điện thoại: 0559701645
                                                            </p>
                                                        </div>
                                                        <div class="delivery-modal__item-hotline">
                                                            <img
                                                                src="https://winmart.vn/_next/static/images/2h-highlight-a72a7d04d45d544f710468f34432bd14.png"
                                                                alt=""
                                                                style="width: 80px"
                                                            />
                                                            <p>Khoảng cách</p>
                                                            <p>2.5 km</p>
                                                        </div>
                                                    </div>
                                                    <div class="delivery-modal__store-item">
                                                        <div class="delivery-modal__item-warap-img">
                                                            <img
                                                                class="delivery-modal__item-img"
                                                                src="https://winmart.vn/_next/static/images/winmart-store-43c86497a3546993b51e6f86683e5234.png"
                                                                alt=""
                                                            />
                                                        </div>
                                                        <div class="delivery-modal__store-item-info">
                                                            <p class="delivery-modal__item-name">
                                                                WM HNI Cầu Giấy
                                                            </p>
                                                            <p class="delivery-modal__item-address">
                                                                Địa chỉ: Tòa nhà Skypark, Số 2 Tôn Thất Thuyết,
                                                                Phường Dịch Vọng Hậu, Quận Cầu Giấy, TP. Hà Nội
                                                                Việt Nam
                                                            </p>
                                                            <p class="delivery-modal__item-phone">
                                                                Số điện thoại: 0559701645
                                                            </p>
                                                        </div>
                                                        <div class="delivery-modal__item-hotline">
                                                            <img
                                                                src="https://winmart.vn/_next/static/images/2h-highlight-a72a7d04d45d544f710468f34432bd14.png"
                                                                alt=""
                                                                style="width: 80px"
                                                            />
                                                            <p>Khoảng cách</p>
                                                            <p>2.5 km</p>
                                                        </div>
                                                    </div>
                                                    <div class="delivery-modal__store-item">
                                                        <div class="delivery-modal__item-warap-img">
                                                            <img
                                                                class="delivery-modal__item-img"
                                                                src="https://winmart.vn/_next/static/images/winmart-store-43c86497a3546993b51e6f86683e5234.png"
                                                                alt=""
                                                            />
                                                        </div>
                                                        <div class="delivery-modal__store-item-info">
                                                            <p class="delivery-modal__item-name">
                                                                WM HNI Cầu Giấy
                                                            </p>
                                                            <p class="delivery-modal__item-address">
                                                                Địa chỉ: Tòa nhà Skypark, Số 2 Tôn Thất Thuyết,
                                                                Phường Dịch Vọng Hậu, Quận Cầu Giấy, TP. Hà Nội
                                                                Việt Nam
                                                            </p>
                                                            <p class="delivery-modal__item-phone">
                                                                Số điện thoại: 0559701645
                                                            </p>
                                                        </div>
                                                        <div class="delivery-modal__item-hotline">
                                                            <img
                                                                src="https://winmart.vn/_next/static/images/2h-highlight-a72a7d04d45d544f710468f34432bd14.png"
                                                                alt=""
                                                                style="width: 80px"
                                                            />
                                                            <p>Khoảng cách</p>
                                                            <p>2.5 km</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-danger"
                                                    style="width: 100%"
                                                >
                                                    Xác nhận
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input-group">
                                <label class="checkout__label" for="address"
                                >Địa chỉ<span class="text-danger">*</span></label
                                >
                                <input
                                    class="checkout__input"
                                    type="text"
                                    id="address"
                                    name="address"
                                    placeholder="Nhập số nhà, tên đường"
                                    required
                                />
                            </div>
                        </form>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <div class="checkout__section checkout__section--methods">
                        <h2 class="checkout__section-title">Phương thức thanh toán</h2>
                        <form class="checkout__methods-form">
                            <div class="checkout__method checkout__method-cod" style="border: 2px solid red">
                                <input
                                    class="checkout__method-input"
                                    type="radio"
                                    id="credit-card"
                                    name="payment-method"
                                    value="credit-card"
                                    checked
                                />
                                <label class="checkout__method-label" for="credit-card"
                                ><span><i class="fa-solid fa-money-bills"></i></span> Tiền mặt(COD)</label
                                >
                            </div>
                            <div class="checkout__method checkout__method-online">
                                <input
                                    class="checkout__method-input"
                                    type="radio"
                                    id="paypal"
                                    name="payment-method"
                                    value="paypal"
                                />
                                <label class="checkout__method-label" for="paypal"
                                ><span><i class="fa-solid fa-credit-card"></i></span> Thanh toán trực
                                    tuyến(online)</label
                                >
                            </div>
                            <label
                                class="checkout__method-label"
                                for="order_note"
                                style="font-size: 14px; font-weight: bold; color: #555; margin-bottom: 5px"
                            >Ghi chú(nếu có)</label
                            >
                            <textarea
                                class="form-control"
                                id="order_note"
                                name="order_note"
                                rows="3"
                            ></textarea>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-5">
                <div class="order-summary">
                    <h4
                        class="order-summary__title"
                        style="
                                    font-size: 18px;
                                    font-weight: bold;
                                    color: #333;
                                    margin-bottom: 15px;
                                    text-align: left;
                                "
                    >
                        Thông tin đơn hàng
                    </h4>

                    <div class="oder-list">
                        <div class="oder-list__product-cart">
                            <table class="table oder-list__product-item">
                                <thead>
                                <tr>
                                    <th scope="col" colspan="3" class="text-center">Sản phẩm</th>
                                    <th scope="col" class="text-center">Số tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th
                                        class="order-list__product-item-name text-justify align-middle"
                                        scope="row"
                                    >
                                        Túi Nước Giặt Xả Maxkleen Hương hoa huyền diệu 3.8kg
                                    </th>
                                    <td class="text-center align-middle">
                                        <img
                                            src="https://hcm.fstorage.vn/images/2024/09/10161636-20240911031205.png"
                                            alt=""
                                            style="width: 120px; height: 90px; object-fit: contain"
                                        />
                                    </td>
                                    <td class="text-center align-middle">2</td>
                                    <td class="text-center align-middle" style="width: 120px">149.000 ₫</td>
                                </tr>
                                <tr>
                                    <th
                                        class="order-list__product-item-name text-justify align-middle"
                                        scope="row"
                                    >
                                        Túi Nước Giặt Xả Maxkleen Hương hoa huyền diệu 3.8kg
                                    </th>
                                    <td class="text-center align-middle">
                                        <img
                                            src="https://hcm.fstorage.vn/images/2024/09/10161636-20240911031205.png"
                                            alt=""
                                            style="width: 120px; height: 90px; object-fit: contain"
                                        />
                                    </td>
                                    <td class="text-center align-middle">2</td>
                                    <td class="text-center align-middle" style="width: 120px">149.000 ₫</td>
                                </tr>
                                <tr>
                                    <th
                                        class="order-list__product-item-name text-justify align-middle"
                                        scope="row"
                                    >
                                        Túi Nước Giặt Xả Maxkleen Hương hoa huyền diệu 3.8kg
                                    </th>
                                    <td class="text-center align-middle">
                                        <img
                                            src="https://hcm.fstorage.vn/images/2024/09/10161636-20240911031205.png"
                                            alt=""
                                            style="width: 120px; height: 90px; object-fit: contain"
                                        />
                                    </td>
                                    <td class="text-center align-middle">2</td>
                                    <td class="text-center align-middle" style="width: 120px">149.000 ₫</td>
                                </tr>
                                <tr>
                                    <th
                                        class="order-list__product-item-name text-justify align-middle"
                                        scope="row"
                                    >
                                        Túi Nước Giặt Xả Maxkleen Hương hoa huyền diệu 3.8kg
                                    </th>
                                    <td class="text-center align-middle">
                                        <img
                                            src="https://hcm.fstorage.vn/images/2024/09/10161636-20240911031205.png"
                                            alt=""
                                            style="width: 120px; height: 90px; object-fit: contain"
                                        />
                                    </td>
                                    <td class="text-center align-middle">2</td>
                                    <td class="text-center align-middle" style="width: 120px">149.000 ₫</td>
                                </tr>
                                <tr>
                                    <th
                                        class="order-list__product-item-name text-justify align-middle"
                                        scope="row"
                                    >
                                        Túi Nước Giặt Xả Maxkleen Hương hoa huyền diệu 3.8kg
                                    </th>
                                    <td class="text-center align-middle">
                                        <img
                                            src="https://hcm.fstorage.vn/images/2024/09/10161636-20240911031205.png"
                                            alt=""
                                            style="width: 120px; height: 90px; object-fit: contain"
                                        />
                                    </td>
                                    <td class="text-center align-middle">2</td>
                                    <td class="text-center align-middle" style="width: 120px">149.000 ₫</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="oder-list__info">
                            <div class="order-summary__item">
                                <span class="order-summary__label">Tổng tiền</span>
                                <span class="order-summary__value">127.460.000 ₫</span>
                            </div>

                            <div class="order-summary__item">
                                <span class="order-summary__label">Tổng khuyến mãi</span>
                                <span class="order-summary__value">7.500.000 ₫</span>
                            </div>

                            <div class="order-summary__item">
                                <span class="order-summary__label">Phí vận chuyển</span>
                                <span class="order-summary__value">Miễn phí</span>
                            </div>

                            <div class="order-summary__item order-summary__item--total">
                                <span class="order-summary__label">Cần thanh toán</span>
                                <span class="order-summary__value order-summary__value--total"
                                >119.960.000 ₫</span
                                >
                            </div>

                            <!-- Checkout Button -->
                            <div class="checkout__actions">
                                <button class="btn btn-danger checkout__button--submit" type="submit">
                                    Thanh toán
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('client') }}/js/checkout.js"></script>
@endsection

@push('custom-script')
@endpush
