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
        <link rel="stylesheet" href="{{ url('client') }}/css/login.css">
        <link rel="stylesheet" href="{{ url('client') }}/css/global.css">
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
        <div class="login-page">
            <div class="login-page__container container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-12 col-md-12">
                        <div class="login-page__form-wrapper card">
                            <div class="card-body">
                                <div class="card-body__header">
                                    <div class="card-body__header-action">
                                        <a href="{{ url()->previous() }}" ><i class="fa-solid fa-arrow-left"></i></a>
                                        <img
                                            class="card-body__header-logo"
                                            src="https://mixivivu.com/_next/image?url=%2Fblack-logo.png&w=256&q=75"
                                            alt="logo"
                                        />
                                        <a href="{{route('web.home')}}" ><i class="fa-solid fa-house"></i></a>
                                    </div>
                                    <p class="login-page__title mb-4 text-center">Đăng nhập</p>
                                </div>
                                <form class="login-page__form" id="login-form" action="{{route('web.user.login')}}">
                                    @csrf
                                    <div class="form-group login-page__form-group mb-4">
                                        <label for="phone" class="login-page__label">Số điện thoại</label>
                                        <input
                                            type="text"
                                            class="form-control login-page__input"
                                            id="phone"
                                            name='customer_phone'
                                            placeholder="Nhập số điện thoại"
                                        />
                                        <span id="phone-error" class="error-message text-danger"></span>
                                    </div>
                                    <div class="form-group login-page__form-group">
                                        <label for="password" class="login-page__label">Mật khẩu</label>
                                        <input
                                            type="password"
                                            class="form-control login-page__input"
                                            id="password"
                                            name='password'
                                            placeholder="Nhập mật khẩu"
                                        />
                                        <span id="password-error" class="error-message text-danger"></span>
                                    </div>
                                    <div class="form-group login-page__form-group">
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                class="form-check-input login-page__checkbox"
                                                id="remember-me"
                                            />
                                            <label
                                                class="form-check-label login-page__checkbox-label"
                                                for="remember-me"
                                            >
                                                Ghi nhớ đăng nhập
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-danger btn-block login-page__submit-btn">
                                        Đăng nhập
                                    </button>
                                </form>
                                <div class="login-page__footer mt-3 text-center">
                                    <p class="login-page__text">
                                        Chưa có tài khoản? <a href="{{route('web.regit')}}" class="login-page__link">Đăng ký ngay</a>
                                    </p>
                                    <a href="#" class="login-page__forgot-password-link">Quên mật khẩu?</a>
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
        <script src="{{ url('client') }}/js/login.js"></script>
    </body>
</html>