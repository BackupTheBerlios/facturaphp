<?php

//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');

require_once ($ADODB_DIR."adodb.inc.php");


class user_corps{
				
//Internas	
var $num_corps;



  	//constructor
	function user_corps()
	{
		
	}
	
	
	
	/*		
	function calculate_tpl($method, $tpl)
	{
			
			$tpl=$this->listar($tpl);
			
			$tpl->assign('plantilla','emps_'.$method.'.tpl');	
			$tpl->assign('plantilla', 'user_corps_list.tpl');								
	
		return $tpl;
	}*/
	
	
	function calculate_tpl($method, $tpl)
	{
		
		switch($method)
		{
				case 'select':	
								//Asignar corp
								
								$tpl->assign('plantilla','resuival.tpl');	
								break;
				default:
								$method='list';
								$tpl=$this->listar($tpl);

								if($this->num_corps == 1)
									$tpl->assign('plantilla','resuival.tpl');	
								else
									$tpl->assign('plantilla','user_corps_'.$method.'.tpl');	
								break;
		}
			
		
		return $tpl;
	}
	
	
	function listar($tpl)
	{
		$user = new users();
		$id_user = $user->get_id($_SESSION['user']);
		$emp = new emps();
		$this->num_corps = $emp->get_user_corps($id_user);

		$tabla_listado = new table(true);
		$cadena=''.$tabla_listado->make_tables('user_corps',$emp->corps_list,array('Nombre',50),array('id_user','name'),10,array('select'),false);
		$variables=$tabla_listado->nombres_variables;		
		$tpl->assign('variables',$variables);
		$tpl->assign('cadena',$cadena);		
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

	function title($method,$corp)
	{
		if ($corp != "")
		{
			$corp=$corp." ::";
		}
		$title = "Zona Privada :: $corp Usuario empresas";
		$title=$title;		
		return $title;
	}		
	

	
	}
?>