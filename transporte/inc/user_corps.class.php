<?php
//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');

require_once ($ADODB_DIR."adodb.inc.php");


//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');

require_once ($ADODB_DIR."adodb.inc.php");


class user_corps{
var $name_corp;
var $id_corp;



  	//constructor
	function user_corps()
	{
	}
	
	
		
	
	function calculate_tpl($method, $tpl)
	{
		$user = new users();
		$id_user = $user->get_id($_SESSION['user']);
		$emp = new emps();
		$num = $emp->get_user_corps($id_user);
		$tpl->assign('user_corps', $emp->corps_list);	
		$tpl->assign('plantilla', 'user_corps.tpl');					
		
		return $tpl;
	}
	
	function bar($method,$corp){		
		if ($corp != ""){
			$corp='<a href="index.php">'.$corp.' ::';
		}
		$nav_bar = '<a href="index.php">Zona privada</a> :: '.$corp.' <a href="index.php?module=user_corps">Usuario empresas</a>';
		$nav_bar=$nav_bar;
		return $nav_bar;
	}	

	function title($method,$corp){
		if ($corp != ""){
			$corp=$corp." ::";
		}
		$title = "Zona Privada :: $corp Usuario empresas";
		$title=$title;		
		return $title;
	}	
	
	
}
?>