<?php
//clase que da soporte a los grupos del programa
//enlaza con la bbdd 
//Variables para el listado de grupos en el formulario de alta de "usuarios": groups_list

global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($ADODB_DIR."adodb.inc.php");
class groups{
//internal vars
	var $id_group;
	var $name;
	var $descrip;
	var $name_web;
	var $theme;
//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $table_prefix;
	var $table_name='groups';
	var $ddbb_id_group='id_group';
	var $ddbb_name='name';
	var $ddbb_name_web='name_web';
  	var $ddbb_descrip='descrip';
  	var $db;
	var $result;
//variables complementarias	
  	var $groups_list;
  	var $num;
  	var $fields_list;
  	var $error;
	var $belong; //<- Esta variable se usara desde users.class.php la cual nos dira si el checkbox de los modelos modify o add estan a 1 o a 0 para grupos. Por defecto estará a 0.
	var $per_modules;
	var $num_modules;
	var $users_list;
  	//constructor
	function groups(){
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
		$this->fields_list->add($this->ddbb_id_group, $this->id_group, 'int', 11,0);
		$this->fields_list->add($this->ddbb_name, $this->name, 'varchar', 20,0);
		$this->fields_list->add($this->ddbb_name_web, $this->name_web, 'varchar', 100,0);
		$this->fields_list->add($this->ddbb_descrip, $this->descrip, 'text', 255,0);		
		//print_r($this);
		//se puede acceder a los grupos por numero de campo o por nombre de campo
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
		
		return $this->get_list_groups();	 
		
	}
	
	function get_list_groups (){
		//se puede acceder a los grupos por numero de campo o por nombre de campo
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
		
		$this->num=0;
		while (!$this->result->EOF) {
			//cogemos los datos del usuario
			$this->groups_list[$this->num][$this->ddbb_id_group]=$this->result->fields[$this->ddbb_id_group];
			$this->groups_list[$this->num][$this->ddbb_name]=$this->result->fields[$this->ddbb_name];
			$this->groups_list[$this->num][$this->ddbb_name_web]=$this->result->fields[$this->ddbb_name_web];
			$this->groups_list[$this->num][$this->ddbb_descrip]=$this->result->fields[$this->ddbb_descrip];
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		return $this->num;
	
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
	
	function verify_user($id){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql='SELECT `id_user` FROM `group_users` WHERE `id_group` = \''.$this->id_group.'\' AND `id_user` = \''.$id.'\'';
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
			$this->users_list[$this->num]['id_user']=$this->result->fields['id_user'];
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		return $this->num;
	}
	
	function get_permissions($id_group)
	{
		$this->modules = new modules();
	
		$this->num_modules = $this->modules->get_list_modules();

		for ($modulo_num = 0; $modulo_num < $this->num_modules; $modulo_num++) 
		{
			//Como se tiene el numero de modulos entonces se puede ver nombre e identificador en $this->modules->modules_list
			//Así será mas fácil recorrer la matriz, y no hay problemas de pasar un hash a smarty ya que no los acepta
			$this->per_modules[$modulo_num] = new permissions_modules();
			$this->per_modules[$modulo_num]->id_module = $this->modules->modules_list[$modulo_num]['id_module'];
			$this->per_modules[$modulo_num]->module_name = $this->modules->modules_list[$modulo_num]['name'];
			
			$this->per_modules[$modulo_num]->per =  0;
			
			
		
			$this->per_modules[$modulo_num]->inicializar_base_datos();
			$result = $this->per_modules[$modulo_num]->validate_per_group_module($id_group,$this->modules->modules_list[$modulo_num]['id_module'] );
		
			if($result == true)
				$this->per_modules[$modulo_num]->per =  1;
			
			$this->per_modules[$modulo_num]->num_methods = $this->modules->get_list_module_methods($this->per_modules[$modulo_num]->id_module);
			
			for ($metodo_num = 0; $metodo_num < $this->per_modules[$modulo_num]->num_methods; $metodo_num++) 
			{
				$this->per_modules[$modulo_num]->per_methods[$metodo_num] = new permissions_methods();
				$this->per_modules[$modulo_num]->per_methods[$metodo_num]->id_method = $this->modules->module_methods[$metodo_num]['id_method'];
				$this->per_modules[$modulo_num]->per_methods[$metodo_num]->method_name = $this->modules->module_methods[$metodo_num]['name'];				
				
					
				if($this->per_modules[$modulo_num]->per == true)
				{	
					$this->per_modules[$modulo_num]->per_methods[$metodo_num]->inicializar_base_datos();
					$this->per_modules[$modulo_num]->per_methods[$metodo_num]->per = 0;
					$result = $this->per_modules[$modulo_num]->per_methods[$metodo_num]->validate_per_group_method($id_group, $this->per_modules[$modulo_num]->per_methods[$metodo_num]->id_method);
					if($result == true)
						$this->per_modules[$modulo_num]->per_methods[$metodo_num]->per =  1;
				}
				else
				{
					$this->per_modules[$modulo_num]->per_methods[$metodo_num]->per = 0;
					//print "NO MOdulo: metodo ".$this->method_name." permisos ".$this->per."............";
				}
				
			}
		}
	}
	
	function read($id){
	
		//se puede acceder a los gruposs por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name." WHERE ".$this->ddbb_id_group."= \"".$id."\"";
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$error=1;
			return 0;
			$this->db->close();
		}else{
			$this->id_group=$id;
			$this->name=$this->result->fields[$this->ddbb_name];
			$this->name_web=$this->result->fields[$this->ddbb_name_web];
			$this->descrip=$this->result->fields[$this->ddbb_descrip];
			$this->belong=0;//Variable para los checkbox, por defecto a 0.
			$this->db->close();
			return 1;
		}
		
	
	}
	
	function add(){
	
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta para coger los campos de la bbdd
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_group." = -1" ;
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
		$record[$this->ddbb_name] = $this->name;
		$record[$this->ddbb_name_web]=$this->name_web;
		$record[$this->ddbb_descrip]=$this->descrip;
		//calculamos la sql de inserci—n respecto a los atributos
		$this->sql = $this->db->GetInsertSQL($this->result, $record);
		
		//print($this->sql);
		//insertamos el registro
		$this->db->Execute($this->sql);
		//si se ha insertado una fila
		if($this->db->Insert_ID()>=0){
			//capturammos el id de la linea insertada
			$this->id_group=$this->db->Insert_ID();
			//print("<pre>::".$this->id_user."::</pre>");
			//devolvemos el id de la tabla ya que todo ha ido bien
			$this->db->close();
			return $this->id_group;
		}else {
			//devolvemos 0 ya que no se ha insertado el registro
			$this->error=-1;
			$this->db->close();
			return 0;
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
		$this->sql="DELETE FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_group." = ".$id." LIMIT 1";
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
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_group." = \"".$this->id_group."\"" ;
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
		$record[$this->ddbb_id_group]=$this->id_group;
		$record[$this->ddbb_name]=$this->name;
		$record[$this->ddbb_name_web]=$this->name_web;
		$record[$this->ddbb_descrip]=$this->descrip;		
		//calculamos la sql de inserci—n respecto a los atributos
		$this->sql = $this->db->GetUpdateSQL($this->result, $record);
		//insertamos el registro
		$this->db->Execute($this->sql);
		//si se ha insertado una fila
		if($this->db->Affected_Rows()==1){
			//capturammos el id de la linea insertada
			$this->db->close();
			//devolvemos el id de la tabla ya que todo ha ido bien
			return $this->id_group;
		}else {
			//devolvemos 0 ya que no se ha insertado el registro
			$this->error=-1;
			$this->db->close();
			return 0;
		}

	
	}
	  
	/*function validate_user($user, $passwd){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name." WHERE ".$this->ddbb_login."=\"".$user."\"";
		//printf($this->sql);
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla
		//printf($this); 
		if ($this->result === false){
			//printf('no existe usuario o contrase–a');
			$error=1;
			$this->db->close();
			return 0;
		}else{  
		//la contrase–a es correcta
			if($passwd==$this->result->fields[$this->ddbb_passwd]){
			//printf('existe usuario o contrase–a');
			$this->db->close();
			return 1;
			}
		}
		$this->db->close();
		return 0;
		
		
	
	}*/
	
	function view ($id){
	
	}
	
	function admin ($id){
	
	}
}
?>