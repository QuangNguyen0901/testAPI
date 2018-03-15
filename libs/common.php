<?php
//Truy vấn
$query = $query_content;

//Tạo bảng lưu thông tin
$query_results = array();
while ($rs = mysqli_fetch_assoc($query)) {
//    print_r($rs);
    $query_results[] = $rs;
}

//print_r($members);
//
//echo $members[1]['user_name'];

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

//Trả về kiểu json
if ($format == 'json') {
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($query_results);
}
if ($format == 'xml') {
    header('Content-type: text/xml; charset=utf-8');
    echo '<'.$xml_tag.'s>';
    foreach ($query_results as $query_result) {
        echo '<'.$xml_tag.'>';
        if (is_array($query_result)) {
            foreach ($query_result as $key => $value) {
                echo '<', $key, '>', $value, '</', $key, '>';
            }
        }
        echo '</'.$xml_tag.'>';
    }
    echo '</'.$xml_tag.'s>';
}

mysqli_close($conn);
?>