<?php
global $INSTALL_DIR, $SMARTY_DIR;
require_once($SMARTY_DIR.'Smarty.class.php');
class fields{
	var $lista;
	var $num;
	function fields(){
		
		$this->num=0;
		
	}
	
	function get_ddbb_fields(){
	
		
	
	}
	
	function add($name, $value, $type, $size, $valid){
	
		$this->lista = array ($name => array("value" => $value, "type" => $type, "size" => $size, "valid" => $valid));
		$this->num++;
		
	}
	
	function remove(){
	
		
	}
	
	function free(){
	
		
	}
	
	function modify_value($name,$new_value){
		$this->lista[$name]["value"]=$new_value;
	}
	
	function validate(){
	
		for ($i=0;$i<$this->num;$i++){
			switch ($this->lista[$i]["type"]){
				case "int": break;
				case "text": break;
				case "double": break;
				case "varchar": break;
				case "char": break;
				case "long": break;
				case "string": break;
				case "real": break;
				case "date": break;
				default: break;
			}			
		}
	
	}
}
?>