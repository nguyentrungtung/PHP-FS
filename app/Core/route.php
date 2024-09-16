<?php 
    namespace App\Core;
    // 
    use App\Controllers\viewController;
    use App\Core\error;
    class Route{
        public function __construct() {
            $this->viewController=new ViewController();
            // lay ra ten trang duoc truy cap
            if(isset($_REQUEST['cat'])){
                $name=$_REQUEST['cat'];
            }else{
                // neu khong co tham so cat se gan mac dinh truy cap vao students
                $name="students";
            }
            // lay ra tham so view de goi den man hinh tuong ung
            if(isset($_REQUEST['view'])){
                $method=$_REQUEST['view'];
                if($method==='index'){
                    // neu truy cap vao index se can them tham so page de hien thi sao tung trang
                    if(isset($_REQUEST['page'])){
                        $param=$_REQUEST['page'];
                    }else{
                        // gan bang 1 neu khong co tham so page
                        $param=1;
                    }
                }
                elseif(isset($_REQUEST['param'])){
                    $param=$_REQUEST['param'];
                }
                // doi voi cac phuong thuc khac tham so dau vao la id neu khong co se gan la null va khong co tham so dau vao
                else{
                    if(isset($_REQUEST['id'])){
                        $param=$_REQUEST['id'];
                    }else{
                        $param=null;
                    }
                }
            }else{
                // neu khong co tham so view se gan mac dinh truy cap vao index
                $method="index";
                $param=1;
            }
            $this->viewController->render($name,$method,$param);
        }
        // 
        // public function __construct() {
        //     $uri =str_replace(__Base_Uri,"",$_SERVER['REQUEST_URI']);
        //     $uri=explode("/",$uri);
        //     $this->viewController=new ViewController();
        //     $params=[];
        //     if($uri[0]!==""){
        //         $controller=$uri[0];
        //     }else{
        //         $controller="students";
        //     }
        //     if(isset($uri[1])){
        //         $method=$uri[1];
        //     }else{
        //         $method="index";
        //     }
        //     if(isset($uri[2])){
        //         $params=$uri[2];
        //     }
        //     if(!empty($params)){
        //         $this->viewController->render($controller,$method,$params);
        //     }else{
        //         $this->viewController->render($controller,$method);
        //     }
            
        // }
        // 
    }