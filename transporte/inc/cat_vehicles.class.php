<?php
//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');
require_once ($ADODB_DIR."adodb.inc.php");

class cat_vehicles{
//internal vars
	var $id_cat_vehicle;
	var $name;
	var $name_web;
	var $descrip;
//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $table_prefix;
	var $table_name='cat_vehicles';
	var $ddbb_id_cat_vehicle='id_cat_vehicle';
  	var $ddbb_name='name';
  	var $ddbb_name_web='name_web';
  	var $ddbb_descrip='descrip';
	var $db;
	var $result;  	
//variables complementarias	
  	var $cat_vehicles_list;
  	var $num;
  	var $fields_list;
	var $table_names_modify;
	var $table_names_delete = array ("rel_vehicles_cats");
	//var $mensaje;


  	//constructor
	function cat_vehicles(){
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
		$this->fields_list->add($this->ddbb_id_cat_vehicle, $this->id_cat_vehicle, 'int', 11,0);
		$this->fields_list->add($this->ddbb_name, $this->name, 'varchar', 50,0);
		$this->fields_list->add($this->ddbb_name_web, $this->name_web, 'varchar', 50,0);
		$this->fields_list->add($this->ddbb_descrip, $this->descrip, 'varchar', 255,0);
		
		//se puede acceder a los vehiculos por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
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
		
		return $this->get_list_cat_vehicles();	 
		
	}
	
	function get_list_cat_vehicles (){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
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
			$this->cat_vehicles_list[$this->num][$this->ddbb_id_cat_vehicle]=$this->result->fields[$this->ddbb_id_cat_vehicle];
			$this->cat_vehicles_list[$this->num][$this->ddbb_name]=$this->result->fields[$this->ddbb_name];
			$this->cat_vehicles_list[$this->num][$this->ddbb_name_web]=$this->result->fields[$this->ddbb_name_web];
			$this->cat_vehicles_list[$this->num][$this->ddbb_descrip]=$this->result->fields[$this->ddbb_descrip];
					
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
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name." WHERE ".$this->ddbb_id_cat_vehicle."= \"".$id."\"";
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$error=1;
			return 0;
			$this->db->close();
		}else{
			$this->id_cat_vehicle=$id;
			$this->name=$this->result->fields[$this->ddbb_name];
			$this->name_web=$this->result->fields[$this->ddbb_name_web];
			$this->descrip=$this->result->fields[$this->ddbb_descrip];
			
			$this->db->close();

			return 1;
		}
		
	
	}
	
	function add()
	{
		
		
		//Miramos a ver si esta definida el "submit_add" y si no lo esta, pasamos directamente a mostrar la plantilla
		if (!isset($_POST['submit_add']))
		{
			//Mostrar plantilla vac�a	
			return 0;
		}
		//en el caso de que SI este definido submit_add
		else
		{
				//Entramos porque hemos introducido datos y a�n no hemos preguntado por la foto
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
					
					
					//Se a�aden los campos a la base de datos
					$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
					//crea una nueva conexin con una bbdd (mysql)
					$this->db = NewADOConnection($this->db_type);
					//le dice que no salgan los errores de conexin de la ddbb por pantalla
					$this->db->debug=false;
					//realiza una conexin permanente con la bbdd
					$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
					//mete la consulta para coger los campos de la bbdd
					$this->sql = "SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_cat_vehicle." = -1" ;
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
					$record[$this->ddbb_name] = $this->name;
					$record[$this->ddbb_name_web]=$this->name_web;
					$record[$this->ddbb_descrip]=$this->descrip;
					
					//calculamos la sql de insercin respecto a los atributos
					$this->sql = $this->db->GetInsertSQL($this->result, $record);
					//print($this->sql);
					//insertamos el registro
					$this->db->Execute($this->sql);
					//si se ha insertado una fila
					if($this->db->Insert_ID()>=0)
					{
						//capturammos el id de la linea insertada
						$this->id_cat_vehicle=$this->db->Insert_ID();
						//devolvemos el id de la tabla ya que todo ha ido bien
						$this->db->close();
					}
					return $this->id_cat_vehicle;
			
				}
		}
	}
	
	function get_fields_from_post(){
		//Cogemos los campos principales
		//$this->id_vehicle=$_POST[$this->ddbb_id_vehicle];
		$this->name=$_POST[$this->ddbb_name];
		$this->name_web=$_POST[$this->ddbb_name_web];
		$this->descrip=$_POST[$this->ddbb_descrip];			
		//Cogemos los checkbox de grupos
	//	$this->get_groups_from_post();
		//Cogemos los checkboxn de modulos-grupos
	//	$this->get_modules_methods_from_post();

		return 0;
	}
	
			
	function remove($id){
		if (!isset($_POST["submit_delete"]))
		{				
				return 0;
		}
		else
		{
			//Se borra el vehiculo de la bbdd
			$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
			//crea una nueva conexi�n con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexi�n permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.
			$this->sql="DELETE FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_cat_vehicle." = ".$id." LIMIT 1";
			//la ejecuta y guarda los resultados		
			$this->result = $this->db->Execute($this->sql);
			//si falla 
			if ($this->db->Affected_Rows() == 0)
			{				
				$this->error=1;
				$this->db->close();
				return 0;
			}
			else
			{
				$this->make_remove($id);
				$this->error=0;
				$this->db->close();
				return 1;	
			}
		}		
	}
	
	function make_remove($id){
		//modificamos todos aquellos registros en los que hay un id_user;
	/*	for ($i=0;$i<count($this->table_names_modify);$i++){
			$this->modify_all_id_cat_vehicle($id,$this->table_names_modify[$i]);
		}
		//borramos todos aquellos registros en los que hay un id_user;		
		for ($i=0;$i<count($this->table_names_delete);$i++){
			$this->delete_all_id_cat_vehicle($id,$this->table_names_delete[$i]);
		}
		*/
	}
	
	function modify_all_id_cat_vehicle($id,$table){
			$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
			//crea una nueva conexi�n con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexi�n permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.
			$this->sql="UPDATE ".$table. " SET id_vehicle = 0 WHERE id_cat_vehicle = ".$id;
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
	
	function modify(){
		if (!isset($_POST['submit_modify'])){
			//Mostrar plantilla vac�a	
			//pasarle a la plantilla las categor�as con sus respectivos checkbox a checked false
		//	$this->checkbox=new permissions_modules;
		//	$modules=new modules();
		/*	
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
							//Si es admin y el modulo es empresas s�lo puede otorgar permisos en el m�todo Ver, 
							//por lo que todos los dem�s m�todos no le ser�n accesibles
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
			}
			*/
			//$tpl->assign('usuarios',$this->per_module_methods);
			
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
				//crea una nueva conexin con una bbdd (mysql)
				$this->db = NewADOConnection($this->db_type);
				//le dice que no salgan los errores de conexin de la ddbb por pantalla
				$this->db->debug=false;
				//realiza una conexin permanente con la bbdd
				$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
				//mete la consulta para coger los campos de la bbdd
				$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_cat_vehicle." = \"".$this->id_cat_vehicle."\"" ;
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
				$record[$this->ddbb_id_cat_vehicle]=$this->id_cat_vehicle;
				$record[$this->ddbb_name]=$this->name;
				$record[$this->ddbb_name_web] = $this->name_web;
				$record[$this->ddbb_descrip]=$this->descrip;
				//calculamos la sql de insercin respecto a los atributos
				$this->sql = $this->db->GetUpdateSQL($this->result, $record);
				//insertamos el registro				
				$this->db->Execute($this->sql);
				//si se ha insertado una fila

				if(($this->db->Affected_Rows()==1)||($this->sql=="")){
					//capturammos el id de la linea insertada
				
				//	$this->modify_group_users();
				//	$this->modify_module_methods();

					$this->db->close();
					//devolvemos el id de la tabla ya que todo ha ido bien
					return $this->id_cat_vehicle;
				}else {
					//devolvemos 0 ya que no se ha insertado el registro
					$this->error=-1;
					$this->db->close();
					return 0;
				}
			}
		}	
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
				
			
			
			
			
			//Se comprueba si hay permiso para borrar o modificar
			$permisos_mod_del = new permissions();
			$permisos_mod_del->get_permissions_modify_delete('cat_vehicles');
			
			$tpl->assign('acciones',$permisos_mod_del->per_mod_del);

			$tpl->assign('variables',$variables);
			$tpl->assign('cadena',$cadena);
			//			
			return $tpl;
				
	}
	
	function listar($tpl){
		$num = $this->get_list_cat_vehicles();
		$tabla_listado = new table(true);			
		$per = new permissions();
		$per->get_permissions_list('cat_vehicles');
		if ($num==0)
		{
			$cadena=''.$cadena.$tabla_listado->tabla_vacia('cat_vehicles', $per->add);
			$variables=$tabla_listado->nombres_variables;
		}
		else
		{
			$cadena=''.$tabla_listado->make_tables('cat_vehicles',$this->cat_vehicles_list,array('Nombre',20),array($this->ddbb_id_cat_vehicle,$this->ddbb_name_web),10,$per->permissions_module,$per->add);
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
									
									if ($this->add() !=0)
									{
										$this->method="list";
										$tpl=$this->listar($tpl);										
										$tpl->assign("message","&nbsp;<br>Categor&iacute;a de veh&iacute;culo a&ntilde;adida correctamente<br>&nbsp;");
									}
																
									$tpl->assign("objeto",$this);
								
								//	$tpl->assign("modulos",$this->checkbox);
								//	$tpl->assign("grupos",$this->checkbox_groups);
									break;			
						case 'list':
									$tpl=$this->listar($tpl);
									break;
						case 'modify':
									$this->read($_GET['id']);
									if ($this->modify() !=0){
										$this->method="list";
										$tpl=$this->listar($tpl);										
										$tpl->assign("message","&nbsp;<br>Categor&iacute;a de veh&iacute;culo modificada correctamente<br>&nbsp;");
									}
									$tpl->assign("objeto",$this);
							//		$tpl->assign("modulos",$this->checkbox);
							//		$tpl->assign("grupos",$this->checkbox_groups);
									break;
						case 'delete':
									$this->read($_GET['id']);
									if ($this->remove($_GET['id'])==0){
										//$tpl->assign("message",$this->emps);
									}
									else{
										$this->cat_vehicles_list = "";
										$this->method="list";
										$tpl=$this->listar($tpl);
										$tpl->assign("message","&nbsp;<br>Categor&iacute;a de veh&iacute;culo borrada correctamente<br>&nbsp;");
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
				$tpl->assign('plantilla','cat_vehicles_'.$this->method.'.tpl');					
		
		return $tpl;
	}

	function bar($method,$corp){
		if ($method!=$this->method){
			$method = $this->method;
		}		
	if ($corp != ""){
			$corp='<a href="index.php?module=user_corps&method=select&id='.$_SESSION['ident_corp'].'">'.$corp.' ::';
		}
		$nav_bar = '<a>Zona privada</a> :: '.$corp.' <a href="index.php?module=cat_vehicles">Categor&iacute;as de veh&iacute;culos</a>';
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
		$title = "Zona Privada :: $corp Categor&iacute;as de veh�culos";
		$title=$title.$this->localice($method);		
		return $title;
	}		
	
	
	function localice($method){	
		switch($method){
						case 'add':
									$localice=" :: A&ntilde;adir Categor&iacute;as de veh�culos";
									break;
						case 'list':
									$localice=" :: Buscar Categor&iacute;as de veh�culos";
									break;
						case 'modify':
									$localice=" :: Modificar Categor&iacute;as de veh�culos";
									break;
						case 'delete':
									$localice=" :: Borrar Categor&iacute;as de veh�culos";
									break;
						case 'view':
									$localice=" :: Ver Categor&iacute;as de veh�culos";	
									break;
						default:
									$localice=" :: Buscar Categor&iacute;as de veh�culos";
									break;
		}
		return $localice;
	}
	
	
}
?>