<?php
//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');
require_once ($ADODB_DIR."adodb.inc.php");

class drivers{
//internal vars
	var $id_driver;
	var $id_emp;
	var $id_vehicle;
	var $name;
	var $last_name;
	var $last_name2;
	var $num_vehicles;
//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $table_prefix;
	var $table_name='drivers';
	var $ddbb_id_driver = 'id_driver';
	var $ddbb_id_emp = 'id_emp';
	var $ddbb_id_vehicle = 'id_vehicle';
	var $ddbb_alias = 'alias';
	var $ddbb_date = 'date';
//Información necesaria sobre empleado conductor y vehículo conducido
	var $ddbb_name = 'name';
	var $ddbb_last_name = 'last_name';
	var $ddbb_last_name2 = 'last_name2';
//Consultas a la BBDD
	var $db;
	var $result; 
	var $result1; 
	var $sql;
		
//variables complementarias	
  	var $drivers_list;
	var $vehicles_list;
  	var $num;
  	var $fields_list;
  	var $error;
//	var $corps_list;
//	var $num_corps;
	var $drivers_emps_list;
//	var $emps_corp_list;
	var $obj_emp;
	var $come;
	var $method;
	var $table_names_modify=array();
	var $table_names_delete=array();
  	//constructor
	function drivers(){
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
		$this->fields_list->add($this->ddbb_id_driver, $this->id_driver, 'int', 11,0);
		$this->fields_list->add($this->ddbb_id_emp, $this->id_emp, 'int', 11,0);
		$this->fields_list->add($this->ddbb_id_vehicle, $this->id_vehicle, 'int', 11,0);
		$this->fields_list->add($this->ddbb_date, $this->date, 'date', 20,0);
	
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
			$error=1;
			return 0;
		}  
		$this->db->close();
		
		/*******************************/
		
		return $this->get_list_drivers();	 
		
	}
	
	function get_list_drivers ()
	{
		
		//Buscar los empleados de la empresa en la que se está y coincidencia en id con los id de emps en drivers
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT drivers.* FROM emps, drivers WHERE emps.id_corp =".$_SESSION['ident_corp']." AND emps.id_emp=drivers.id_emp";

		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$this->error=1;
			$this->db->close();

			return 0;
		}  
		
		$num_emps=0;
		$this->num = 0;
		while (!$this->result->EOF) 
		{
			//Si hay más de un id_driver asociado a un empleado de la empresa evitamos que salga más de una vez, 
			//para ello por cada emp nuevo se incrementa en uno su contador
			$temp[$num_emps][$this->ddbb_id_driver]=$this->result->fields[$this->ddbb_id_driver];
			$temp[$num_emps][$this->ddbb_id_emp]=$this->result->fields[$this->ddbb_id_emp];
			$temp[$num_emps][$this->ddbb_id_vehicle]=$this->result->fields[$this->ddbb_id_vehicle];
			$temp[$num_emps][$this->ddbb_id_date]=$this->result->fields[$this->ddbb_id_date];

			$drivers[$temp[$num_emps][$this->ddbb_id_emp]]['cont']++;

			
			if(($drivers[$temp[$num_emps][$this->ddbb_id_emp]]['cont'] == 1))
			{
				//Si aparece y cont es 1 entonces es la primera vez que aparece
				//cogemos los datos del conductor (directamente de la BBDD)
				$this->drivers_list[$this->num][$this->ddbb_id_driver]=$temp[$num_emps][$this->ddbb_id_driver];
				$this->drivers_list[$this->num][$this->ddbb_id_emp]=$temp[$num_emps][$this->ddbb_id_emp];
				$this->drivers_list[$this->num][$this->ddbb_id_vehicle]=$temp[$num_emps][$this->ddbb_id_vehicle];
				$this->drivers_list[$this->num][$this->ddbb_id_date]=$temp[$num_emps][$this->ddbb_id_date];
			
				//Tratamos los datos para poder presentarselos al usuario
				$this->preparar_datos($this->drivers_list[$this->num][$this->ddbb_id_emp], $this->drivers_list[$this->num][$this->ddbb_id_vehicle]);
	
				$this->num++;
				
			}

			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$num_emps++;
			
		}	
		
		$this->db->close();
		return $this->num;
	
	}
	
	function get_list_drivers_vehicle ($id_vehicle)
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
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name." WHERE id_vehicle = ".$id_vehicle;

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
			//cogemos los datos del conductor (directamente de la BBDD)
			$this->drivers_list[$this->num][$this->ddbb_id_driver]=$this->result->fields[$this->ddbb_id_driver];
			$this->drivers_list[$this->num][$this->ddbb_id_emp]=$this->result->fields[$this->ddbb_id_emp];
			$this->drivers_list[$this->num][$this->ddbb_id_vehicle]=$this->result->fields[$this->ddbb_id_vehicle];
			$this->drivers_list[$this->num][$this->ddbb_id_date]=$this->result->fields[$this->ddbb_id_date];
			
			//Tratamos los datos para poder presentarselos al usuario
			$this->preparar_datos($this->drivers_list[$this->num][$this->ddbb_id_emp], $this->drivers_list[$this->num][$this->ddbb_id_vehicle]);
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		return $this->num;
	
	}
	
	function preparar_datos($id_emp)
	{
		$empleado = new emps();
		$empleado->read($id_emp);
		$this->drivers_list[$this->num][$this->ddbb_name] = $empleado->name;
		$this->drivers_list[$this->num][$this->ddbb_last_name] = $empleado->last_name;
		$this->drivers_list[$this->num][$this->ddbb_last_name2] = $empleado->last_name2;
		
		$this->name = $empleado->name;
		$this->last_name = $empleado->last_name;
		$this->last_name2 = $empleado->last_name2;
		
		$this->get_list_vehicles($id_emp);
		
	}
	
	function get_list_vehicles($id_emp)
	{
		//Buscar todos los id_drivers asociados al empleado

		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT id_vehicle, id_driver, date FROM ".$this->table_prefix.$this->table_name." WHERE id_emp = ".$id_emp;

		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$this->error=1;
			$this->db->close();

			return 0;
		}  
		
		$this->num_vehicles=0;
		while (!$this->result->EOF) {
			//cogemos los datos del conductor (directamente de la BBDD)
			$this->vehicles_list[$this->num_vehicles][$this->ddbb_id_driver]=$this->result->fields[$this->ddbb_id_driver];
			$this->vehicles_list[$this->num_vehicles][$this->ddbb_alias]=$this->result->fields[$this->ddbb_id_emp];
			$this->vehicles_list[$this->num_vehicles][$this->ddbb_id_vehicle]=$this->result->fields[$this->ddbb_id_vehicle];
			$this->vehicles_list[$this->num_vehicles][$this->ddbb_date]=$this->result->fields[$this->ddbb_date];
			
			//Por cada uno buscar el alias y demás datos (enlazar con vehículos)
			$vehiculo = new vehicles();
			$vehiculo->read($this->vehicles_list[$this->num_vehicles][$this->ddbb_id_vehicle]);
			//Añadir vehículo al listado		
			$this->vehicles_list[$this->num_vehicles][$this->ddbb_alias]=$vehiculo->alias;

			//Se cambia el formato de la fecha
			if ($this->vehicles_list[$this->num_vehicles][$this->ddbb_date]!="0000-00-00")
			{
				list($anno,$mes,$dia)=sscanf($this->vehicles_list[$this->num_vehicles][$this->ddbb_date],"%d-%d-%d");
				$this->vehicles_list[$this->num_vehicles]['fecha_cambiada']="$dia-$mes-$anno";
			}
			else{
				$this->vehicles_list[$this->num_vehicles]['fecha_cambiada']="00-00-0000";
			}	
			
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num_vehicles++;
		}
		$this->db->close();
		return $this->num_vehicles;
	}
	/*
	function add(){
		if((!isset($_POST['existUser']))||($_POST['existUser']=="new")){
			$this->obj_user=new users();
			$this->obj_user->is_emps=true;
			$this->obj_user->add();
		}
		//Miramos a ver si esta definida el "submit_add" y si no lo esta, pasamos directamente a mostrar la plantilla
		if (!isset($_POST['submit_add'])){
			//Mostrar plantilla vacía	
			//pasarle a la plantilla los modulos y grupos con sus respectivos checkbox a checked false
			//Modulos
			$this->cat_emps=new cat_emps();
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
				//crea una nueva conexin con una bbdd (mysql)
				$this->db = NewADOConnection($this->db_type);
				//le dice que no salgan los errores de conexin de la ddbb por pantalla
				$this->db->debug=false;
				//realiza una conexin permanente con la bbdd
				$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
				//mete la consulta para coger los campos de la bbdd
				$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_user." = -1" ;
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
				$record[$this->ddbb_name]=$this->name;
				$record[$this->ddbb_last_name]=$this->last_name;
				$record[$this->ddbb_last_name2]=$this->last_name2;
				$record[$this->ddbb_birthday]=$this->birthday;
				$record[$this->ddbb_address]=$this->address;
				$record[$this->ddbb_id_corp]=$this->id_corp;
				$record[$this->ddbb_city]=$this->city;
				$record[$this->ddbb_state]=$this->state;
				$record[$this->ddbb_country]=$this->country;
				$record[$this->ddbb_postal_code]=$this->postal_code;
				$record[$this->ddbb_phone]=$this->phone;
				$record[$this->ddbb_mobile_phone]=$this->mobile_phone;
				$record[$this->ddbb_fax]=$this->fax;
				$record[$this->ddbb_mail]=$this->mail;				
				
				//Insertamus el usuario.
				if ($_POST["user"]=="new"){
					$this->id_user=$this->obj_user->id_user;
				}	
				$record[$this->ddbb_id_user]=$this->id_user;		
				
				//calculamos la sql de insercin respecto a los atributos
				$this->sql = $this->db->GetInsertSQL($this->result, $record);
				//print($this->sql);
				//insertamos el registro
				$this->db->Execute($this->sql);
				//si se ha insertado una fila
				if($this->db->Insert_ID()>=0){
					//Cogemos el id del empleado insertado.
					
					$this->id_emp=$this->db->Insert_ID();
					
					//capturammos el id de la linea insertada
					//Introducimos categorias;
					$this->add_category($this->id_emp);
					//Introducimos fecha de alta.
					$this->add_holyday($this->id_emp);

					
					//print("<pre>::".$this->id_user."::</pre>");
					//devolvemos el id de la tabla ya que todo ha ido bien
					$this->db->close();
					return $this->id_user;
				}else {
					
					//devolvemos 0 ya que no se ha insertado el registro
					$this->error=-1;
					$this->db->close();
					return 0;
				}			
				
				
				
			}
		}
	}
	
	
	
	function modify(){
		$user_changed=0;
		if((!isset($_POST['existUser']))||($_POST['existUser']=="new")||($_POST['existUser']=="modify")){
			
				if(($_POST['existUser']=="new")||($this->id_user==0)||($this->id_user=="")){
					$this->obj_user=new users();
					$this->obj_user->is_emps=true;
					$user_changed=$this->obj_user->add();
					}
				if(($_POST['existUser']=="modify")||($this->id_user!=0)){
					$this->obj_user=new users();
					$this->obj_user->is_emps=true;
					$this->obj_user->read($this->id_user);
					$user_changed=$this->obj_user->modify();
					}
		}
		if (!isset($_POST['submit_modify'])){
			
			$this->cat_emps=new cat_emps();
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
				$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_emp." = \"".$this->id_emp."\"" ;
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
				$record[$this->ddbb_id_emp]=$this->id_emp;
				$record[$this->ddbb_name]=$this->name;
				$record[$this->ddbb_last_name]=$this->last_name;
				$record[$this->ddbb_last_name2]=$this->last_name2;
				$record[$this->ddbb_birthday]=$this->birthday;
				$record[$this->ddbb_address]=$this->address;
				$record[$this->ddbb_id_corp]=$this->id_corp;
				$record[$this->ddbb_city]=$this->city;
				$record[$this->ddbb_state]=$this->state;
				$record[$this->ddbb_country]=$this->country;
				$record[$this->ddbb_postal_code]=$this->postal_code;
				$record[$this->ddbb_phone]=$this->phone;
				$record[$this->ddbb_mobile_phone]=$this->mobile_phone;
				$record[$this->ddbb_fax]=$this->fax;
				$record[$this->ddbb_mail]=$this->mail;		

				if ($_POST["user"]=="new"){
					$this->id_user=$this->obj_user->id_user;
				}	
				$record[$this->ddbb_id_user]=$this->id_user;	
				//calculamos la sql de insercin respecto a los atributos
				$this->sql = $this->db->GetUpdateSQL($this->result, $record);
				//insertamos el registro
				
				$this->db->Execute($this->sql);
				//si se ha insertado una fila
				$Affected_Rows=$this->db->Affected_Rows();
		*/
				/*Al hacer la modificacion de categorias y vacaciones antes del siguiente "if"
				 se debe de guardar en una variable el contenido de las filas afectadas y hacer
				 la condicion del if con esa variable ya que al hacer las modificaciones ese valor varía.
				*/
		/*		
				$return_category=$this->modify_category($this->id_emp);
				$return_holyday=$this->modify_holyday($this->id_emp);
			
			
				if(($Affected_Rows==1)||($user_changed!=0)||($this->sql=="")||($return_category!=0)||($return_holyday!=0)){
					//capturammos el id de la linea insertada
					$this->db->close();
					//devolvemos el id de la tabla ya que todo ha ido bien
					return $this->id_emp;
				}else {
					//devolvemos 0 ya que no se ha insertado el registro
					$this->error=-1;
					$this->db->close();
					return 0;
				}
			}
		}	
	}
	*/
	function remove($id){
			if (!isset($_POST["submit_delete"])){
				
									
				return 0;
			}
			else{
			//HAY QUE VERIFICAR EN LAS COMPROBACIONES QUE NO SE ELIMINE EL MISMO USUARIO
			//QUE ESTA CONECTADO EN ESTE MOMENTO.
			$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
			//crea una nueva conexión con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexión de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexión permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.
			$this->sql="DELETE FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_driver." = ".$id;
			//la ejecuta y guarda los resultados		

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
			$this->modify_all_id_driver($id,$this->table_names_modify[$i]);
		}
		//borramos todos aquellos registros en los que hay un id_user;		
		for ($i=0;$i<count($this->table_names_delete);$i++){
			$this->delete_all_id_driver($id,$this->table_names_delete[$i]);
		}
	}
	
	function modify_all_id_driver($id,$table){
			$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
			//crea una nueva conexión con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexión de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexión permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.
			$this->sql="UPDATE ".$table. " SET id_emp = 0 WHERE id_driver = ".$id;
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
	
	function delete_all_id_driver($id,$table){
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
			//crea una nueva conexión con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexión de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexión permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.

			$this->sql="DELETE FROM ".$table. " WHERE id_driver = ".$id;
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
	/*
	function belong_corp($id_corp){
				//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql='SELECT * FROM `emps` WHERE `id_corp` = \''.$id_corp.'\'';
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		if ($this->result === false){
			$this->error=1;
			$this->db->close();
			
			return 0;
		}  
		
		$this->num=0;


		while (!$this->result->EOF) {
			//cogemos los datos del usuario
			
			$this->emps_corp_list[$this->num]['id_emp']=$this->result->fields['id_emp'];
			$this->emps_corp_list[$this->num]['name']=$this->result->fields['name'];
			$this->emps_corp_list[$this->num]['last_name']=$this->result->fields['last_name'];
			$this->emps_corp_list[$this->num]['last_name2']=$this->result->fields['last_name2'];
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		return $this->emps_corp_list;
		
	}*/
	
	function get_user_corps($id_user)
	{
	
		//Se pasa como parámetro el login del usuario que se conectó a la sesión, esto se hace desde index.php
		

		//coge las variables globales del fichero config.inc.php
		global $DDBB_TYPE, $DDBB_NAME, $IP_DDBB, $DDBB_USER, $DDBB_PASS, $DDBB_PORT, $TABLE_PREFIX;
		$this->db_type=$DDBB_TYPE;
		$this->db_name=$DDBB_NAME;
		$this->db_ip=$IP_DDBB;
		$this->db_user=$DDBB_USER;
		$this->db_passwd=$DDBB_PASS;
		$this->db_port=$DDBB_PORT;
		$this->table_prefix=$TABLE_PREFIX;
		//A partir de este id, se busca dentro de emps todos los empleados que contenga el id_user y sus correspondientes id_corp
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT `id_corp` FROM `emps` WHERE `id_user` =".$id_user;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$this->error=1;
			$this->db->close();

			return 0;
		}  
		//$this->corps_list[0][$this->ddbb_id_user] = $id_user;
		
		//Con el id_corp se podrá obtener el nombre de cada empresa en la trabaja id_user
		$this->num_corps=0;
		$i = 0;
		while (!$this->result->EOF) 
		{
			$id_corp = $this->result->fields['id_corp'];

			$this->sql="SELECT `name` FROM `corps` WHERE `id_corp` =".$id_corp;
			//la ejecuta y guarda los resultados
			$this->result1 = $this->db->Execute($this->sql);
			//si falla 
			if ($this->result1 === false)
			{
				$this->error=1;
				$this->db->close();
	
				return 0;
			}  
/*		
			//Si hay más de un empleado con mismo login en la empresa evitamos que salga más de una vez, 
			//para ello por cada empresa nueva se incrementa en uno su contador
			$temp[$this->num_corps][$this->ddbb_id_corp] = $id_corp;
			$temp[$this->num_corps]['name'] = $this->result1->fields['name'];
		
			$empresas[$id_corp]['cont']++;

			
			if(($empresas[$id_corp]['cont'] == 1))
			{
				//Si aparece y cont es 1 entonces es la primera vez que aparece
				$this->corps_list[$i][$this->ddbb_id_corp] = $temp[$this->num_corps][$this->ddbb_id_corp];
				$this->corps_list[$i]['name'] = $temp[$this->num_corps]['name'];
				$i++;
				
			}
*/
				
			$this->corps_list[$this->num_corps][$this->ddbb_id_corp] = $id_corp;
			$this->corps_list[$this->num_corps]['name'] = $this->result1->fields['name'];

			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num_corps++;
		}
	
		$this->db->close();
		//$this->num_corps = $i;
		
		return $this->num_corps;
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
		$this->sql="SELECT * FROM `drivers` WHERE `id_driver`=".$id;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false)
		{
			$error=1;
			$this->db->close();
			return 0;
		}
		else
		{
			$this->id_driver = $id;
			$this->id_emp = $this->result->fields[$this->ddbb_id_emp];
			$this->id_vehicle = $this->result->fields[$this->ddbb_id_vehicle];
			$this->date = $this->result->fields[$this->ddbb_date];
			//Prepara datos
			$this->preparar_datos($this->id_emp, $this->id_vehicle);
			
			$this->db->close();
				
			return 1;
		}
		
	
	}


	function view ($id,$tpl){
			$cadena='';			
			// Leemos el conductor y se lo pasamos a la plantilla
			$this->read($id);
			$tpl->assign('objeto',$this);

			//Puede darse el caso de contratar un condutor temporalmente y no asignarle un usuario de la empresa
			$empleado = new emps();
			$empleado->read($this->id_emp);
			if(($empleado->id_user==0)||($empleado->id_user=='')){
				$tpl->assign("emp_driver","Sin Usuario");
			}
			else
			{
				$usuario = new users();
				$usuario->read($empleado->id_user);
				$tpl->assign("emp_driver",$usuario->login);
			}
			
			
			
			//Se comprueba si hay permiso para borrar o modificar
			$permisos_mod_del = new permissions();
			$permisos_mod_del->get_permissions_modify_delete('drivers');
			$tpl->assign('acciones',$permisos_mod_del->per_mod_del);
			
			//Se prepara la lista de vehiculos
			$tabla_listado = new table(true);
			$per = new permissions();
			$per->get_permissions_list('vehicles');
	
		/*		
			//Toda persona con permso podrá modificar los datos del vehículo, por precaución para borrar solo se podrá hacer desde vehicles 
			//para no borrar conductores de los que no se tenga conocimiento
			$j=0;
			for ($i=0;$i<count($per->permissions_module);$i++)
			{
				if(($per->permissions_module[$i]=="modify")||($per->permissions_module[$i]=="view"))
				{
					$permisos[$j]=$per->permissions_module[$i];
					$j++;
				} 
			}

		*/
			if ($this->num_vehicles==0)
			{
				$cadena=''.$cadena.$tabla_listado->tabla_vacia('vehicles', $per->add);
				$variables=$tabla_listado->nombres_variables;
			}
			else
			{	
				$cadena=''.$tabla_listado->make_tables('vehicles',$this->vehicles_list,array('Identificador del conductor',20,'Alias del vehículo',20,'Fecha de asignacion',20),array($this->ddbb_id_vehicle, $this->ddbb_id_driver, $this->ddbb_alias, 'fecha_cambiada'),10,$per->permissions_module,$per->add);
				$variables=$tabla_listado->nombres_variables;	
			}				
			$tpl->assign('variables',$variables);
			$tpl->assign('cadena',$cadena);		
						
			return $tpl;
				
	}

	function listar($tpl)
	{
		$num = $this->get_list_drivers();
	
		$tabla_listado = new table(true);
		$per = new permissions();
		$per->get_permissions_list('drivers');
		if ($num==0)
		{
			$cadena=''.$cadena.$tabla_listado->tabla_vacia('drivers', $per->add);
			$variables=$tabla_listado->nombres_variables;
		}
		else
		{	
			$cadena=''.$tabla_listado->make_tables('drivers',$this->drivers_list,array('Nombre',20,'Primer Apellido',20,'Segundo Apellido',20),array($this->ddbb_id_driver, $this->ddbb_name, $this->ddbb_last_name, $this->ddbb_last_name2),10,$per->permissions_module,$per->add);
			$variables=$tabla_listado->nombres_variables;	
		}				
		$tpl->assign('variables',$variables);
		$tpl->assign('cadena',$cadena);		
		return $tpl;
	}
	
	
	function calculate_tpl($method, $tpl)
	{
		$this->method=$method;
		switch($method){
				case 'add':									
							if ($this->add() !=0){
								$this->method="list";
								$tpl=$this->listar($tpl);										
								$tpl->assign("message","&nbsp;<br>Conductor a&ntilde;adido correctamente<br>&nbsp;");
							}					
							$tpl->assign("objeto",$this);									
							$tpl->assign("empleados",$this->obj_emp);
							$tpl->assign("listado_empleados",$this->obj_emp->emps_list);
							break;
							
				case 'list':
							$tpl=$this->listar($tpl);
							break;
				case 'modify':
							$this->read($_GET['id']);
							if ($this->modify() !=0){
								$this->method="list";
								$tpl=$this->listar($tpl);										
								$tpl->assign("message","&nbsp;<br>Conductor modificado correctamente<br>&nbsp;");
							}
							$tpl->assign("objeto",$this);									
							$tpl->assign("empleados",$this->obj_user);
							$tpl->assign("listado_empleados",$this->obj_emp->emps_list);
							break;
				case 'delete':
							$this->read($_GET['id']);
							if ($this->remove($_GET['id'])==0){
								$tpl->assign("message",$this->conductores);
							}
							else{
								$this->emps_list="";
								$this->method="list";
								$tpl=$this->listar($tpl);
								$tpl->assign("message","&nbsp;<br>Conductor borrado correctamente<br>&nbsp;");
							}
							$tpl->assign("objeto",$this);
							break;
				case 'view':									
							$tpl=$this->view($_GET['id'],$tpl);
							break;
				default:
							if($_SESSION['ident_corp'] !=0)
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
		$tpl->assign('plantilla','drivers_'.$this->method.'.tpl');					
		
		return $tpl;
	}
	
	function get_fields_from_post()
	{		
		//Se necesita calcular id del vehículo a través de su matrícula, alias no porque puede haber 2 con el mísmo
		//id tampoco se puede poner directamente porque no lo conoce
		/*
		$this->name=$_POST[$this->ddbb_name];
		$this->last_name=$_POST[$this->ddbb_last_name];
		$this->last_name2=$_POST[$this->ddbb_last_name2];
		$this->birthday=$_POST[$this->ddbb_birthday];
		$this->address=$_POST[$this->ddbb_address];
		$this->id_corp=$_SESSION['ident_corp'];
		$this->city=$_POST[$this->ddbb_city];
		$this->state=$_POST[$this->ddbb_state];
		$this->country=$_POST[$this->ddbb_country];
		$this->postal_code=$_POST[$this->ddbb_postal_code];
		$this->phone=$_POST[$this->ddbb_phone];
		$this->mobile_phone=$_POST[$this->ddbb_mobile_phone];
		$this->fax=$_POST[$this->ddbb_fax];
		$this->mail=$_POST[$this->ddbb_mail];
		*/
		
		//Cogemos la fecha de alta
		$this->come=$_POST["come"];
		
		//Si el usuario ya estaba creado, se lo asignamos		
		if ($_POST["emp"]=="exist"){
			$this->id_user=$_POST["existEmp"];
		}		
		
		//Cogemos la categoria
		$this->category=$_POST["category"];
	}

	function bar($method,$corp){	
		if ($method!=$this->method){
			$method=$this->method;
		}	
		if ($corp != ""){
			$corp='<a href="index.php?module=corps&method=view&id='.$_SESSION['ident_corp'].'">'.$corp.' ::';
		}
		$nav_bar = '<a href="index.php?module=user_corps">Zona privada</a> :: '.$corp.' <a href="index.php?module=drivers">Conductores</a>';
		$nav_bar=$nav_bar.$this->localice($method);
		return $nav_bar;
	}	

	function title($method,$corp){
				if ($method!=$this->method){
			$method=$this->method;
		}	
		if ($corp != ""){
			$corp=$corp." ::";
		}
		$title = "Zona Privada :: $corp Conductores";
		$title=$title.$this->localice($method);		
		return $title;
	}		
	
	
	function localice($method){	
		switch($method){
						case 'add':
									$localice=" :: A&ntilde;adir Conductores";
									break;
						case 'list':
									$localice=" :: Buscar Conductores";
									break;
						case 'modify':
									$localice=" :: Modificar Conductores";
									break;
						case 'delete':
									$localice=" :: Borrar Conductores";
									break;
						case 'view':
									$localice=" :: Ver Conductor";									
									break;
						default:
									$localice=" :: Buscar Conductores";
									break;
		}
		return $localice;
	}
	
	function verify_drivers($id){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql='SELECT * FROM `drivers` WHERE `id_emp` = \''.$id.'\'';
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		if ($this->result === false){
			$this->error=1;
			$this->db->close();
			return 0;
		}  
		
		$this->num=0;
		while (!$this->result->EOF) {
			//cogemos los datos del usuario
			$this->emps_users_list[$this->num]['id_driver']=$this->result->fields['id_driver'];
			$this->emps_users_list[$this->num]['id_emp']=$this->result->fields['id_emp'];
			$this->emps_users_list[$this->num]['id_vehicle']=$this->result->fields['id_vehicle'];
			$this->emps_users_list[$this->num]['date']=$this->result->fields['date'];
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		return $this->num;
	}
	
	function admin ($id){
	
	
	}
	
}
?>