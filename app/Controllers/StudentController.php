<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Student;


class StudentController extends Controller {
    private $limit = 3;

    public function index($page = 1) {
        $page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $totalPage = $this->getTotalPage(); //tổng số trang
        $students = $this->getAllStudents($page);

        $this->view('students/index', ['students' => $students, 'totalPage' => $totalPage, 'page' => $page]);
    }

    public function create() {
        $this->view('students/create');
    }

    public function store() {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $age  = isset($_POST['age']) ? $_POST['age'] : '';
    
        $name = $this->validateInput($name);
        $age  = $this->validateInput($age);
    
        // Kiểm tra tên không rỗng
        if (empty($name)) {
            echo "<script>alert('Tên không được để trống.');</script>";
            echo "<script>window.location.href='" . BASE_PATH. "student/create';</script>";

            return;
        }
    
        // Kiểm tra tuổi không rỗng và phải là số nguyên dương
        if (empty($age)) {
            echo "<script>alert('Tuổi không được để trống.');</script>";
            echo "<script>window.location.href='" . BASE_PATH . "student/create';</script>";

            return;
        } elseif (!filter_var($age, FILTER_VALIDATE_INT) || $age <= 0) {
            echo "<script>alert('Tuổi phải là số nguyên dương.');</script>";
            echo "<script>window.location.href='" . BASE_PATH . "student/create';</script>";

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
                    echo "<script>alert('Lỗi khi tải ảnh lên.');</script>";
                    echo "<script>window.location.href='" . BASE_PATH . "student/create';</script>";

                    return;
                }
            } else {
                echo "<script>alert('Định dạng ảnh không hợp lệ.');</script>";
                echo "<script>window.location.href='" . BASE_PATH . "student/create';</script>";

                return;
            }
        }
        
        $_SESSION['flash_message'] = [
            'message' => 'Thêm sinh viên thành công!',
            'type' => 'success'
        ];
    
       
        Student::create([
            'name' => $name,
            'age' => $age,
            'photo' => $photo,
        ]);
    
        header('Location: ' . BASE_PATH . 'student/index');
    }

    public function show($studentId =null){

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['studentId'])) {
            $studentId = $_GET['studentId'];
            $student = Student::find($studentId);
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
        $student = Student::find($id);

        $this->view('students/edit', ['student' => $student]);

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
            echo "<script>alert('Tên không được để trống.');</script>";
            echo "<script>window.location.href='" . BASE_PATH . "student/edit/$id';</script>";

            return;
        }
    
        // Kiểm tra tuổi không rỗng và phải là số nguyên dương
        if (empty($age)) {
            echo "<script>alert('Tuổi không được để trống.');</script>";
            echo "<script>window.location.href='" . BASE_PATH . "student/edit/$id';</script>";

            return;
        } elseif (!filter_var($age, FILTER_VALIDATE_INT) || $age <= 0) {
            echo "<script>alert('Tuổi phải là số nguyên dương.');</script>";
            echo "<script>window.location.href='" . BASE_PATH . "student/edit/$id';</script>";

            return;
        }
    
        // Lấy thông tin sinh viên hiện tại
        $student = Student::find($id); 
    
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
                    echo "<script>alert('Lỗi khi tải ảnh lên.');</script>";
                    echo "<script>window.location.href='" . BASE_PATH . "student/edit/$id';</script>";

                    return;
                }
            } else {
                echo "<script>alert('Định dạng ảnh không hợp lệ.');</script>";
                echo "<script>window.location.href='" . BASE_PATH . "student/edit/$id';</script>";

                return;
            }
        }

        $_SESSION['flash_message'] = [
            'message' => 'Sửa thông tin sinh viên thành công!',
            'type' => 'success'
        ];

        if ($photo) {
            Student::where('id', $id)->update([
                'name' => $name,
                'age' => $age,
                'photo' => $photo,
            ]);
        } else {
            Student::where('id', $id)->update([
                'name' => $name,
                'age' => $age,
            ]);
        }
    
        header('Location: ' . BASE_PATH . 'student/index');
    }
    
    public function delete($id) {
        Student::destroy($id);

        $_SESSION['flash_message'] = [
            'message' => 'Xóa sinh viên thành công!',
            'type' => 'success'
        ];

        header('Location: '. BASE_PATH .'student/index');
    }


    public function getTotalPage() {
        $totalRecords = Student::count(); 
        $totalPage = ceil($totalRecords / $this->limit); // Tính tổng số trang

        return $totalPage;
    }


    public function getAllStudents($page) {
        $offSet = ($page - 1) * $this->limit; // Vị trí bắt đầu của dữ liệu trên mỗi trang
        
        $students = Student::skip($offSet)->take($this->limit)->get();
    
        return $students;
    }

}