<?php
$current_dir = "upload/";
$dir = opendir($current_dir);
while($file = readdir($dir)){
	if($file != "." && $file != ".."){
		echo $file."<br>";
	}
}
closedir($dir);
echo "</table>";
?>