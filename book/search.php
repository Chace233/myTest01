<?php
include 'pdo.php';

try{
	$type = $_POST['type'];
	$term = $_POST['term'];
	$sql = "select * from books where $type like :term ";

	$term = '%'.$term.'%';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':term',$term);
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	var_dump($result);
	foreach($result as $value){
		echo $value['isbn']."<br>";
	}
	/*foreach($pdo->query($sql) as $value){
		echo $value['isbn']."--".$value['author']."--".$value['title']."--".$value['price'] ."<br>";
	}*/

	
}catch(PDOException $e){
	echo $e->getMessage();
}

?>