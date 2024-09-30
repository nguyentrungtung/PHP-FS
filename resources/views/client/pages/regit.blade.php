<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            rel="icon"
            href="https://i.pinimg.com/originals/b2/57/81/b2578191becd55a7ebbc3aa9cfda9a7a.jpg"
            type="image/x-icon"
        />
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Own carousel  -->
        <link rel="stylesheet" href="{{ url('client') }}/libs/owlcarousel/assets/owl.carousel.min.css" />
        <link rel="stylesheet" href="{{ url('client') }}/libs/owlcarousel/assets/owl.theme.default.min.css" />
        <!-- External link css -->
        <link rel="stylesheet" href="{{ url('client') }}/css/global.css" />
        <link rel="stylesheet" href="{{ url('client') }}/css/regit.css" />
        <!-- Font-awesome -->
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
            integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
    </head>
    <body>
        <div class="register-page">
            <div class="register-page__container container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-12 col-md-12">
                        <div class="register-page__form-wrapper card">
                            <div class="card-body">
                                <div class="card-body__header-action">
                                    <a href="{{ url()->previous() }}"><i class="fa-solid fa-arrow-left"></i></a>
                                    <img
                                        class="card-body__header-logo"
                                        src="https://mixivivu.com/_next/image?url=%2Fblack-logo.png&w=256&q=75"
                                        alt="logo"
                                    />
                                    <a href="{{route('web.home')}}"><i class="fa-solid fa-house"></i></a>
                                </div>
                                <p class="register-page__title mb-4 text-center">Đăng ký tài khoản</p>
                                <form class="register-page__form" id="register-form" action="{{route('web.user.regit')}}">
                                    @csrf
                                    <div class="form-group register-page__form-group">
                                        <label for="name" class="register-page__label">Họ và Tên</label>
                                        <input
                                            type="text"
                                            class="form-control register-page__input"
                                            id="name"
                                            name="customer_name"
                                            placeholder="Nhập họ và tên"
                                        />
                                        <span id="name-error" class="error-message text-danger"></span>
                                    </div>
                                    <div class="form-group register-page__form-group">
                                        <label for="phone" class="register-page__label">Số điện thoại</label>
                                        <input
                                            type="text"
                                            class="form-control register-page__input"
                                            id="phone"
                                            name="customer_phone"
                                            placeholder="Nhập số điện thoại"
                                        />
                                        <span id="phone-error" class="error-message text-danger"></span>
                                    </div>
                                    <div class="form-group register-page__form-group">
                                        <label for="password" class="register-page__label">Mật khẩu</label>
                                        <input
                                            type="password"
                                            class="form-control register-page__input"
                                            id="password"
                                            name="password"
                                            placeholder="Nhập mật khẩu"
                                        />
                                        <span id="password-error" class="error-message text-danger"></span>
                                    </div>
                                    <div class="form-group register-page__form-group">
                                        <label for="date-of-birth" class="register-page__label">Ngày sinh</label>
                                        <input
                                            type="date"
                                            class="form-control register-page__input"
                                            id="date-of-birth"
                                            name="date_of_birth"
                                            placeholder="Chọn ngày sinh"
                                        />
                                        <span id="dob-error" class="error-message text-danger"></span>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-block register-page__submit-btn">
                                        Đăng ký
                                    </button>
                                </form>
                                <div class="register-page__footer mt-3 text-center">
                                    <p class="register-page__text">
                                        Đã có tài khoản? <a href="{{route('login')}}" class="register-page__link">Đăng nhập ngay</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS and dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Link Jquery -->
        <script src="{{ url('client') }}/libs/jquery/jquery-3.7.0.min.js"></script>
        <!-- JavaScript -->
        <script src="{{ url('client') }}/js/regit.js"></script>
    </body>
</html>