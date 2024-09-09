<?php

namespace App\Models;

use Core\Database;
use PDO;

class Student {
    private   $conn;
    private   $table  = 'student';

    public    $id;
    public    $name;
    public    $age;
    private   $limit  = 2;

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    // Tình tổng số trang
    public function getLastPage() {
        $query          = $this->conn->prepare("SELECT COUNT(*) FROM student");
        $query->execute();
        $totalRecords  = $query->fetchColumn();
        $totalPage     = ceil($totalRecords / $this->limit);

        return $totalPage;
    }

    public function getAllStudents($page) {
        $page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;  
        // echo "<script>console.log($page)</script>";
        
        //vị trí bắt đầu của dữ liệu trên mỗi trang
        $offSet = ($page - 1) * $this->limit; 
        
        $stmt = $this->conn->prepare("SELECT * FROM student LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':limit', $this->limit, PDO::PARAM_INT); // Ràng buộc kiểu dữ liệu là số nguyên
        $stmt->bindParam(':offset', $offSet, PDO::PARAM_INT); // Ràng buộc kiểu dữ liệu là số nguyên
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    

    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt  = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function create($name, $age, $photo) {
        $query = 'INSERT INTO ' . $this->table . ' (name, age, photo) VALUES (:name, :age, :photo)';
        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':photo', $photo);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = :id';

        $stmt  = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function update($id, $name, $age, $photo = null) {
        // Xây dựng câu lệnh SQL cập nhật
        $query = 'UPDATE ' . $this->table . ' SET name = :name, age = :age';
    
        // Thêm điều kiện cập nhật ảnh nếu có
        if ($photo !== null) {
            $query .= ', photo = :photo';
        }
    
        $query .= ' WHERE id = :id';
        
        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($query);
        
        // Gán giá trị cho các tham số
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        
        if ($photo !== null) {
            $stmt->bindParam(':photo', $photo);
        }
        
        $stmt->bindParam(':id', $id);
        
        // Thực thi câu lệnh
        return $stmt->execute();
    }
    

    public function delete($id) {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
}