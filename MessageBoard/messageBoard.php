<?php

require "connectMySQL.php";

$content= null;
$headImg = null;
$title = null;
$email = null;
$headImg = null;
$userName = null;


if(isset($_POST["userName"])){
	 $userName = $_POST['userName'];
}else{
	echo"<script>alert('用户名不能为空');</script>";   
}

if(isset($_POST["headImg"])){
	$headImg = $_POST['headImg'];
}

if(isset($_POST['title'])){
	echo "1111";
	$tite = $_POST['title'];
}

if(isset($_POST['content'])){
	echo "content<br>";
	$content = $_POST['content'];
}else{
	echo "<script> alter('内容不能为空！');  </script>";
}

if(isset($_POST['email'])){
	$email = $_POST['email'];
}

$time = date("Y-m-d H:i:s");
echo $userName."    ".$content."<br>";
if(isset($userName) && isset($content)){
	$sql = "insert into messageBoard(userName, headImg, title, time, content, email) values($userName, $headImg, $title, $time, $content, $email)";
	$result = $pdo->exec($sql);

	if($result > 0){
		echo "写入数据库成功!";
	}else{
		echo "写入数据库失败!";
	}
}else{
	die("数据填写不完整!");
}


?>