<?php
    namespace APP\Core;
    class Model{
        private $host = __Host;
        private $user=__User;
        private $password=__Pass;
        private $dbname=__DB_Name;
        private $conn;
        public function __construct() {
            $this->conn =mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
            if($this->conn->connect_error) {
                die("Connection failed: ". $this->conn->connect_error);
            }
        }
        // ham dung de thuc hien truy van
         public function query($sql){
            $this->result=mysqli_query($this->conn,$sql);
         }
         // ham select ban ghi theo bang va dieu kien
         public function select($table,$where="",$check="AND"){
            if($where!==""){
                if(is_array($where)){
                    foreach($where as $comp=>$data){
                        foreach($data as $key=>$val){
                            if($comp==='LIKE'){
                                $wheres[]="$key $comp '%$val%'";
                            }else{
                               $wheres[]="$key $comp '$val'"; 
                            }
                        }
                    }
                    // print_r($where);
                    $where=implode(" $check ",$wheres);
                }
                $where=" WHERE $where";
            }
            // echo $where;
            $sql="SELECT * FROM $table $where";
            // echo $sql;
            $this->query($sql);
         }
        
        // ham ngat ket noi voi database
         public function disconnect($id){
            if($this->conn){
                mysqli_close($this->conn);
            }
         }
        // ham dem so ban ghi duoc tra ve
         public function numRow(){
            if($this->result){
                return mysqli_num_rows($this->result);
            }
            return 0;
         }
        //
        // chuyen cac ban ghi thanh mang
        public function fetch(){
            if($this->result){
                if($this->numRow()!==0){
                    while ($row = mysqli_fetch_array($this->result, MYSQLI_BOTH)) {
                        $this->data[]=$row;
                    }
                }else{
                    $this->data=[];
                }
            }else{
                $this->data=[];
            }
            return $this->data;
        }
        // 
        // lay cac ban ghi tu vi tri start toi vi tri ket thuc
        public function getLimit($start,$limit){
            // se lay ban ghi dua vao du lieu data da duoc luu lai truoc do qua phuong thuc getAll
           if($this->data){
             $this->data2=array_slice($this->data,$start,$limit);
           }else{
             $this->fetch();
             $this->getLimit($start,$limit);
           }
        }
        // ham khoi tao cau truy van de cap nhap du lieu
        public function updateData($table,$data="",$where=""){
            foreach($data as $key=>$value){
                $set[]="$key='$value'";
            }
            $set=implode(' , ',$set);
            // 
            foreach($where as $key=>$value){
                $wheres[]="$key='$value'";
            }
            $where=implode(' and ',$wheres);
            // 
            $sql="UPDATE $table SET $set WHERE $where";
            // echo $sql;
            $this->query($sql);
        }
        // ham khoi tao cau truy van de xoa ban ghi
        public function deleteData($table,$where=""){
            foreach($where as $key=>$value){
                $wheres[]="$key='$value'";
            }
            $where=implode(' and ',$wheres);
            $sql="DELETE FROM $table WHERE $where";
            // echo $sql;
            $this->query($sql);
        }
        // ham khoi tao cau truy van de them ban ghi
        public function insert($table,$data=""){
            $set=array_keys($data);
            $set=implode(' , ',$set);
            $value=array_values($data);
            $value=implode(' , ',$value);
            $sql="INSERT INTO $table ($set) VALUES ($value)";
            // echo $sql;
            $this->query($sql);
        }
    }