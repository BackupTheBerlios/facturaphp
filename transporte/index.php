<?php

//Comprueba si existe la bbdd
//si no existe la bbdd va a la instalación
//aqui debe de irse a la instalación de la aplicación
//si existe la bbdd ya puede conectarse con lo que sea

//inicia o retoma una sesion
session_start();
//realiza todos los includes necesarios
require_once('inc/config.inc.php');
require_once('inc/index.inc.php');
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
		//registra la variable de sesion user con el nombre de usuario
		$_SESSION['user']=$_POST['user'];
		//como el usuario esta validado asigna su nombre a la plantilla
		$tpl->assign('user_name',$_SESSION['user']);
		$tpl->assign('login',0);
		//inicializa la plantilla principal de empresas a las que pertenece el usuario
		//El usuario está logeado y se le presenta la plantilla de las empresas con las que trabaja
		$index_template="index.tpl";

		
	}else{
		//printf('usuario no validado');
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
if(isset($_GET['module']))
{
	$module=$_GET['module'];
	$_SESSION['module']=$module;
	switch ($module)
	{
		case ('users'): 
		{
			$object= new users;
		}
	
	}
}

//coge el listado de modulos disponibles para el usuario
$module= new modules();
if(isset($_SESSION['user']))
{
	$modules_list=$module->get_list_modules_user($_SESSION['user']);
}
else
{
	$modules_list=$module->get_list_public_modules();

}

$tpl->assign('modules_list',$modules_list);

//coge las operaciones de ese modulo disponibles
if(isset($_GET['module'])||isset($_SESSION['module']))
{
	if(isset($_GET['module']))
	{
		$module_name=$_GET['module'];
	}
	else
	{
		$module_name=$_SESSION['module'];
	}
	$operations_list=$module->get_module_operations_list($module_name);
}

//Se indica si se trabaja con una empresa, con cuál se está trabajando
if((isset($_SESSION['user'])) && ((isset($_GET['module'])) && (isset($_GET['method']))))
{
	if(($_GET['module'] == 'user_corps') && ($_GET['method'] == 'select'))
		$_SESSION['corp'] = $_GET['id'];
}



//2 opciones:
//- El usuario no está logeado pero el módulo es público, en cuyo caso no habría problema
//- El usuario está logeado pero intenta entrar en un móudlo donde no tiene permisos
if(!isset($_SESSION['user']) && isset($_GET['module']))
{
	//Se comprueba si el modulo es público, sino es así se indica el error
	if($module->is_public_module($_GET['module']) == 0)
	{
		$module_name = 'error';
	}	
}

//Se comprueba que el usuario tenga permisos sobre el módulo que aparece en la barra de direccion
if(isset($_SESSION['user']) && isset($_GET['module']))
{
	//Se comprueba si el modulo es público si es así se deja no hay problema, pero sino se tendrá que saber si tiene o no acceso a él
	if($module->is_public_module($_GET['module']) == 0)
	{
		$permiso = new permissions_modules();
		
		//Se prepara para poder investigar los permisos en el modulo
		if (!isset($_GET['method']))
		{
			$method=null;
		}
		else
		{
			$method=$_GET['method'];
		}
		
		if($permiso->validate_per($_SESSION['user'], $_GET['module'], $method) == 0)
		{
			$module_name = 'error';	
		}
	}
}



//inicializar el objeto que corresponda
//en el caso de que no haya modulo definido se deja la plantilla por defecto
//en el caso de que no se haya pasado metodo se presenta el listado con la
//busqueda del modulo
$objeto= initialize_object($module_name);


//coge las sesiones abiertas y los usuarios registrados
$users= new users();
$num=$users->num;
$tpl->assign('num_users',$num);
$session= new sessions();
$num_sessions=$session->num();
$tpl->assign('num_sessions',$num_sessions);

//calcula la barra de navegaci—n y titulo de la pagina
if ($objeto===null)
{
	$nav_bar='Gesti&oacute;n';
	$title='Gesti&oacute;n';
	$plantilla='wellcome.tpl';
	$tpl->assign('plantilla',$plantilla);
}
else
{	
	//Se obtiene el nombre de la empresa en la que se está trabajando
	if(!isset($_SESSION['corp']))
		$corp = "";
	else
	{
		$my_corp = new corps();
		$my_corp->read($_SESSION['corp']);
		$corp = $my_corp->name;
	}	

		
	///*************************************
	
	//En este orden
	$tpl=$objeto->calculate_tpl($method,$tpl);
	$nav_bar=$objeto->bar($method,$corp);
	$title=$objeto->title($method,$corp);
	
 
	//elige la plantilla a presentar
	
}
	//pasa las variables de la presentaci—n a la plantilla dependiente del objeto

	$tpl->assign('title',$title);
	$tpl->assign('nav_bar',$nav_bar);
	
//presenta las plantillas

// ****************************** prueba de lectura de usuarios
//$obje=new users();
//*********************************************** listado
 //listado
/* $tpl=$obje->listar($tpl);
 //fin listadohttp://127.0.0.1/transporte/index.php*/

/* ***************************** Edicion
$obje->read(1);
$tpl->assign('objeto',$obje);
*/ //***************** fin Edicion

//********************************************** Vista
//$tpl=$obje->view(1,$tpl);

// ****************************** fin Vista*/

$tpl->display($index_template);
//print_r($post_user);
?>