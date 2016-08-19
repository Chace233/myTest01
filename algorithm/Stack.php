<?php
class Stack{
	private $_data = array();
	private $_end = null;
	public function push($data){
		if($this->_end === null){
			$this->_end = 0;
		}else{
			$this->_end ++;
		}
		$this->_data[$this->_end] = $data;
	}
	public function pop(){
		if($this->_end == null){
			return false;
		}
		$end = $this->_data[$this->_end];
		array_splice($this->_data, $this->_end);
		$this->_end--;
		return $end;
	}
	public function isEmpty(){
		if($this->_end === null){
			return true;
		}
		return false;
	}
}
?>