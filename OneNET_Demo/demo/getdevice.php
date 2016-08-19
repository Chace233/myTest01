<?php
require '../OneNetApi.php';

$apikey = 'VY0vQlfwsUM3v5hHEmVtyy3mKGs=';
$apiurl = 'http://api.heclouds.com';

//创建api对象
$sm = new OneNetApi($apikey, $apiurl);

$device_id = '3213513';
$device = $sm->device($device_id);
$error_code = 0;
$error = '';
if (empty($device)) {
    //处理错误信息
    $error_code = $sm->error_no();
    $error = $sm->error();
}

//展现设备

print_r($device);
echo "<br>-----------------------------------<br>";
print_r($device['datastreams']['5']);