<?php

$db_user = 'root'; //User đăng nhập MYSQL
$db_pass = ''; // Pass đăng nhập MySQL
$db_host = 'localhost'; //IP, Domain kết nối
$db_name = 'qblog'; //Tên CSDL
//Tạo biến kết nối với CSDL
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die('Kết nối thất bại');

//Lấy kiểu định dạng muốn lấy của request
$formatList = array('json', 'xml');
if (isset($_GET['format'])) {
    $format = $_GET['format'];
} else {
    $format = 'json';
}
if (!in_array($format, $formatList)) {
    $format = 'json';
}

//Truy vấn
$query = mysqli_query($conn, 'SELECT * FROM member');

//Tạo bảng lưu thông tin
$members = array();
while ($rs = mysqli_fetch_assoc($query)) {
    print_r($rs);
    $members[] = $rs;
}

print_r($members);

echo $members[1]['user_name'];


//Trả về kiểu json
if ($format == 'json') {
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($members);
}
if ($format == 'xml') {
    header('Content-type: text/xml; charset=utf-8');
    echo '<users>';
    foreach ($members as $member) {
        echo '<user>';
        if (is_array($member)) {
            foreach ($member as $key => $value) {
                echo '<', $key, '>', $value, '</', $key, '>';
            }
        }
        echo '</user>';
    }
    echo '</users>';
}

mysqli_close($conn);
?>