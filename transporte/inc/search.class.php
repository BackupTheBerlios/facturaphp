<?php
//clase que da soporte a las empresas del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');
require_once ($ADODB_DIR."adodb.inc.php");

class search{
//internal vars
	//BBDD name vars
	//constructor
	function search(){
		//coge las variables globales del fichero config.inc.php
				return $this;	 
		
	}
	
	function get_query ($search, $fields)
	{		
		
	}
	
		  
}
?>