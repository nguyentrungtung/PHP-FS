<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Student;


class StudentController extends Controller {
    private $site_path; 
    private $student;

    public function __construct() {
        global $site_path; 
        $this->site_path = $site_path;
        $this->student = new Student(); 

    }
    
    public function index($page = 1) {
        $page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        
        $studentModel = $this->student;
        $totalPage = $studentModel->getTotalPage(); //tổng số trang
        $students = $studentModel->getAllStudents($page);

        $this->view('students/index', ['students' => $students, 'site_path' => $this->site_path, 'totalPage' => $totalPage, 'page' => $page]);
    }

    public function create() {
        $this->view('students/create', ['site_path' => $this->site_path]);
    }

    public function store() {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $age  = isset($_POST['age']) ? $_POST['age'] : '';
    
        $name = $this->validateInput($name);
        $age  = $this->validateInput($age);
    
        // Kiểm tra tên không rỗng
        if (empty($name)) {
            // echo "<script>alert('Tên không được để trống.');</script>";
            // echo "<script>window.location.href='" . $this->site_path . "student/create';</script>";

            return;
        }
    
        // Kiểm tra tuổi không rỗng và phải là số nguyên dương
        if (empty($age)) {
            // echo "<script>alert('Tuổi không được để trống.');</script>";
            // echo "<script>window.location.href='" . $this->site_path . "student/create';</script>";

            return;
        } elseif (!filter_var($age, FILTER_VALIDATE_INT) || $age <= 0) {
            // echo "<script>alert('Tuổi phải là số nguyên dương.');</script>";
            // echo "<script>window.location.href='" . $this->site_path . "student/create';</script>";

            return;
        }

        // Xử lý ảnh
        $photo = '';
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            // Lấy đường dẫn tạm thời của tệp
            $fileTmpPath = $_FILES['photo']['tmp_name'];
            // Xác định tên tệp mới 
            $fileName = $_FILES['photo']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Xác định loại ảnh hợp lệ
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileExtension, $allowedExtensions)) {
                // Xác định thư mục lưu trữ
                $uploadFileDir = 'uploads/';
                // thư mục lưu trữ cố định
                $dest_path = $uploadFileDir . uniqid() . '.' . $fileExtension;

                // Di chuyển tệp từ thư mục tạm thời đến thư mục lưu trữ
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $photo = $dest_path;
                    
                } else {
                    // echo "<script>alert('Lỗi khi tải ảnh lên.');</script>";
                    // echo "<script>window.location.href='" . $this->site_path . "student/create';</script>";

                    return;
                }
            } else {
                // echo "<script>alert('Định dạng ảnh không hợp lệ.');</script>";
                // echo "<script>window.location.href='" . $this->site_path . "student/create';</script>";

                return;
            }
        }
        
        $_SESSION['flash_message'] = [
            'message' => 'Thêm sinh viên thành công!',
            'type' => 'success'
        ];
    
        $studentModel = $this->student;
        $studentModel->create($name, $age, $photo);
    
        header('Location: ' . $this->site_path . 'student/index');
    }

    public function show($studentId =null){

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['studentId'])) {
            $studentId = $_GET['studentId'];
            $studentModel = $this->student;
            $student = $studentModel->getById($studentId);
            // echo "<pre>"; 
            // print_r($student);
            // echo "</pre>";
            echo json_encode([
                'status' => 'success',
                'studentId' => $studentId,
                'student' => $student
            ]);
        }
    }
    
    public function edit($id) {
        $studentModel = $this->student;
        $student = $studentModel->getById($id);

        $this->view('students/edit', ['student' => $student, 'site_path' => $this->site_path]);

    }

    public function update($id) {
        // Lấy dữ liệu từ biểu mẫu
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $age = isset($_POST['age']) ? $_POST['age'] : '';
    
        // Xác thực dữ liệu đầu vào
        $name = $this->validateInput($name);
        $age = $this->validateInput($age);
    
        // Kiểm tra tên không rỗng
        if (empty($name)) {
            // echo "<script>alert('Tên không được để trống.');</script>";
            // echo "<script>window.location.href='" . $this->site_path . "student/edit/$id';</script>";

            return;
        }
    
        // Kiểm tra tuổi không rỗng và phải là số nguyên dương
        if (empty($age)) {
            // echo "<script>alert('Tuổi không được để trống.');</script>";
            // echo "<script>window.location.href='" . $this->site_path . "student/edit/$id';</script>";

            return;
        } elseif (!filter_var($age, FILTER_VALIDATE_INT) || $age <= 0) {
            // echo "<script>alert('Tuổi phải là số nguyên dương.');</script>";
            // echo "<script>window.location.href='" . $this->site_path . "student/edit/$id';</script>";

            return;
        }
    
        // Lấy thông tin sinh viên hiện tại
        $studentModel = $this->student;
        $student = $studentModel->getById($id); // Giả sử có hàm tìm sinh viên theo ID
    
        // Xử lý ảnh nếu có
        $photo = $student->photo; // Giữ lại ảnh cũ
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            // Lấy đường dẫn tạm thời của tệp
            $fileTmpPath = $_FILES['photo']['tmp_name'];
    
            // Xác định tên tệp mới 
            $fileName = $_FILES['photo']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
    
            // Xác định loại ảnh hợp lệ
            $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
            if (in_array($fileExtension, $allowedExtensions)) {
                // Xác định thư mục lưu trữ
                $uploadFileDir = 'uploads/';
                $dest_path = $uploadFileDir . uniqid() . '.' . $fileExtension;
    
                // Di chuyển tệp từ thư mục tạm thời đến thư mục lưu trữ
                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    // Nếu ảnh mới được tải lên thành công, xóa ảnh cũ nếu có
                    if ($photo && file_exists($photo)) {
                        unlink($photo); // Xóa file cũ
                    }
                    // Cập nhật đường dẫn của ảnh mới
                    $photo = $dest_path;
                } else {
                    // echo "<script>alert('Lỗi khi tải ảnh lên.');</script>";
                    // echo "<script>window.location.href='" . $this->site_path . "student/edit/$id';</script>";

                    return;
                }
            } else {
                // echo "<script>alert('Định dạng ảnh không hợp lệ.');</script>";
                // echo "<script>window.location.href='" . $this->site_path . "student/edit/$id';</script>";

                return;
            }
        }

        $_SESSION['flash_message'] = [
            'message' => 'Sửa thông tin sinh viên thành công!',
            'type' => 'success'
        ];
    
        // Cập nhật thông tin sinh viên
        if ($photo) {
            $studentModel->update($id, $name, $age, $photo);
        } else {
            $studentModel->update($id, $name, $age);
        }
    
        header('Location: ' . $this->site_path . 'student/index');
    }
    
    public function delete($id) {
        $studentModel = $this->student;
        $studentModel->delete($id);

        $_SESSION['flash_message'] = [
            'message' => 'Xóa sinh viên thành công!',
            'type' => 'success'
        ];

        header('Location: '.$this->site_path.'student/index');
    }
}