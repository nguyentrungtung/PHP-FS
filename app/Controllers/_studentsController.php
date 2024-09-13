<?php
    namespace App\controllers;
    use App\Core\Controller;
    use App\Core\pagination;
    use App\Core\error;
    // 
    // dung voi studentModel duoc ke thua tu model nam trong core;
    class _studentsController extends Controller{
        private $table="students";
        public function __construct() {
            parent::__construct();
            $this->loadModel("_students");
        }
        // 
        public function index($page){
            // 
            if($this->model->getAll()===true){
                $path=__Path_Views.$this->table."/home/index.php";
                $total=$this->model->fetch();
                $count=count($total); 
                // 
                // echo $count;
                $config=array(
                    'limit'=>5,#gioi han du lieu moi trang
                    'current_page'=>$page,
                    'total_records'=>$count,
                    'link_full'=>"index.php?cat=".$this->table."&view=index&page="
                );
                // tao phan trang
                $pagination= new Pagination();
                $pagination->init($config);
                // 
                $start=$pagination->getStart();
                // lay du lieu hien thi theo phan trang
                $this->model->getLimit($start,$config['limit']);
                $data=$this->model->data2;
                require_once ($path);
                // goi ui phan trang
                $pagination->getPagination();
            }else{
                $this->error->print("Failed to load Data!");
            }
        }
        // lay view detail data
        public function detail($id){
            $path=__Path_Views.$this->table."/detail/index.php";
            $this->model->getOne($id);
            $data=$this->model->data[0];
            $check=false;
            require_once ($path);
        }
        // lay view change data
        public function change($id){
            $path=__Path_Views.$this->table."/detail/index.php";
            $this->model->getOne($id);
            $data=$this->model->data[0];
            // thay doi trang thai the in put cho phep thay doi du lieu
            $check=true;
            require_once ($path);
        }
        // goi view create 
        public function create($id=''){
            $path=__Path_Views.$this->table."/create/index.php";
            require_once ($path);
            if($id!==''){
                echo '<script>
                    document.getElementById("student-id").value="'.$id.'";
                </script>';
            }
        }
        // goi ham tao ban ghi moi
        public function add(){
            if($this->model->create()){
                echo '<script>
                    alert("Add succefully!");
                    window.location.replace("http://localhost:8080/ommani/learn/phrases1/index.php?cat=_students&view=search&id='.$_POST["student_id"].'");
                </script>';
            };
        }
        // 
        public function update($id){
            $this->model->update($id);
            echo '<script>
                    alert("Update succefully!");
                    window.location.replace("http://localhost:8080/ommani/learn/phrases1/index.php?cat=_students&view=detail&id='.$id.'");
                </script>';
        }
        // 
        public function delete($id){
            $this->model->delete($id);
            // 
            if(isset($_SERVER['HTTP_REFERER'])){
                $previous_url =$_SERVER['HTTP_REFERER'];
                parse_str($previous_url,$query);
                if(isset($query['page'])){
                    $page=$query['page'];
                }else{
                    $page=1;
                }
            }
            else{
                $page=1;
            }
            echo '<script>
                    alert("Delete succefully!");
                    window.location.replace("http://localhost:8080/ommani/learn/phrases1/index.php?cat=_students&view=index&page='.$page.'");
                </script>';
        }
        // 
        public function search($param){
            if($this->model->search($param)===true){
                $this->model->fetch();
                $data=$this->model->data;
                $path=__Path_Views.$this->table."/home/index.php";
                require_once ($path);
            }else{
                echo "Not Found";
            }
            echo '<script>
                    const searchValue =document.getElementById("search");
                    searchValue.value="'.$param.'";
                </script>';
        }
        
    }