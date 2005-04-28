<?php

//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');

require_once ($ADODB_DIR."adodb.inc.php");


class user_groups{
				
//Internas	
var $emp;




  	//constructor
	function user_groups()
	{
		
	}

	
	function calculate_tpl($method, $tpl)
	{
		
		switch($method)
		{
				case 'select':	
				
								$my_group = new groups();
								$tpl = $my_group->view($_SESSION['ident_group'],$tpl);
								$tpl->assign('plantilla','groups_view.tpl');	
								break;
				default:
								$method='list';
								$user = new users();
								$id_user = $_SESSION['ident_user'];
								
								$this->emp = new emps();
								$num_groups = $this->emp->get_user_groups($id_user);
								$tpl=$this->listar($tpl);
	//Empieza comentado
								if($_SESSION['super'] || $_SESSION['admin'])
								{
									$tpl->assign('plantilla','user_groups_'.$method.'.tpl');	
								}
								else
								{
								//Fin comentado
									if($num_groups == 1)
									{
										$_SESSION['ident_group'] = $this->emp->groups_list[0]['id_group'];
										$my_group = new groups();
										$tpl = $my_group->view($_SESSION['ident_group'],$tpl);
										$tpl->assign('plantilla','groups_view.tpl');	
										
									}
									else
										$tpl->assign('plantilla','user_groups_'.$method.'.tpl');	
							//Empieza comentado			
								}
								//Fin cometnado
								break;
		}
			
		
		return $tpl;
	}
	
	
	function listar($tpl)
	{
		$tabla_listado = new table(true);
		//Empieza comentado
		if($_SESSION['super'] || $_SESSION['admin'])
		{
			$my_group = new groups();
			$my_group->get_list_groups();
			$cadena=''.$tabla_listado->make_tables('user_groups',$my_group->groups_list,array('Nombre',50),array('id_group','name'),10,array('select'),false);
			$variables=$tabla_listado->nombres_variables;		
			$tpl->assign('variables',$variables);
			$tpl->assign('cadena',$cadena);		
			return $tpl;
			
		}
		
		//Fin comentado
		$cadena=''.$tabla_listado->make_tables('user_groups',$this->emp->groups_list,array('Nombre',50),array('id_group','name'),10,array('select'),false);
		$variables=$tabla_listado->nombres_variables;		
		$tpl->assign('variables',$variables);
		$tpl->assign('cadena',$cadena);		
		return $tpl;
	}
	
	function bar($method,$group){		
		if ($group != ""){
			$group='<a href="index.php?module=groups&method=view&id='.$_SESSION['ident_group'].'">'.$group.' ::';
		}
		$nav_bar = 'Zona privada :: '.$group.' <a href="index.php?module=user_groups">Usuario grupos</a>';
		$nav_bar=$nav_bar;
		return $nav_bar;
	}	

	function title($method,$group)
	{
		if ($group != "")
		{
			$group=$group." ::";
		}
		$title = "Zona Privada :: $group Usuario grupos";
		$title=$title;		
		return $title;
	}		
	

	
	}
?>