<?php
global $INSTALL_DIR, $SMARTY_DIR;
require_once($SMARTY_DIR.'Smarty.class.php');
class fields{
	var $list;
	var $num;
	function fields(){
		
		$this->num=0;
		
	}
	
	function get_ddbb_fields(){
	
		
	
	}
	
	function add($name, $value, $type, $size, $valid){
	
		$this->list = array ($name => array("value" => $value, "type" => $type, "size" => $size, "valid" => $valid));
		$this->num++;
		
	}
	
	function remove(){
	
		
	}
	
	function free(){
	
		
	}
	
	function validate($fields_form){
	
		/*for ($i=0;i<$this->num;$i++){
		
		
			
		}*/		
	
	}
}
?>