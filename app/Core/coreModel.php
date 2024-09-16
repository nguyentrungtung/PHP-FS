<?php
    namespace APP\Core;
    // 
    use Illuminate\Database\Eloquent\Model;
    //model moi 
    class coreModel extends Model{
        public $data=[];
        // ham get query voi where la tap hop cac dieu kien truy van theo cau truc
        /**
         * [
         *      [
         *          'connect'=>'AND',
         *          'key'=>'key',
         *          'value'=>'value',
         *          'operator'=>'=',
         *          'where'=>[]
         *      ]
         * ]
         * trong do:
         * connect: la dieu kien noi voi dieu kien where truoc do
         * connect la '' hoac 'AND' se di voi where() con 'OR' di voi orWhere()
         * key: thuoc tinh can truy van
         * value: gia tri cua thuoc tinh
         * operator: toan tu so sanh giua key va value
         * where:cac dieu kien di cung
         * ex:
         * [[connect=>'',key=>'id',value=>'1',operator=>'='],
         * [connect=>'OR',where=>[[
         * connect=>'',key='name',value='Danh',operator='like']
         * ,[connect=>'',key='age',value='22',operator='=']]]]
         * #
         * query se la:
         * $this->where('id','=',1)->orWhere(function($query)=>{
         * $query->where('name','like','Danh')->where('age','=',22);
         * })
         * cau truy van se lay ra ban ghi co id la 1 hoac name giong voi Danh va age la 22
         */
        public function getQuery($wheres=''){
            // tao moi truy van moi.
            $query=$this::query();
            // set xem co dieu kien hay khong
            if($wheres!==''){
                if(is_array($wheres)){
                    foreach($wheres as $where){
                        if(isset($where['where'])){
                            $query=$query->where(function($query)use ($where){
                                foreach($where['where'] as $w){
                                    if(!isset($w['connect'])||$w['connect']==''||$w['connect']=='AND'){
                                        $query=$query->where($w['key'], $w['operator'], $w['value']);
                                    }else{
                                        $query=$query->orWhere($w['key'], $w['operator'], $w['value']);
                                    }
                                }
                            });
                        }else{
                            if(!isset($where['connect'])||$where['connect']==''||$where['connect']=='AND'){
                                $query=$query->where($where['key'], $where['operator'], $where['value']);
                            }else{
                                $query=$query->orWhere($where['key'], $where['operator'], $where['value']);
                            }
                        }
                    }
                }
            } 
            return $query;
        }
        // thuc hien truy van
        public function select($query){
            $this->result=$query->get();
            $this->fetch();
        }
        // lay moi doi tuong
        public function getOne($id){
            return $this->find($id);
        }
        // chuyen tu object sang array
        public function fetch(){
            if($this->result){
                if($this->numRow()!==0){
                    foreach($this->result as $row){
                        $this->data[]=$row;
                    }
                }
            }
            return $this->data;
        }
        // lay ra so luong ket qua cua truy van
        public function numRow(){
            if($this->result){
                return count($this->result);
            }
            return 0;
        }
        // lay gioi han ket qua dua vao truy van truoc do
        public function getLimit($start,$limit){
            $data=$this->data;
            if($data){
                $this->data=array_slice($data,$start,$limit);
            }else{
                $this->fetch();
                $this->getLimit($start,$limit);
            }
        }
        //xoa voi dieu kien
        public function deleteWhere($query){
            $this->result=$query->delete();
        }
    }
    // model cu
    // class Model{
    //     private $host = __Host;
    //     private $user=__User;
    //     private $password=__Pass;
    //     private $dbname=__DB_Name;
    //     private $conn;
    //     public function __construct() {
    //         $this->conn =mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
    //         if($this->conn->connect_error) {
    //             die("Connection failed: ". $this->conn->connect_error);
    //         }
    //     }
    //     // ham dung de thuc hien truy van
    //      public function query($sql){
    //         $this->result=mysqli_query($this->conn,$sql);
    //      }
    //      // ham select ban ghi theo bang va dieu kien
    //      public function select($table,$where="",$check="AND"){
    //         if($where!==""){
    //             if(is_array($where)){
    //                 foreach($where as $operator=>$data){
    //                     foreach($data as $key=>$val){
    //                         if($operator==='LIKE'){
    //                             $wheres[]="$key $operator '%$val%'";
    //                         }else{
    //                            $wheres[]="$key $operator '$val'"; 
    //                         }
    //                     }
    //                 }
    //                 // print_r($where);
    //                 $where=implode(" $check ",$wheres);
    //             }
    //             $where=" WHERE $where";
    //         }
    //         // echo $where;
    //         $sql="SELECT * FROM $table $where";
    //         // echo $sql;
    //         $this->query($sql);
    //      }
        
    //     // ham ngat ket noi voi database
    //      public function disconnect($id){
    //         if($this->conn){
    //             mysqli_close($this->conn);
    //         }
    //      }
    //     // ham dem so ban ghi duoc tra ve
    //      public function numRow(){
    //         if($this->result){
    //             return mysqli_num_rows($this->result);
    //         }
    //         return 0;
    //      }
    //     //
    //     // chuyen cac ban ghi thanh mang
    //     public function fetch(){
    //         if($this->result){
    //             if($this->numRow()!==0){
    //                 while ($row = mysqli_fetch_array($this->result, MYSQLI_BOTH)) {
    //                     $this->data[]=$row;
    //                 }
    //             }else{
    //                 $this->data=[];
    //             }
    //         }else{
    //             $this->data=[];
    //         }
    //         return $this->data;
    //     }
    //     // 
    //     // lay cac ban ghi tu vi tri start toi vi tri ket thuc
    //     public function getLimit($start,$limit){
    //         // se lay ban ghi dua vao du lieu data da duoc luu lai truoc do qua phuong thuc getAll
    //        if($this->data){
    //          $this->data2=array_slice($this->data,$start,$limit);
    //        }else{
    //          $this->fetch();
    //          $this->getLimit($start,$limit);
    //        }
    //     }
    //     // ham khoi tao cau truy van de cap nhap du lieu
    //     public function updateData($table,$data="",$where=""){
    //         foreach($data as $key=>$value){
    //             $set[]="$key='$value'";
    //         }
    //         $set=implode(' , ',$set);
    //         // 
    //         foreach($where as $key=>$value){
    //             $wheres[]="$key='$value'";
    //         }
    //         $where=implode(' and ',$wheres);
    //         // 
    //         $sql="UPDATE $table SET $set WHERE $where";
    //         // echo $sql;
    //         $this->query($sql);
    //     }
    //     // ham khoi tao cau truy van de xoa ban ghi
    //     public function deleteData($table,$where=""){
    //         foreach($where as $key=>$value){
    //             $wheres[]="$key='$value'";
    //         }
    //         $where=implode(' and ',$wheres);
    //         $sql="DELETE FROM $table WHERE $where";
    //         // echo $sql;
    //         $this->query($sql);
    //     }
    //     // ham khoi tao cau truy van de them ban ghi
    //     public function insert($table,$data=""){
    //         $set=array_keys($data);
    //         $set=implode(' , ',$set);
    //         $value=array_values($data);
    //         $value=implode(' , ',$value);
    //         $sql="INSERT INTO $table ($set) VALUES ($value)";
    //         // echo $sql;
    //         $this->query($sql);
    //     }
    // }