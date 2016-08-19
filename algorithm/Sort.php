<?php

function bubble_sort($arr){
	for($i = 0; $i < sizeof($arr); $i++){
		for($j = $i; $j<sizeof($arr); $j++){
			if($arr[$i] > $arr[$j]){
				$temp = $arr[$i];
				$arr[$i] = $arr[$j];
				$arr[$j] = $temp;
			}
		}
	}
	return $arr;
}

function quick_sort($arr){
	$length = count($arr);
	if($length <= 1) return $arr;
	$base_num = $arr[0];
	$left_array = array();
	$right_array = array();
	for($i = 1; $i < $length; $i++){
		if($base_num > $arr[$i]){
			$left_array[] = $arr[$i];
		}else{
			$right_array[] = $arr[$i];
		}
	}
	$left_array = quick_sort($left_array);
	$right_array = quick_sort($right_array);
	return array_merge($left_array, array($base_num), $right_array);
}

function insert_sort($arr){
	$len = count($arr);
	for($i = 1; $i<$len; $i++){
		$temp = $arr[$i];
		for($j = $i-1; $j >= 0; $j --){
			if($temp < $arr[$j]){
				$arr[$j+1] = $arr[$j];
				$arr[$j] = $temp;
			}else{
				break;
			}
		}
	}
	return $arr;
}

function select_sort($arr){
	$len = count($arr);
	for($i = 0; $i < $len-1; $i++){
		$p = $i;
		for($j = $i+1; $j<$len; $j++){
			if($arr[$p] > $arr[$j]){
				$p = $j;
			}
		}
		if($p != $i){
			$temp = $arr[$i];
			$arr[$i] = $arr[$p];
			$arr[$p] = $temp;
		}
	}
	return $arr;
}

$arr = array(1,3,4,6,5,2);
print_r(select_sort($arr));
?>