<?php
//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');
require_once ($INSTALL_DIR.'inc/permissions_methods.class.php');

require_once ($ADODB_DIR."adodb.inc.php");

class permissions_modules{

//internal vars	
	var $num_methods; //Numero de metodos que contiene el modulo
	var $methods;	//Lista de metodos del modulo en cuestión
	var $id_module;   //Id del modulo
	var $module_name; //Nombre del modulo
	var $per;
	//var $list_methods; No hace falta porque la lista de metodos por módulo la encontraremos con el numero de metodos listando los nombres que aparecen en cada campo de per_module_methods
	
//
	var $per_modules;
	var $per_methods; //lista de permisos en metodos del modulo (objeto de clase permissions_methods)
	
//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $table_prefix;
	var $result; 
	var $db;
	var $sql;
	var $result;  	 	
  	
	//constructor
	function permissions_modules()
	{
		return $this;
	}
	
	function inicializar_base_datos(){
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
	
	
	
	function validate_per_group_module ($id_group, $id_module)
	{		
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		
		//mete la consulta
		$this->sql='SELECT `per`FROM `per_group_modules` WHERE `id_module`='.$id_module.' AND `id_group`='.$id_group;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		if ($this->result === false)
		{
			$this->error=1;
			$this->db->close();
			
			return false;
		}  
		
		$this->db->close();
		return $this->result->fields['per'];
		
	}
	

	function validate_per_user_module ($id_user, $module)
	{	
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		
		//mete la consulta
		$this->sql='SELECT `per`FROM `per_user_modules` WHERE `id_module`='.$module.' AND `id_user`='.$id_user;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		if ($this->result === false)
		{
			$this->error=1;
			$this->db->close();
			
			return false;
		}  
		
		$this->db->close();

		return $this->result->fields['per'];
		
	}
	
	function validate_per ($id_user, $module, $id_method)
	{
		$method = 1;
		$id_user = 1;
		$module = "usuarios";
		//print "Pasados usuario: ".$id_user.", modulo: ".$module.", metodo: ".$id_method;
		
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		
		$this->sql='SELECT `id_module` FROM `modules` WHERE `name`='."\"".$module."\"";
		$this->result = $this->db->Execute($this->sql);
		
		if ($this->result === false)
		{
			$this->error=1;
			$this->db->close();

			return false;
		} 
		
		$id_module=$this->result->fields['id_module'];
		
		//mete la consulta
		$this->sql='SELECT `per`FROM `per_user_modules` WHERE `id_module`='.$id_module.' AND `id_user`='.$id_user;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		if ($this->result === false)
		{
			$this->error=1;
			$this->db->close();
			
			return false;
		}  
		
		
		if ($this->result->fields['per'] == 1)
		{
			$this->sql='SELECT `per`FROM `per_user_methods` WHERE `id_method`='.$id_method.' AND `id_user`='.$id_user;
			//la ejecuta y guarda los resultados
			$this->result = $this->db->Execute($this->sql);
			if ($this->result === false)
			{
				$this->error=1;
				$this->db->close();

				return false;
			}  

			$this->db->close();
			return $this->result->fields['per'];
		}
			$this->db->close();
			return false;
	
	}


	//Función que indicará para qué tiene permisos un usuario (ya sea por los grupos a los que pertenece o por él mísmo)
	//Para ello se hará un listado de modulos_metodos_permiso en cada metodo de cada modulo
	//Se usará una lista de permissions que contendrá por cada id_modulo (indice de la lista) el metodo (nombre e id de este) y permiso
	//El nombre del modulo se puede obtener gracias al id_modulo desde la lista de modulos (modules->modules_list[$module_num]['name'])
	//
	function validate_per_module($id_user)
	{
	
		$this->inicializar_base_datos();
	
		$user = new users();
	
		//Se toma la lista de grupos a los que pertenece el usuario
		$num_groups = $user->get_groups($id_user); 
		
		
		$per = false;
		$this->per = 0;
		$num = 0;
	
		
		//Se comprueba si el usuario tiene permisos en el módulo
			
		$result = $this->validate_per_user_module($id_user, $this->id_module);

		if($result == true)
		{
			$per = true;
			$this->per = 1;
			//print "USER";
		}
		else //Se comprueba que alguno de los grupos al que pertenece tenga permiso
		{	
			while((!$per) && ($num < $num_groups))
			{
				$result = $this->validate_per_group_module ($user->groups_list[$num]['id_group'], $this->id_module);
				if($result == true)
				{
					$per=true;
					$this->per = 1;
				}
				
				$num++;
			}
		}
		
		$modules = new modules();
	
		$this->num_methods = $modules->get_list_module_methods($this->id_module);



		for ($metodo_num = 0; $metodo_num < $this->num_methods; $metodo_num++) 
		{
			//Como se tiene el numero de metodos de este modulo, entonces se puede ver nombre e identificador en $this->per_methods[$metodo_num]->name
			//Así será mas fácil recorrer la matriz, y no hay problemas de pasar un hash a smarty ya que no los acepta

			$this->per_methods[$metodo_num] = new permissions_methods();
			$this->per_methods[$metodo_num]->id_method = $modules->module_methods[$metodo_num]['id_method'];
			$this->per_methods[$metodo_num]->method_name = $modules->module_methods[$metodo_num]['name'];				
			$this->per_methods[$metodo_num]->method_name_web = $modules->module_methods[$metodo_num]['name_web'];
			if($per == true)
			{	
				$this->per_methods[$metodo_num]->validate_per_method($id_user, $this->per_methods[$metodo_num]->id_method);
			}
			else
			{
				$this->per_methods[$metodo_num]->per = 0;
				//print "NO MOdulo: metodo ".$this->method_name." permisos ".$this->per."............";
			}
		}
		
	}
	
	function validate_per_module_without_groups($id_user)
	{
	
		$this->inicializar_base_datos();
	
		$user = new users();
	
		//Se toma la lista de grupos a los que pertenece el usuario
		$num_groups = $user->get_groups($id_user); 
		
		
		$per = false;
		$this->per = 0;
		$num = 0;
	
		
		//Se comprueba si el usuario tiene permisos en el módulo
			
		$result = $this->validate_per_user_module($id_user, $this->id_module);

		if($result == true)
		{
			$per = true;
			$this->per = 1;
			//print "USER";
		}
		
		
		$modules = new modules();
	
		$this->num_methods = $modules->get_list_module_methods($this->id_module);



		for ($metodo_num = 0; $metodo_num < $this->num_methods; $metodo_num++) 
		{
			//Como se tiene el numero de metodos de este modulo, entonces se puede ver nombre e identificador en $this->per_methods[$metodo_num]->name
			//Así será mas fácil recorrer la matriz, y no hay problemas de pasar un hash a smarty ya que no los acepta

			$this->per_methods[$metodo_num] = new permissions_methods();
			$this->per_methods[$metodo_num]->id_method = $modules->module_methods[$metodo_num]['id_method'];
			$this->per_methods[$metodo_num]->method_name = $modules->module_methods[$metodo_num]['name'];				
			$this->per_methods[$metodo_num]->method_name_web = $modules->module_methods[$metodo_num]['name_web'];
			if($per == true)
			{	
				$this->per_methods[$metodo_num]->validate_per_method_without_groups($id_user, $this->per_methods[$metodo_num]->id_method);
			}
			else
			{
				$this->per_methods[$metodo_num]->per = 0;
				//print "NO MOdulo: metodo ".$this->method_name." permisos ".$this->per."............";
			}
		}
		
	}
	
}
?>	