<?php
class fields{
	var $list;
	var $num;
	function fields(){
		
		$this->num=0;
		
	}
	
	function add($name, $value, $type, $size){
	
		$this->list = array($name => array("value" => $value, "type" => $type, "size" => 42));
		$this->num++;
		
	}
	
	function remove(){
	
		
	}
	
	function free(){
	
		
	}
}
?>