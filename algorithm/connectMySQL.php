<?php

function connection(){
	$dsn = "mysql:host=localhost;dbname=test";
	$username = "root";
	$pw = "chenlin2333";

	try{
		$pdo = new PDO($dsn,$username,$pw);
		$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		echo "SECCUSE! <br>";
		return $pdo;
	}catch(PDOException $e){
		echo $e->getMessage()." on the line ".$e.getLine();
	}
}

?>