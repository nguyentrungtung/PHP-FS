@foreach($carts as $product_id => $cart)
    <div class="cart__item col-12" data-id="{{$product_id}}">
        <div class="cart__item-wrapper d-flex justify-content-between align-items-center border-bottom hover--box-shadow">
            <div class="cart__item-info d-flex align-items-center">
                <img
                        src="{{ $cart['product_image'] }}"
                        class="cart__item-image"
                        alt="Sản phẩm {{ $cart['product_name'] }}"
                />
                <div class="cart__item-product-info">
                    <h5 class="cart__item-name">{{ $cart['product_name'] }}</h5>
                    <p class="cart__item-price">
                        Giá: <span class="text-danger">{{ number_format($cart['product_price'], 0, ',', '.') }} đ</span>
                    </p>
                    <p class="cart__item-unit">
                        ĐVT: <span class="text-danger">{{ $cart['product_unit'] }}</span>
                    </p>
                </div>
            </div>
            <div class="cart__item-actions d-flex flex-column align-items-end">
                <input
                        type="number"
                        class="form-control cart__item-quantity"
                        value="{{ $cart['product_quantity'] }}"
                        min="1"
                        style="width: 80px"
                        data-url_update_cart="{{route('cart.update')}}"
                />
                {{--                                            <button class="btn btn-danger btn-sm mt-2 cart__item-remove" data-url="{{ route('cart.remove', $cart['id']) }}">Xóa</button>--}}
            </div>
        </div>
    </div>
@endforeach
<a href="#" class="mt-3 btn btn-outline-danger text-decoration-underline"
   data-url="{{ route('cart.clear') }}" id="btn_cart--clear" style="width: max-content">Xóa
    giỏ hàng</a>
