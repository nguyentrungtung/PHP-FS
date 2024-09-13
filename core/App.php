<?php

namespace Core;

class App {
    protected $controller = 'StudentController';
    protected $method = 'index';
    protected $params = [];
    protected $uri;

    public function __construct() {
        $url = $this->parseUrl();
        $controllerName = ucfirst($url[0]) . 'Controller';
        $fullController = "App\\Controllers\\" . $controllerName;

        // Kiểm tra nếu class controller tồn tại (autoload sẽ tự động tìm file controller)
        if (class_exists($fullController)) {
            $this->controller = $fullController;
        }

        $this->controller = new $this->controller;

        // Method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
        } else {
            // Đặt method mặc định nếu không tìm thấy
            $this->method = 'index';
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
