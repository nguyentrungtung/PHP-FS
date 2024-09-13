<div class="card">
    <div class="card-header">
        <a href="<?php echo BASE_PATH; ?>student/create"
            style="display: inline-block; color: red; font-size:18px; font-style: italic; margin-bottom: 20px; text-decoration: none; border-radius: 5px; padding: 3px 4px; box-shadow: 1px 4px black; font-style: normal;"><i
                class="fa-solid fa-plus icon-add"></i> Tạo mới sinh viên
        </a>

        <?php if (isset($_SESSION['flash_message'])): ?>
        <div id="flash-message" style="width : 400px;"
            class="alert alert-<?= $_SESSION['flash_message']['type']; ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['flash_message']['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i
                    style="transform:translateY(-3px) ;" class="fa-solid fa-x"></i></button>
        </div>
        <?php unset($_SESSION['flash_message']); // Xóa thông báo sau khi hiển thị ?>
        <?php endif; ?>
    </div>
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead class="header-position" style="background-color: #cbd8d6 !important;">
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th class="text-center" style="width: 200px;">Tên sinh viên</th>
                    <th class="text-center" style="width: 200px;">Ảnh sinh viên</th>
                    <th class="text-center" style="width: 50px;">Tuổi</th>
                    <!-- <th class="text-center" colspan="2">Action</th> -->
                    <th class="text-center" style="width: 50px;">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['students'] as $key => $student): ?>
                <tr>
                    <td class="text-center" style="vertical-align: middle;"><?php echo $key +1?></td>
                    <td class="text-center" style="vertical-align: middle;">
                        <a href="<?php echo BASE_PATH; ?>student/show/<?php echo $student->id; ?>"
                            class="modal_detail-student" studentId="<?php echo $student->id; ?>"
                            style="cursor : pointer"><?php echo $student->name; ?></a></td>
                    <td class="text-center" style="vertical-align: middle;">
                        <img src="<?php echo BASE_PATH; ?><?php echo $student->photo;?>" alt="Ảnh sinh viên"
                            style="width: 180px ;height:150px; object-fit: cover; border-radius:20px;">
                    </td>
                    <td class="text-center" style="vertical-align: middle;"><?php echo $student->age; ?></td>
                    <td class="text-center" style="vertical-align: middle; width: 50px;">
                        <div class="dropdown">
                            <!-- <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            </button> -->
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"
                                style="padding: 2px 8px 2px 6px; background-color: white; color: black;">
                            </a>

                            <ul class="dropdown-menu">
                                <!-- href="<?php echo BASE_PATH; ?>student/edit/<?php echo $student->id; ?>" -->
                                <li><a class="dropdown-item text-center btn-modal_edit"
                                        href="<?php echo BASE_PATH; ?>student/edit/<?php echo $student->id; ?>">Edit</a>
                                </li>
                                <li><a class="dropdown-item text-center btn-modal_edit"
                                        href="<?php echo BASE_PATH; ?>student/delete/<?php echo $student->id; ?>"
                                        onclick="return confirm('Bạn có chắc muốn xóa?')">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card-footer" style="display:flex; justify-content: center;">
        <?php echo $data['paginationLinks'] ?>
    </div>

    <div class="modal-edit">
        <div class="content-toast-wrap">
            <div class="card edit-student">
                <!-- <div class="card-header" style ="display:flex; align-items: center;"> -->
                <div style="width:100%; display:flex; align-items: center;justify-content: space-between;">
                    <h5 class="card-title">Thông tin sinh viên</h5>
                    <p class="close-edit" style="cursor : pointer; font-size: 18px;"><i class="fa-solid fa-x"></i></p>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
</div>