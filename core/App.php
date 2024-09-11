<?php

namespace Core;

class App {
    protected $controller = 'StudentController';
    protected $method = 'index';
    protected $params = [];
    protected $uri;

    public function __construct() {
        $url = $this->parseUrl();
        // echo dirname(__DIR__);

        // Controller
        if (file_exists('../app/Controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $this->controller = $controllerName;
        }   

        $this->controller = "App\\Controllers\\" . $this->controller;
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
