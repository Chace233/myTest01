<?php
$a = null;
echo isset($a);
var_dump($a);
echo "<br>---------------------------------------------------------------------------------------------------------------------<br>";
$str = "LAMP";
$str1 = "LAMPaaab";
$strc = strcmp($str,$str1);
printf($strc);
echo "<br>---------------------------------------------------------------------------------------------------------------------<br>";
class A{
	public $num = 100;
}
$a = new A();
$b = $a;
$a->num = 200;
echo $b->num;
echo "<br>";
echo get_class($a);
echo "<br>---------------------------------------------------------------------------------------------------------------------<br>";
$user[] = 'a';
//array_add($user,'b');
array_push($user, 'c');
//$user ||= 'd';
print_r($user);

?>