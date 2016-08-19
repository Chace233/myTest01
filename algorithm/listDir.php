<?php
header("Content-Type:text/html;charset=gb2312");
function listDir($dir){
	$files = array();
	//$dir = iconv("GBK", "utf-8", $dir);
	$dir = mb_convert_encoding($dir, "GBK", "UTF-8");
	if(is_dir($dir)){
		if($handle = opendir($dir)){
			while(($file = readdir($handle)) != false){
				if($file != "." && $file != ".."){
					if(is_dir($dir."/".$file)){
						$files[$file] = listDir($dir."/".$file);
					}else{
						$files[] = $dir."/".$file; 
					}
				}
			}
			closedir($handle);
			return $files;
		}
	}
}

print_r(listDir("D:\study\云计算"));
?>