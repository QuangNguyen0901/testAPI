<?php
include ('../libs/config.php');
include ($root.'/libs/connection.php');  //=>$conn
$query_content = mysqli_query($conn, 'SELECT * FROM member');

//xml tag
//level1 tag    <users>, </users>
//level2 tag    <user>,</user>
$xml_tag= 'user';

include ($root.'/libs/common.php');
