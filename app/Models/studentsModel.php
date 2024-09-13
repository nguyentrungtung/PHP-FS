<?php
    namespace App\Models;
    use Illuminate\Database\Eloquent\Model;
    // 
    // dung model trong Eloquent ORM 
    class studentsModel extends Model{
        protected $table ="students";
        protected $fillable=['id','first_name','last_name','date_of_birth','phone_number','address','gpa'];
        // chuyen tu object ve array
        public function fetch($data){
            // var_dump($data);
            if($data){
                if($this->numRow($data)!==0){
                    foreach($data as $row){
                        $rows[]=$row;
                    }
                }else{
                    $rows=[];
                }
            }else{
                $rows=[];
            }
            // var_dump($rows[0]);
            return $rows;
        }
        // 
        public function numRow($data){
            if($data){
                return count($data);
            }
            return 0;
        }
        // gan du lieu cho object 
        public function write($student){
            $student->first_name=isset($_POST['first_name'])?$_POST['first_name']:'';
            $student->last_name=isset($_POST['last_name'])?$_POST['last_name']:'';
            $student->date_of_birth=isset($_POST['date_of_birth'])?$_POST['date_of_birth']:'';
            $student->phone_number=isset($_POST['phone_number'])?$_POST['phone_number']:'';
            $student->address=isset($_POST['address'])?$_POST['address']:'';
            $student->gpa=isset($_POST['gpa'])?$_POST['gpa']:'';
            $student->save();
        }
    }