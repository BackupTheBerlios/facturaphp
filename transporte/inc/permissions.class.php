<?php
//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');


require_once ($ADODB_DIR."adodb.inc.php");

class permissions{
//internal vars
	var $method_name;
	var $id_method;
	var $per;
	var $permissions_module;
	var $add;


	//constructor
	function permissions()
	{
		return $this;
	}
	
	function add_permissions($name, $id, $valor)
	{
		$this->method_name = $name;
		$this->id_method = $id;
		$this->per = $valor;
	}
	
	function add_module ($module_n, $id_mo)
	{
		$this->module_name = $module_n;
		$this->id_module = $id_mo;
	}
	
	function add_method ($method_n, $id_me)
	{
		$this->method_name = $method_n;
		$this->id_method = $id_me;
	}
	
	function add_per ($valor_per)
	{
		$this->per = $valor_per;
	}
	
	function get_permissions_list($module)
	{
		
		if($_SESSION['super'] || $_SESSION['admin'])
		{
			$this->permissions_module = array('view', 'modify', 'delete');
			$this->add = true;
			return 3;
		}
		else
		{
			$user = new users();
			$id_user = $user->get_id($_SESSION['user']);
			$user->validate_per_user($id_user);
		
			$this->permissions_module = array();
		
			for($i = 0; $i < $user->num_modules; $i++)
			{
				//Si coincide el modulo a buscar con el que estamos estudiando
				if($user->per_modules[$i]->module_name == $module)
				{
					$j = 0;
					for($k = 0; $k < $user->per_modules[$i]->num_methods; $k++)
					{
						//Si tiene permiso sobre el metodo se añade al array
						if($user->per_modules[$i]->per_methods[$k]->per == 1)
						{
							$this->per_add = false; 
						
							if(($user->per_modules[$i]->per_methods[$k]->method_name == 'view') || ($user->per_modules[$i]->per_methods[$k]->method_name == 'modify') || ($user->per_modules[$i]->per_methods[$k]->method_name == 'delete'))
							{
								$this->permissions_module[$j] = $user->per_modules[$i]->per_methods[$k]->method_name;
								$j++;
							}
						
							if($user->per_modules[$i]->per_methods[$k]->method_name == 'add')
							{
								$this->add = true;
							}
						}
					}
					
					return $j-1;	
				}
			}
		
		}
	
	}
	
}
?>