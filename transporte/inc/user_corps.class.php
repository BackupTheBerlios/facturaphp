<?php

//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');

require_once ($ADODB_DIR."adodb.inc.php");


class user_corps{
	
//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $table_prefix;
	var $table_name='emps';
	var $ddbb_id_corp ='id_corp';
	var $db;
	var $result; 
	var $result1; 
	var $sql;
			
//Internas	
var $name_corp;
var $id_corp;
var $corps_list;
var $num_corps;



  	//constructor
	function user_corps()
	{
		$this->inicializar_base_datos();
		//return $this->get_user_corps($_SESSION['user']);
	}
	
	
	function inicializar_base_datos()
	{
		//coge las variables globales del fichero config.inc.php
		global $DDBB_TYPE, $DDBB_NAME, $IP_DDBB, $DDBB_USER, $DDBB_PASS, $DDBB_PORT, $TABLE_PREFIX;
		$this->db_type=$DDBB_TYPE;
		$this->db_name=$DDBB_NAME;
		$this->db_ip=$IP_DDBB;
		$this->db_user=$DDBB_USER;
		$this->db_passwd=$DDBB_PASS;
		$this->db_port=$DDBB_PORT;
		$this->table_prefix=$TABLE_PREFIX;
	}
			
	function calculate_tpl($method, $tpl)
	{
			
			$tpl=$this->listar($tpl);
			
			$tpl->assign('plantilla','emps_'.$method.'.tpl');	
			$tpl->assign('plantilla', 'user_corps_list.tpl');								
	
		return $tpl;
	}
	
	
	function listar($tpl)
	{
		$user = new users();
		$id_user = $user->get_id($_SESSION['user']);
		$emp = new emps();
		$num = $emp->get_user_corps($id_user);

		$tabla_listado = new table(true);
		$cadena=''.$tabla_listado->make_tables('user_corps',$emp->corps_list,array('Nombre',50),array('id_user','name'),10,array('view'),false);
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