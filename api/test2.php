<?php

include ('../libs/config.php');
include ($root.'/libs/MysqliDb.php');
include ($root.'/libs/Array2XML.php');

$db = new MysqliDb();

$members = $db->get('member');

$xml_info = new SimpleXMLElement("<?xml version=\"1.0\"?><root></root>");
array_to_xml($members,$xml_info);

$xml=strip_tags($xml_info->asXML());
//echo $xml;
header('Content-type: text/xml; charset=utf-8');
echo $xml_info->asXML();

//print_r($xml_members_info);

//http://php.net/manual/en/simplexmlelement.asxml.php