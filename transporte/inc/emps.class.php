<?php
//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');

require_once ($ADODB_DIR."adodb.inc.php");

class emps{
//internal vars
	var $id_emp;
	var $id_corp;
	var $id_user;
	var $name;
	var $last_name;
	var $last_name2;
	var $birthday;
	var $phone;
	var $mobile_phone;
	var $fax;
	var $mail;
	var $address;
	var $city;
	var $state;
	var $postal_code;
	var $country;
//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $table_prefix;
	var $table_name='emps';
	var $ddbb_id_emp = 'id_emp';
	var $ddbb_id_corp ='id_corp';
	var $ddbb_id_user='id_user';
	var $ddbb_name= 'name';
	var $ddbb_last_name='last_name';
	var $ddbb_last_name2='last_name2';
	var $ddbb_birthday='birthday';
	var $ddbb_phone='phone';
	var $ddbb_mobile_phone='mobile_phone';
	var $ddbb_fax='fax';
	var $ddbb_mail='mail';
	var $ddbb_address='address';
	var $ddbb_city='city';
	var $ddbb_state='state';
	var $ddbb_postal_code='postal_code';
	var $ddbb_country='country';
	var $db;
	var $result; 
	var $result1; 
	var $sql;
		
//variables complementarias	
  	var $emps_list;
  	var $num;
  	var $fields_list;
  	var $error;
	var $corps_list;
	var $num_corps;
	var $emps_users_list;
	var $method;
	var $obj_user;
	
  	//constructor
	function emps(){
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
		$this->fields_list->add($this->ddbb_id_emp, $this->id_emp, 'int', 11,0);
		$this->fields_list->add($this->ddbb_id_corp, $this->id_corp, 'int', 11,0);
		$this->fields_list->add($this->ddbb_id_user, $this->id_user, 'int', 11,0);
		$this->fields_list->add($this->ddbb_name, $this->name, 'varchar', 20,0);
		$this->fields_list->add($this->ddbb_last_name, $this->last_name, 'varchar', 20,0);
		$this->fields_list->add($this->ddbb_last_name2, $this->last_name2, 'varchar', 20,0 );
		$this->fields_list->add($this->ddbb_birthday, $this->birthday, 'date', 0,0);
		$this->fields_list->add($this->ddbb_phone, $this->phone, 'varchar', 15,0);		
		$this->fields_list->add($this->ddbb_mobile_phone, $this->mobile_phone, 'varchar', 15,0 );
		$this->fields_list->add($this->ddbb_fax, $this->fax, 'varchar', 15,0 );
		$this->fields_list->add($this->ddbb_mail, $this->mail, 'varchar', 50,0 );
		$this->fields_list->add($this->ddbb_address, $this->address, 'varchar', 255,0 );
		$this->fields_list->add($this->ddbb_city, $this->city, 'varchar', 50,0 );
		$this->fields_list->add($this->ddbb_state, $this->state, 'varchar', 50,0 );
		$this->fields_list->add($this->ddbb_postal_code, $this->postal_code, 'varchar', 50,0 );
		$this->fields_list->add($this->ddbb_country, $this->country, 'varchar', 50,0 );
		//print_r($this);
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
			$error=1;
			return 0;
		}  
		$this->db->close();
		
		/*******************************/
		
		return $this->get_list_emps($_SESSION['ident_corp']);	 
		
	}
	
	function get_list_emps ($id_corp)
	{

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
		
		$this->num=0;
		while (!$this->result->EOF) {
			//cogemos los datos del empleado
			$this->emps_list[$this->num][$this->ddbb_id_emp]=$this->result->fields[$this->ddbb_id_emp];
			$this->emps_list[$this->num][$this->ddbb_id_corp]=$this->result->fields[$this->ddbb_id_corp];
			$this->emps_list[$this->num][$this->ddbb_id_user]=$this->result->fields[$this->ddbb_id_user];
			$this->emps_list[$this->num][$this->ddbb_name]=$this->result->fields[$this->ddbb_name];
			$this->emps_list[$this->num][$this->ddbb_last_name]=$this->result->fields[$this->ddbb_last_name];
			$this->emps_list[$this->num][$this->ddbb_last_name2]=$this->result->fields[$this->ddbb_last_name2];
			$this->emps_list[$this->num][$this->ddbb_birthday]=$this->result->fields[$this->ddbb_birthday];
			$this->emps_list[$this->num][$this->ddbb_phone]=$this->result->fields[$this->ddbb_phone];
			$this->emps_list[$this->num][$this->ddbb_mobile_phone]=$this->result->fields[$this->ddbb_mobile_phone];
			$this->emps_list[$this->num][$this->ddbb_fax]=$this->result->fields[$this->ddbb_fax];
			$this->emps_list[$this->num][$this->ddbb_mail]=$this->result->fields[$this->ddbb_mail];
			$this->emps_list[$this->num][$this->ddbb_address]=$this->result->fields[$this->ddbb_address];
			$this->emps_list[$this->num][$this->ddbb_city]=$this->result->fields[$this->ddbb_city];
			$this->emps_list[$this->num][$this->ddbb_state]=$this->result->fields[$this->ddbb_state];
			$this->emps_list[$this->num][$this->ddbb_postal_code]=$this->result->fields[$this->ddbb_postal_code];
			$this->emps_list[$this->num][$this->ddbb_country]=$this->result->fields[$this->ddbb_country];

			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		return $this->num;
	
	}
	
		function add(){
		if(!isset($_POST['add_adduser'])){
			$this->obj_user=new users();
			$this->obj_user->add();
		}
		//Miramos a ver si esta definida el "submit_add" y si no lo esta, pasamos directamente a mostrar la plantilla
		if (!isset($_POST['submit_add'])){
			//Mostrar plantilla vacía	
			//pasarle a la plantilla los modulos y grupos con sus respectivos checkbox a checked false
			//Modulos

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
				$record[$this->ddbb_login] = $this->login;
				$record[$this->ddbb_passwd]=$this->passwd;
				$record[$this->ddbb_name]=$this->name;
				$record[$this->ddbb_last_name]=$this->last_name;
				$record[$this->ddbb_last_name2]=$this->last_name2;
				$record[$this->ddbb_full_name]=$this->full_name;
				$record[$this->ddbb_internal]=$this->internal;
				$record[$this->ddbb_active]=$this->active;
				//calculamos la sql de insercin respecto a los atributos
				$this->sql = $this->db->GetInsertSQL($this->result, $record);
				//print($this->sql);
				//insertamos el registro
				$this->db->Execute($this->sql);
				//si se ha insertado una fila
				if($this->db->Insert_ID()>=0){
					//SE INSERTAN LOS PERMISOS.
					//Insertamos los permisos por modulo					
					//Insertamos los grupos
					//$this->insert_per_groups();
					//capturammos el id de la linea insertada
					$this->id_user=$this->db->Insert_ID();
					$this->add_group_users();
					$this->add_per_modules_methods();
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
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
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
		$this->corps_list[0][$this->ddbb_id_user] = $id_user;
		
		//Con el id_corp se podrá obtener el nombre de cada empresa en la trabaja id_user
		$this->num_corps=0;
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
			$this->corps_list[$this->num_corps] = new user_corps();
			$this->corps_list[$this->num_corps]->name_corp = $this->result1->fields['name'];
			$this->corps_list[$this->num_corps]->id_corp = $id_corp;
			*/
			
			$this->corps_list[$this->num_corps][$this->ddbb_id_corp] = $id_corp;
			$this->corps_list[$this->num_corps]['name'] = $this->result1->fields['name'];
	

			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num_corps++;
		}
	
		$this->db->close();
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
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT * FROM `emps` WHERE `id_emp`= \"".$id."\"";
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false)
		{
			$error=1;
			return 0;
			$this->db->close();
		}
		else
		{
			$this->id_emp = $id;
			$this->id_corp = $this->result->fields[$this->ddbb_id_corp];
			$this->id_user = $this->result->fields[$this->ddbb_id_user];
			$this->name = $this->result->fields[$this->ddbb_name];
			$this->last_name = $this->result->fields[$this->ddbb_last_name];
			$this->last_name2 = $this->result->fields[$this->ddbb_last_name2];
			$this->birthday = $this->result->fields[$this->ddbb_birthday];
			$this->phone = $this->result->fields[$this->ddbb_phone];
			$this->mobile_phone = $this->result->fields[$this->ddbb_mobile_phone];
			$this->fax = $this->result->fields[$this->ddbb_fax];
			$this->mail = $this->result->fields[$this->ddbb_mail];
			$this->address = $this->result->fields[$this->ddbb_address];
			$this->city = $this->result->fields[$this->ddbb_city];
			$this->state = $this->result->fields[$this->ddbb_state];
			$this->postal_code = $this->result->fields[$this->ddbb_postal_code];
			$this->country = $this->result->fields[$this->ddbb_country];
			
			$this->db->close();
				
			return 1;
		}
		
	
	}
	/*
	function add($tpl){
		//Miramos a ver si esta definida el "submit_add" y si no lo esta, pasamos directamente a mostrar la plantilla
		if (!isset($_POST['submit_add'])){
			//Mostrar plantilla vacía	
			//pasarle a la plantilla los modulos y grupos con sus respectivos checkbox a checked false
			
			
			
			//$tpl->assign('usuarios',$this->per_module_methods);
			
			return $tpl;
		}
		//en el caso de que SI este definido submit_add
		else{
						
			//Introducir los datos de post.
			$this->get_elements_from_post();
			//$this->insert_post();
			
			//Validacion
			//$return=validate_fields();
			
			//Een caso de que la validacion haya sido fallida se muestra la plantilla
			//con los campos erroneos marcados con un *
			return $tpl;
			$return=true; //Para pruebas dejar esta linea sin comentar
			
			if (!$return){
				//Mostrar plantilla con datos erroneos
				
			}
			else{
				//Si todo es correcto si meten los datos
				
				$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
				//crea una nueva conexi—n con una bbdd (mysql)
				$this->db = NewADOConnection($this->db_type);
				//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
				$this->db->debug=false;
				//realiza una conexi—n permanente con la bbdd
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
				$record[$this->ddbb_login] = $this->login;
				$record[$this->ddbb_passwd]=$this->passwd;
				$record[$this->ddbb_name]=$this->name;
				$record[$this->ddbb_last_name]=$this->last_name;
				$record[$this->ddbb_last_name2]=$this->last_name2;
				$record[$this->ddbb_full_name]=$this->full_name;
				$record[$this->ddbb_internal]=$this->internal;
				$record[$this->ddbb_active]=$this->active;
				//calculamos la sql de inserci—n respecto a los atributos
				$this->sql = $this->db->GetInsertSQL($this->result, $record);
				//print($this->sql);
				//insertamos el registro
				$this->db->Execute($this->sql);
				//si se ha insertado una fila
				if($this->db->Insert_ID()>=0){
					//SE INSERTAN LOS PERMISOS.

					//capturammos el id de la linea insertada
					$this->id_user=$this->db->Insert_ID();
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
	
	function remove($id){
	
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta para coger los campos de la bbdd
		//calcula la consulta de borrado.
		$this->sql="DELETE FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_user." = ".$id." LIMIT 1";
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
	
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta para coger los campos de la bbdd
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_user." = \"".$this->id_user."\"" ;
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
		$record[$this->ddbb_id_user]=$this->id_user;
		$record[$this->ddbb_login] = $this->login;
		$record[$this->ddbb_passwd]=$this->passwd;
		$record[$this->ddbb_name]=$this->name;
		$record[$this->ddbb_last_name]=$this->last_name;
		$record[$this->ddbb_last_name2]=$this->last_name2;
		$record[$this->ddbb_full_name]=$this->full_name;
		$record[$this->ddbb_internal]=$this->internal;
		$record[$this->ddbb_active]=$this->active;
		//calculamos la sql de inserci—n respecto a los atributos
		$this->sql = $this->db->GetUpdateSQL($this->result, $record);
		//insertamos el registro
		$this->db->Execute($this->sql);
		//si se ha insertado una fila
		if($this->db->Affected_Rows()==1){
			//capturammos el id de la linea insertada
			$this->db->close();
			//devolvemos el id de la tabla ya que todo ha ido bien
			return $this->id_user;
		}else {
			//devolvemos 0 ya que no se ha insertado el registro
			$this->error=-1;
			$this->db->close();
			return 0;
		}

	
	}
	  
	*/

	function view ($id,$tpl)
	{
	
	/*	Cosas que faltan por hacer:
			De forma general, mirar los permisos del usuario que vaya a acceder aqui, para saber si tiene permisos de borrar editar ver etc...
			Averiguar como pasar el numero de registros, si va a ser a grupos a grupos, si va a ser a modulos, a modulos
			Order By (y mantener la búsqueda en el caso de que hubiera hecha una y averiguar la "pestaña" a la que hace referencia)
			Busquedas
	*/
	/*
			$cadena='';			
			// Leemos el usuario y se lo pasamos a la plantilla
			$this->read($id);
			$tpl->assign('objeto',$this);
			//listado de modulos
			$tabla_empleados = new table(false);

			if ($this->get_list_emps($id)==0)
			{
				$cadena=$cadena.$tabla_empleados->tabla_vacia('emps');
				$variables_empleados=$tabla_empleados->nombres_variables;
			}
			else
			{					
				$cadena=$cadena.$tabla_empleados->make_tables('user_corps',$this->emps_list,array('Nombre de empleado',75),array('id_emp','name'),10,array('select'),true);
				$variables_empleados=$tabla_empleados->nombres_variables;
			}
			$i=0;
			while($i< count($variables_empleados))
			{
				for($j=0;$j< count($variables_empleados);$j++)
				{
					$variables[$i]=$variables_empleados[$j];
					$i++;
				}
				
			}
			
			//****			
			$tpl->assign('variables',$variables);
			$tpl->assign('cadena',$cadena);
			//	
			
			*/		
				
	}
	
	function listar($tpl)
	{
		$this->get_list_emps($_SESSION['ident_corp']);

		$tabla_listado = new table(true);
		$cadena=''.$tabla_listado->make_tables('emps',$this->emps_list,array('Nombre',20,'Primer Apellido',20,'Segundo Apellido',20),array($this->ddbb_id_emp, $this->ddbb_name,$this->ddbb_last_name,$this->ddbb_last_name2),10,array('view','modify','delete'),true);
		$variables=$tabla_listado->nombres_variables;		
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
										$tpl->assign("message","&nbsp;<br>Usuario a&ntilde;adido correctamente<br>&nbsp;");
									}
									$tpl->assign("objeto",$this);									
									$tpl->assign("usuarios",$this->obj_user);
									$tpl->assign("modulos",$this->obj_user->checkbox);
									$tpl->assign("grupos",$this->obj_user->checkbox_groups);
									break;
									
						case 'list':
									$tpl=$this->listar($tpl);
									break;
						case 'modify':
									$this->read($_GET['id']);
									if ($this->modify() !=0){
										$this->method="list";
										$tpl=$this->listar($tpl);										
										$tpl->assign("message","&nbsp;<br>Usuario modificado correctamente<br>&nbsp;");
									}
									$tpl->assign("objeto",$this);
									$tpl->assign("modulos",$this->checkbox);
									$tpl->assign("grupos",$this->checkbox_groups);
									break;
						case 'delete':
									$this->read($_GET['id']);
									if ($this->remove($_GET['id'])==0){
										$tpl->assign("message",$this->empleados);
									}
									else{
										$this->emps_list="";
										$method="list";
										$tpl=$this->listar($tpl);
										$tpl->assign("message","&nbsp;<br>Usuario borrado correctamente<br>&nbsp;");
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
				$tpl->assign('plantilla','emps_'.$this->method.'.tpl');					
		
		return $tpl;
	}
	
	function get_elements_from_post(){		
		$resultado=$_POST["modulo_1"];
		echo "hola1<br>";
		print_r($resultado);
		echo "<br>";
		echo "hola2<br>";
		return 0;
	}

	function bar($method,$corp){		
		if ($corp != ""){
			$corp='<a href="index.php">'.$corp.' ::';
		}
		$nav_bar = '<a href="index.php">Zona privada</a> :: '.$corp.' <a href="index.php?module=users">Empleados</a>';
		$nav_bar=$nav_bar.$this->localice($method);
		return $nav_bar;
	}	

	function title($method,$corp){
		if ($corp != ""){
			$corp=$corp." ::";
		}
		$title = "Zona Privada :: $corp Empleados";
		$title=$title.$this->localice($method);		
		return $title;
	}		
	
	function localice($method){	
		switch($method){
						case 'add':
									$localice=" :: A&ntilde;adir Empleados";
									break;
						case 'list':
									$localice=" :: Buscar Empleados";
									break;
						case 'modify':
									$localice=" :: Modificar Empleados";
									break;
						case 'delete':
									$localice=" :: Borrar Empleados";
									break;
						case 'view':
									$localice=" :: Ver Empleado";									
									break;
						default:
									$localice=" :: Buscar Empleados";
									break;
		}
		return $localice;
	}
	
	function verify_emps($id){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql='SELECT * FROM `emps` WHERE `id_user` = \''.$id.'\'';
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
			$this->emps_users_list[$this->num]['id_emp']=$this->result->fields['id_emp'];
			$this->emps_users_list[$this->num]['name']=$this->result->fields['name'];
			$this->emps_users_list[$this->num]['last_name']=$this->result->fields['last_name'];
			$this->emps_users_list[$this->num]['last_name2']=$this->result->fields['last_name2'];
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