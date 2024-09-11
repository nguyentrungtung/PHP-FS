<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tạo mới thông tin sinh viên</h4>
    </div>
    <div class="card-body">

        <!-- <form action="<?php echo BASE_PATH; ?>student/store" enctype="multipart/form-data" method="POST"> -->
        <!-- @csrf -->
        <form id="studentForm" action="<?php echo BASE_PATH; ?>student/store" enctype="multipart/form-data" method="POST"
            onsubmit="return validateForm()">
            <div class="mb-3">
                <!-- <label  class="form-label">Tên học sinh</label>
                <input type="text" class="form-control"  name="name" aria-describedby="Nhập tên sinh viên"> -->
                <label class="form-label">Tên học sinh</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sinh viên">
                <small id="nameError" style="color: red;"></small>
            </div>

            <div class="mb-3">
                <label class="form-label">Tuổi</label>
                <input type="text" class="form-control" name="age" id="age" placeholder="Nhập tuổi sinh viên">
                <small id="ageError" style="color: red;"></small>
            </div>

            <div class="mb-3">
                <label for="photo">Ảnh:</label>
                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                <small id="photoError" style="color: red;"></small>
            </div>

            <button type="submit" class="btn btn-primary btn-save">Gửi</button>
        </form>
    </div>
</div>