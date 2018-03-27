<?php
include('../libs/config.php');
$db_user = DB_USER; //User đăng nhập MYSQL
$db_pass = DB_PASS; // Pass đăng nhập MySQL
$db_host = DB_HOST; //IP, Domain kết nối
$db_name = DB_DBNAME; //Tên CSDL
//Tạo biến kết nối với CSDL
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('Kết nối thất bại');
?>