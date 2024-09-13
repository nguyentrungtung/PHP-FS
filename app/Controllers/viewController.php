<?php
    namespace App\Controllers;
    use App\Core\Controller;
    Class viewController extends Controller{
        public function __construct() {
            parent::__construct();
        }
        // 
        public function render($name,$method,$param=''){
            $path=__Path_Controllers.$name."Controller.php";
            // echo $name;
            if(!file_exists($path)){
                $this->error->print("This controller does not exist!!");
                return;    
            }
            $controllerName=__Controller_Space.$name."Controller";
            $controller = new $controllerName;
            if(!method_exists($controller,$method)){
                $this->error->print("This method does not exist!!");
                return;
            }
            require_once(__Path_Layout.'head.php');
            call_user_func([$controller,$method],$param);
            require_once(__Path_Layout.'footer.php');
        }
        // public function render($link,$method="",$params=[]){
        //     // 
        //     $this->loadModel('students');
        //     $data=[];
        //     if(method_exists($this->model,$method)){
        //         if(!empty($params)){
        //             $data=call_user_func_array([$this->model, $method],[$params]);
        //         }else{
        //             $data=call_user_func([$this->model, $method]);
        //         }
        //     }
        //     if($method==="getAll"){
        //         $pages=$this->model->pages;
        //     }
        //     // 
        //     require_once(__Path_Layout.'head.php');
        //     require_once($link);
        //     require_once(__Path_Layout.'footer.php');
        // }
    }