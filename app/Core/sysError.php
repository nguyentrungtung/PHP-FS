<?php
    namespace App\Core;
    require_once('app/config/validator.php');
    require_once ('resources/lang/en/validation.php');
    class sysError{
        public function __construct() {
            $this->validator = getValidator();
            $this->messages= getMessages();
        }
        // ham kiem tra gia tri voi data la du lieu dau vao va rules la dieu kien thoa man cua cac gia tri
        public function checkValidator($data,$rules){
            $validation=$this->validator->make($data,$rules,$this->messages);
            // kiem tra xem co gia tri nao khong thoa man hay khong
            if($validation->fails()){
                $errors=$validation->errors();
                // print_r($errors->all());
                foreach($errors->all() as $key=>$value){
                    echo $value."<br/>";
                }
                
                echo '<script>
                    setTimeout(()=>{
                        window.history.back();
                    },3000);
                </script>';
                return false;
            }
            return true;
        }
        // 
        public function print($mess){
            $path=__Path_Views."error/index.php";
            require_once($path);
        }
    }
?>