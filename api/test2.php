<?php

include ('../libs/config.php');
include ($root.'/libs/MysqliDb.php');
include ($root.'/libs/ConvertFormat.php');

$db = new MysqliDb();
//
$members = $db->get('member');
//
/*$xml_info = new SimpleXMLElement("<?xml version=\"1.0\"?><root></root>");*/
//array_to_xml($members,$xml_info);
//
//$xml=strip_tags($xml_info->asXML());
////echo $xml;
//header('Content-type: text/xml; charset=utf-8');
//echo $xml_info->asXML();

//print_r($xml_members_info);

//http://php.net/manual/en/simplexmlelement.asxml.php


if (!empty(file_get_contents('php://input'))){
    $_POST = json_decode(file_get_contents('php://input'), true);
    ConvertFormat::showData($_POST);
}


//$test = new ConvertFormat();
//$test->nhandoi(2);

//ConvertFormat::nhandoi(2);
//
//ConvertFormat::nhandoi(4);

//$a = array("a" =>1,"c"=>3);
//print_r($a);
//$xml_root_tag = '<user></user>';
//ConvertFormat::showData($members);

///test ignoresssssâssgt