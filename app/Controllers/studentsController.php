<?php
    namespace App\controllers;
    use App\Core\Controller;
    use App\Core\error;
    // 
    // dung voi studentModel duoc ke thua tu model nam trong core;
    class studentsController extends Controller{
        private $table="students";
        public function __construct() {
            parent::__construct();
            $this->loadModel($this->table);
        }
        // 
        public function index($page){
            // 
            if($this->model->getAll()===true){
                $path=__Path_Views.$this->table."/home/index.php";
                $count=$this->model->numRow();
                // echo $count;
                $config=array(
                    'limit'=>5,#gioi han du lieu moi trang
                    'current_page'=>$page,
                    'total_records'=>$count,
                    'link_full'=>"index.php?cat=".$this->table."&view=index&page="
                );
                // tao phan trang
                $this->pagi->init($config);
                // 
                $start=$this->pagi->getStart();
                // lay du lieu hien thi theo phan trang
                $this->model->getLimit($start,$config['limit']);
                $data=$this->model->data;
                require_once ($path);
                // goi ui phan trang
                $this->pagi->getPagination();
            }else{
                $this->error->print("Failed to load Data!");
            }
        }
        // lay view detail data
        public function detail($id){
            $path=__Path_Views.$this->table."/detail/index.php";
            $data=$this->model->getOne($id);
            $check=false;
            require_once ($path);
        }
        // lay view change data
        public function change($id){
            $path=__Path_Views.$this->table."/detail/index.php";
            $data=$data=$this->model->getOne($id);
            $check=true;
            require_once ($path);
        }
        // goi view create 
        public function create($id=''){
            $path=__Path_Views.$this->table."/create/index.php";
            $name=$this->table;
            require_once ($path);
            if($id!==''){
                echo '<script>
                    document.getElementById("student-id").value="'.$id.'";
                </script>';
            }
        }
        // goi ham tao ban ghi moi
        public function add(){
            $student=$this->model->create();
            echo '<script>
                    alert("Add succefully!");
                    window.location.replace("http://localhost:8080/ommani/learn/phrases1/index.php?cat=students&view=search&param='.$student->id.'&page=1");
                </script>';
        }
        // 
        public function update($id){
            $this->model->updateData($id);
            // echo 'alert("Update succefully!");';
            echo '<script>
                    alert("Update succefully!");
                    window.location.replace("http://localhost:8080/ommani/learn/phrases1/index.php?cat=students&view=detail&id='.$id.'");
                </script>';
        }
        // 
        public function delete($id){
            if(!$this->model->deleteData($id)){
                echo '<script>
                    alert("Delete fally!");
                    window.history.back();
                </script>';
                return; 
            }
            // 
            $view='index';
            $page=1;
            if(isset($_SERVER['HTTP_REFERER'])){
                $previous_url =$_SERVER['HTTP_REFERER'];
                parse_str($previous_url,$query);
                if(isset($query['page'])){
                    if(isset($query['view'])){
                        $view=$query['view'];
                    }
                    $page=$query['page'];
                }
                if(isset($query['param'])){
                    $param=$query['param'];
                }
            }
            echo '<script>
                    alert("Delete succefully!");
                    window.location.replace("http://localhost:8080/ommani/learn/phrases1/index.php?cat=students&view='.$view.'&'.(isset($param)?"param=$param":"").'&page='.$page.'");
                </script>';
        }
        // 
        public function search($param){
            echo '<script>
                    const searchValue =document.getElementById("search");
                    searchValue.value="'.$param.'";
                </script>';
            if($this->model->search($param)===true){
                $page=isset($_REQUEST['page'])?$_REQUEST['page']:1;
                $count=$this->model->numRow();
                $config=array(
                    'limit'=>5,#gioi han du lieu moi trang
                    'current_page'=>$page,
                    'total_records'=>$count,
                    'link_full'=>"index.php?cat=".$this->table."&view=search&param=$param&page="
                );
                $this->pagi->init($config);
                $start=$this->pagi->getStart();
                $this->model->getLimit($start,$config['limit']);
                $data=$this->model->data;
                $path=__Path_Views.$this->table."/home/index.php";
                require_once ($path);
                $this->pagi->getPagination();
            }else{
                echo "Not Found";
            }
        }
        
    }