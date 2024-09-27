<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('dashboard') }}/assets/img/apple-icon.png">
    <link rel="icon"
          href="https://play-lh.googleusercontent.com/29JpANiXA74CO46WxNM3DWN1XU92NhRPe0ET1D_ogFbgO6YSQjQKpuA48-IicZOVdw"
          type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>
        Dashboard winmart
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>

    <!-- Nucleo Icons -->
    <link href="{{ url('dashboard') }}/assets/css/nucleo-icons.css" rel="stylesheet"/>
    <link href="{{ url('dashboard') }}/assets/css/nucleo-svg.css" rel="stylesheet"/>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ url('dashboard') }}/assets/css/nucleo-svg.css" rel="stylesheet"/>

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('dashboard') }}/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet"/>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- Add Select2 -->
    <link rel="stylesheet" href="{{ url('libs') }}/select2/css/select2.min.css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"/>
    <!-- Add datatable -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ url('admin') }}/css/global.css">
</head>

<body class="g-sidenav-show   bg-gray-100">
<div class="min-height-300 position-absolute w-100"
     style="background-image: linear-gradient(to right, #DECBA4, #3E5151);"></div>
{{-- sidebar --}}
@include('admin.components.sidebar')

{{-- main --}}
<main class="main-content position-relative border-radius-lg ">
    <!-- navbar -->
    @include('admin.components.navbar')

    <div class="container py-4">
        @include('admin.components.alert')

        {{-- content --}}
        @yield('content')

        {{-- footer --}}
        @include('admin.components.footer')
    </div>
</main>

<!--   Core JS Files   -->
<script src="{{ url('dashboard') }}/assets/js/core/popper.min.js"></script>
<script src="{{ url('dashboard') }}/assets/js/core/bootstrap.min.js"></script>
<script src="{{ url('dashboard') }}/assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ url('dashboard') }}/assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="{{ url('dashboard') }}/assets/js/plugins/chartjs.min.js"></script>
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Mobile apps",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#fbfbfb',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#ccc',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ url('dashboard') }}/assets/js/argon-dashboard.min.js?v=2.0.4"></script>

<!-- Add Select2 -->
<script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>

<!-- Add datatable -->
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

{{-- add tinymce như ckeditor --}}
<script src="{{ asset('tinymce/tinymce.min.js') }}"></script>

{{--  Custom file js--}}
@stack('custom-script')
</body>

</html>
