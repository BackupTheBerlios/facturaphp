<?php
//Comprueba si existe la bbdd
//si no existe la bbdd va a la instalación
//aqui debe de irse a la instalación de la aplicación
//si existe la bbdd ya puede conectarse con lo que sea

//inicia o retoma una sesion
session_start();

//realiza todos los includes necesarios
//Si estamos en windows comentar el config que tenga / si no comentar el config \\
//require_once('inc\\config.inc.php');
require_once('inc/config.inc.php');
global $INSTALL_DIR;
require_once('inc/index.inc.php');

//En inc/photos.php realizan las operaciones necesarias por cada modulo para el trabajo con las fotos
require_once($INSTALL_DIR.'inc/photos.php');
require_once($INSTALL_DIR.'inc/includes.php');
//inicializamos algunas variables
$title="::Gesti&oacute;n::";
$nav_bar="::Gesti&oacute;n::";

//inicializa una plantilla
$tpl= new template;



/******************************************* Identificación de usuario ***************************************************/

//comprueba si existe el usuario en la sesion
if(!isset($_SESSION['user']))
{
	//comprobamos si estan mandando el formulario
	$post_user= new users(); 
	if(isset($_POST['passwd'])&& isset($_POST['user'])&&$post_user->validate_user($_POST['user'],$_POST['passwd'])==1)
	{	
		//registra la variable de sesion user con el nombre de usuario
		$_SESSION['user']=$_POST['user'];
		
		//Se busca registro de la sesión (ya se conoce al usuario)
		$session=new sessions();
		$_SESSION['ident_sesion'] = $session->register();

		
		//Comprueba si es admin o super
		$user = new users();
		$id_user = $user->get_id($_SESSION['user']);
		$num_groups = $user->get_groups($id_user);
		
		$_SESSION['super'] = false;
		$_SESSION['admin'] = false;
		
		for($i = 0; $i < $num_groups; $i++)
		{	
			if($user->groups_list[$i]['id_group'] == 2)
			{
				$_SESSION['admin'] = true;

			}
			else
			if($user->groups_list[$i]['id_group'] == 1)
			{	

				$_SESSION['super'] = true;				
			}
		}

		//Inicia empresas a 0 (no se conoce empresa con la que se quiere trabajar)
		$_SESSION['ident_corp'] = 0;
		
		//Se crea coockie
		if(!isset($_COOKIE[session_name()]))
       	{
           // Gives the user 30 seconds to type the password.
           // Should be enough :-)
           setcookie(session_name(), 1,time()+60);
       	}

		//Se busca registro de la sesión (ya se conoce al usuario) y se introduce al usuario
		
		//como el usuario esta validado asigna su nombre a la plantilla
		$tpl->assign('user_name',$_SESSION['user']);
		$tpl->assign('login',0);
		//inicializa la plantilla principal de empresas a las que pertenece el usuario
		//El usuario está logeado y se le presenta la plantilla de las empresas con las que trabaja
		$index_template="index.tpl";	
	}
	else
	{
		//printf('usuario no validado');
		if(isset($_POST['user']))
		{
				//segundo intento
				$tpl->assign('user_name', $_POST['user']);
				$tpl->assign('error',1);
				$tpl->assign('login',1);
		}
		else
		{
			//primer intento
			$tpl->assign('user_name','');
			$tpl->assign('error',0);
			$tpl->assign('login',1);
		}
		$index_template='login.tpl';	
	
	}
	
}
else
{
	//usuario registrado en la sesion
	if(isset($_POST['submit'])&& $_POST['submit']=='Desconectar')
	{
		$session=new sessions();
		$session->unregister();
		unset($_COOKIE[session_name()]);
		session_unset();
		session_destroy();
		session_start();
		
		$tpl->assign('user_name','');
		$tpl->assign('corp_id',0);
		$tpl->assign('error',0);
		$tpl->assign('login',1);
		$index_template='index.tpl';
	}
	else
	{
		$tpl->assign('user_name',$_SESSION['user']);
		$tpl->assign('login',0);
		$index_template='index.tpl';
	} 
}

//identifica el usuario el modulo y la operacin
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


/************************************ Se preparan menus ************************************************/

//coge el listado de modulos disponibles para el usuario
$menu = new menu();

$tpl->assign('modules_list',$menu->table_modules(-2));
$tpl->assign('public_modules',$menu->table_modules(0));
$module=new modules();
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


/********************************* Comprobación de permisos **************************************************/

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
	if((!$_SESSION['super']) && (!$_SESSION['admin']))
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
		
			if(($_GET['module'] != 'user_corps') &&($method != 'select'))
			{
				if($permiso->validate_per($_SESSION['user'], $_GET['module'], $method) == 0)
				{
					$module_name = 'error';	
				}
			}
		}
	}
	else
	if($_SESSION['admin'] && (!$_SESSION['super']) && ($_GET['module'] == 'modules' || $_GET['module'] == 'methods'))
	{
		$module_name = 'error';	
	}
}


/******************************** Operaciones con modulos ***********************************************************************************/

//Se comprueba si se pasa de nuevo a elegir empresa
if(isset($_GET['module'])&& (!isset($_GET['method']))&&($_GET['module']=='user_corps'))
{
	//registra la variable de sesion ident_corp con el identificador nulo para diferenciar en los menús
	$_SESSION['ident_corp']=0;
}

//Se indica si se trabaja con una empresa, con cuál se está trabajando
//Se comprueba si estan eligiendo empresa
if(isset($_GET['module'])&& isset($_GET['method'])&&(($_GET['module']=='user_corps')&&($_GET['method']=='select')))
{	
	//registra la variable de sesion user con el nombre de usuario
	$_SESSION['ident_corp']=$_GET['id'];
	
}	

		
/*************************** Preparación de la plantilla a mostrar ***************************************************/

//inicializar el objeto que corresponda
//en el caso de que no haya modulo definido se deja la plantilla por defecto
//en el caso de que no se haya pasado metodo se presenta el listado con la
//busqueda del modulo
$objeto= initialize_object($module_name);


//coge las sesiones abiertas y los usuarios registrados
$users= new users();
$tpl->assign('num_users',$users->registrados);
$session= new sessions();
$num_sessions=$session->conectados();
print "Ya se tine conectads";
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
	///*************************************
	
	//En este orden
	if (!isset($_GET['method']))
	{
		$method=null;
	}
	else
	{
		$method=$_GET['method'];
	}
	$tpl=$objeto->calculate_tpl($method,$tpl);
	
	
	//Se obtiene el nombre de la empresa en la que se está trabajando
	if($_SESSION['ident_corp']==0)
	{
		$corp = "";
	}
	else
	{
		$my_corp = new corps();
		$my_corp->read($_SESSION['ident_corp']);
		$corp = $my_corp->name;
	}	
	
	$nav_bar=$objeto->bar($method,$corp);
	$title=$objeto->title($method,$corp);
	
 
	//elige la plantilla a presentar
	
}
	//pasa las variables de la presentaci—n a la plantilla dependiente del objeto

	$tpl->assign('title',$title);
	$tpl->assign('nav_bar',$nav_bar);


$tpl->display($index_template);
//print_r($post_user);
?>