<?php
global $INSTALL_DIR;

require_once($INSTALL_DIR.'inc/includes.php');

function initialize_object($module){	
	
	switch($module){
		case 'users':
					$objeto=new users();		
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
		case 'holidays':
					$objeto=new holidays();
					break;
		case 'methods':
					$objeto=new methods();
					break;
		default:		
					$objeto = null; 
					break;
	}
	
	return $objeto;
}


?>