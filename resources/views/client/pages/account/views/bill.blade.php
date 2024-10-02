@extends('.client.pages.account.account')
@section('account.title','Orders')
@section('link')
    <link rel="stylesheet" href="{{ asset('client/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/account.css') }}">
@endsection
@section('account.content')
<div class="d-flex flex-column acount_bill">
    <h3 class='account_title'>Quản lý đơn hàng</h3>
    <table class="table table-hover">
        <thead>
            <tr>
              <th scope="col">Đơn hàng</th>
              <th scope="col">Ngày mua</th>
              <th scope="col">Tổng tiền</th>
              <th scope="col">Tình trạng</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody id="bill_rows">
            @if(isset($orders) && count($orders) > 0)
                @foreach ($orders as $key => $order)
                <a href="">
                    <tr style="height: 30px;">
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$order->created_at}}</td>
                        <td>{{number_format($order->total)}} đ</td>
                        <td>{{$order->status}}</td>
                        <td><a href="{{route('web.user.order.detail',['id'=>$order->id])}}" class="btn btn-primary">Detail</a></td>
                    </tr>
                </a>
                @endforeach
            @endif
        </table>
        @if (isset($orders) && count($orders) > 0)
            <div class="d-flex align-items-center justify-content-center">
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>
        @endif
        @if(!isset($orders) || count($orders) === 0)
        <img class='nullbill' src="{{asset('img/null_bill.png')}}" alt="">
        @endif
</div>
@endsection
