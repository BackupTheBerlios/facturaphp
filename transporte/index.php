<?php

//Comprueba si existe la bbdd
//si no existe la bbdd va a la instalaci—n
//aqui debe de irse a la instalaci—n de la aplicaci—n
//si existe la bbdd ya puede conectarse con lo que sea

//inicia o retoma una sesion
session_start();
//realiza todos los includes necesarios
require_once('inc/config.inc.php');
global $INSTALL_DIR;

require_once($INSTALL_DIR.'inc/includes.php');
//inicializamos algunas variables
$title="::Gesti&oacute;n::";
$nav_bar="::Gesti&oacute;n::";

//inicializa una plantilla
$tpl= new template;
//comprueba si existe el usuario en la sesion
if(!isset($_SESSION['user'])){
	//comprobamos si estan mandando el formulario
	$post_user= new users(); 
	if(isset($_POST['passwd'])&& isset($_POST['user'])&&$post_user->validate_user($_POST['user'],$_POST['passwd'])==1){
		//printf('usuario validado');
		$session=new sessions();
		$session->register();
		//registra la variable de sesion user cone l nombre de usuario
		$_SESSION['user']=$_POST['user'];
		//como el usuario esta validado asigna su nombre a la plantilla
		$tpl->assign('user_name',$_SESSION['user']);
		$tpl->assign('login',0);
		//inicializa la plantilla de index del programa principal
		$index_template="index.tpl";	
		
	}else{
		//usuario no validado
			if(isset($_POST['user'])){
				//segundo intento
				$tpl->assign('user_name', $_POST['user']);
				$tpl->assign('error',1);
				$tpl->assign('login',1);
			}else{
				//primer intento
				$tpl->assign('user_name','');
				$tpl->assign('error',0);
				$tpl->assign('login',1);
			}
			$index_template='login.tpl';	
	
	}
	
}else{
	//usuario registrado en la sesion
	if(isset($_POST['submit'])&& $_POST['submit']=='Desconectar'){
		session_destroy();
		session_start();
		$tpl->assign('user_name','');
		$tpl->assign('error',0);
		$tpl->assign('login',1);
		$index_template='index.tpl';
	}else{
	$tpl->assign('user_name',$_SESSION['user']);
	$tpl->assign('login',0);
	$index_template='index.tpl';
	} 
}



//identifica el usuario el modulo y la operaci—n
if(isset($_GET['module'])){
	$module=$_GET['module'];
	$_SESSION['module']=$module;
	switch ($module){
		case ('users'): {
			$object= new users;
		}
	
	}
}

//coge el listado de modulos disponibles para el usuario
$module= new modules();
if(isset($_SESSION['user'])){
$modules_list=$module->get_list_modules_user($_SESSION['user']);
}else{
	$modules_list=$module->get_list_public_modules();

}
$tpl->assign('modules_list',$modules_list);
//coge las operaciones de ese modulo disponibles
if(isset($_GET['module'])||isset($_SESSION['module'])){
	if(isset($_GET['module'])){
		$module_name=$_GET['module'];
	}else{
		$module_name=$_SESSION['module'];
	}
	$operations_list=$module->get_module_operations_list($module_name);
}

//coge las sesiones abiertas y los usuarios registrados
$users= new users();
$num=$users->num;
$tpl->assign('num_users',$num);
$session= new sessions();
$num_sessions=$session->num();
$tpl->assign('num_sessions',$num_sessions);
//calcula la barra de navegaci—n y titulo de la pagina

//calcula la plantilla a presentar

//pasa las variables de la presentaci—n a la plantilla dependiente del objeto



$tpl->assign('title',$title);
$tpl->assign('nav_bar',$nav_bar);

 
//elige la plantilla a presentar
//presenta las plantillas
$tpl->display($index_template);
?>