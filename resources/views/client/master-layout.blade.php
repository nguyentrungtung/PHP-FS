<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link
            rel="icon"
            href="https://i.pinimg.com/originals/b2/57/81/b2578191becd55a7ebbc3aa9cfda9a7a.jpg"
            type="image/x-icon"
        />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7H1PzBlIH4a8uRxV2H0vGnlB3Tt4c3aG3D" crossorigin="anonymous"></script>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Own carousel  -->
        <link rel="stylesheet" href="{{ url('libs') }}/owlcarousel/assets/owl.carousel.min.css" />
        <link rel="stylesheet" href="{{ url('libs') }}/owlcarousel/assets/owl.theme.default.min.css" />

        <link rel="stylesheet" href="{{ url('client') }}/css/layout.css">
        <link rel="stylesheet" href="{{ url('client') }}/css/global.css">
        <!-- Font-awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        @yield('link')
        <title>@yield('title')</title>
    </head>
    <body>
        <header class="header">
            @include('client.components.layout.header')
        </header>

        <main class="main-content container">
            @yield('content')
        </main>
        <footer class="footer">
            @include('client.components.layout.footer')
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Link Jquery -->
        <script src="{{ url('libs') }}/jquery/jquery-3.7.0.min.js"></script>
        <!-- own carousel  -->
        <script src="{{ url('libs') }}/owlcarousel/owl.carousel.min.js"></script>
        <!-- Các file JavaScript dùng chung -->
        <script type="module" src="{{ url('client') }}/js/layout.js"></script>
        <!-- Các file JavaScript dùng riêng -->
        @yield('scripts')
        {{--  Custom file js--}}
        @stack('custom-script')
    </body>
</html>
