{{--@php--}}
{{--    dd($carts);--}}
{{--@endphp--}}
@foreach($carts as $cart)
    <div class="d-flex list_items_item">
        <img src="{{ asset($cart['product_image']) }}" alt="" class="item_img">
        <div class="d-flex flex-wrap flex-column item_content">
            <p class="item_content_text mb-1">{{ $cart['product_name'] }}</p>
            <div class="d-flex content_dv">
                <p class="item_content_text">DVT:</p>
                <p class="item_content_text ms-1">{{ $cart['product_unit'] }}</p>
            </div>
            <div class="d-flex justify-content-between item_content_price">
                <p class="item_content_text">x {{ $cart['product_quantity'] }}</p>
                <p class="item_price">{{ number_format($cart['product_total']) }}đ</p>
            </div>
        </div>
    </div>
@endforeach

