<?php

$dsn = "mysql:host=localhost;dbname=test";
$name = "dog";
$pw = "1234";

try{
	$pdo = new PDO($dsn, $name, $pw);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	echo "数据库连接成功！";
}catch(PDOException $e){
	echo "-_# ".$e->getMessage()." on the lone :"+$e->getlien();
}

?>