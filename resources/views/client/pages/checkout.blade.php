@extends('client.master-layout') <!-- Kế thừa layout chính -->

@section('title', 'Thanh toán')

@section('link')
    <link rel="stylesheet" href="{{ url('client') }}/css/checkout.css">
@endsection

@section('content')
    @php
        // dd($carts);
        // dd($checkoutCartSummary);
    @endphp
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
                        <form class="checkout__customer-form" action="{{route('checkout.store')}}" enctype="multipart/form-data" method="POST">
                            @csrf
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
                                />
                            </div>
                            {{--Đổi khu vực - modal ....--}}
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
                                />
                            </div>
                            <!-- Phương thức thanh toán -->
                            <div class="checkout__section checkout__section--methods">
                                <h2 class="checkout__section-title">Phương thức thanh toán</h2>
                                <div class = "checkout__methods-form">
{{--                                <form class="checkout__methods-form">--}}
                                    <div class="checkout__method checkout__method-cod" style="border: 2px solid red">
                                        <input
                                            class="checkout__method-input"
                                            type="radio"
                                            id="credit-card"
                                            name="payment_method"
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
                                            name="payment_method"
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
{{--                                </form>--}}
                                </div>
                            </div>
                            <input readonly type = "hidden" name="total" class="total" value="{{$checkoutCartSummary['totalPrice']}}" >
                            <!-- Checkout Button -->
                            <div class="checkout__actions">
                                <button class="btn btn-danger checkout__button--submit translate--y" type="submit"
                                        style="float: right; width: 200px">
                                    Thanh toán
                                </button>
                            </div>
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
                                    <th scope="col" class="text-center">Giá</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carts as $cart)
                                    <tr>
                                        <th class="order-list__product-item-name text-justify align-middle" scope="row">
                                            {{ $cart['product_name'] }}
                                        </th>
                                        <td class="text-center align-middle">
                                            <img
                                                src="{{ asset($cart['product_image']) }}"
                                                alt="{{ $cart['product_name'] }}"
                                                style="width: 120px; height: 90px; object-fit: contain"
                                            />
                                        </td>
                                        <td class="text-center align-middle">{{ $cart['product_quantity'] }}</td>
                                        <td class="text-center align-middle"
                                            style="width: 120px">{{ number_format($cart['product_price'], 0, ',', '.') }}
                                            ₫
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="oder-list__info">
                            <div class="order-summary__item">
                                <span class="order-summary__label">Tổng tiền</span>
                                <span class="order-summary__value">{{ number_format($checkoutCartSummary['subtotal']) }}₫</span>
                            </div>

                            <div class="order-summary__item">
                                <span class="order-summary__label">Tổng khuyến mãi</span>
                                <span class="order-summary__value">-{{ number_format($checkoutCartSummary['discount'] + $checkoutCartSummary['totalSaving']) }}₫</span>
                            </div>

                            <div class="order-summary__item">
                                <span class="order-summary__label">Phí vận chuyển</span>
                                <span class="order-summary__value">Miễn phí</span>
                            </div>

                            <div class="order-summary__item order-summary__item--total">
                                <span class="order-summary__label">Cần thanh toán</span>
                                <span class="order-summary__value order-summary__value--total"
                                >{{ number_format($checkoutCartSummary['totalPrice']) }}₫</span
                                >
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
