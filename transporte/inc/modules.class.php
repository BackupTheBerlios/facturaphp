<?php
//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($ADODB_DIR."adodb.inc.php");
class modules{
//internal vars
	var $id_module;
	var $name_web;
	var $name;
	var $path;
	var $active;
	var $theme;
	var $publico;
	var $parent;
//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $table_prefix;
	var $table_name='modules';
	var $ddbb_id_module='id_module';
  	var $ddbb_name_web='name_web';
  	var $ddbb_name='name';
  	var $ddbb_path='path';
  	var $ddbb_active='active';
	var $ddbb_public='public';
	var $ddbb_parent = 'parent';
	var $db;
	var $result;  	
//variables complementarias	
  	var $modules_list;
  	var $num;
  	var $fields_list;
  	var $error;
	var $module_methods;
	var $public_modules;
	var $method;
	var $module_meth;
	var $module_methods;
  	//constructor
	function modules(){
		//coge las variables globales del fichero config.inc.php
		global $DDBB_TYPE, $DDBB_NAME, $IP_DDBB, $DDBB_USER, $DDBB_PASS, $DDBB_PORT, $TABLE_PREFIX;
		$this->db_type=$DDBB_TYPE;
		$this->db_name=$DDBB_NAME;
		$this->db_ip=$IP_DDBB;
		$this->db_user=$DDBB_USER;
		$this->db_passwd=$DDBB_PASS;
		$this->db_port=$DDBB_PORT;
		$this->table_prefix=$TABLE_PREFIX;
		//define el array asociativo de los tipos de datos de los campos de la tabla
		/*****************
		//Importante
		//aqui hay que mirar las funciones meta de adodb para ver si podemos rellenar
		//este array de alguna manera aumatizada
		************************/
		$this->fields_list= new fields();
		$this->fields_list->add($this->ddbb_id_module, $this->id_module, 'int', 11,0);
		$this->fields_list->add($this->ddbb_name_web, $this->name_web, 'varchar', 50,0);
		$this->fields_list->add($this->ddbb_name, $this->name, 'varchar', 50,0);
		$this->fields_list->add($this->ddbb_path, $this->path, 'varchar', 255,0);
		$this->fields_list->add($this->ddbb_active, $this->active, 'tinyint', 3,0);	
		$this->fields_list->add($this->ddbb_public, $this->publico, 'tinyint', 3,0);
		$this->fields_list->add($this->ddbb_parent, $this->parent, 'tinyint', 3,0);	
		//print_r($this);
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi�n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi�n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$error=1;
			return 0;
		}  
		$this->db->close();
		
		return $this->get_list_modules();	 
		
	}
	
	function get_list_modules (){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi�n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi�n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$this->error=1;
			$this->db->close();

			return 0;
		}  
		
		$this->num=0;
		while (!$this->result->EOF) {
			//cogemos los datos del usuario
			$this->modules_list[$this->num][$this->ddbb_id_module]=$this->result->fields[$this->ddbb_id_module];
			$this->modules_list[$this->num][$this->ddbb_name_web]=$this->result->fields[$this->ddbb_name_web];
			$this->modules_list[$this->num][$this->ddbb_name]=$this->result->fields[$this->ddbb_name];
			$this->modules_list[$this->num][$this->ddbb_path]=$this->result->fields[$this->ddbb_path];
			$this->modules_list[$this->num][$this->ddbb_active]=$this->result->fields[$this->ddbb_active];
			$this->modules_list[$this->num][$this->ddbb_public]=$this->result->fields[$this->ddbb_public];
			$this->modules_list[$this->num][$this->ddbb_parent]=$this->result->fields[$this->ddbb_parent];
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		return $this->num;
	
	}
	
	function get_list_module_methods($id_module)
	{
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi�n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi�n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT `name`, `id_method`,`name_web` FROM `methods` WHERE `id_module` =".$id_module;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$this->error=1;
			$this->db->close();

			return 0;
		}  
		
		$this->num = 0;
		while (!$this->result->EOF)
		{
			$this->module_methods[$this->num]['name']=$this->result->fields['name'];
			$this->module_methods[$this->num]['id_method']=$this->result->fields['id_method'];
			$this->module_methods[$this->num]['name_web']=$this->result->fields['name_web'];			
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		return $this->num;	
	}
	
	function get_list_public_modules()
	{
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi�n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi�n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$uno = 1;
		$this->sql="SELECT `name`, `id_module`, `name_web` FROM `modules` WHERE `public` =".$uno;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$this->error=1;
			$this->db->close();
			return 0;
		}  
		
		$this->num = 0;
		while (!$this->result->EOF)
		{
			$this->public_modules[$this->num][0]=$this->result->fields['name'];
			$this->public_modules[$this->num][1]=$this->result->fields['id_module'];
			$this->public_modules[$this->num][2]=$this->result->fields['name_web'];
			
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		
		return $this->num;	
	}
	
	function is_public_module($name_module)
	{
	
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi�n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi�n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$uno = 1;
		$this->sql="SELECT `public` FROM `modules` WHERE `name` =\"".$name_module."\"";
	
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false)
		{
			$this->error=1;
			$this->db->close();
			return 0;
		}  
		
		return $this->result->fields['public'];	
	}
	
	
	function get_add_form(){
	
		
	
	}
	
	function print_add_form(){
	
	}
	
	function validate_add_form(){
	
	}
	
	function get_modify_form(){
	
	}
	
	function print_modify_form(){
	
	}
	
	function validate_modify_form(){
	
	}
	
	function get_id($name)
	{
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT `id_module` FROM `modules` WHERE `name` = \"".$name."\"";
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$this->error=1;
			$this->db->close();

			return 0;
		}  
		
		return $this->result->fields['id_module'];
	}
	
	function read($id){
	
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi�n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi�n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name." WHERE ".$this->ddbb_id_module."= \"".$id."\"";
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$error=1;
			return 0;
			$this->db->close();
		}else{
			$this->id_module=$id;
			$this->name_web=$this->result->fields[$this->ddbb_name_web];
			$this->name=$this->result->fields[$this->ddbb_name];
			$this->path=$this->result->fields[$this->ddbb_path];
			$this->active=$this->result->fields[$this->ddbb_active];
			$this->publico=$this->result->fields[$this->ddbb_public];
			$this->parent=$this->result->fields[$this->ddbb_parent];
			$this->db->close();
			return 1;
		}
		
	
	}
	
	function add(){
	if (!isset($_POST['submit_add'])){
			//Mostrar plantilla vac�a				
			
			return 0;
		}
		//en el caso de que SI este definido submit_add
		else{
						
			//Introducir los datos de post.
			$this->get_fields_from_post();	
						
			//Validacion
			//$return=validate_fields();
			
			//En caso de que la validacion haya sido fallida se muestra la plantilla
			//con los campos erroneos marcados con un *
			$return=true; //Para pruebas dejar esta linea sin comentar
			
			if (!$return){
				//Mostrar plantilla con datos erroneos
				
			}
			else{
				//Si todo es correcto si meten los datos
				
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi�n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi�n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta para coger los campos de la bbdd
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_module." = -1" ;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$this->error=1;
			$this->db->close();
			return 0;
		}
		//rellenamos el array con los datos de los atributos de la clase
		$record = array();
		$record[$this->ddbb_name_web] = $this->name_web;
		$record[$this->ddbb_name]=$this->name;
		$record[$this->ddbb_path]=$this->path;
		$record[$this->ddbb_active]=$this->active;
		$record[$this->ddbb_public]=$this->publico;
		$record[$this->ddbb_parent]=$this->parent;
		//calculamos la sql de inserci�n respecto a los atributos
		$this->sql = $this->db->GetInsertSQL($this->result, $record);
		//print($this->sql);
		//insertamos el registro
		$this->db->Execute($this->sql);
		//si se ha insertado una fila
		if($this->db->Insert_ID()>=0){
			//capturammos el id de la linea insertada
			$this->id_module=$this->db->Insert_ID();
			$this->add_methods($this->id_module);
			//print("<pre>::".$this->id_module."::</pre>");
			//devolvemos el id de la tabla ya que todo ha ido bien
			$this->db->close();
			return $this->id_module;
		}else {
			//devolvemos 0 ya que no se ha insertado el registro
			$this->error=-1;
			$this->db->close();
			return 0;
		}	
	}}		
	}
	
	function calculate_tpl($method, $tpl){
		$this->method=$method;
				switch($method){
						case 'add':									
									if ($this->add() !=0){
										$this->method="list";
										$tpl=$this->listar($tpl);										
										$tpl->assign("message","&nbsp;<br>M&oacute;dulo a&ntilde;adido correctamente<br>&nbsp;");
									}
									$tpl->assign("padres",$this->modules_list);
									$tpl->assign("objeto",$this);
									break;
									
						case 'list':
									$tpl=$this->listar($tpl);
									break;
						case 'modify':
									$this->read($_GET['id']);
						
									
									if ($this->modify() !=0){
										$this->method="list";
										$tpl=$this->listar($tpl);										
										$tpl->assign("message","&nbsp;<br>M&oacute;dulo modificado correctamente<br>&nbsp;");
									}
									$tpl->assign("objeto",$this);
									$tpl->assign("module_methods",$this->module_methods);
									$tpl->assign("padres",$this->modules_list);
									break;
						case 'delete':
									$this->read($_GET['id']);
									if ($this->remove($_GET['id'])==0){
										$tpl->assign("message",$this->empleados);
									}
									else{
										$this->modules_list="";
										$this->method="list";
										$tpl=$this->listar($tpl);
										$tpl->assign("message","&nbsp;<br>M&oacute;dulo borrado correctamente<br>&nbsp;");
									}
									$tpl->assign("objeto",$this);
									break;
						case 'view':									
									$tpl=$this->view($_GET['id'],$tpl);
									break;
						default:
									$this->method='list';
									$tpl=$this->listar($tpl);
									break;
					}
				$tpl->assign('plantilla','modules_'.$this->method.'.tpl');					
		
		return $tpl;
	}
	
	function remove($id){
		if (!isset($_POST["submit_delete"])){
			//Miramos a ver si hay algun empleado que tenga este modulo
				return 0;
		}
		else{
			$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
			//crea una nueva conexi�n con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexi�n permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.
			$this->sql="DELETE FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_module." = ".$id." LIMIT 1";
			//la ejecuta y guarda los resultados
			$this->result = $this->db->Execute($this->sql);
			//si falla 
			if ($this->db->Affected_Rows() == 0){			
				$this->error=1;
				$this->db->close();
				return 0;
			}else{
				$this->delete_methods($id);
				$this->delete_per_methods($id);

				
				$this->error=0;
				$this->db->close();
				return 1;
				
			}
		}
	}
	
	function modify(){
	if (!isset($_POST['submit_modify'])){
			//Mostrar plantilla vac�a	
			//pasarle a la plantilla los modulos y grupos con sus respectivos checkbox a checked false
			$this->get_methods($this->id_module);			
			
			
			return 0;
		}
		else{
			//Introducir los datos de post.
			$this->get_fields_from_post();
			//$this->insert_post();
			
			//Validacion
			//$return=validate_fields();
			
			//En caso de que la validacion haya sido fallida se muestra la plantilla
			//con los campos erroneos marcados con un *
			$return=true; //Para pruebas dejar esta linea sin comentar
			
			if (!$return){
				//Mostrar plantilla con datos erroneos
				
			}
			else{
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi�n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi�n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta para coger los campos de la bbdd
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_module." = \"".$this->id_module."\"" ;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$this->error=1;
			$this->db->close();
			return 0;
		}
		//rellenamos el array con los datos de los atributos de la clase
		$record = array();
		$record[$this->ddbb_id_module]=$this->id_module;
		$record[$this->ddbb_name_web] = $this->name_web;
		$record[$this->ddbb_name]=$this->name;
		$record[$this->ddbb_path]=$this->path;
		$record[$this->ddbb_active]=$this->active;
		$record[$this->ddbb_public]=$this->publico;
		$record[$this->ddbb_parent]=$this->parent;
		//calculamos la sql de inserci�n respecto a los atributos
		$this->sql = $this->db->GetUpdateSQL($this->result, $record);
		//insertamos el registro
		$this->db->Execute($this->sql);
		//si se ha insertado una fila
		
		if(($this->db->Affected_Rows()==1)||($this->sql=="")){
			$this->modify_methods();

			//capturammos el id de la linea insertada
			$this->db->close();
			//devolvemos el id de la tabla ya que todo ha ido bien
			return $this->id_module;
		}else {
			//devolvemos 0 ya que no se ha insertado el registro
			$this->error=-1;
			$this->db->close();
			return 0;
		}

			}}
	}
		function view ($id,$tpl){
	/*
		Cosas que faltan por hacer:
			De forma general, mirar los permisos del usuario que vaya a acceder aqui, para saber si tiene permisos de borrar editar ver etc...
			Averiguar como pasar el numero de registros, si va a ser a grupos a grupos, si va a ser a modulos, a modulos
			Order By (y mantener la b�squeda en el caso de que hubiera hecha una y averiguar la "pesta�a" a la que hace referencia)
			Busquedas
	*/
			$cadena='';			
			// Leemos el usuario y se lo pasamos a la plantilla
			$this->read($id);
			$tpl->assign('objeto',$this);
			if($this->parent==0){
				$padre="Ninguno";
			}
			else{
				$new_obj=new modules();
				$new_obj->read($this->parent);
				$padre=$new_obj->name_web;
			}
			//cogemos los metodos del modulo
			$this->get_methods($id);
			$metodos="";
			for ($i=0;$i<count($this->module_meth);$i++){
				$metodos = $metodos.$this->module_meth[$i]['name_web']." ";				
			}
			
			$tpl->assign('metodos',$metodos);
			$tpl->assign('padre',$padre);
			
			
			if(!$_SESSION['super'] || !$_SESSION['admin'])
			{	
				$groups = false;
				$modules = false;
			
				$i=0;
				while($i!=$this->num_modules)
				{
			
					if(($this->per_modules[$i]->per == 1)&&($this->per_modules[$i]->module_name=='modules'))
					{
					//Se comprueba si se tiene permiso para ver
						$j=0;
						while(($j<$this->per_modules[$i]->num_methods))
						{
							if(($this->per_modules[$i]->per_methods[$j]->per == 1)&&($this->per_modules[$i]->per_methods[$j]->method_name == 'view'))
							{
								$modules = true;
							}
							$j++;
						}
					}
					else 
					if(($this->per_modules[$i]->per == 1)&&($this->per_modules[$i]->module_name=='groups'))
					{
						//Se comprueba si se tiene permiso para ver
						$j=0;
						while(($j<$this->per_modules[$i]->num_methods))
						{
							if(($this->per_modules[$i]->per_methods[$j]->per == 1)&&($this->per_modules[$i]->per_methods[$j]->method_name == 'view'))
							{
								$groups = true;
							}
							$j++;
						}
					}
					
					$i++;
					
				}

			}
			else
			{
				$modules = true;
				$groups = true;
			}
			
		
			$mensaje = null;
			$mensaje[0]['id_mensaje'] = 1;
			$mensaje[0]['mes'] = "Sentimos informarle de que no tiene permiso para acceder a esta informaci�n";
			
			//listado de modulos
		/*	$tabla_modulos = new table(false);
			if($modules)
			{
				if ($this->num_modules==0)
				{
	
					$cadena=$cadena.$tabla_modulos->tabla_vacia('modules');
					$variables_modulos=$tabla_modulos->nombres_variables;
				}
				else{	
					//Se prepara el array de permisos
					$k=0;
					for($i = 0;$i<$this->num_modules;$i++)
					{
						if(($this->per_modules[$i]->per == 1)&&($this->per_modules[$i]->module_name != 'error'))
						{
							$permissions[$k]['id_module']=$this->per_modules[$i]->id_module;
							$permissions[$k]['name']=$this->per_modules[$i]->web_name;
							$permissions[$k]['methods'] = "";
							for($j=0;$j<$this->per_modules[$i]->num_methods;$j++)
								if($this->per_modules[$i]->per_methods[$j]->per ==1)
								{
									$permissions[$k]['methods'] = $permissions[$k]['methods'].' '.$this->per_modules[$i]->per_methods[$j]->method_name_web;
								}
								$k++;
						}
					}
					
						
					$cadena=$cadena.$tabla_modulos->make_tables('modules',$permissions,array('Nombre del modulo',20,'M�todos en los que se tiene permiso',120),array('id_module','name', 'methods'),10,null,false);
					$variables_modulos=$tabla_modulos->nombres_variables;
				}
			}
			else
			{
				$cadena=$cadena.$tabla_modulos->make_tables('modules',$mensaje,array('ACCION NO PERMITIDA',50),array('id_mensaje','mes'),10,null,false);
				$variables_modulos=$tabla_modulos->nombres_variables;
			}
			
			
			//listado de permisos por modulos
			$tabla_grupos = new table(false);
			if($groups)
			{
				
				//listado de grupos
				if ($this->get_groups($id)==0)
				{
					$cadena=$cadena.$tabla_grupos->tabla_vacia('group_users');
					$variables_grupos=$tabla_grupos->nombres_variables;
				}
				else
				{		
					$per = new permissions();
					$num = $per->get_permissions_list('users');
					
					$per_delete = null;
					for($i=0; $i<$num;$i++)
					if($per->permissions_module[$i] == 'delete')
						$per_delete = array('delete');
								
					$cadena=$cadena.$tabla_grupos->make_tables('group_users',$this->groups_list,array('Nombre de grupo',75),array('id_group','name_web'),10,$per_delete,$per->add);
					$variables_grupos=$tabla_grupos->nombres_variables;
				}
			}
			else
			{
				$cadena=$cadena.$tabla_grupos->make_tables('groups_users',$mensaje,array('ACCION NO PERMITIDA',50),array('id_mensaje','mes'),10,null,false);
				$variables_grupos=$tabla_grupos->nombres_variables;
			}
			
			$i=0;
			while($i<(count($variables_grupos)+count($variables_modulos))){
				for($j=0;$j<count($variables_grupos);$j++){
					$variables[$i]=$variables_grupos[$j];
					$i++;
				}
				for($k=0;$k<count($variables_modulos);$k++){
					$variables[$i]=$variables_modulos[$k];
					$i++;
				}
			}*/

			//Se comprueba si hay permiso para borrar o modificar
			$permisos_mod_del = new permissions();
			$permisos_mod_del->get_permissions_modify_delete();
			
			$tpl->assign('acciones',$permisos_mod_del->per_mod_del);

			$tpl->assign('variables',$variables);
			$tpl->assign('cadena',$cadena);
			//			
		
			return $tpl;
				
	}
	
	function bar($method,$corp){
		if ($method!=$this->method){
			$method = $this->method;
		}		
	if ($corp != ""){
			$corp='<a href="index.php?module=user_corps&method=select&id='.$_SESSION['ident_corp'].'">'.$corp.' ::';
		}
		$nav_bar = '<a>Zona privada</a> :: '.$corp.' <a href="index.php?module=modules">M&oacute;dulos</a>';
		$nav_bar=$nav_bar.$this->localice($method);
		return $nav_bar;
	}	

	function title($method,$corp){
		if ($method!=$this->method){
			$method = $this->method;
		}
		if ($corp != ""){
			$corp=$corp." ::";
		}
		$title = "Zona Privada :: $corp M&oacute;dulos";
		$title=$title.$this->localice($method);		
		return $title;
	}		
	
	function localice($method){	
		switch($method){
						case 'add':
									$localice=" :: A&ntilde;adir M&oacute;dulos";
									break;
						case 'list':
									$localice=" :: Buscar M&oacute;dulos";
									break;
						case 'modify':
									$localice=" :: Modificar M&oacute;dulos";
									break;
						case 'delete':
									$localice=" :: Borrar M&oacute;dulos";
									break;
						case 'view':
									$localice=" :: Ver M&oacute;dulo";									
									break;
						default:
									$localice=" :: Buscar M&oacute;dulos";
									break;
		}
		return $localice;
	}
	
	function listar($tpl){
		$this->get_list_modules();
		$tabla_listado = new table(true);
		
		if($_SESSION['user']=='admin')
			{
				$acciones = array('view', 'modify', 'delete');
				$add = true;
			}
			else
			{
				$per = new permissions();
				$per->get_permissions_list('modules');
				
				$acciones = $per->permissions_module;
				$add = $per->add;
			}
	
		
		$cadena=''.$tabla_listado->make_tables('modules',$this->modules_list,array('Nombre Web',40,'Nombre',20,'Ruta',20),array($this->ddbb_id_module,$this->ddbb_name_web,$this->ddbb_name,$this->ddbb_path),10,$acciones,$add);
		$variables=$tabla_listado->nombres_variables;		
		$tpl->assign('variables',$variables);
		$tpl->assign('cadena',$cadena);		
		return $tpl;
	}
	
		function get_fields_from_post(){
		
		//Cogemos los campos principales
		$this->name=$_POST[$this->ddbb_name];
		$this->name_web=$_POST[$this->ddbb_name_web];
		$this->path=$_POST[$this->ddbb_path];
		$this->active=$_POST[$this->ddbb_active];
		$this->publico=$_POST[$this->ddbb_public];	
	
		$this->parent=$_POST[$this->ddbb_parent];
		
		//Colocar de manera provisional hasta que se haga la validacion de fields
		//************Bloque
		if ($this->name==""){
			$this->name=" ";
		}
		if ($this->name_web==""){
			$this->name_web=" ";
		}
		if ($this->path==""){
			$this->path=" ";
		}
		//************Fin Bloque
		
		//Cogemos los modulos.
		$i=0;
		$this->module_methods="";
		$meth=array("list","select","view","add","modify","delete");
		for($j=0;$j<count($meth);$j++)
		{	//echo "<script>alert('".$_POST[$meth[$j]]."')</script>";
			if ($_POST[$meth[$j]]!=""){
				$this->module_methods[$i]["name"]=$meth[$j];
				$this->module_methods[$i]["name_web"]=$_POST[$meth[$j]];
				$i++;
			}
		}		

		return 0;
	}	
	
	  function get_list_modules_user($user){
	
		return 0;
		
	}
	
	function modify_methods(){		

		$this->delete_methods($this->id_module);
		$this->add_methods($this->id_module);
		$this->module_methods="";
		
	//	$this->get_methods($this->id_module);		
		//Leer los metodos desde bbdd
		$this->get_methods($this->id_module);	
		//Leer los metodos que hay en el formulario
		$formulario="";
		$i=0;
		$meth=array("list","select","view","add","modify","delete");
		for($j=0;$j<count($meth);$j++)
		{	//echo "<script>alert('".$_POST[$meth[$j]]."')</script>";
			if ($_POST[$meth[$j]]!=""){
				$formulario[$i]["name"]=$meth[$j];
				$formulario[$i]["name_web"]=$_POST[$meth[$j]];
				$i++;
			}
		}	

		//Los que haya en la bbdd y no haya en los nuevos, seran los borrados
		for ($i=0;$i<count($this->module_methods);$i++){
			$result=false;
			for ($j=0;$j<count($formulario);$j++){
				if($formulario[$j]["name"]==$this->module_meth[$i]["name"]){
					$result=true;
					break;
				}
			}
			if(!$result){
				$borrados[$i]["id_method"]=$this->module_meth[$i]["id_method"];
			}
		}		
		
		//Los que haya en los nuevos y no en la bbdd seran los a�adidos.
		$nuevos="";
		for ($i=0;$i<count($formulario);$i++){
			$result=false;
			for ($j=0;$j<count($this->module_methods);$j++){
				if($formulario[$i]["name"]==$this->module_meth[$j]["name"]){
					$result=true;
					break;
				}
			}
			if(!$result){
				$nuevos[$i]["name"]=$formulario[$i]["name"];
				$nuevos[$i]["name_web"]=$formulario[$i]["name_web"];
			}
		}
		
		
		//Borramos
		for($i=0;$i<count($borrados);$i++){
			$this->delete_per_group_user_methods('per_user_methods',$borrados[$i]['id_method'],'id_method');
			$this->delete_per_group_user_methods('per_user_methods',$borrados[$i]['id_method'],'id_method');
		}
		//A�adimos los nuevos
		for	($i=0;$i<count($nuevos);$i++){
			$method = new methods();
			$method->id_module=$this->id_module;
			$method->name=$nuevos[$i]["name"];
			//echo "<script>alert('".$this->module_methods[$i]["name"]."')</script>";
			$method->name_web=$nuevos[$i]["name_web"];
			$method->add();
		}
		return 0;
	}
	
	
	function delete_methods($id){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql='DELETE FROM `methods` WHERE `id_module` = \''.$id.'\'';
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		if ($this->result === false){
			$this->error=1;
			$this->db->close();
			return 0;
		}  
				
		return 1;
	}
	
	function get_methods($id){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql='SELECT `id_method` , `name_web`, `name` FROM `methods` WHERE `id_module` = \''.$id.'\'';
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		if ($this->result === false){
			$this->error=1;
			$this->db->close();
			return 0;
		}  
		
		$this->num=0;
		$this->module_methods="";
		while (!$this->result->EOF) {
			//cogemos los datos del usuario
//			
			$this->module_methods[$this->result->fields['name']]['id_method']=$this->result->fields['id_method'];
			$this->module_methods[$this->result->fields['name']]['name']=$this->result->fields['name'];
			$this->module_methods[$this->result->fields['name']]['name_web']=$this->result->fields['name_web'];
			$this->module_meth[$this->num]['id_method']=$this->result->fields['id_method'];
			$this->module_meth[$this->num]['name']=$this->result->fields['name'];
			$this->module_meth[$this->num]['name_web']=$this->result->fields['name_web'];
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		return $this->num;
	}
	
	
	function add_methods($id){
		
		for	($i=0;$i<count($this->module_methods);$i++){
			$method = new methods();
			$method->id_module=$id;
			$method->name=$this->module_methods[$i]["name"];
			//echo "<script>alert('".$this->module_methods[$i]["name"]."')</script>";
			$method->name_web=$this->module_methods[$i]["name_web"];
			$method->add();
		}
	}
	
	function delete_per($table,$id){
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta para coger los campos de la bbdd
		//calcula la consulta de borrado.
		$this->sql="DELETE FROM ".$table. " WHERE ".$this->ddbb_id_module." = ".$id." LIMIT 1";
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->db->Affected_Rows() == 0){			
			$this->error=1;
			$this->db->close();
			return 0;
		}else{
	
			$this->error=0;
			$this->db->close();
			return 1;
			
		}
	}
	
	function delete_per_methods($id){
		
		//Borramos los permisos de los metodos relacionados con el modulo
		for($i=0;$i<count($this->module_meth);$i++){
			$this->delete_per_group_user_methods('per_user_methods',$this->module_meth[$i]['id_method'],'id_method');
			$this->delete_per_group_user_methods('per_group_methods',$this->module_meth[$i]['id_method'],'id_method');
		}
		//Borramos los permisos con el modulo.
		$this->delete_per_group_user_methods('per_user_modules',$id,'id_module');
		$this->delete_per_group_user_methods('per_group_modules',$id,'id_module');
	}
	
	
	function delete_per_group_user_methods($table,$id,$column){
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta para coger los campos de la bbdd
		//calcula la consulta de borrado.
		$this->sql="DELETE FROM ".$table. " WHERE ".$column." = ".$id." LIMIT 1";
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->db->Affected_Rows() == 0){			
			$this->error=1;
			$this->db->close();
			return 0;
		}else{
	
			$this->error=0;
			$this->db->close();
			return 1;
			
		}
	}
	
	function get_module_operations_list($module_name){
	
		return 0;	
	
	}
}	
?>