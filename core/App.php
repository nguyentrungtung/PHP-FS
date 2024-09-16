<?php

namespace Core;

class App {
    protected $controller = '';
    protected $method = 'index';
    protected $params = [];
    protected $uri;

    public function __construct() {
        $url = $this->parseUrl();
        $controllerName = ucfirst($url[0]) . 'Controller';
        $fullController = __CONTROLLER_NAMESPACE . $controllerName;

        // Kiểm tra nếu class controller tồn tại (autoload sẽ tự động tìm file controller)
        if (class_exists($fullController)) {
            $this->controller = $fullController;
        }

        if (class_exists($fullController)) {
            // Tạo đối tượng controller từ tên class
            $this->controller = new $fullController;
            
            // Kiểm tra phương thức LoadModel có tồn tại trong đối tượng controller không
            if (method_exists($this->controller, 'loadModel')) {
                $this->controller->LoadModel(ucfirst($url[0]));
            }
        }

        // Method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
        } 

        // Parameters
        $this->params = array_slice($url, 2);

        // echo "<pre>"; 
        // echo $this->uri;
        // print_r($url);
        // echo "</pre>";

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        // $this->uri = $_SERVER['REQUEST_URI'];
        $this->uri = $_GET['url'];

        return explode('/', $this->uri);   
    }
}
