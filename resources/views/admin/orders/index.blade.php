@extends('admin.master-layout')

@section('content')
    <div class="row" style="background-color:white; border-radius:5px; padding:20px; overflow: auto">
        <div class="container my-5">
            <h2 class="text-center mb-4">Danh sách đơn hàng</h2>

            <table class="table table-bordered table-hover" id="myOrderTable">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Tên khách hàng</th>
                    <th class="text-center">Số điện thoại</th>
                    <th class="text-center">Địa chỉ</th>
                    <th class="text-center">Phương thức thanh toán</th>
                    <th class="text-center">Ngày đặt hàng</th>
                    <th class="text-center">Tổng tiền</th>
                    <th class="text-center">Trạng thái</th>
                    <th class="text-center">Ghi chú</th>
                    <th class="text-center">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $key => $order)
                    <tr>
                        <td class="text-center">{{ $key+1 }}</td>
                        <td class="text-center">{{ $order->customer_name }}</td>
                        <td class="text-center">{{ $order->customer_phone }}</td>
                        <td class="text-center">{{ $order->customer_address }}</td>
                        <td class="text-center">{{ $order->payment_method }}</td>
                        <td class="text-center">{{ $order->order_date }}</td>
                        <td class="text-center">{{ number_format($order->total) }}đ</td>
                        <td class="text-center"><span class="badge bg-success">{{ $order->status }}</span></td>
                        <td class="text-center">{{ $order->order_note }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-info btn-sm btn__show-order--detail" data-bs-toggle="modal"
                               data-bs-target="#orderModal{{ $order->id }}">Chi tiết</a>
                            <a href="#" class="btn btn-danger btn-sm">Hủy</a>

                            <!-- Modal -->
                            <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1"
                                 aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content"
                                         style="height:600px; width:900px; display:block; margin:auto; overflow: auto">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chi tiết đơn hàng</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Order Details -->
                                            <div class="row mb-3 text-start">
                                                <div class="col-md-6 d-flex justify-content-between pe-3">
                                                    <strong>Tên khách hàng:</strong> <span
                                                        id="customer_name">{{ $order->customer_name }}</span>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-between pe-3">
                                                    <strong>Số điện thoại:</strong> <span
                                                        id="customer_phone">{{ $order->customer_phone }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-3 text-start">
                                                <div class="col-md-6 d-flex justify-content-between pe-3">
                                                    <strong>Trạng thái:</strong> <span
                                                        id="order_status">{{ $order->status }}</span>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-between pe-3">
                                                    <strong>Tổng tiền:</strong> <span id="order_total">{{ number_format($order->total) }}đ</span>
                                                </div>
                                            </div>
                                            <div class="row mb-3 text-start">
                                                <div class="col-md-6 d-flex justify-content-between pe-3">
                                                    <strong>Phương thức thanh toán:</strong> <span
                                                        id="payment_method">{{ $order->payment_method }}</span>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-between pe-3">
                                                    <strong>Ngày đặt hàng:</strong> <span
                                                        id="order_date">{{ $order->order_date }}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-3 text-start">
                                                <div class="col-md-12">
                                                    <strong>Địa chỉ khách hàng:</strong> <span
                                                        id="customer_address">{{ $order->customer_address }}</span>
                                                </div>
                                            </div>
                                            <div class="row text-start">
                                                <div class="col-md-12">
                                                    <strong>Ghi chú đơn hàng:</strong>
                                                    <p id="order_note">{{ $order->order_note }}</p>
                                                </div>
                                            </div>
                                            <!-- Order Products Details -->
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <h5>Danh Sách Sản Phẩm</h5>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th>Tên Sản Phẩm</th>
                                                            <th>Ảnh</th>
                                                            <th>Giá</th>
                                                            <th>Số Lượng</th>
                                                            <th>Tổng Tiền</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="order_products">
                                                        {{--Danh sách sản phẩm trong đơn hàng--}}
                                                        @foreach($order->orderDetails as $orderDetail)
                                                            <tr>
                                                                <td class="text-center">
                                                                    <div class="text-truncate"
                                                                         style="max-width: 200px;">{{ $orderDetail->product->product_name }}</div>
                                                                </td>
                                                                <td class="text-center">
                                                                    @php
                                                                        $main_image = $orderDetail->product->productImage->firstWhere('image_type', 'main');
                                                                    @endphp
                                                                    @if($main_image)
                                                                        <img src="{{ asset($main_image->image_url) }}"
                                                                             alt="Main Image"
                                                                             style="max-width: 100px; max-height: 100px;">
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">{{ number_format($orderDetail->price) }}
                                                                    ₫
                                                                </td>
                                                                <td class="text-center">{{ $orderDetail->quantity }}</td>
                                                                <td class="text-center">{{ number_format($orderDetail->quantity * $orderDetail->price) }}
                                                                    đ
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('custom-script')
    <script>
        $(document).ready(function () {
            $('#myOrderTable').DataTable();
        })


    </script>
@endpush

