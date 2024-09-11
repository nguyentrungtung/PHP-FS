<?php

namespace Core;

class Controller {
   
    public function view($view, $data = []) {
        // Đường dẫn tới view cụ thể
        $content = '../app/Views/' . $view . '.php';
    
        // Khởi tạo bộ đệm đầu ra
        // ob_start();
    
        // Nạp layout chính (dashboard.php), nhưng chưa xuất ra màn hình ngay
        require_once '../app/Views/layouts/dashboard.php';
    
        // Lấy nội dung của layout đã nạp và lưu vào biến $screen
        // $screen = ob_get_clean();
    
        // Xuất nội dung cuối cùng
        // echo $screen;
    }
    

    // Hàm để kiểm tra dữ liệu đầu vào
    function validateInput($data) {
        $data = trim($data); // Xóa khoảng trắng đầu và cuối chuỗi
        $data = stripslashes($data); // Xóa các dấu gạch chéo
        $data = htmlspecialchars($data); // Chuyển đổi ký tự đặc biệt thành HTML entities
        return $data;
    }

}
