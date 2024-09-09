<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tạo mới thông tin sinh viên</h4>
    </div>
    <div class="card-body">

        <form action="/build_fw/public/student/store" enctype="multipart/form-data" method="POST">
            <!-- @csrf -->
            <div class="mb-3">
                <!-- <label  class="form-label">Tên học sinh</label>
                <input type="text" class="form-control"  name="name" aria-describedby="Nhập tên sinh viên"> -->
                <label class="form-label">Tên học sinh</label>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên sinh viên">
            </div>

            <div class="mb-3">
                <label class="form-label">Tuổi</label>
                <input type="text" class="form-control" name="age" placeholder="Nhập tuổi sinh viên">
            </div>

            <div class="mb-3">
                <label for="photo">Ảnh:</label>
                <input type="file" class="form-control" id="photo" name="photo">
            </div>

            <button type="submit" class="btn btn-primary save-tags">Gửi</button>
        </form>
    </div>
</div>