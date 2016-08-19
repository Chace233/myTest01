<?php
function reverse($str){
	$len = mb_strlen($str, 'utf-8');
	for($i = 0; $i<$len; $i++){
		$arr[] = mb_substr($str, $i, 1, "utf-8");
	}
	return implode("", array_reverse($arr));
}

$str = "你c好haha";

function  reverse2($str){  
	preg_match_all('/./us', $str, $ar);  //preg_match_all(string $pattern,  string $subject, array $arr)将$str字符串中与 $pattern x相匹配的放到$arr数组中
	print_r($ar);
	echo"<br>"; 
	return implode('', array_reverse($ar[0]));   //implode 作用是将数组的值转化为字符串
	                                                                  //array_reverse() 数组反转
	
}


print_r(reverse2($str));
?>