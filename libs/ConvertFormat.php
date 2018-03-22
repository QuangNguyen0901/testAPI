<?php

class ConvertFormat
{
    static function showData(array $data,$xml_root_tag = null) //Ham static khong can khai bao doi duong class cung dung duoc
    {
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
            echo json_encode($data);
        }

//Trả về kiểu xml
        if ($format == 'xml') {
            if (!isset($xml_root_tag)) {
                $xml_root_tag = '<root></root>';
            }
            header('Content-type: text/xml; charset=utf-8');
            $xml_info = new SimpleXMLElement("<?xml version=\"1.0\"?>" . $xml_root_tag);
            $toXml = new ConvertFormat(); //De goi duoc ham trong cung 1 class cho trong ham static can khai bao doi tuong Class
            $toXml->array_to_xml($data, $xml_info);
            echo $xml_info->asXML();
        }
    }

    function array_to_xml($array, &$xml_info)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (!is_numeric($key)) {
                    $subnode = $xml_info->addChild("$key");
                    array_to_xml($value, $subnode);
                } else {
                    $subnode = $xml_info->addChild("item_$key");
                    array_to_xml($value, $subnode);
                }
            } else {
                $xml_info->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }
}
