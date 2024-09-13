<?php 
    namespace App\Core;
    use App\Core\Pagination;
    use App\Core\sysError;
    require_once('app/config/validator.php');
    // 
    class Controller{
        public function __construct() {
            $this->error=new sysError;
        }
        // 
        public function loadModel($modelName){

            $path=__Path_Model.$modelName.'Model.php';
            // kiem tra xem model duoc goi toi co ton tai hay khong
            // neu co thi tao mot object moi cua model do
            if(file_exists($path)){
                $name=__Model_Space.$modelName.'Model';
                // khoi tao mot object moi cua model
                $this->model= new $name;
            }else{
                $this->error->print("This Model does not exist!");
            }
        }
    }