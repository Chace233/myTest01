<?php
$fileName = "something.txt";
$path = "../upload/";
if(! file_exists($path.$fileName)){
	die('not exsts the file');
}else{
	$file = fopen($path.$fileName,r);
	Header("Content-type:application/octet-stream");
	Header("Accept-Ranges:bytes");
	Header("Accept-Length:".filesize($path.$fileName));
	Header("Content-Disposition:attachment;filename=".$fileName);
	echo fread($file,filesize($path.$fileName));
	fclose($file);
	exit;
}
?>