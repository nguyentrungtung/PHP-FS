<?php

namespace Core;

class Controller {
    protected $model;
    
    public function view($view, $data = []) {
        // Lưu đường dẫn tới file view
        $viewPath = '../'. __Path_Views . $view . '.php';

        // Kiểm tra nếu file view tồn tại
        if (file_exists($viewPath)) {
            // Bắt nội dung của view
            ob_start();
            require_once $viewPath;
            $content = ob_get_clean();

            // Gọi layout chính, chèn nội dung vào layout
            require_once '../'.__Path_Views.'/layouts/dashboard.php';
        } else {
            die("View $view không tồn tại.");
        }
    }

    public function loadModel($name)
    {
        $fullModel = __MODEL_NAMESPACE . $name;
    
        if (class_exists($fullModel)) {
            $this->model = new $fullModel;
        } else {
            //("Model $fullModel không được tìm thấy.");
            return ;
        }
    }
    
}
