<?php
function tail($fp,$n,$base = 5){
	if(assert($n <= 0)){
		die("n的值不能小于0！");
	}
	$pos = $n+1;
	$lines = array();
	while(count($lines) <= $n){
		try{
			fseek($fp, -$pos,SEEK_END);
		}catch(Exception $e){
			fseek(0);
			break;
		}
		$pos *= $base;
		 while(!feof($fp)){
			array_unshift($lines, fgets($fp));
		}
	}
	return array_slice($lines, 0,$n);
}


var_dump(tail(fopen("Stack.php","r+"),10));
?>