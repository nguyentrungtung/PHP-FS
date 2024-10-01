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
                        Giá: <span class="text-danger" style="font-size: 14px; font-weight: 500; color:black">{{ number_format($cart['product_price']) }} ₫</span>
                        @if(isset($cart['product_price_old']))
                            <span
                                class="d-inline-block ms-3"
                                style="font-size: 14px; font-weight: 500; color:#696363; text-decoration: line-through;">{{ number_format($cart['product_price_old']) }}₫</span>
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
                <button style ="background-color:white; border:none; padding:4px" class="text-danger btn-sm mt-3 cart__item-remove translate--y live-toast__btn--remove-cart" data-url="{{ route('cart.remove', $product_id) }}"><i class="fa-regular fa-trash-can"></i></button>
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div  class="toast live-toast--remove-cart" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img style ="width:30px; height:30px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxWVUh-5Tpawx11aP2YqFYmRMN_kBoAUic6g&s" class="rounded me-2" alt="...">
                            <strong class="me-auto ">....</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                        </div>
                        <div class="toast-body text-success" >
                            Xóa giỏ hàng thành công
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
