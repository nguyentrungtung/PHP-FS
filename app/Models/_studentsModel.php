<?php 
    namespace App\Models;
    use App\Core\Model;
    use App\Core\error;
    
    // dung model trong core;

    class _studentsModel extends Model{
        protected $table="students";
        public function __construct() {
            parent::__construct();
        }
        // lay tat ca cac ban ghi cua bang
        public function getAll(){
            $this->select($this->table);
            if($this->numRow()===0){
                return false;
            }
            return true;
        }
        
        // 
        public function update($id){
            $data = array(
                'first_name'=>$_POST['first_name'],
                'last_name'=>$_POST['last_name'],
                'date_of_birth'=>$_POST['date_of_birth'],
                'phone_number'=>$_POST['phone_number'],
                'address'=>$_POST['address'],
                'gpa'=>$_POST['gpa']
            );
            $result=$this->updateData($this->table,$data,array('id'=>$id));
        }
        // 
        public function delete($id){
            $this->deleteData($this->table,array('id'=>$id));
        }   
        // 
        public function create(){
            // kiem tra id da ton tai hay chua truoc khi khoi tao du lieu moi
            if($this->checkExists($_POST['student_id'])){
                // neu da ton tai se hien thong bao va quay lai form tao
                echo "<script>alert('Student ID already exists!');
                     window.history.back();</script>";
                return false;
            }
            // neu chua ton tai se tao moi du lieu moi
            $data=array(
                'id'=>$_POST['student_id'],
                'first_name'=>"'".$_POST['first_name']."'",
                'last_name'=>"'".$_POST['last_name']."'",
                'date_of_birth'=>"'".$_POST['date_of_birth']."'",
                'phone_number'=>"'".$_POST['phone_number']."'",
                'gpa'=>$_POST['gpa'],
                'address'=>"'".$_POST['address']."'"
            );
            $this->insert($this->table,$data);
            return true;
        }
        // 
        protected function checkExists($id){
            $this->select($this->table,array('='=>['id'=>$id]));
            if($this->numRow()===0){
                return false;
            }
            return true;
        }
        //
        public function getOne($id){
            $this->select($this->table,array('='=>['id'=>$id]));
            if($this->numRow()===0){
                return false;
            }
            $this->fetch();
            return true;
        }
        public function search($param){
            $where=$where = array(
                '=' => [
                    'id'=> $param,
                    'date_of_birth'=> $param
                ],
                'LIKE' => [
                    'first_name'=> $param,
                    'last_name'=> $param
                ]
            );
            // print_r($where);
            $this->select($this->table,$where,"OR");
            if($this->numRow()===0){
                return false;
            }
            return true;
        }

    }