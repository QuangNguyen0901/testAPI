<?php

use Libs\ArrayToXml\ArrayToXml;
//use libs\ArrayToXml\test;
//include ($root.'/libs/ArrayToXml.php');

include ('../libs/config.php');
include ($root.'/libs/MysqliDb.php');

$db = new MysqliDb();

$members = $db->get('member');
$result = ArrayToXml::convert($members);
echo $result;

//echo '$members = $db->get(\'member\');';
//echo '<br>';
//print_r($members);
//echo '<br>';
//echo '<br>';
//
//
//$db->where("id",2);
//
//$member = $db->getOne('member');
//echo '$db->where("id",2);';
//echo '<br>';
//echo '$members = $db->get(\'member\');';
//echo '<br>';
//print_r($member);
//echo '<br>';
//echo '<br>';
//
//
//
//$db->where("full_name",'%Nguyen%','like');
//$member1 = $db->get('member');
//print_r($member1);
//echo '<br>';
//echo '<br>';
//
//$user_name = "vana";
//$pass = 111111 ;
//$db->where("user_name",$user_name);
//$cols = Array ('salt');
//$salt = $db->get('member',null,$cols);
//print_r($salt);
//echo '<br>';
//echo '<br>';
//
//$db->where("user_name",$user_name);
//$db->where("password",$pass);
//$member = $db->getOne('member');
//print_r($member);
//
//echo '<br>';
//echo '<br>';
//
//echo $db->count;

//$arraytoxml = new ArrayToXml();



//$b = test::xinchao();

//echo $b;


