<?php
class Courier{
	public $name;
	public $home_country;

	public function __construct($name){
		$this->name = $name;
		return true;
	}

	public static function getCourierByCountry($country){
		return $country;
	}

	public function ship($parcel){
		return true;
	}
}
?>