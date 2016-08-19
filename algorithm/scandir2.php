<?php
header("Content-Type:text/html;charset=GBK");
function myscandir($dir){
	$files = array();
	$dir = mb_convert_encoding($dir, "GBK","UTF-8");
	if(is_dir($dir)){
		if($handle = opendir($dir)){
			while(($file = readdir($handle)) !== false){
				if($file != "." || $file != ".."){
					if(is_dir($dir."/".$file)){
						$files[$file] = myscandir($dir."/".$file); 
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

print_r(myscandir("D:\study\云计算"));
?>