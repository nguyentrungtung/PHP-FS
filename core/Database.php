<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// quản lý kết nối cơ sở dữ liệu và thiết lập môi trường cho Eloquent ORM
$capsule = new Capsule;

//  Cấu hình kết nối cơ sở dữ liệu
$capsule->addConnection([

   "driver" => "mysql",

   "host" =>"localhost",

   "database" => "mvc",

   "username" => "root",

   "password" => ""

]);

// Đặt Eloquent vào chế độ toàn cầu (cho phép sử dụng khắp nơi)
$capsule->setAsGlobal();

// Khởi động Eloquent
$capsule->bootEloquent();
