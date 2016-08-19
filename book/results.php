<?php
$type = trim($_POST['type']);
$term = trim($_POST['term']);
if(!$type || $term===""){
	die("<br>you have not entered search details!");
}

if(!get_magic_quotes_gpc()){
	$type = addslashes($type);
	$term = addslashes($term);
}

@ $db = new mysqli('localhost',"root","chenlin2333","test");

if(mysqli_connect_errno()){
	die("Error:could not connect to db");
}

$query = "select * from books where ".$type." like '%".$term."%'";
$result = $db->query($query);

$num_results = $result->num_rows;
echo "Number of books found: ".$num_results."<br>";

for($i=0;$i<$num_results;$i++){
	$row = $result->fetch_assoc();  //将结果返回到一个列举数组中
	print_r($row);
	echo "<br>";
	echo "Title:".htmlspecialchars(stripslashes($row['title']))."<br>";
	echo "Author: ".stripcslashes($row['author'])."<br>";
	echo "ISBN:".stripcslashes($row['isbn'])."<br>";
	echo "===============================================<br>";
}

$result -> free();
$db->close();
?>