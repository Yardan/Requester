<?php
//return request method
var_dump($_SERVER['REQUEST_METHOD']);

//return request params
$test = file_get_contents("php://input");
var_dump(json_decode($test));


