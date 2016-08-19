<?php
////////////////////两个文件的相对路径
function getRelativePath($a,$b){
	$aArray = explode("/", $a);
	$bArray = explode("/", $b);
	for($i = 0; $i <= count($bArray)-2; $i++){
		$relativePath .= $aArray[$i] == $bArray[$i] ? "../" : $bArray[$i]."/";
	}
	return $relativePath;
}

$a = "/a/b/c/d/e.php";
$b = "/a/b/13/34/c.php";
print_r(getRelativePath($a, $b));
?>