<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

spl_autoload_register(function($class){
    if(preg_match('/\\\\/', $class)){
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    } else {
        $path = str_replace('_', DIRECTORY_SEPARATOR, $class);
    }
    require_once 'src/'.$path.'.php';
});

use Yardan\Requester\Requester;



//GET request
$test = Requester::init('GET', "http://mytest/requester/post.php");
$test->setHeaders(array('Accept: application/json', 'Content-Type: application/json;charset=UTF-8'));
$test->returnHeaders(true);
$result = $test->request();
echo $result;

//POST request
$test = Requester::init('POST', "http://mytest/requester/post.php");
$test->setHeaders(array('Accept: application/json', 'Content-Type: application/json;charset=UTF-8'));
$test->setParams(array('name'=>'Peter', 'age'=>'23'));
$test->returnHeaders(true);
$test->setParamsType('json');
$result = $test->request();
echo $result;


//POST request
$test = Requester::init('PUT', "http://mytest/requester/post.php");
$test->setHeaders(array('Accept: application/json', 'Content-Type: application/json;charset=UTF-8'));
$test->setParams(array('name'=>'Peter', 'age'=>'23'));
$test->returnHeaders(true);
$test->setParamsType('json');
$result = $test->request();
echo $result;

//GET request
$test = Requester::init('DELETE', "http://mytest/requester/post.php");
$test->setHeaders(array('Accept: application/json', 'Content-Type: application/json;charset=UTF-8'));
$test->returnHeaders(true);
$result = $test->request();
echo $result;