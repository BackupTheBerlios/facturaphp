<?php
global $INSTALL_DIR;

require_once($INSTALL_DIR.'inc/includes.php');

function initialize_object($module)
{
	switch($module){
		case 'users':
					$objeto=new users();		
					break;
		case 'user_corps':
					$objeto=new user_corps();		
					break;
		case 'clients':
					$objeto=new clients();		
					break;
		case 'groups':
					$objeto=new groups();
					break;
		case 'modules':
					$objeto=new modules();
					break;
		case 'corps':
					$objeto=new corps();
					break;					
		case 'emps':
					$objeto=new emps();
					break;
		case 'cat_emps':
					$objeto=new cat_emps();
					break;
		case 'holidays':
					$objeto=new holidays();
					break;
		case 'methods':
					$objeto=new methods();
					break;
		case 'news':
					$objeto=new news();
					break;
		case 'contact':
					$objeto=new contact();
					break;
		case 'products':
					$objeto=new products();
					break;
		case 'services':
					$objeto=new services();
					break;
		case 'error':
					$objeto=new error();
					break;
		default:		
					if(!isset($_SESSION['user']))
					{
						$objeto = null;
					}
					else
					{
						$objeto=new user_corps();	
					} 
					break;
	}
	
	return $objeto;
}


?>