<?php
include 'pdo.php';

$isbn = trim($_POST['isbn']);
$author = trim($_POST['author']);
$title = trim($_POST['title']);
$price = trim($_POST['price']);

if(!$isbn || !$author || !$title || !$price){
	die("输入的内容不能为空！");
}
try{
	$insert = "insert into books(isbn,author,title,price) value(:isbn,:author,:title,:price)";
	$stmt = $pdo->prepare($insert);
	$arr = array("isbn"=>$isbn,"author"=>$author,"title"=>$title,"price"=>$price);
	$effect = $stmt->execute($arr);

	if($effect){
		echo "插入成功！";
	}
}catch(PDOException $e){
	echo $e->getMessage();
}

?>