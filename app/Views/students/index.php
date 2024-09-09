<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tạo mới thông tin sinh viên</h4>
    </div>
    <div class="card-body">
        <a href="/build_fw/public/student/create"
            style="display:block; color: red; font-size:18px;font-style: italic; margin-bottom: 20px;"><i
                class="fa-solid fa-plus icon-add"></i> Tạo mới sinh viên </a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Tên sinh viên</th>
                    <th class="text-center">Tuổi</th>
                    <th class="text-center">Ảnh sinh viên</th>
                    <th class="text-center" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['students'] as $key => $student): ?>
                <tr>
                    <td class="text-center vertical-align: middle;"><?php echo $key?></td>
                    <td class="text-center vertical-align: middle;"><?php echo $student->name; ?></td>
                    <td class="text-center vertical-align: middle;"><?php echo $student->age; ?></td>
                    <td class="text-center vertical-align: middle;">
                        <img src="/build_fw/public/<?php echo $student->photo;?>" alt="Ảnh sinh viên"
                            style="width: 200px ;height:300px; object-fit: cover; border-radius:20px;">
                    </td>
                    <td style="width:150px; text-align: center; color:red;">
                        <a href="/build_fw/public/student/edit/<?php echo $student->id; ?>" style="color: red;">Edit</a>
                    </td>
                    <td style="width:150px; text-align: center; color:red;">
                        <a href="/build_fw/public/student/delete/<?php echo $student->id; ?>" style="color: red;"
                            onclick="return confirm('Bạn có chắc muốn xóa?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card-footer" style= "display:flex; justify-content: center;">
        <nav aria-label="Page navigation">
            <ul class="pagination float-end">
                <?php if ($data['page'] != 1 || !isset($data['page'])) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= '/build_fw/public/student/index/' . $data['page'] - 1 ?>"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php endif; ?>
                
                <?php for ($i = 1; $i <= $data['lastPage']; $i++) : ?>
                <li class="page-item <?= $data['page'] == $i ? 'active' : '' ?>">
                    <!-- <a class="page-link" href="<?= '/build_fw/public/student/index/' . $i ?>"> <?= $i ?> </a> -->
                    <a class="page-link" href="/build_fw/public/student/index?page=<?php echo $i; ?>"><?php echo $i; ?></a>

                </li>
                <?php endfor; ?>
                
                <?php if ($data['page'] != $data['lastPage']) : ?>
                <li class="page-item">
                    <button type="button" class="page-link"
                        href="<?= '/build_fw/public/student/index/' . $data['page'] + 1 ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </button>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>
</div>