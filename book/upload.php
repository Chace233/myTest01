
<?php

header("Content-type: text/html; charset=utf-8"); 
echo "uploading.......";
if($_FILES['userfile']['error']>0){
	echo "Problem:";
	switch($_FILES['userfile']['error']){
		case 1: echo "文件超出了约定值，去php.ini文件里面修改upload_max_filesize";
			break;
		case 2: echo "文件超出了HTML中指定的大小";
			break;
		case 3: echo "文件只有部分被上传";
			break;
		case 4: echo "没有任何文件上传";
			break;
		case 6: echo "php.ini文件中没有指定临时目录";
			break;
		case 7: echo "写入磁盘失败";
			break;
	}
	exit;
}

if($_FILES['userfile']['type'] != 'text/plain'){
	echo "Problem : file is not text plain ";
	exit;
}

$upfile = "upload/".$_FILES['userfile']['name'];
print_r( $_FILES['userfile']);
echo "<br>";
if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
	if(!move_uploaded_file($_FILES['userfile']['tmp_name'],$upfile)){
		echo "Problem : Could not move file to destination directory";
		exit;
	}
}else{
	echo "Problem : Possible file upload attack  . filename : ";
	echo $_FILES['userfile']['name'];
	exit;
}

echo "file upload successfully <br><br>";

$contents = file_get_contents($upfile);
$contents = strip_tags($contents);
file_put_contents($_FILES['userfile']['name'],$contents);

echo "preview of upload file contents : <br>";
echo nl2br($contents);
echo "<br>";
?>
