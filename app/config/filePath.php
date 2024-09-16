<?php 
    namespace App\Config;
    $host="http://localhost:8080/";
    $site_path=$host."ommani/learn/phrases1/";
    $base_uri="/ommani/learn/phrases1/index.php";
    // duong dan lay layout
    define('__Path_Layout','app/views/layout/');
    // 
    define('__Site_Path',$site_path);
    define('__Base_Uri',$base_uri);
    define('__Path_Model','app/models/');
    // 
    define('__Model_Space','App\Models\\');
    define('__Controller_Space','App\Controllers\\');
    // 
    define('__Path_Views','app/views/');
    define('__Path_Controllers','app/controllers/');
    define('__PAth_Config','app/config/');
    define('__Path_Core','app/core/');