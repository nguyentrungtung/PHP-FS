<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Student;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Translation\Translator;
use Illuminate\Translation\FileLoader;
use Illuminate\Filesystem\Filesystem;

class StudentController extends Controller {
    private $limit = 5;

    private $validator;

    public function __construct() {
        $loader             = new FileLoader(new Filesystem(), '../../Config/lang/vi/validation.php');   //FileLoader sẽ tìm và nạp các file ngôn ngữ cho dịch vụ Validation
        $translator         = new Translator($loader, 'en');                                //Translator sử dụng FileLoader để cung cấp thông tin ngôn ngữ cho các quy tắc xác thực.
        $this->validator    = new ValidatorFactory($translator);                       //Factory là dịch vụ chính của Validation để tạo và quản lý các đối tượng Validator
    }

    public function index($page = 1) {
        $page       = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $totalPage  = $this->getTotalPage(); //tổng số trang
        $students   = $this->getAllStudents($page);

        $this->view('students/index', ['students' => $students, 'totalPage' => $totalPage, 'page' => $page]);
    }

    public function create() {
        $this->view('students/create');
    }

    public function store() {
        $name       = isset($_POST['name']) ? $_POST['name'] : '';
        $age        = isset($_POST['age']) ? $_POST['age'] : '';
        $photo      = isset($_POST['photo']) ? $_POST['photo'] : 'null';
    
        $rules = [
            'name'   => 'required|min:3|max:50',
            'age'    => 'required|integer|min:18|max:30',
            'photo'  => 'required'
        ];
        
        $data = [
            'name'   => $name,
            'age'    => $age,
            'photo'  => $_FILES['photo'] ?? null,
        ];
        
        // Thông báo lỗi tùy chỉnh
        $messages = [
            'required'  => ':attribute không được để trống.',
            'integer'   => ':attribute phải là một số nguyên.',
            'min'       => ':attribute phải có ít nhất :min ký tự.',
            // 'mimes'     => ':attribute phải có định dạng jpg, png hoặc gif.',
            
            // Thông báo tuỳ chỉnh riêng cho từng trường và rule
            'name.min'  => 'Tên phải có ít nhất :min ký tự.',
            'name.max'  => 'Tên không được vượt quá :max ký tự.',
            'age.min'   => 'Tuổi phải ít nhất là :min.',
            'age.max'   => 'Tuổi không được vượt quá :max.',
            'photo.required' => 'Ảnh đại diện không được để trống'
            // 'photo.mimes' => 'Ảnh đại diện phải có định dạng jpg, png, hoặc gif.',
        ];
        
        // Custom attribute: Thay thế tên trường
        $customAttributes = [
            'name'      => 'Tên sinh viên',
            'age'       => 'Tuổi sinh viên',
            'photo'     => 'Ảnh đại diện',
        ];
        
        $validator = $this->validator->make($data, $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            $errors     = $validator->errors();
            $_SESSION['validation_errors']  = $errors->all();
            echo "<script>window.location.href='" . BASE_PATH . "student/create';</script>";
            return;
        } 
        

        // Xử lý ảnh
        $photo = '';
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            // Lấy đường dẫn tạm thời của tệp
            $fileTmpPath    = $_FILES['photo']['tmp_name'];
            // Xác định tên tệp mới 
            $fileName       = $_FILES['photo']['name'];
            $fileNameCmps   = explode(".", $fileName);
            $fileExtension  = strtolower(end($fileNameCmps));

            // Xác định thư mục lưu trữ
            $uploadFileDir  = 'uploads/';
            // thư mục lưu trữ cố định
            $dest_path      = $uploadFileDir . uniqid() . '.' . $fileExtension;

            // Di chuyển tệp từ thư mục tạm thời đến thư mục lưu trữ
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $photo      = $dest_path;
                
            } else {
                echo "<script>alert('Lỗi khi tải ảnh lên.');</script>";
                echo "<script>window.location.href='" . BASE_PATH . "student/create';</script>";

                return;
            }
          
        }
        
        $_SESSION['flash_message'] = [
            'message'   => 'Thêm sinh viên thành công!',
            'type'      => 'success'
        ];
       
        Student::create([
            'name'      => $name,
            'age'       => $age,
            'photo'     => $photo,
        ]);
    
        header('Location: ' . BASE_PATH . 'student/index');
    }

    public function show($studentId =null){

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['studentId'])) {
            $studentId  = $_GET['studentId'];
            $student    = Student::find($studentId);
            // echo "<pre>"; 
            // print_r($student);
            // echo "</pre>";
            echo json_encode([
                'status'    => 'success',
                'studentId' => $studentId,
                'student'   => $student
            ]);
        }
    }
    
    public function edit($id) {
        $student = Student::find($id);

        $this->view('students/edit', ['student' => $student]);

    }

    public function update($id) {
        // Lấy dữ liệu từ biểu mẫu
        $name   = isset($_POST['name']) ? $_POST['name'] : '';
        $age    = isset($_POST['age']) ? $_POST['age'] : '';
    
        // Lấy thông tin sinh viên hiện tại
        $student = Student::find($id); 
    
        // Xử lý ảnh nếu có
        $photo = $student->photo; // Giữ lại ảnh cũ
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {

            // Lấy đường dẫn tạm thời của tệp
            $fileTmpPath    = $_FILES['photo']['tmp_name'];

            // Xác định tên tệp mới 
            $fileName       = $_FILES['photo']['name'];
            $fileNameCmps   = explode(".", $fileName);
            $fileExtension  = strtolower(end($fileNameCmps));
    

            // Xác định thư mục lưu trữ
            $uploadFileDir  = 'uploads/';
            $dest_path      = $uploadFileDir . uniqid() . '.' . $fileExtension;

            // Di chuyển tệp từ thư mục tạm thời đến thư mục lưu trữ
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Nếu ảnh mới được tải lên thành công, xóa ảnh cũ nếu có
                if ($photo && file_exists($photo)) {
                    unlink($photo); // Xóa file cũ
                }
                // Cập nhật đường dẫn của ảnh mới
                $photo  = $dest_path;
            } else {
                echo "<script>alert('Lỗi khi tải ảnh lên.');</script>";
                echo "<script>window.location.href='" . BASE_PATH . "student/edit/$id';</script>";

                return;
            }
        }

        $_SESSION['flash_message'] = [
            'message'   => 'Sửa thông tin sinh viên thành công!',
            'type'      => 'success'
        ];

        if ($photo) {
            Student::where('id', $id)->update([
                'name'  => $name,
                'age'   => $age,
                'photo' => $photo,
            ]);
        } else {
            Student::where('id', $id)->update([
                'name'  => $name,
                'age'   => $age,
            ]);
        }
    
        header('Location: ' . BASE_PATH . 'student/index');
    }
    
    public function delete($id) {
        Student::destroy($id);

        $_SESSION['flash_message'] = [
            'message'   => 'Xóa sinh viên thành công!',
            'type'      => 'success'
        ];

        header('Location: '. BASE_PATH .'student/index');
    }


    public function getTotalPage() {
        $totalRecords   = Student::count(); 
        $totalPage      = ceil($totalRecords / $this->limit); // Tính tổng số trang

        return $totalPage;
    }


    public function getAllStudents($page) {
        $offSet     = ($page - 1) * $this->limit; // Vị trí bắt đầu của dữ liệu trên mỗi trang
        
        $students   = Student::skip($offSet)->take($this->limit)->get();
    
        return $students;
    }

}