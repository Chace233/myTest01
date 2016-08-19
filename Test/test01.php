<?php
echo "------------------------<==与===的比较>----------------------------------";
$str1 = 0;
$str2 = false;
echo $str1 == $str2 ? "相等":"不想等";
echo "<br>";
$str3 = '';
$str4 = 0;
echo $str3 == $str4 ? "相等":"不相等";
echo "<br>";
$str5 = '0';
echo $str5 === $str4?"相等":"不相等";
echo"<br>-----------------------------------------------------------------------------<br>";
$a1 = null;
$a2 = false;
$a3 = 0;
$a3 = '';
$a5 = "0";
$a5 = "null";
$a6 = array();
$a7 = array(array());
echo "<br> null is empty?                     ";
echo empty($a1) ?"true":"false";
echo "<br> false is empty?                  ";
echo empty($a2) ?"true":"false";
echo "<br> 0 is empty?                        ";
echo empty($a3) ?"true":"false";
echo "<br> \'\' is empty                     ";
echo empty($a4) ?"true":"false";
echo "<br> \"0\" is empty?                ";
echo empty($a5) ?"true":"false";
echo "<br>  array() is empty?             ";
echo empty($a6) ?"true":"false";
echo "<br>  array(array()) is empty?  ";
echo empty($a7) ?"true":"false";

echo "<br>----------------------------------------------------------------------------------------------------------<br>";
$count = 5;
function get_count(){
	static $count = 0 ;
	return $count++;
}
echo $count."<br>";
++$count;
echo get_count()."<br>";
echo get_count()."<br>";
echo "------------------------------------------------------------------------------------------------------<br>";
$GLOBALS['var1'] = 5;
$var2 = 1;
function get_value(){
	global $var2 ;
	$var1 = 0;
	return $var2++;
}

get_value();
echo $var1;
echo "<br>".$var2;
echo "<br>------------------------------------------------------------------------------------------------------<br>";

function get_arr($arr){
	unset($arr[0]);
}
$arr1 = array(1,2);
$arr2 = array(1,2);
//get_arr(&$arr1);
get_arr($arr2);
echo count($arr1)."<br>";
echo count($arr2)."<br>";
echo "<br>------------------------------------------------------------------------------------------------------<br>";
$c = "12345";
print $c;
print $d;
?>