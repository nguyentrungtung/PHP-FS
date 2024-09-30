@foreach($carts as $product_id => $cart)
    <div class="cart__item col-12" data-id="{{$product_id}}">
        <div
            class="cart__item-wrapper d-flex justify-content-between align-items-center border-bottom  hover--box-shadow cart__item-{{$product_id}}">
            <div class="cart__item-info d-flex align-items-center">
                <img
                    src="{{ $cart['product_image'] }}"
                    class="cart__item-image"
                    alt="Sản phẩm {{ $cart['product_name'] }}"
                />
                <div class="cart__item-product-info">
                    <h5 class="cart__item-name">{{ $cart['product_name'] }}</h5>
                    <p class="cart__item-price">
                        Giá: <span class="text-danger" style="font-size: 14px; font-weight: 500; color:black">{{ number_format($cart['product_price'], 0, ',', '.') }} ₫</span>
                        @if(isset($cart['product_price_old']))
                            <span
                                class="d-inline-block ms-3"
                                style="font-size: 14px; font-weight: 500; color:#696363; text-decoration: line-through;">{{number_format($cart['product_price_old'])}}₫</span>
                        @endif
                    </p>
                    <p class="cart__item-unit">
                        ĐVT: <span class="text-danger"
                                   style="font-size: 14px; font-weight: 500; color:black">{{ $cart['product_unit'] }}</span>
                    </p>
                </div>
            </div>
            <div class="cart__item-actions d-flex flex-column align-items-end">
                <input
                    type="number"
                    class="form-control cart__item-quantity cart__item-quantity-{{$product_id}}"
                    value="{{ $cart['product_quantity'] }}"
                    min="1"
                    style="width: 80px"
                    data-url_update_cart="{{route('cart.update')}}"
                    data-available-quantity="{{ $cart['available_quantity'] }}"
                />
                <button style ="background-color:white; border:none; padding:4px" class="text-danger btn-sm mt-3 cart__item-remove translate--y" data-url="{{ route('cart.remove', $product_id) }}"><i class="fa-regular fa-trash-can"></i></button>
            </div>
        </div>
    </div>
@endforeach
