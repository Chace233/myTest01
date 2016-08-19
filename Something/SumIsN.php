<?php
function foo($x,$y,$n){
	$count = 0;
	for($i = 0;$i < 10000;$i++){
		$sum = 0;
		for($j = 0;$j < $x;$j++){
			$sum += mt_rand(0,$y);
		}
		if($sum == $n) {
			$count ++;
		}
	}
	echo $count/10000;
}

$x = 100;
$y = 20;
$n = 200;
foo($x,$y,$n);
?>
