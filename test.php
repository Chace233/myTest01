<?php
header("Content-Type:text/html;charset=gb2312");
function myScandir($dir){
	$files = array();
	if($handle = opendir($dir)){
		while(($file = readdir($handle)) != false){
			if($file != "." && $file != ".." ){
				if(is_dir($dir."/".$file)){
					$files[$file] = myScandir($dir."/".$file);
				}else{
					$files[] = $dir."/".$file;
				}
			}
		}
		closedir($handle);
		return $files;
	}
}

var_dump(is_dir("D:\study\云计算"));
?>