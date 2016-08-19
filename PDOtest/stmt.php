<?php
include 'pdo.php';
try{
/*
	$sql = "insert into user (id,username,pwd,email) value(?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(1,$id);
	$stmt->bindParam(2,$username);
	$stmt->bindParam(3,$pwd);
	$stmt->bindParam(4,$email);

	$id=2;
	$username = "user2";
	$pwd = md5("123456");
	$email = "user2@qq.com";
	$pwd = md5("123456");
	$result = $stmt->execute(array(3,"user3",$pwd,"user5.@qq.com"));*/

	$sql = "insert into user (id,username,pwd,email) value(:id,:username,:pwd,:email)";
	$stmt = $pdo->prepare($sql);
	$pwd=md5(123456);
	$arr = array("id"=>5,"username"=>"user5","pwd"=>$pwd,"email"=>"user5@qq.com");
	$result = $stmt->execute($arr);

	echo $result;
}catch(PDOException $e){
	echo $e->getMessage()."on the line ".$e->getLine();
}


?>