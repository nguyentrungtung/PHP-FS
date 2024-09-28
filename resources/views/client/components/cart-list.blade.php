
@foreach($carts as $cart)
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
                    value="{{$cart['product_quantity']}}"
                    style="width: 80px"
                />
                <button class="btn btn-danger btn-sm mt-2 cart__item-remove">Xóa</button>
            </div>
        </div>
    </div>
@endforeach
