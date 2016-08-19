<?php
function myscandir($dir){
	$files = array();
	if(is_dir($dir)){
		if($handle=opendir($dir)){
			while(($file = readdir($handle)) !== false){
				if($file != "." && $file != ".."){
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

print_r(myscandir('C:\Users\98263\Pictures\Saved Pictures'));
?>