<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../public/mixi/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../public/mixi/assets/img/favicon.png">
  <title>build framework</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../../public/mixi/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../../public/mixi/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="../../public/mixi/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../../public/mixi/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- main.css -->
  <link id="pagestyle" href="../../public/assets/main.css" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100" style="background-color: #dacfdd !important"></div>
  <aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header" style="display: flex; align-items: center; justify-content: center;">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <img style="width:50px !important; height: 50px !important; object-fit: contain; border-radius: 100%;  "
        src="https://www.pngitem.com/pimgs/m/243-2439806_iron-man-png-iron-man-face-vector-png.png" alt="">

      <a class="navbar-brand m-0" href="http://localhost/build_fw/public/student/index"
        style="margin-left: -2rem !important;">
        <span class="ms-1 font-weight-bold">I'm NaM</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link_ nav-link active" href="/build_fw/public/home/index">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link_ nav-link" href="/build_fw/public/student/index">
            <div
              class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sinh viên</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
      data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center" style="opacity: 0;">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Sign In</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="content" style="padding:20px 40px;">
      <?php require_once($content); ?>
    </div>
    
  </main>
  <!-- --Toast Messeage -->
  <div id="toast"></div>

  <!-- ------------------------------------------------------------------------------------------------------ -->
  <!-- jquery -->
  <script src="../../public/libs/jquery/jquery-3.7.0.min.js"></script>

  <script src="../../public/mixi/assets/js/core/popper.min.js"></script>
  <script src="../../public/mixi/assets/js/core/bootstrap.min.js"></script>
  <script src="../../public/mixi/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../public/mixi/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../../public/mixi/assets/js/plugins/chartjs.min.js"></script>

  <script>
    const sidebarItems = document.querySelectorAll('.nav-link_');
    sidebarItems.forEach(item => {
      item.addEventListener('click', function () {
        sidebarItems.forEach(i => i.classList.remove('active'));
        console.log(this);
        this.classList.add('active');
        // this.classList.toggle('active');
      });
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
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="../../public/mixi/assets/js/argon-dashboard.min.js?v=2.0.4"></script>

  <script>
    function validateForm(isEdit = false) {
      let valid = true;
      // Lấy giá trị của các trường
      let name = document.getElementById('name').value;
      let age = document.getElementById('age').value;
      let photo = document.getElementById('photo').value;

      // Xóa thông báo lỗi trước đó
      document.getElementById('nameError').textContent = '';
      document.getElementById('ageError').textContent = '';
      document.getElementById('photoError').textContent = '';

      if (name.trim() === '') {
        document.getElementById('nameError').textContent = 'Tên học sinh không được để trống.';
        valid = false;
      }

      if (age.trim() === '') {
        document.getElementById('ageError').textContent = 'Tuổi không được để trống.';
        valid = false;
      } else if (!/^\d+$/.test(age) || age <= 0) {
        document.getElementById('ageError').textContent = 'Tuổi phải là số nguyên dương.';
        valid = false;
      }

      // Kiểm tra trường ảnh (chỉ bắt buộc ở form create)
      if (!isEdit && photo.trim() === '') {
        document.getElementById('photoError').textContent = 'Vui lòng chọn ảnh.';
        valid = false;
      } else if (photo.trim() !== '' && !(/\.(jpg|jpeg|png|gif)$/i).test(photo)) {
        document.getElementById('photoError').textContent = 'Chỉ chấp nhận định dạng ảnh jpg, jpeg, png, gif.';
        valid = false;
      }

      return valid;
    }

    //hide status CRUD
    setTimeout(function () {
      var flashMessage = document.getElementById('flash-message');
      if (flashMessage) {
        flashMessage.style.display = 'none';
      }
    }, 1000);

    // $(document).on('click', '.modal_detail-student', function (e) {
    //   alert('Please enter');
    //   $('.modal-edit').addClass('show');
    // });

    // $(document).on('click', '.close-edit', function (event) {
    //   $('.modal-edit').removeClass('show');
    // });

  </script>
  <script src="../../public/assets/main.js"></script>
</body>

</html>