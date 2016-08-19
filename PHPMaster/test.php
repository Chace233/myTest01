<?php
require 'courier.php';
$mono = new Courier("Monopace Delivery");
echo "Courier name: ".$mono->name;
$mono->ship($parcel);
$spanish_couriers = Courier::getCourierByCountry("Spain");

/*function __autoload($classname){
	include strtolower($classname).".php";
}*/
?>
