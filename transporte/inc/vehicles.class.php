<?php
//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');
require_once ($ADODB_DIR."adodb.inc.php");

class vehicles{
//internal vars
	var $id_vehicle;
	var $id_corp;
	var $number_plate;
	var $alias;
	var $path_photo;
//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $table_prefix;
	var $table_name='vehicles';
	var $ddbb_id_vehicle='id_vehicle';
  	var $ddbb_id_corp='id_corp';
  	var $ddbb_number_plate='number_plate';
  	var $ddbb_alias='alias';
  	var $ddbb_path_photo='path_photo';
	var $db;
	var $result;  	
//variables complementarias	
  	var $vehicles_list;
  	var $num;
  	var $fields_list;
	var $mensaje;


  	//constructor
	function vehicles(){
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
		$this->fields_list->add($this->ddbb_id_vehicle, $this->id_vehicle, 'int', 11,0);
		$this->fields_list->add($this->ddbb_id_corp, $this->id_corp, 'int', 11,0);
		$this->fields_list->add($this->ddbb_number_plate, $this->number_plate, 'varchar', 10,0);
		$this->fields_list->add($this->ddbb_alias, $this->alias, 'varchar', 10,0);
		$this->fields_list->add($this->ddbb_path_photo, $this->path_photo, 'varchar', 20,0);
		
		//se puede acceder a los vehiculos por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
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
		
		return $this->get_list_vehicles();	 
		
	}
	
	function get_list_vehicles (){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
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
		
		
		//cogemos los datos del usuario
		$this->num=0;
		while (!$this->result->EOF) 
		{
			$this->vehicles_list[$this->num][$this->ddbb_id_vehicle]=$this->result->fields[$this->ddbb_id_vehicle];
			$this->vehicles_list[$this->num][$this->ddbb_id_corp]=$this->result->fields[$this->ddbb_id_corp];
			$this->vehicles_list[$this->num][$this->ddbb_number_plate]=$this->result->fields[$this->ddbb_number_plate];
			$this->vehicles_list[$this->num][$this->ddbb_alias]=$this->result->fields[$this->ddbb_alias];
			$this->vehicles_list[$this->num][$this->ddbb_path_photo]=$this->result->fields[$this->ddbb_path_photo];
			
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
	
	
		
		$this->db->close();
		
		return $this->num;
	
	}
	
	function read($id){
	
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name." WHERE ".$this->ddbb_id_vehicle."= \"".$id."\"";
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$error=1;
			return 0;
			$this->db->close();
		}else{
			$this->id_vehicle=$id;
			$this->id_corp=$this->result->fields[$this->ddbb_id_corp];
			$this->number_plate=$this->result->fields[$this->ddbb_number_plate];
			$this->alias=$this->result->fields[$this->ddbb_alias];
			$this->path_photo=$this->result->fields[$this->ddbb_path_photo];
			
			$this->db->close();

			return 1;
		}
		
	
	}
	
	function add()
	{
		
		
		//Miramos a ver si esta definida el "submit_add" y si no lo esta, pasamos directamente a mostrar la plantilla
		if (!isset($_POST['submit_add']))
		{
			//Mostrar plantilla vacía	
			//pasarle a la plantilla los modulos y grupos con sus respectivos checkbox a checked false
			//Modulos
		/*	$this->checkbox=new permissions_modules;
			$modules=new modules();
			
			$k=0;
			for($i=0;$i<$modules->num;$i++)
			{
				if($_SESSION['super'])
				{
					$this->checkbox->per_modules[$i]=new permissions_modules;
					$this->checkbox->per_modules[$i]->id_module=$modules->modules_list[$i]['id_module'];
					$this->checkbox->per_modules[$i]->module_name=$modules->modules_list[$i]['name_web'];
					$this->checkbox->per_modules[$i]->validate_per_module_without_groups($this->id_user);
				}
				else
				{
					if(($modules->modules_list[$i]['name']!='modules')&&($modules->modules_list[$i]['name']!='methods'))
					{
						$this->checkbox->per_modules[$k]=new permissions_modules;
						$this->checkbox->per_modules[$k]->id_module=$modules->modules_list[$i]['id_module'];
						$this->checkbox->per_modules[$k]->module_name=$modules->modules_list[$i]['name_web'];
						$this->checkbox->per_modules[$k]->validate_per_module_without_groups($this->id_user);
						
						if($modules->modules_list[$i]['name']=='corps')
						{
							//Si es admin y el modulo es empresas sólo puede otorgar permisos en el método Ver, 
							//por lo que todos los demás métodos no le serán accesibles
							$j=0;
							$salir = false;
							while(($j<$this->checkbox->per_modules[$k]->num_methods)&&($salir==false))
							{
								if($this->checkbox->per_modules[$k]->per_methods[$j]->method_name == 'view')
								{
									$name = $this->checkbox->per_modules[$k]->per_methods[$j]->method_name; 
									$id_method = $this->checkbox->per_modules[$k]->per_methods[$j]->id_method;
									$name_web = $this->checkbox->per_modules[$k]->per_methods[$j]->method_name_web;
									$permiso = $this->checkbox->per_modules[$k]->per_methods[$j]->per;
									
									$this->checkbox->per_modules[$k]->per_methods = null;
									
									$this->checkbox->per_modules[$k]->per_methods[0] = new permissions_methods();
									$this->checkbox->per_modules[$k]->per_methods[0]->id_method = $id_method;
									$this->checkbox->per_modules[$k]->per_methods[0]->method_name_web = $name_web;
									$this->checkbox->per_modules[$k]->per_methods[0]->method_name == $name; 
									$this->checkbox->per_modules[$k]->per_methods[0]->per = $permiso;

									$this->checkbox->per_modules[$k]->num_methods = 1;
									$salir = true;
								}
								$j++;
							}
						}
						
						$k++;
					}
				}
			}
			
		
			$groups=new groups();
			$this->get_groups($this->id_user);
			$k=0;
			for($i=0;$i<$groups->num;$i++)
			{
				if($_SESSION['super'])
				{
					$this->checkbox_groups[$i]= new groups();
					$this->checkbox_groups[$i]->read($groups->groups_list[$i][$groups->ddbb_id_group]);				
					if ($this->checkbox_groups[$i]->verify_user($this->id_user)!=0)
					{
						$this->checkbox_groups[$i]->belong=1;
					}
				}
				else
				{
					if(($groups->groups_list[$i][$groups->ddbb_name] != 'superadmin')&&($groups->groups_list[$i][$groups->ddbb_name] != 'admin'))
					{
						$this->checkbox_groups[$k]= new groups();
						$this->checkbox_groups[$k]->read($groups->groups_list[$i][$groups->ddbb_id_group]);				
						if ($this->checkbox_groups[$k]->verify_user($this->id_user)!=0)
						{
							$this->checkbox_groups[$k]->belong=1;
						}
						$k++;
					}
				}
			}*/
		
			return 0;
		}
		//en el caso de que SI este definido submit_add
		else
		{
				//Entramos porque hemos introducido datos y aún no hemos preguntado por la foto
				//Introducir los datos de post.
				$this->get_fields_from_post();	
				
				//Validacion
				//$return=validate_fields();
				
				//En caso de que la validacion haya sido fallida se muestra la plantilla
				//con los campos erroneos marcados con un *
				$return=true; //Para pruebas dejar esta linea sin comentar
				
				if (!$return)
				{
					//Mostrar plantilla con datos erroneos
					return 0;
				}
				else
				{
					//Si todo es correcto si meten los datos
					
					//Se copia el fichero de la foto elegida por el usuario en el servidor
					
					
					//Se añaden los campos a la base de datos
					$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
					//crea una nueva conexi—n con una bbdd (mysql)
					$this->db = NewADOConnection($this->db_type);
					//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
					$this->db->debug=false;
					//realiza una conexi—n permanente con la bbdd
					$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
					//mete la consulta para coger los campos de la bbdd
					$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_vehicle." = -1" ;
					//la ejecuta y guarda los resultados
					$this->result = $this->db->Execute($this->sql);
					//si falla 
					if ($this->result === false)
					{
						$this->error=1;
						$this->db->close();
						return 0;
					}
					//rellenamos el array con los datos de los atributos de la clase
					$record = array();
					$record[$this->ddbb_id_corp] = $this->id_corp;
					$record[$this->ddbb_alias]=$this->alias;
					$record[$this->ddbb_number_plate]=$this->number_plate;
					$record[$this->ddbb_path_photo]=$this->path_photo;
					
					//calculamos la sql de inserci—n respecto a los atributos
					$this->sql = $this->db->GetInsertSQL($this->result, $record);
					//print($this->sql);
					//insertamos el registro
					$this->db->Execute($this->sql);
					//si se ha insertado una fila
					if($this->db->Insert_ID()>=0)
					{
						//SE INSERTAN LOS PERMISOS.
						//Insertamos los permisos por modulo					
						//Insertamos los grupos
						//$this->insert_per_groups();
						//capturammos el id de la linea insertada
						$this->id_vehicle=$this->db->Insert_ID();
					//	$this->add_group_users();
					//	$this->add_per_modules_methods();
						//print("<pre>::".$this->id_user."::</pre>");
						//devolvemos el id de la tabla ya que todo ha ido bien
						$this->db->close();
					}
					$_SESSION['ident_vehicle'] = $this->id_vehicle;
					return $this->id_vehicle;
			
				}
		}
	}
	
	function get_fields_from_post(){
		
		//Cogemos los campos principales
		//$this->id_vehicle=$_POST[$this->ddbb_id_vehicle];
		$this->id_corp=$_POST[$this->ddbb_id_corp];
		$this->alias=$_POST[$this->ddbb_alias];
		$this->number_plate=$_POST[$this->ddbb_number_plate];			
		$this->path_photo = $_SESSION['ruta_photo'];	
		//Cogemos los checkbox de grupos
	//	$this->get_groups_from_post();
		//Cogemos los checkboxn de modulos-grupos
	//	$this->get_modules_methods_from_post();

		return 0;
	}
	
			
	function remove($id){
		if (!isset($_POST["submit_delete"])){
				//Miramos a ver si hay algun empleado que tenga este usuario						
			//	$this->view_emps($id);					
				return 0;
			}
			else{
			
			$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
			//crea una nueva conexión con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexión de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexión permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.
			$this->sql="DELETE FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_vehicle." = ".$id;
			//la ejecuta y guarda los resultados		
print "Intentamos borrar";
			$this->result = $this->db->Execute($this->sql);
			//si falla 

			if ($this->db->Affected_Rows() == 0){				
				$this->error=1;
				$this->db->close();
				return 0;
			}else{
				$this->make_remove($id);
				$this->error=0;
				$this->db->close();
				return 1;
				
			}
		}		
	}
	
	function make_remove($id){
		//modificamos todos aquellos registros en los que hay un id_user;
		for ($i=0;$i<count($this->table_names_modify);$i++){
			$this->modify_all_id_user($id,$this->table_names_modify[$i]);
		}
		//borramos todos aquellos registros en los que hay un id_user;		
		for ($i=0;$i<count($this->table_names_delete);$i++){
			$this->delete_all_id_user($id,$this->table_names_delete[$i]);
		}
	}
	
	function modify(){
		
	}
	
	function view ($id,$tpl){
	/*
		Cosas que faltan por hacer:
			De forma general, mirar los permisos del usuario que vaya a acceder aqui, para saber si tiene permisos de borrar editar ver etc...
			Averiguar como pasar el numero de registros, si va a ser a grupos a grupos, si va a ser a modulos, a modulos
			Order By (y mantener la búsqueda en el caso de que hubiera hecha una y averiguar la "pestaña" a la que hace referencia)
			Busquedas
	*/
			$cadena='';			
			// Leemos el usuario y se lo pasamos a la plantilla
			$this->read($id);
			$tpl->assign('objeto',$this);
				
			
			
			
			
			//Se comprueba si hay permiso para borrar o modificar
			$permisos_mod_del = new permissions();
			$permisos_mod_del->get_permissions_modify_delete();
			
			$tpl->assign('acciones',$permisos_mod_del->per_mod_del);

			$tpl->assign('variables',$variables);
			$tpl->assign('cadena',$cadena);
			//			
			return $tpl;
				
	}
	
	function listar($tpl){
		$num = $this->get_list_vehicles();
		$tabla_listado = new table(true);			
		$per = new permissions();
		$per->get_permissions_list('vehicles');
		if ($num==0)
		{
			$cadena=''.$cadena.$tabla_listado->tabla_vacia('vehicles', $per->add);
			$variables=$tabla_listado->nombres_variables;
		}
		else
		{
			//Se cambia el campo path, por la foto en sí
		/*	for($i=0;$i<$num;$i++)
				$this->vehicles_list[$i]['path_photo'] = '<img src="images/vehicles/129" width="20" height="20">';*/
			$cadena=''.$tabla_listado->make_tables('vehicles',$this->vehicles_list,array('Identificador de Empresa',20,'Alias',20,'Foto',20),array($this->ddbb_id_vehicle,$this->ddbb_id_corp,$this->ddbb_alias,$this->ddbb_path_photo),10,$per->permissions_module,$per->add);
			$variables=$tabla_listado->nombres_variables;
		}		
		$tpl->assign('variables',$variables);
		$tpl->assign('cadena',$cadena);		
		return $tpl;
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
																
									$tpl->assign("objeto",$this);
								
								//	$tpl->assign("modulos",$this->checkbox);
								//	$tpl->assign("grupos",$this->checkbox_groups);
									break;
						case 'add_photo':
									
									$tpl->assign("objeto",$this);
									break;			
						case 'list':
									$tpl=$this->listar($tpl);
									break;
						case 'modify':
						/*			$this->read($_GET['id']);
									if ($this->modify() !=0){
										$this->method="list";
										$tpl=$this->listar($tpl);										
										$tpl->assign("message","&nbsp;<br>Usuario modificado correctamente<br>&nbsp;");
									}
									$tpl->assign("objeto",$this);
									$tpl->assign("modulos",$this->checkbox);
									$tpl->assign("grupos",$this->checkbox_groups);*/
									break;
						case 'delete':
							/*		$this->read($_GET['id']);
									if ($this->remove($_GET['id'])==0){
										$tpl->assign("message",$this->empleados);
									}
									else{
										$this->users_list="";
										$this->method="list";
										$tpl=$this->listar($tpl);
										$tpl->assign("message","&nbsp;<br>Usuario borrado correctamente<br>&nbsp;");
									}
									$tpl->assign("objeto",$this);*/
									break;
						case 'view':									
									$tpl=$this->view($_GET['id'],$tpl);
									break;
						default:
									$this->method='list';
									$tpl=$this->listar($tpl);
									break;
					}
				$tpl->assign('plantilla','vehicles_'.$this->method.'.tpl');					
		
		return $tpl;
	}

	function bar($method,$corp){
		if ($method!=$this->method){
			$method = $this->method;
		}		
	if ($corp != ""){
			$corp='<a href="index.php?module=user_corps&method=select&id='.$_SESSION['ident_corp'].'">'.$corp.' ::';
		}
		$nav_bar = '<a>Zona privada</a> :: '.$corp.' <a href="index.php?module=vehicles">Vehículos</a>';
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
		$title = "Zona Privada :: $corp Vehículos";
		$title=$title.$this->localice($method);		
		return $title;
	}		
	
	
	function localice($method){	
		switch($method){
						case 'add':
									$localice=" :: A&ntilde;adir Vehículos";
									break;
						case 'list':
									$localice=" :: Buscar Vehículos";
									break;
						case 'modify':
									$localice=" :: Modificar Vehículos";
									break;
						case 'delete':
									$localice=" :: Borrar Vehículos";
									break;
						case 'view':
									$localice=" :: Ver Vehículos";	
									break;
						default:
									$localice=" :: Buscar Vehículos";
									break;
		}
		return $localice;
	}
	
	
}
?>