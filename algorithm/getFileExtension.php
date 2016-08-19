<?php

//substr(string, start, length); length可选，默认是从start到字符串的结尾。
function getExten1($file){
	//strtchr 搜索字符在字符串中的位置并返回从该位置到字符串结尾所有的字符
	return substr(strrchr($file, '.'), 1);
}

function getExten2($file){
	return substr($file, strrpos($file, '.')+1); //strrpos()查找字符在字符串中最后一次出现的位置
}

function getExten3($file){
	return end(explode('.', $file)); //end() 返回数组最后一个元素，没有则返回false
}

function getExten4($file){
	$info = pathinfo($file);
	return $info['extension'];
}

function getExten5($file){
	return pathinfo($file);
}

$file = "/usr/www/html/index.php";
echo getExten1($file);
echo "<br>";
echo getExten2($file)."<br>";
echo getExten3($file)."<br>";
echo getExten4($file)."<br>";
print_r(getExten5($file));
?>