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
	var $cat_vehicles;
	var $category;
	var $table_names_modify=array();
	var $table_names_delete=array("rel_vehicles_cats",);


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
		$this->fields_list->add($this->ddbb_alias, $this->alias, 'varchar', 255,0);
		$this->fields_list->add($this->ddbb_path_photo, $this->path_photo, 'varchar', 255,0);
		
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
		
		return $this->get_list_vehicles($_SESSION['ident_corp']);	 
		
	}
	
	function get_list_vehicles ($id_corp){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name." WHERE id_corp = ".$id_corp;
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
			$this->db->close();
			return 0;		
		}else{
			$this->id_vehicle=$id;
			$this->id_corp=$this->result->fields[$this->ddbb_id_corp];
			$this->number_plate=$this->result->fields[$this->ddbb_number_plate];
			$this->alias=$this->result->fields[$this->ddbb_alias];
			$this->path_photo=$this->result->fields[$this->ddbb_path_photo];
			$this->category = $this->category_vehicles($id);
		
			$this->db->close();
			return 1;
		}
		
	
	}
	
	function category_vehicles($id){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql='SELECT * FROM `rel_vehicles_cats` WHERE `id_vehicle`='.$id;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		if ($this->result === false){
			$this->error=1;
			$this->db->close();
			return 0;
		}  
		
		while (!$this->result->EOF) {
			
			$id_category = $this->result->fields['id_cat_vehicle'];
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		//Se busca el nombre de la categoria a la que pertenece
		$categorias = new cat_vehicles();
		$categorias->read($id_category);
		return $categorias->name;
	}
	
	function show($id, $tpl)
	{
		$this->read($id);
		$tpl->assign('objeto', $this);
		return $tpl;
	}
	
	function add()
	{
		
		//Miramos a ver si esta definida el "submit_add" y si no lo esta, pasamos directamente a mostrar la plantilla
		if (!isset($_POST['submit_add']))
		{
			//Mostrar plantilla vacía	
			//pasarle a la plantilla las categorías de vehículos con sus respectivos checkbox a checked false
			$this->cat_vehicles=new cat_vehicles();
			return 0;
		}
		else		//en el caso de que SI este definido submit_add
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
						//capturammos el id de la linea insertada
						$this->id_vehicle=$this->db->Insert_ID();
						//capturammos el id de la linea insertada
						//Introducimos categorias;
						$this->add_category($this->id_vehicle);
						
						//devolvemos el id de la tabla ya que todo ha ido bien
						$this->db->close();
					
					}else {
						//devolvemos 0 ya que no se ha insertado el registro
						$this->error=-1;
						$this->db->close();
						return 0;
					}	
					//se inserto el vehiculo, ahora se inserta la foto y se modifica el registro para indicar la ruta
					if($_SESSION['ruta_temporal'] != "")
					{
   						$file = new upload_file( $_SESSION['nombre_photo'], $_SESSION['ruta_temporal'], $_SESSION['tamanno_photo'], $this->id_vehicle);
   						$result = $file->upload( "images/vehicles/" );
   						if($result == 1)
   						{
   							//modificar ruta de la foto
							$this->modify_photo($this->id_vehicle);
						}
   					}	
					return $this->id_vehicle;
			
				}
		}
	}
	
	function add_category($id)
	{
		$category=new rel_vehicles_cats();
		$category->id_vehicle=$id;
		$category->id_cat_vehicle=$this->category;
		return $category->add();
	}
	
	function sig_id()
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
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name." ORDER BY id_vehicle";
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
		
		return $this->vehicles_list[$this->num-1][$this->ddbb_id_vehicle] + 1;
	
	}
	
	
	function get_fields_from_post(){
		
		//Cogemos los campos principales
		$this->id_corp=$_SESSION['ident_corp'];
		$this->alias=$_POST[$this->ddbb_alias];
		$this->number_plate=$_POST[$this->ddbb_number_plate];			
		$this->path_photo = $_SESSION['ruta_photo'];	
		//Cogemos la categoria
		$this->category=$_POST["category"];

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
			//Crea una nueva conexión con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexión de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexión permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.
			$this->sql="DELETE FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_vehicle." = ".$id;
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
				//Se borra la foto asociada con el vehiculo, si hay
				if($this->path_photo != "")
					unlink($this->path_photo);
				return 1;	
			}
		}		
	}
	
	function make_remove($id){
		//borramos todos aquellos registros en los que hay un id_user;		
		for ($i=0;$i<count($this->table_names_delete);$i++){
			$this->delete_all_id_vehicle($id,$this->table_names_delete[$i]);
		}
	}
	
	function delete_all_id_vehicle($id,$table)
	{
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
			//crea una nueva conexión con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexión de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexión permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.

			$this->sql="DELETE FROM ".$table. " WHERE id_vehicle = ".$id;
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
	
	function modify_photo()
	{
	
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta para coger los campos de la bbdd
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_vehicle." = \"".$this->id_vehicle."\"" ;
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
		$record[$this->ddbb_id_vehicle]=$this_vehicle;
		$record[$this->ddbb_path_photo]=$_SESSION['ruta_photo'];
		//calculamos la sql de insercin respecto a los atributos
		$this->sql = $this->db->GetUpdateSQL($this->result, $record);
		//insertamos el registro				
		$this->db->Execute($this->sql);
		//si se ha insertado una fila
		$Affected_Rows=$this->db->Affected_Rows();
				
		if(($Affected_Rows==1)||($this->sql==""))
		{
			//capturammos el id de la linea insertada
			$this->db->close();
			//devolvemos el id de la tabla ya que todo ha ido bien
			return $this->id_vehicle;
		}
		else 
		{
			//devolvemos 0 ya que no se ha insertado el registro
			$this->error=-1;
			$this->db->close();
			return 0;
		}
	}
	
	function modify(){
		if (!isset($_POST['submit_modify']))
		{
			$this->cat_vehicles=new cat_vehicles();
			return 0;
		}
		else{
			//Introducir los datos de post.
			//Si se modificó la foto
			if($_SESSION['ruta_temporal'] != "")
			{
   				$file = new upload_file( $_SESSION['nombre_photo'], $_SESSION['ruta_temporal'], $_SESSION['tamanno_photo'], $this->id_vehicle);
   				$result = $file->upload( "images/vehicles/" );
   			}	
			
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
				$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_vehicle." = \"".$this->id_vehicle."\"" ;
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
				$record[$this->ddbb_id_vehicle]=$this->id_vehicle;
				$record[$this->ddbb_id_corp]=$this->id_corp;
				$record[$this->ddbb_alias] = $this->alias;
				$record[$this->ddbb_number_plate]=$this->number_plate;
				$record[$this->ddbb_path_photo]=$this->path_photo;
				//calculamos la sql de insercin respecto a los atributos
				$this->sql = $this->db->GetUpdateSQL($this->result, $record);
				//insertamos el registro				
				$this->db->Execute($this->sql);
				//si se ha insertado una fila
				$Affected_Rows=$this->db->Affected_Rows();
				/*Al hacer la modificacion de categorias antes del siguiente "if"
				 se debe de guardar en una variable el contenido de las filas afectadas y hacer
				 la condicion del if con esa variable ya que al hacer las modificaciones ese valor varía.
				*/
				
				$return_category=$this->modify_category($this->id_emp);
			
				if(($Affected_Rows==1)||($user_changed!=0)||($this->sql=="")||($return_category!=0))
				{
					//capturammos el id de la linea insertada
					$this->db->close();
					//devolvemos el id de la tabla ya que todo ha ido bien
					return $this->id_vehicle;
				}
				else 
				{
					//devolvemos 0 ya que no se ha insertado el registro
					$this->error=-1;
					$this->db->close();
					return 0;
				}
			}
		}	
	}
	
	function modify_category($id)
	{
		$category=new rel_vehicles_cats();
		$return=$category->read($category->get_rel_vehicle_cat($this->id_vehicle));
		if ($return==0){
			return $this->add_category($id);
		}
		$category->id_vehicle=$id;
		$category->id_cat_vehicle=$this->category;
		return $category->modify();
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
			// Leemos el vehículo y se lo pasamos a la plantilla
			$this->read($id);
			$tpl->assign('objeto',$this);	
			
			$user = new users();
			$id_user = $user->get_id($_SESSION['user']);
			$user->validate_per_user($id_user);
			
			if(!$_SESSION['super'] && !$_SESSION['admin'])
			{	
				$drivers = false;
				$laborers = false;
			
				$i=0;
				while($i!=$user->num_modules)
				{
			
					if(($user->per_modules[$i]->per == 1)&&($user->per_modules[$i]->module_name=='drivers'))
					{
					//Se comprueba si se tiene permiso para ver
						$j=0;
						while(($j<$user->per_modules[$i]->num_methods))
						{
							if(($user->per_modules[$i]->per_methods[$j]->per == 1)&&($user->per_modules[$i]->per_methods[$j]->method_name == 'view'))
							{
								$drivers = true;
							}
							$j++;
						}
					}
					else 
					if(($user->per_modules[$i]->per == 1)&&($user->per_modules[$i]->module_name=='laborers'))
					{
						//Se comprueba si se tiene permiso para ver
						$j=0;
						while(($j<$user->per_modules[$i]->num_methods))
						{
							if(($user->per_modules[$i]->per_methods[$j]->per == 1)&&($user->per_modules[$i]->per_methods[$j]->method_name == 'view'))
							{
								$laborers = true;
							}
							$j++;
						}
					}
					
					$i++;
					
				}

			}
			else
			{
				$drivers = true;
				$laborers = true;
			}
			
			$mensaje = null;
			$mensaje[0]['id_mensaje'] = 1;
			$mensaje[0]['mes'] = "Sentimos informarle de que no tiene permiso para acceder a esta información";
			
			//listado de conductores
			$tabla_listado_drivers = new table(false);
			if($drivers)
			{
				$conductor = new drivers();
				$num_drivers = $conductor->get_list_drivers_vehicle($_GET['id']);
	print ("Nombre ".$conductor->dri);	
				if ($num_drivers==0)
				{
					$cadena=$cadena.$cadena.$tabla_listado_drivers->tabla_vacia('drivers', false);
					$variables_drivers=$tabla_listado_drivers->nombres_variables;
				}
				else
				{	
					$cadena=$cadena.$tabla_listado_drivers->make_tables('drivers',$conductor->drivers_list,array('Nombre',20,'Primer Apellido',20,'Segundo Apellido',20),array($conductor->ddbb_id_driver, $conductor->ddbb_name, $conductor->ddbb_last_name, $conductor->ddbb_last_name2),10,array(),false);
					$variables_drivers=$tabla_listado_drivers->nombres_variables;	
				}				
			}
			else
			{
				$cadena=$cadena.$tabla_listado_drivers->make_tables('drivers',$mensaje,array('ACCION NO PERMITIDA',50),array('id_mensaje','mes'),10,null,false);
				$variables_drivers=$tabla_listado_drivers->nombres_variables;
			}
			
			
			//listado de permisos por modulos
			$tabla_listado_laborers = new table(false);
			if($laborers)
			{
				
				$peon = new laborers();
				$num_laborers = $peon->get_list_laborers_vehicle($_GET['id']);
	print("numero de laborers ".$num_laborers);
						
				if ($num_laborers==0)
				{
					$cadena=$cadena.$cadena.$tabla_listado_laborers->tabla_vacia('laborers', false);
					print ("Cadena".$cadena);
					$variables_laborers=$tabla_listado_laborers->nombres_variables;
				}
				else
				{	
					$cadena=$cadena.$tabla_listado_laborers->make_tables('laborers',$peon->laborers_list,array('Nombre',20,'Primer Apellido',20,'Segundo Apellido',20),array($peon->ddbb_id_laborer, $peon->ddbb_name, $peon->ddbb_last_name, $peon->ddbb_last_name2),10,array(),false);
					$variables_laborers=$tabla_listado_laborers->nombres_variables;	
				}	
			}
			else
			{
				$cadena=$cadena.$tabla_listado_laborers->make_tables('laborers',$mensaje,array('ACCION NO PERMITIDA',50),array('id_mensaje','mes'),10,null,false);
				$variables_laborers=$tabla_listado_laborers->nombres_variables;
			}
			
			
			
			$i=0;
			while($i<(count($variables_grupos)+count($variables_modulos))){
				for($j=0;$j<count($variables_drivers);$j++){
					$variables[$i]=$variables_drivers[$j];
					$i++;
				}
				for($k=0;$k<count($variables_laborers);$k++){
					$variables[$i]=$variables_laborers[$k];
					$i++;
				}
			}
						
			$tpl->assign('variables',$variables);
			$tpl->assign('cadena',$cadena);	

			//			
			return $tpl;
				
	}
	
	function listar($tpl){
		$num = $this->get_list_vehicles($_SESSION['ident_corp']);
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
			$cadena=''.$tabla_listado->make_tables('vehicles',$this->vehicles_list,array('Alias',20,'Matr&iacute;cula',20,'Foto',20),array($this->ddbb_id_vehicle,$this->ddbb_alias,$this->ddbb_number_plate, $this->ddbb_path_photo),10,$per->permissions_module,$per->add);
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
									if ($this->add() != 0)
									{
										$this->vehicles_list = "";
										$this->method="list";
										$tpl=$this->listar($tpl);										
										$tpl->assign("message","&nbsp;<br>Veh&iacute;culo a&ntilde;adido correctamente<br>&nbsp;");
									}
																							
									$tpl->assign("objeto",$this);
									$tpl->assign("categorias",$this->cat_vehicles->cat_vehicles_list);
									break;		
						case 'list':
									$tpl=$this->listar($tpl);
									break;
						case 'modify':
									$this->read($_GET['id']);
									if ($this->modify() !=0)
									{
										$this->vehicles_list = "";
										$this->method="list";
										$tpl=$this->listar($tpl);										
										$tpl->assign("message","&nbsp;<br>Veh&iacute;culo modificado correctamente<br>&nbsp;");
									}
									$tpl->assign("objeto",$this);
									$tpl->assign("categorias",$this->cat_vehicles->cat_vehicles_list);
									break;
						case 'delete':
									$this->read($_GET['id']);
									if ($this->remove($_GET['id'])==0){
										//$tpl->assign("message",$this->emps);
									}
									else{
										$this->vehicles_list = "";
										$this->method="list";
										$tpl=$this->listar($tpl);
										$tpl->assign("message","&nbsp;<br>Veh&iacute;culo borrado correctamente<br>&nbsp;");
									}
									$tpl->assign("objeto",$this);
									break;
						case 'view':									
									$tpl=$this->view($_GET['id'],$tpl);
									break;
						case 'show':
									$tpl=$this->show($_GET['id'], $tpl);									
									break;
						default:
									if($_SESSION['ident_corp'] != 0)
									{
										$this->method='list';
										$tpl=$this->listar($tpl);
									}
									else
									{
										$tpl->assign('plantilla','error_corp.tpl');	
										return $tpl;
									}	
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
						case 'show':
									$localice=" :: Ver foto del Vehículo";	
									break;
						default:
									$localice=" :: Buscar Vehículos";
									break;
		}
		return $localice;
	}
	
	
}
?>