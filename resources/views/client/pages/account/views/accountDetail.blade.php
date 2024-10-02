@extends('.client.pages.account.account')
@section('account.title','Information')
@section('link')
    <link rel="stylesheet" href="{{ asset('client/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/account.css') }}">
@endsection
@section('account.content')
@php
$user=Auth::user();
@endphp

<div class="d-flex flex-column account_detail">
<div class="d-flex account_detail_tabs">
    <div id="main-view-btn" class="detail_tabs_tab active">Thông tin tài khoản</div>
    <span class="move"></span>
</div>
<div class="account_detail_content">
    <div id="main-view" class="detail_content_view">
        <form class="row g-3" method="POST" action="{{route('web.account.update')}}">
            @csrf
            <div class="d-flex form-content">
                <label for="staticEmail" class="col-sm-2 col-form-label">Họ tên</label>
                <div class="col-sm-10">
                  <input name="customer_name" type="text" class="form-control content_input" id="staticEmail" value="{{$user->customer_name}}">
                </div>
            </div>
            <div class="d-flex form-content">
                <label for="staticEmail" class="col-sm-2 col-form-label">Số điện thoại</label>
                <div class="col-sm-10">
                  <input disabled name="customer_phone" type="text" class="form-control content_input"  value="{{$user->customer_phone}}">
                </div>
            </div>
            <div class="d-flex form-content">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input name="customer_email" type="text" class="form-control content_input" id="staticEmail" value="{{$user->customer_email}}">
                </div>
            </div>
            <div class="d-flex align-item-center justify-content-start form-content gender">
                <label for="staticEmail" class="col-sm-2 col-form-label">Giới tính</label>
                <div class="d-flex gender_radio">
                    <div class="gender_radio_value">
                        <input {{$user->customer_gender==='male'?'checked':''}} id="gender_men" type="radio" name="customer_gender" checked>
                        <label for="gender_men">Nam</label>
                    </div>
                    <div class="gender_radio_value">
                        <input id="gender_wumen" type="radio" name="customer_gender" >
                        <label {{$user->customer_gender==='female'?'checked':''}} for="gender_wumen">Nữ</label>
                    </div>
                </div>
            </div>
            <div class="d-flex form-content">
                <label for="staticEmail" class="col-sm-2 col-form-label">Ngày sinh</label>
                <div class="col-sm-10">
                  <input type="date" name="date_of_birth" class="form-control content_input" id="staticEmail" value="{{$user->date_of_birth}}">
                </div>
            </div>
            <div class="d-flex form-content">
                <label for="staticEmail" class="col-sm-2 col-form-label">Quốc gia</label>
                <div class="col-sm-10">
                    <select name="country" class="form-select content_input" disabled aria-label="Default select example">
                        <option selected>Việt Nam</option>
                      </select>
                </div>
            </div>
            <div class="d-flex form-content">
                <label for="staticEmail" class="col-sm-2 col-form-label">Tỉnh/ Thành phố</label>
                <div class="col-sm-10">
                    <select name='city' class="form-select content_input" aria-label="Default select example">
                        <option {{$user->city===''?'selected':''}}></option>
                        <option {{$user->city==='Hà Nội'?'selected':''}} value="Hà Nội">Hà Nội</option>
                        <option {{$user->city==='Bắc Ninh'?'selected':''}} value="Bắc Ninh">Bắc Ninh</option>
                        <option {{$user->city==='Thái Bình'?'selected':''}} value="3">Thái Bình</option>
                      </select>
                </div>
            </div>
            <div class="d-flex form-content">
                <label for="staticEmail" class="col-sm-2 col-form-label">Quận huyện</label>
                <div class="col-sm-10">
                    <select name="state" class="form-select content_input" aria-label="Default select example">
                        <option {{$user->state===''?'selected':''}}></option>
                        <option {{$user->state==='1'?'selected':''}} value="1">One</option>
                        <option {{$user->state==='2'?'selected':''}} value="2">Two</option>
                        <option {{$user->state==='3'?'selected':''}} value="3">Three</option>
                      </select>
                </div>
            </div>
            <div class="d-flex form-content">
                <label for="staticEmail" class="col-sm-2 col-form-label">Số nhà</label>
                <textarea type="text" name="customer_address" class="form-control content_input" id="staticAddress">{{$user->customer_address}}</textarea>
            </div>
            <button class="btn_account" type="submit">Cập nhập</button>
        </form>
    </div>
</div>
</div>
@endsection