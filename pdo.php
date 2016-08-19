<?php
$dsn = "mysql:host=127.0.0.1;dbname=test";
$username = "root";
$pwd = "chenlin2333";

try{
	$pdo = new PDO($dsn,$username,$pwd);
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//var_dump($pdo);
}catch(PDOException $e){
	echo $e->getMessage()." on the line ".$e->getLine();
}


?>
