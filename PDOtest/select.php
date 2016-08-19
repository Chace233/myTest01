<?php
include 'pdo.php';

try{
	$sql = "select * from user where id > :id";
	$stmt = $pdo->prepare($sql);
	$stmt->execute($_GET);

	//$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//$result = $stmt->fetch(PDO::FETCH_ASSOC);
	//var_dump($results);

	$stmt->bindColumn(1,$id);
	$stmt->bindColumn(2,$username);
	$stmt->bindColumn("pwd",$pwd);
	$stmt->bindColumn("email",$email);

	$result = $stmt->fetch(PDO::FETCH_ASSOC);
	while($stmt->fetch(PDO::FETCH_ASSOC)){
		echo "$id -- $username -- $pwd -- $email <br >";
	}
}catch(PDOException $e){
	echo $e->getMessage();
}

?>