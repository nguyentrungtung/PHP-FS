@extends('.client.pages.account.account')
@section('account.title','Buy Products')
@section('link')
    <link rel="stylesheet" href="{{ asset('client/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/account.css') }}">
@endsection
@section('account.content')
<div class="d-flex flex-column acount_bill">
    <h3 class='account_title'>Sản phẩm đã mua</h3>
    <table class="table"  id ="myProductTable" >
        <thead>
        <tr>
            <th class ="text-center" scope="col">Stt</th>
            <th class ="text-start" scope="col">Tên sản phẩm</th>
            <th class ="text-center" scope="col">Hình ảnh</th>
            <th class ="text-center" scope="col">Giá sản phẩm</th>
            <th class ="text-center" scope="col">action</th>
        </tr>
        </thead>
        <tbody>
            @if(isset($products) && count($products) > 0)
                @foreach($products as $key => $product)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td class="text-center">
                            <div class="text-truncate" style="max-width: 200px;">{{ $product->product_name ?? null }}</div>
                        </td>
                        <td class="text-center">
                            @php
                                $main_image = $product->productImage->firstWhere('image_type', 'main');
                            @endphp
                            @if($main_image)
                                <img src="{{ asset($main_image->image_url) }}" alt="Main Image" style="max-width: 100px; max-height: 100px;">
                            @endif
                        </td>
                        <td class="text-center">{{ number_format($product->product_price) }}₫</td>
                        <td class="text-center"><a href="{{route('product.show',['id'=>$product->id])}}" class="btn btn-primary">Detail</a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    @if (isset($products) && count($products) > 0)
        <div class="d-flex align-items-center justify-content-center">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    @endif
    @if(!isset($products) || count($products) === 0)
    <img class='nullbill' src="{{asset('img/null_bill.png')}}" alt="">
    @endif
</div>
@endsection
