<?php

//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');

require_once ($ADODB_DIR."adodb.inc.php");


class user_corps{
				
//Internas	
var $emp;




  	//constructor
	function user_corps()
	{
		
	}

	
	function calculate_tpl($method, $tpl)
	{
		
		switch($method)
		{
				case 'select':	
				
								$my_corp = new corps();
								$tpl = $my_corp->view($_SESSION['ident_corp'],$tpl);
								$tpl->assign('plantilla','corps_view.tpl');	
								break;
				default:
								$method='list';
								$user = new users();
								$id_user = $user->get_id($_SESSION['user']);

								$this->emp = new emps();
								$num_corps = $this->emp->get_user_corps($id_user);
								$tpl=$this->listar($tpl);

								if($num_corps == 1)
								{
									$_SESSION['ident_corp'] = $this->emp->corps_list[0]['id_corp'];
									$my_corp = new corps();
									$tpl = $my_corp->view($this->emp->corps_list[0]['id_corp'],$tpl);
									$tpl->assign('plantilla','corps_view.tpl');	
								}
								else
									$tpl->assign('plantilla','user_corps_'.$method.'.tpl');	
								break;
		}
			
		
		return $tpl;
	}
	
	
	function listar($tpl)
	{
		$tabla_listado = new table(true);
		$cadena=''.$tabla_listado->make_tables('user_corps',$this->emp->corps_list,array('Nombre',50),array('id_corp','name'),10,array('select'),false);
		$variables=$tabla_listado->nombres_variables;		
		$tpl->assign('variables',$variables);
		$tpl->assign('cadena',$cadena);		
		return $tpl;
	}
	
	function bar($method,$corp){		
		if ($corp != ""){
			$corp='<a href="index.php?module=user_corps&method=select&id='.$_SESSION['ident_corp'].'">'.$corp.' ::';
		}
		$nav_bar = '<a>Zona privada</a> :: '.$corp.' <a href="index.php?module=user_corps">Usuario empresas</a>';
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