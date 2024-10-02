{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <title>Thank You - Payment Successful</title>--}}
{{--    <style>--}}
{{--        .thank-you-page {--}}
{{--            text-align: center;--}}
{{--            padding: 50px;--}}
{{--            background-color: #f8f9fa;--}}
{{--        }--}}
{{--        .thank-you-icon {--}}
{{--            font-size: 80px;--}}
{{--            color: #28a745;--}}
{{--        }--}}
{{--        .thank-you-message {--}}
{{--            font-size: 24px;--}}
{{--            margin-top: 20px;--}}
{{--        }--}}
{{--        .order-details {--}}
{{--            margin-top: 30px;--}}
{{--            font-size: 18px;--}}
{{--        }--}}
{{--        .back-to-home {--}}
{{--            margin-top: 40px;--}}
{{--        }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}

@extends('client.master-layout') <!-- Kế thừa layout chính -->

@section('title', 'Chi tiết giỏ hàng')

@section('link')
        <style>
            .thank-you-page {
                text-align: center;
                padding: 50px;
                background-color: #f8f9fa;
            }
            .thank-you-icon {
                font-size: 80px;
                color: #28a745;
            }
            .thank-you-message {
                font-size: 24px;
                margin-top: 20px;
            }
            .order-details {
                margin-top: 30px;
                font-size: 18px;
            }
            .back-to-home {
                margin-top: 40px;
            }
        </style>
@endsection

@section('content')

<div class="container thank-you-page">
    <div class="thank-you-icon">
        <i class="bi bi-check-circle-fill"></i>
    </div>
    <div class="thank-you-message">
        Cảm ơn bạn! Thanh toán của bạn đã thành công.
    </div>
    <div class="order-details">
        Mã đơn hàng của bạn là: <strong>#{{ $id . rand(1000, 9999) }}</strong><br>
        Bạn sẽ nhận được email xác nhận trong giây lát.
    </div>
    <div class="back-to-home">
        <a href="{{ route('web.home') }}" class="btn btn-primary">Trở về trang chủ</a>
    </div>
</div>
@endsection


{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>--}}
{{--</body>--}}
{{--</html>--}}
