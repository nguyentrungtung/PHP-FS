@extends('client.master-layout') <!-- Kế thừa layout chính -->

@section('title', 'Chi Tiết Sản Phẩm')

@section('link')
    <link rel="stylesheet" href="{{ url('client') }}/css/product.css">
@endsection

@section('content')
    <!-- Main Content -->
    <div class="row product-info">

        <!-- Product Image and product-info__Thumbnails -->
        <div class="col-md-5 product-info__image-gallery">
            @php
                // Biến để kiểm tra xem có ảnh thumbnail không
                $hasThumbnail = false;
            @endphp

            @foreach($product->productImage as $product_image)
                @if($product_image->image_type == 'main')
                    <!-- Main Product Image -->
                @php
                    $mainPath = $product_image->image_url;
                @endphp
                    <img
                        id="mainImage"
                        src="{{ asset($product_image->image_url) }}"
                        class="product-info__image"
                        alt="Main Product Image"
                    />
                @elseif($product_image->image_type == 'thumbnail')
                    @php
                        $hasThumbnail = true;
                    @endphp
                        <!-- product-info__Thumbnail Images -->
                    <div class="product-info__thumbnail-container">
                        <ul class="product-info__thumbnail-list">
                            <li class="product-info__thumbnail-item">
                                <img
                                    src="{{ asset($mainPath) }}"
                                    class="product-info__thumbnail-image"
                                    alt="Thumbnail Image"
                                    onclick="changeImage(this.src)"
                                />
                            </li>
                            <li class="product-info__thumbnail-item">
                                <img
                                    src="{{ asset($product_image->image_url) }}"
                                    class="product-info__thumbnail-image"
                                    alt="Thumbnail Image"
                                    onclick="changeImage(this.src)"
                                />
                            </li>
                        </ul>
                    </div>
                @endif
            @endforeach

            <!-- Nếu không có thumbnail, sử dụng ảnh main làm thumbnail -->
            @if(!$hasThumbnail)
                <hr/>
                <div class="product-info__thumbnail-container">
                    <ul class="product-info__thumbnail-list">
                        <li class="product-info__thumbnail-item">
                            <img
                                src="{{ asset($product->productImage->firstWhere('image_type', 'main')->image_url) }}"
                                class="product-info__thumbnail-image"
                                alt="Main Image as Thumbnail"
                                onclick="changeImage(this.src)"
                            />
                        </li>
                    </ul>
                </div>
            @endif
        </div>

        <!-- Product Details -->
        <div class="col-md-7 product-details">
            <h5 class="product-details__name-product m-0" id ="product_name--detail">
                {{$product->product_name}}
            </h5>
            <p class="product-details__text-muted">
                <span>SKU : </span>
                <span class="inline-block product-details__text-muted-value">{{$product->product_sku}}</span>
            </p>
            <p class="product-details__text-stock"></p>
            <span class="product-details__title inline-block">Tình trạng : </span>
            @if($product->product_quantity > 0)
            <span class="inline-block p-2 btn" style="border:1px solid rgb(226, 218, 218)">Còn hàng</span>
            @else
            <span class="inline-block p-2 btn" style="border:1px solid rgb(226, 218, 218)">Hết hàng</span>
            @endif
            </p>
            <p class="product-details__product-price">
                <span class="product-details__title inline-block">Giá : </span>
                <span class="text-danger fs-5" id ="product_price--detail">{{ number_format($product->product_price) }}đ</span>
            </p>
            <p class="product-details__text-ship">
                <span class="product-details__title inline-block">Vận chuyển : </span>
                <span class="inline-block">Miễn phí giao hàng cho đơn từ 300.000đ.
                            Giao hàng trong 2 giờ.</span>
            </p>
            <div class="product-details__text-type">
                <span class="product-details__title inline-block">Chọn loại : </span>
                <ul class="product-details__unit-list">
                    @foreach($product->unitValues as $unitValue)
                        @php
                            $price = $product->product_price;
                            $priceUnit = (int)$price * (int)$unitValue->value
                        @endphp
{{--                        @if(number_format($unitValue->value) > 1)--}}
{{--                            <li class="product-details__unit-item btn btn-danger">{{number_format($unitValue->value) .' '. $unitValue->unit->unit_name }}</li>--}}
{{--                        @else--}}
                            <li class="product-details__unit-item btn btn-danger" value = "{{$priceUnit}}" onclick="changePrice(this.value, this)">{{$unitValue->unit->unit_name}}</li>
{{--                        @endif--}}
                    @endforeach
                </ul>
            </div>

            <div class="product-details__quantity-selector">
                <span class="product-details__title inline-block">Số lượng : </span>
                <!-- <input type="number" class="form-control" id="quantity" value="1" min="1" max="10" /> -->
                <div class="quantity">
                    <button type="button">
                        <i class="fa-solid fa-minus icon-minus"
                           style="color:white;border-top-left-radius: 12px;border-bottom-right-radius: 12px"></i>
                    </button>
                    <!-- <input type="number" name="quatity" id="" value="1" max-length="12" /> -->
                    <input type="text" inputmode="numeric" name="quatity" id="input-quantity" value="1" max-length="12"
                           class="input-quantity">
                    <button type="button">
                        <i class="fa-solid fa-plus icon-flus"
                           style="color:white;border-top-left-radius: 12px;border-bottom-right-radius: 12px"></i>
                    </button>
                </div>
            </div>
            <button class="btn btn-danger translate--y btn-lg product-quantity__selector--add">Thêm vào giỏ hàng
            </button>
        </div>
    </div>

    <!-- Product Description and info -->
    <div class="row product-description">
        <div class="col-md-5">
            <div class="product-description__tab-buttons">
                <button class="product-description__btn-description translate--y" onclick="showTab('description')">
                    Mô tả
                </button>
                <button class="product-description__btn-info translate--y d-none" onclick="showTab('info')">
                    Thông tin sản phẩm
                </button>
            </div>
            <div class="product-description__tab-content" id="description-tab" style ="text-align: justify">
                <h4 class="fw-bold">Chi tiết sản phẩm</h4>
                <p>
                    {{$product->product_description}}
                </p>
            </div>
            <div class="product-description__tab-content d-none" id="info-tab">
                <h3>Đánh giá của khách hàng</h3>
                <p>Hiện tại chưa có đánh giá nào. Hãy là người đầu tiên đánh giá sản phẩm này!</p>
            </div>
        </div>
        <div class="col-md-7" style ="opacity:0"></div>
    </div>

    <!-- Related Products -->
    <div class="row  product-related mt-4">
        <h4 class="product-related__title mb-3 fw-bold">Sản phẩm tương tự</h4>
        <div class="product-list  owl-carousel owl-theme">
{{--        <div class="col-md-12 product-list">--}}
{{--            <div class="row g-2">--}}
            @foreach($productRelates as $productRelate)
            <div class="col-lg-1-5">
                <div class="card product-item">
                    <div class="product-item__img-wrap">
                        @foreach($productRelate->productImage as $product_image)
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

                        <div class="product-item__frame d-none"></div>
                    </div>
                    <div class="card-body text-muted product-item__info">
                        <p class="card-title product-item__name">CHERISH Thạch vị thơm gói 405G Mô tả ngắn về sản phẩm
                            này. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium lectus
                            nec urna consequat, a feugiat lectus aliquet.</p>
                        <p class="card-text mb-1">ĐVT: Gói</p>
                        <div class="product-item__promotion-info">
                            <img class="product-item__promotion-info-image"
                                 src="https://hcm.fstorage.vn/images/2024/09/10170556-20240911031445.png" alt="">
                            <p class="product-item__promotion-info-text">Mua 2 Chai được tặng 1 chai Nước lau sàn
                                MaxKleen ngàn hoa ngọt ngào chai 1kg</p>
                        </div>
                        <p class="card-text text-danger fw-bold">30.000đ</p>
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
            @endforeach
{{--            </div>--}}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('client') }}/js/product.js"></script>
@endsection
