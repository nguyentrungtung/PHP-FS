<?php

namespace Core;

class Controller {
    public function view($view, $data = []) {
        $content = '../app/Views/' . $view . '.php';
        // ob_start();
        require_once '../app/Views/layouts/dashboard.php';
        // $screen = ob_get_clean();
    }

    // Hàm để kiểm tra dữ liệu đầu vào
    function validateInput($data) {
        $data = trim($data); // Xóa khoảng trắng đầu và cuối chuỗi
        $data = stripslashes($data); // Xóa các dấu gạch chéo
        $data = htmlspecialchars($data); // Chuyển đổi ký tự đặc biệt thành HTML entities
        return $data;
    }

}
