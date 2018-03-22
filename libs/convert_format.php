<?php
include ($root.'/libs/Array2XML.php');

$query_results = $result;  //need $result

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
    if (!isset($xml_root_tag)){ $xml_root_tag='<root></root>';}
    header('Content-type: text/xml; charset=utf-8');
    $xml_info = new SimpleXMLElement("<?xml version=\"1.0\"?>".$xml_root_tag);
    array_to_xml($query_results,$xml_info);
    echo $xml_info->asXML();
}
?>
