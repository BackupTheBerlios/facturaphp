<?php
class fields{
	var $list;
	var $num;
	function fields(){
		
		$this->num=0;
		
	}
	
	function add($name, $value, $type, $size, $valid){
	
		$this->list = array($name => array("value" => $value, "type" => $type, "size" => $size, "valid" => $valid));
		$this->num++;
		
	}
	
	function remove(){
	
		
	}
	
	function free(){
	
		
	}
}
?>