<?php

//Dữ liệu trả về dạng json
$jsonData = file_get_contents("http://testapi.com/webservice.php?format=json");
$jsonArray = json_decode($jsonData, true);

var_dump($jsonArray);
echo '<br>';
print_r( array_values( $jsonArray ));