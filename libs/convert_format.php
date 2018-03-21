<?php
include ($root.'/libs/Array2XML.php');

$query_results = $result;


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
    $xml_info = new SimpleXMLElement("<?xml version=\"1.0\"?>".$xml_root_tag);
    array_to_xml($query_results,$xml_info);
    echo $xml_info->asXML();

//    echo '<'.$xml_tag.'s>';
//    foreach ($query_results as $query_result) {
//        echo '<'.$xml_tag.'>';
//        if (is_array($query_result)) {
//            foreach ($query_result as $key => $value) {
//                echo '<', $key, '>', $value, '</', $key, '>';
//            }
//        }
//        echo '</'.$xml_tag.'>';
//    }
//    echo '</'.$xml_tag.'s>';
}
?>
