<?php

namespace App\Controllers;

use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Translation\Translator;
use Illuminate\Translation\FileLoader;
use Illuminate\Filesystem\Filesystem;
use Core\Controller;
use App\Models\Student;
use App\Utils\Paginator;
use App\Utils\FileUpload;

class StudentController extends Controller {

    private $validator;
    private $fileUploadService;

    public function __construct() {
        $loader                     = new FileLoader(new Filesystem(), '');
        $translator                 = new Translator($loader, 'en');
        $this->validator            = new ValidatorFactory($translator);
        $this->fileUploadService    = new FileUpload();
    }

    public function index($page = 1) {
        // Xác định trang hiện tại
        $page               = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        $totalStudents      = Student::count();
        $paginator          = new Paginator($totalStudents, $page, LIMIT);

        $offset             = $paginator->getOffset();
        $limit              = $paginator->getLimit();
        $students           = Student::skip($offset)->take($limit)->get();
        $paginationLinks    = $paginator->renderPaginationLinks('student/index');

        $this->view('students/index', [
            'students'          => $students,
            'paginationLinks'   => $paginationLinks,
            'page'              => $page
        ]);
    }


    public function create() {
        $this->view('students/create');
    }

    public function store() {
        $name       = isset($_POST['name']) ? $_POST['name'] : '';
        $age        = isset($_POST['age']) ? $_POST['age'] : '';
        $photo      = $_FILES['photo'] ?? null;
        
        $rules = [
            'name'   => 'required|min:3|max:50',
            'age'    => 'required|integer|min:18|max:30',
            'photo'  => 'required'
        ];
        
        $data = [
            'name'   => $name,
            'age'    => $age,
            'photo'  => $photo,
        ];
        
        // Thông báo lỗi tùy chỉnh
        $messages = [
            'required'  => ':attribute không được để trống.',
            'integer'   => ':attribute phải là một số nguyên.',
            'min'       => ':attribute phải có ít nhất :min ký tự.',
            
            // Thông báo tuỳ chỉnh riêng cho từng trường và rule
            'name.min'  => 'Tên phải có ít nhất :min ký tự.',
            'name.max'  => 'Tên không được vượt quá :max ký tự.',
            'age.min'   => 'Tuổi phải ít nhất là :min.',
            'age.max'   => 'Tuổi không được vượt quá :max.',
            'photo.required' => 'Ảnh đại diện không được để trống'
        ];
        
        // Custom attribute: Thay thế tên trường
        $customAttributes = [
            'name'      => 'Tên sinh viên',
            'age'       => 'Tuổi sinh viên',
            'photo'     => 'Ảnh đại diện',
        ];
        
        $validator = $this->validator->make($data, $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            $errors                         = $validator->errors();
            $_SESSION['validation_errors']  = $errors->all();
            echo "<script>window.location.href='" . BASE_PATH . "student/create';</script>";
            return;
        }

        // Xử lý ảnh
        $uploadedPhoto = $this->fileUploadService->upload($photo);
        
        $_SESSION['flash_message'] = [
            'message'   => 'Thêm sinh viên thành công!',
            'type'      => 'success'
        ];
       
        Student::create([
            'name'      => $name,
            'age'       => $age,
            'photo'     => $uploadedPhoto,
        ]);
    
        header('Location: ' . BASE_PATH . 'student/index');
    }

    public function show($studentId =null){

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['studentId'])) {
            $studentId  = $_GET['studentId'];
            $student    = Student::find($studentId);

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
        $name   = isset($_POST['name']) ? $_POST['name'] : '';
        $age    = isset($_POST['age']) ? $_POST['age'] : '';
    
        $student = Student::find($id); 
        $photo = $student->photo; // Giữ lại ảnh cũ

        // Xử lý ảnh
        $uploadedPhoto = $this->fileUploadService->upload($_FILES['photo'], $student->photo);

        $_SESSION['flash_message'] = [
            'message'   => 'Sửa thông tin sinh viên thành công!',
            'type'      => 'success'
        ];

        $student->name = $name;
        $student->age = $age;
        if ($photo) {
            $student->photo = $uploadedPhoto;
        }
        $student->save();
  
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

}