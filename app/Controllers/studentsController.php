<?php
    namespace App\controllers;
    use App\Core\Controller;
    use App\Core\pagination;
    use App\Core\error;
    // 
    // dung voi studnetModel duoc ke thua tu model Eloquent ORM 
    class studentsController extends Controller{
        private $table="students";
        // khai bao rules de khiem tra du lieu khi khoi tao hoac update du lieu
        private $rules=[
            'student_id'=>'',
            'first_name'=>'required|min:2|max:50',
            'last_name'=>'required|min:2|max:50',
            'date_of_birth'=>'required|date',
            'phone_number'=>'required|digits_between:10,15',
            'address'=>'required',
            'gpa'=>'required|numeric|between:0,4',
        ];
        public function __construct() {
            parent::__construct();
            $this->loadModel($this->table);
            
        }
        // 
        public function index($page){
            $result=$this->model->all();
            // 
            $path=__Path_Views.$this->table."/home/index.php";
            $total=count($result);
            $config=array(
                'limit'=>5,#gioi han du lieu moi trang
                'current_page'=>$page,
                'total_records'=>$total,
                'link_full'=>"index.php?cat=_students&view=index&page="
            );
            // 
            $pagination=new Pagination;
            $pagination->init($config);
            $start=$pagination->getStart();
            $data=array_slice($this->model->fetch($result),$start,$config['limit']);
            require_once ($path);
            $pagination->getPagination();
        }
        // 
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
        // // lay view detail data
        public function detail($id){
            if(isset($id)){
                $path=__Path_Views.$this->table."/detail/index.php";
                $data=$this->model->find($id);
                $check=false;
                require_once ($path);
            }else{
                $this->error->print("Missing parameter id!");
            } 
        }
        // lay view change data
        public function change($id){
            $path=__Path_Views.$this->table."/detail/index.php";
            $data=$this->model->find($id);  
            // thay doi trang thai the in put cho phep thay doi du lieu
            $check=true;
            require_once ($path);
        }
        // 
        public function search($param){
                echo '<script>
                    const searchValue =document.getElementById("search");
                    searchValue.value="'.$param.'";
                </script>';
            $data=$this->model->where('id', $param)
                ->orWhere('first_name', 'LIKE', "%{$param}%")
                ->orWhere('date_of_birth', $param)
                ->get();
                // print_r($data);
                if(isset($data)){
                    $path=__Path_Views.$this->table."/home/index.php";
                    require_once ($path);
                    return ;
                }
                echo "Not Found";
                
            
        }
        // 
        public function update($id){
            $this->rules['student_id']='';
            if($this->error->checkValidator($_POST,$this->rules)){
                $student=$this->model->find($id);
                $this->model->write($student);
                header("Location: index.php?cat=".$this->table."&view=detail&id=".$id);
            }
        }
        // 
        public function delete($id){
            $this->model->find($id)->delete();
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
                    window.location.replace("http://localhost:8080/ommani/learn/phrases1/index.php?cat=students&view=index&page='.$page.'");
                </script>';
        }
        // 
        public function add(){
            $this->rules['student_id']='required|integer';
            // 
            if($this->error->checkValidator($_POST,$this->rules)){
               if(!$this->model->find($_POST['student_id'])){
                    $student=new $this->model;
                    $student->id=$_POST['student_id'];
                    $this->model->write($student);
                    echo '<script>
                        alert("Add succefully!");
                        window.location.replace("http://localhost:8080/ommani/learn/phrases1/index.php?cat=students&view=search&id='.$_POST["student_id"].'");
                    </script>';
                }else{
                    echo '<script>
                        alert("Add failures, This id is allready exist!");
                        window.history.back();
                    </script>';
                }   
            }
        }
        
    }