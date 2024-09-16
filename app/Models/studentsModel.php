<?php 
    namespace App\Models;
    use App\Core\coreModel;
    use App\Core\error;
    
    // dung model trong core;

    class studentsModel extends coreModel{
        protected $table ="students";
        protected $fillable=['id','first_name','last_name','date_of_birth','phone_number','address','gpa'];
        // lay tat ca cac ban ghi cua bang
        public function getAll(){
            // lay cau truy van
            $query=$this->getQuery();
            // lay cac ban ghi
            $this->select($query);
            if($this->numRow()>0){
                return true;
            }else{
                return false;
            }
        }
        // 
        public function search($param){
            // tham so truyen vao ham select theo thu tu:
            // dieu kien giua cac where
            // toan tu so sanh
            // key va value
            $where=[
                [
                    'connect'=>'',
                    'key'=>'id',
                    'operator'=>'=',
                    'value'=>$param
                ],
                [
                    'connect'=>'OR',
                    'key'=>'date_of_birth',
                    'operator'=>'=',
                    'value'=>$param
                ],
                [
                    'connect'=>'OR',
                    'key'=>'first_name',
                    'operator'=>'LIKE',
                    'value'=>$param
                ],
                [
                    'connect'=>'OR',
                    'key'=>'last_name',
                    'operator'=>'LIKE',
                    'value'=>$param
                ]
            ];
            // lay cau truy van voi khoi dieu kien where
            $query=$this->getQuery($where);
            $this->select($query);
            if($this->numRow()===0){
                return false;
            }
            return true;
        }
        // viet cac thay doi cua doi tuong
        public function write($student){
            $student->first_name=isset($_POST['first_name'])?$_POST['first_name']:'';
            $student->last_name=isset($_POST['last_name'])?$_POST['last_name']:'';
            $student->date_of_birth=isset($_POST['date_of_birth'])?$_POST['date_of_birth']:'';
            $student->phone_number=isset($_POST['phone_number'])?$_POST['phone_number']:'';
            $student->address=isset($_POST['address'])?$_POST['address']:'';
            $student->gpa=isset($_POST['gpa'])?$_POST['gpa']:'';
            $student->save();
        }
        // cap nhap du lieu
        public function updateData($id){
            $student=$this->getOne($id);
            $this->write($student);
        }
        // tao du lieu
        public function create(){
            $student=new $this;
            $student->id=isset($_POST['student_id'])?$_POST['student_id']:'';
            $this->write($student);
            return $student;
        }
        // 
        public function deleteData($id){
            $query=$this->getQuery([['key'=>"id",'value'=>$id,'operator'=>'=']]);
            $this->deleteWhere($query);
            $this->select($query);
            if($this->numRow()>0){
                return false;
            }
            return true;
        }
        // 
    }