<div class="card">
    <div class="card-header">
        <h4 class="card-title">Sửa thông tin sinh viên</h4>
    </div>
    <div class="card-body">

        <form action="/build_fw/public/student/update/<?php echo $data['student']->id; ?>" enctype="multipart/form-data"
            method="POST">
            <div class="mb-3">
                <label class="form-label">Sửa tên học sinh</label>
                <input type="text" class="form-control" name="name" value="<?php echo $data['student']->name; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Sửa tuổi học sinh</label>
                <input type="number" class="form-control" name="age" value="<?php echo $data['student']->age; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh hiện tại</label>
                <?php if (!empty($data['student']->photo)): ?>
                <div>
                    <img src="/build_fw/public/<?php echo $data['student']->photo;?>" alt="Ảnh sinh viên"
                        style="max-width: 300px; max-height: 300px;">
                </div>
                <?php else: ?>
                <p>Chưa có ảnh</p>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="photo">Ảnh:</label>
                <input type="file" class="form-control" id="photo" name="photo">
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>