<?php
//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');


require_once ($ADODB_DIR."adodb.inc.php");

class permissions_methods{
//internal vars
	var $method_name;
	var $id_method;
	var $per;

	//constructor
	function permissions_methods()
	{
		return $this;
	}
	
	function add_permissions($name, $id, $valor)
	{
		$this->method_name = $name;
		$this->id_method = $id;
		$this->per = $valor;
	}
	
	function add_module ($module_n, $id_mo)
	{
		$this->module_name = $module_n;
		$this->id_module = $id_mo;
	}
	
	function add_method ($method_n, $id_me)
	{
		$this->method_name = $method_n;
		$this->id_method = $id_me;
	}
	
	function add_per ($valor_per)
	{
		$this->per = $valor_per;
	}
}
?>	