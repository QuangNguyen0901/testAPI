<?php
include ('../libs/config.php');
include ($root.'/libs/MysqliDb.php');

//ket qua list member
$db = new MysqliDb();
$result = $db->get('member');

//xml root tag
$xml_root_tag='<users></users>';

include ($root.'/libs/convert_format.php');
