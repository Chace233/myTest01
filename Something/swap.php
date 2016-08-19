<?php
class courier {
	public $name;
	public $city;
	public function __construct($name){
		$this->name = $name;
	}
	function PigeonPost($city){
		$this->city = $city;
	}
}

$c = new courier('xia haha haha');
$b = $c;
$b->name = "sdddddd";
echo $c->name;
?>