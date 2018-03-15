<?php

$db_user = 'root'; //User đăng nhập MYSQL
$db_pass = ''; // Pass đăng nhập MySQL
$db_host = 'localhost'; //IP, Domain kết nối
$db_name = 'qblog'; //Tên CSDL
//Tạo biến kết nối với CSDL
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('Kết nối thất bại');
?>