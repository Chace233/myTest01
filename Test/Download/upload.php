<html>
<meta charset="utf-8">
<title>uploading...... </title>
<body>
<?php
	//print_r($_FILES);
	if($_FILES['userfile']['error']>0){
		echo "Problem:";
		switch ($_FILES['userfile']['error']) {
			case 1:
				echo "file exceeded upload_max_filesize";
				break;
			case 2:
				echo "file exceeded max_file_size";
				break;
			case 3:
				echo "file onld partially upload";
				break;
			case 4:
				echo "no file uploaded";
				break;
			case 6:
				echo "Cannot upload file: No temp directory specified";
				break;
			case 7:
				echo "upload failed: cannot write to disk";
				break;
		}
		exit;
	}

	if($_FILES['userfile']['type'] != 'text/plain'){
		die('Problem: file is not plain text');
	}

	$upfile = '../upload/'.$_FILES['userfile']['name'];
	if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
		if(!move_uploaded_file($_FILES['userfile']['tmp_name'],$upfile)){
			die('Problem: could not move file to destination directory');
		}
	}
	else{
		echo 'Problem: Possible file upload attack. Filename: ';  
    		echo $_FILES['userfile']['name'];  
    		exit;  
	}

	echo "file upload seccessful<br><br>";

?>
</body>
</html>