<?php
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
    echo '<' . $xml_tag . 's>';
    foreach ($query_results as $k => $query_result) {
        if (is_array($query_result)) {
            echo '<' . $xml_tag . '>';
            foreach ($query_result as $key => $value) {
                echo '<', $key, '>', $value, '</', $key, '>';
            }
            echo '</' . $xml_tag . '>';
        } else {
            echo '<', $k, '>', $query_result, '</', $k, '>';
        }
    }
    echo '</' . $xml_tag . 's>';
}
?>

<?php function array_to_xml($data, &$xml_data)
{
    foreach ($data as $key => $value) {
        if (is_numeric($key)) {
            $key = 'item' . $key; //dealing with <0/>..<n/> issues
        }
        if (is_array($value)) {
            $subnode = $xml_data->addChild($key);
            array_to_xml($value, $subnode);
        } else {
            $xml_data->addChild("$key", htmlspecialchars("$value"));
        }
    }
}

?>