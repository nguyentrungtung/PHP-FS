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
            <h5 class="product-details__name-product m-0" id="product_name--detail">
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
                    <span class="text-danger fs-5 fw-bold" id="product_price--detail">{{ number_format($product->product_price) }}₫</span>
                    @if(isset($product->product_price_old))
                        <span id="product_price--old"
                              style="display:inline-block; color:#817c7c; text-decoration: line-through; margin-left: 10px; transform: translateY(-2px)">{{ number_format($product->product_price_old) }}₫</span>
                    @endif
                </p>
                <p class="product-details__text-ship">
                    <span class="product-details__title inline-block">Vận chuyển : </span>
                    <span class="inline-block">Miễn phí giao hàng cho đơn từ 300.000₫.
                    Giao hàng trong 2 giờ.</span>
                </p>
                <div class="product-details__text-type">
                    <span class="product-details__title inline-block">Chọn loại : </span>
                    @php
                        $unitCount = count($product->unitValues); // Đếm số lượng đơn vị
                    @endphp

                    <ul class="product-details__unit-list">
                        @foreach($product->unitValues as $index => $unitValue)
                            @php
                                $price = $product->product_price;
                                $priceUnit = (int)$price * (int)$unitValue->value;
                                // Kiểm tra điều kiện để xác định trạng thái active
                                $isActive = ($unitCount === 1) || ($index === 0);
                            @endphp
                            <li class="product-details__unit-item {{ $isActive ? 'active' : '' }}"
                                value="{{ $priceUnit }}" data-price_unit="{{ $priceUnit }}"
                                onclick="changePrice(this.value, this)">{{ $unitValue->unit->unit_name }}
                            </li>
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
                        <input type="text" inputmode="numeric" name="quatity" id="input-quantity" value="1"
                               max-length="12"
                               class="input-quantity">
                        <button type="button">
                            <i class="fa-solid fa-plus icon-flus"
                               style="color:white;border-top-left-radius: 12px;border-bottom-right-radius: 12px"></i>
                        </button>
                    </div>
                </div>
                @if($product->product_quantity > 0)
                    <button type="button" id="liveToastBtn"
                            class="liveToastBtn btn btn-danger translate--y btn-lg product-quantity__selector--add btn_add-cart"
                            data-url="{{ route('cart.store',['id' => $product->id]) }}"
                            data-product_price="{{ $product->product_price }}"
                            data-unit_name="{{ $product->unitValues->first()->unit->unit_name }}">Thêm vào giỏ hàng
                    </button>
                    {{--Toast message--}}
                    <div class="toast-container position-fixed bottom-0 end-0 p-3">
                        <div class="toast liveToast" role="alert" aria-live="assertive" aria-atomic="true"
                             style="width: max-content">
                            <div class="toast-header" style="padding: 3px 10px; background-color: rgb(149,230,177)">
                                <img style="width:20px; height:20px"
                                     src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxWVUh-5Tpawx11aP2YqFYmRMN_kBoAUic6g&s"
                                     class="rounded me-2" alt="...">
                                <strong class="me-auto ">....</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="toast"
                                        aria-label="Close" style="font-size: 12px"></button>
                            </div>
                            <div class="toast-body text-success">

                            </div>
                        </div>
                    </div>
                @endif
        </div>
    </div>

    <!-- Product Description and info -->
    <div class="row g-2 product-description">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-5">
                    <div class="product-description__tab-buttons">
                        <button class="product-description__btn-description translate--y"
                            {{--                            onclick="showTab('description')"--}}
                        >
                            Mô tả
                        </button>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="product-description__tab-buttons">
                        <button class="product-description__btn-info translate--y"
                            {{--                            onclick="showTab('info')"--}}
                        >
                            Thông tin sản phẩm
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="product-description__tab-content" id="description-tab" style="text-align: justify">
                <h5 class="mb-3">Chi tiết sản phẩm</h5>
                <p>
                    {{$product->product_description}}
                </p>
            </div>
        </div>

        <div class="col-md-7">
            <div class="product-description__tab-content" id="info-tab">{{--d-none--}}
                <h5 class="mb-3">Thông tin sản phẩm</h5>
                <p>Xuất xứ: Việt Nam</p>
                <p>Hướng Dẫn Sử Dụng: Dùng trộn salad, rau, các món gỏi hoặc dùng làm gia vị tẩm ướp.</p>
                <p>Bảo Quản: Bảo quản nơi khô ráo tránh ánh nắng mặt trời</p>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <div class="row  product-related mt-4">
        <h4 class="product-related__title mb-3 fw-bold">Sản phẩm tương tự</h4>
        <div class="product-list  owl-carousel owl-theme">
            @foreach($productRelates as $productRelate)
                <div class="col-lg-1-5">
                    <div class="card product-item">
                        <a href="{{ route('product.show',['id' => $productRelate->id]) }}">
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
                        </a>
                        <div class="card-body text-muted product-item__info">
                            <p class="card-title product-item__name">{{$productRelate->product_name}}</p>
                            <p class="card-text mb-1">
                                ĐVT: {{$productRelate->unitValues->first()->unit->unit_name}}</p>
                            <p class="card-text text-danger fw-bold">{{number_format($productRelate->product_price)}}
                                ₫
                                <span class="text-decoration-line-through"
                                      style="color:#7e7070; font-size: 14px; margin-left: 10px; font-weight: 500">{{ number_format($productRelate->product_price_old) }}</span>
                            </p>
                        </div>
                        <!-- Product action -->
                        <div class="product-item__action">
                            <a href="#" class="liveToastBtn d-block btn__add-cart btn_add-cart"
                               data-product_id="{{$productRelate->id}}"
                               data-available_stock="{{ $productRelate->product_quantity }}"
                               data-unit_name="{{ $productRelate->unitValues->first()->unit->unit_name }}"
                               data-url="{{ route('cart.store',['id' => $productRelate->id]) }}"
                               data-product_price="{{$productRelate->product_price}}">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                            <a href="#" class="d-block btn__add-cart btn_add-cart">
                                <i class="fa-regular fa-heart"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--            Toas message--}}
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div class="toast liveToast" role="alert" aria-live="assertive" aria-atomic="true"
                     style="width: max-content">
                    <div class="toast-header" style="padding: 3px 10px; background-color: rgb(149,230,177)">
                        <img style="width:20px; height:20px"
                             src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQxWVUh-5Tpawx11aP2YqFYmRMN_kBoAUic6g&s"
                             class="rounded me-2" alt="...">
                        <strong class="me-auto ">....</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                                aria-label="Close" style="font-size: 12px"></button>
                    </div>
                    <div class="toast-body text-success">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ url('client') }}/js/product.js"></script>
    <script type="module" src="{{ url('client') }}/js/cart.js"></script>
@endsection

@push('custom-script')
@endpush
