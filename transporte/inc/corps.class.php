<?php
//clase que da soporte a las empresas del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');
require_once ($ADODB_DIR."adodb.inc.php");

class corps{
//internal vars
	var $id_corp;
	var $name;
	var $full_name;
	var $cif_nif;
	var $address;
	var $fiscal_address;
	var $postal_address;
	var $url;
	var $mail;
	var $city;
	var $state;
	var $postal_code;
	var $country;
	var $phone;
	var $mobile_phone;
	var $fax;
	var $notes;
	var $theme;
//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $table_prefix;
	var $table_name='corps';
	var $ddbb_id_corp='id_corp';
  	var $ddbb_name='name';
  	var $ddbb_full_name='full_name';
	var $ddbb_cif_nif='cif_nif';
  	var $ddbb_address='address';
	var $ddbb_fiscal_address='fiscal_address';
	var $ddbb_postal_address='postal_address';
	var $ddbb_url='url';
	var $ddbb_mail='mail';
	var $ddbb_city='city';
	var $ddbb_state='state';
	var $ddbb_postal_code='postal_code';
	var $ddbb_country='country';
	var $ddbb_phone='phone';
	var $ddbb_mobile_phone='mobile_phone';
	var $ddbb_fax='fax';
	var $ddbb_notes='notes';
	
	var $db;
	var $result;  	
//variables complementarias	
  	var $corps_list;
  	var $num;
  	var $fields_list;
  	var $error;
  	//constructor
	function corps(){
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
		$this->fields_list->add($this->ddbb_id_corp, $this->id_corp, 'int', 11,0);
		$this->fields_list->add($this->ddbb_name, $this->name, 'varchar', 20,0);
		$this->fields_list->add($this->ddbb_full_name, $this->full_name, 'varchar', 50,0);
		$this->fields_list->add($this->ddbb_cif_nif, $this->cif_nif, 'cif_nif', 10,0);		
		$this->fields_list->add($this->ddbb_address, $this->address, 'varchar', 255,0);	
		$this->fields_list->add($this->ddbb_postal_address, $this->postal_address, 'varchar', 255,0);		
		$this->fields_list->add($this->ddbb_fiscal_address, $this->fiscal_address, 'varchar', 255,0);				
		$this->fields_list->add($this->ddbb_url, $this->url, 'varchar', 255,0);
		$this->fields_list->add($this->ddbb_mail, $this->mail, 'varchar', 100,0);
		$this->fields_list->add($this->ddbb_city, $this->city, 'varchar', 50,0);
		$this->fields_list->add($this->ddbb_state, $this->state, 'varchar', 50,0);		
		$this->fields_list->add($this->ddbb_postal_code, $this->postal_code, 'varchar', 10,0);		
		$this->fields_list->add($this->ddbb_country, $this->country, 'varchar', 50,0);				
		$this->fields_list->add($this->ddbb_phone, $this->phone, 'varchar', 15,0);		
		$this->fields_list->add($this->ddbb_mobile_phone, $this->mobile_phone, 'varchar', 15,0);		
		$this->fields_list->add($this->ddbb_fax, $this->fax, 'varchar', 15,0);				
		$this->fields_list->add($this->ddbb_notes, $this->notes, 'varchar', 255,0);						
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
		
		return $this->get_list_corps();	 
		
	}
	
	function get_list_corps (){
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
		
		$this->num=0;
		while (!$this->result->EOF) {
			//cogemos los datos del usuario
			$this->corps_list[$this->num][$this->ddbb_id_corp]=$this->result->fields[$this->ddbb_id_corp];
			$this->corps_list[$this->num][$this->ddbb_name]=$this->result->fields[$this->ddbb_name];
			$this->corps_list[$this->num][$this->ddbb_full_name]=$this->result->fields[$this->ddbb_full_name];
			$this->corps_list[$this->num][$this->ddbb_address]=$this->result->fields[$this->ddbb_address];
			$this->corps_list[$this->num][$this->ddbb_cif_nif]=$this->result->fields[$this->ddbb_cif_nif];
			$this->corps_list[$this->num][$this->ddbb_fiscal_address]=$this->result->fields[$this->ddbb_fiscal_address];
			$this->corps_list[$this->num][$this->ddbb_postal_address]=$this->result->fields[$this->ddbb_postal_address];
			$this->corps_list[$this->num][$this->ddbb_url]=$this->result->fields[$this->ddbb_url];
			$this->corps_list[$this->num][$this->ddbb_mail]=$this->result->fields[$this->ddbb_mail];
			$this->corps_list[$this->num][$this->ddbb_city]=$this->result->fields[$this->ddbb_city];
			$this->corps_list[$this->num][$this->ddbb_state]=$this->result->fields[$this->ddbb_state];
			$this->corps_list[$this->num][$this->ddbb_postal_code]=$this->result->fields[$this->ddbb_postal_code];
			$this->corps_list[$this->num][$this->ddbb_country]=$this->result->fields[$this->ddbb_country];
			$this->corps_list[$this->num][$this->ddbb_phone]=$this->result->fields[$this->ddbb_phone];
			$this->corps_list[$this->num][$this->ddbb_mobile_phone]=$this->result->fields[$this->ddbb_mobile_phone];
			$this->corps_list[$this->num][$this->ddbb_fax]=$this->result->fields[$this->ddbb_fax];
			$this->corps_list[$this->num][$this->ddbb_notes]=$this->result->fields[$this->ddbb_notes];
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
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name." WHERE ".$this->ddbb_id_corp."= \"".$id."\"";
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$error=1;
			return 0;
			$this->db->close();
		}else{
			$this->id_corp=$id;
			$this->name=$this->result->fields[$this->ddbb_name];
			$this->full_name=$this->result->fields[$this->ddbb_full_name];
			$this->cif_nif=$this->result->fields[$this->ddbb_cif_nif];
			$this->address=$this->result->fields[$this->ddbb_address];
			$this->fiscal_address=$this->result->fields[$this->ddbb_fiscal_address];
			$this->postal_address=$this->result->fields[$this->ddbb_postal_address];
			$this->url=$this->result->fields[$this->ddbb_url];
			$this->mail=$this->result->fields[$this->ddbb_mail];
			$this->city=$this->result->fields[$this->ddbb_city];
			$this->state=$this->result->fields[$this->ddbb_state];
			$this->postal_code=$this->result->fields[$this->ddbb_postal_code];
			$this->country=$this->result->fields[$this->ddbb_country];
			$this->phone=$this->result->fields[$this->ddbb_phone];
			$this->mobile_phone=$this->result->fields[$this->ddbb_mobile_phone];
			$this->fax=$this->result->fields[$this->ddbb_fax];
			$this->notes=$this->result->fields[$this->ddbb_notes];
			$this->db->close();
			return 1;
		}
			
	
	
	}
	
	function listar($tpl){

		$tabla_listado = new table(true);
		if (!$this->get_list_corps()){
			$cadena=$cadena.$tabla_listado->tabla_vacia('corps');
			$variables_modulos=$tabla_listado->nombres_variables;
		}
		else{
			if($_SESSION['user']='admin')
			{
				$acciones = array('view', 'modify', 'delete');
				$add = true;
			}
			else
			{
				$per = new permissions();
				$per->get_permissions_list('corps');
				
				$acciones = $per->permissions_module;
				$add = $per->add;
			}
		
			$cadena=''.$tabla_listado->make_tables('corps',$this->corps_list,array('Nombre',20,'Nombre completo',20,'CIF|NIF',20,'Telefono',20),array($this->ddbb_id_corp,$this->ddbb_name,$this->ddbb_full_name,$this->ddbb_cif_nif,$this->ddbb_phone),20,$acciones,$add);
			$variables=$tabla_listado->nombres_variables;		
		}		
		$tpl->assign('variables',$variables);
		$tpl->assign('cadena',$cadena);		
		return $tpl;
	}
	
	
	function calculate_tpl($method, $tpl){
		//vemos si el usuario tiene el permiso para hacer la accion requerida
		$result=true;
	//	$result=validate_per($method,$_SESSION['user'],$module);
		if ($result){
				switch($method){
						case 'add':
									break;
						case 'list':
									$tpl=$this->listar($tpl);
									break;
						case 'modify':
									break;
						case 'delete':
									break;
						case 'view':									
									$tpl=$this->view($_GET['id'],$tpl);
									break;
						default:
									$method='list';
									$tpl=$this->listar($tpl);
									break;
					}
				$tpl->assign('plantilla','corps_'.$method.'.tpl');					
			}
		else
			{
			
			}
		return $tpl;
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
			$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_corp." = -1" ;
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
			$record[$this->ddbb_full_name]=$this->full_name;
			$record[$this->ddbb_address]=$this->address;
			$record[$this->ddbb_cif_nif]=$this->cif_nif;
			$record[$this->ddbb_fiscal_address]=$this->fiscal_address;
			$record[$this->ddbb_postal_address] = $this->postal_address;
			$record[$this->ddbb_url]=$this->url;
			$record[$this->ddbb_mail]=$this->mail;
			$record[$this->ddbb_city]=$this->city;
			$record[$this->ddbb_state]=$this->state;
			$record[$this->ddbb_postal_code]=$this->postal_code;
			$record[$this->ddbb_country] = $this->country;
			$record[$this->ddbb_phone]=$this->phone;
			$record[$this->ddbb_mobile_phone]=$this->mobile_phone;
			$record[$this->ddbb_fax]=$this->fax;
			$record[$this->ddbb_notes]=$this->notes;
			//calculamos la sql de inserci—n respecto a los atributos
			$this->sql = $this->db->GetInsertSQL($this->result, $record);
			//print($this->sql);
			//insertamos el registro
			$this->db->Execute($this->sql);
			//si se ha insertado una fila
			if($this->db->Insert_ID()>=0){
				//capturammos el id de la linea insertada
				$this->id_corp=$this->db->Insert_ID();
				//print("<pre>::".$this->id_corp."::</pre>");
				//devolvemos el id de la tabla ya que todo ha ido bien
				$this->db->close();
				return $this->id_corp;
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
		$this->sql="DELETE FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_corp." = ".$id." LIMIT 1";
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
	
	function modify()
	{
	
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi—n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi—n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi—n permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta para coger los campos de la bbdd
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_corp." = \"".$this->id_corp."\"" ;
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
		$record[$this->ddbb_id_corp]=$this->id_corp;
		$record[$this->ddbb_name] = $this->name;
		$record[$this->ddbb_full_name]=$this->full_name;
		$record[$this->ddbb_address]=$this->address;
		$record[$this->ddbb_cif_nif]=$this->cif_nif;
		$record[$this->ddbb_fiscal_address]=$this->fiscal_address;
		$record[$this->ddbb_postal_address] = $this->postal_address;
		$record[$this->ddbb_url]=$this->url;
		$record[$this->ddbb_mail]=$this->mail;
		$record[$this->ddbb_city]=$this->city;
		$record[$this->ddbb_state]=$this->state;
		$record[$this->ddbb_postal_code]=$this->postal_code;
		$record[$this->ddbb_country] = $this->country;
		$record[$this->ddbb_phone]=$this->phone;
		$record[$this->ddbb_mobile_phone]=$this->mobile_phone;
		$record[$this->ddbb_fax]=$this->fax;
		$record[$this->ddbb_notes]=$this->notes;
		//calculamos la sql de inserci—n respecto a los atributos
		$this->sql = $this->db->GetUpdateSQL($this->result, $record);
		//insertamos el registro
		$this->db->Execute($this->sql);
		//si se ha insertado una fila
		if($this->db->Affected_Rows()==1){
			//capturammos el id de la linea insertada
			$this->db->close();
			//devolvemos el id de la tabla ya que todo ha ido bien
			return $this->id_corp;
		}else {
			//devolvemos 0 ya que no se ha insertado el registro
			$this->error=-1;
			$this->db->close();
			return 0;
		}
	
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
			// Leemos la empresa y se lo pasamos a la plantilla
			$this->read($id);
			$tpl->assign('objeto',$this);
			
			
			//listado de empleados
			$tabla_empleados = new table(false);
			
			$empleados = new emps();

			if ($empleados->get_list_emps($_SESSION['ident_corp'])==0)
			{

				$cadena=$cadena.$tabla_empleados->tabla_vacia('emps');
				$variables_empleados=$tabla_empleados->nombres_variables;
			}
			else
			{	
				if($_SESSION['user']='admin')
				{
					$acciones = array('view', 'modify', 'delete');
					$add = true;
				}
				else
				{
					$per = new permissions();
					$per->get_permissions_list('emps');
					
					$acciones = $per->permissions_module;
					$add = $per->add;
				}
							
				$cadena=''.$tabla_empleados->make_tables('emps',$empleados->emps_list,array('Nombre',20,'Primer Apellido',20,'Segundo Apellido',20),array('id_emp', 'name','last_name','last_name2'),10,$acciones,$add);
		
				$variables_empleados=$tabla_empleados->nombres_variables;
			}
			
			
			
			//$tpl->assign('list_modules', $this->list_modules_availables($id))
			//listado de permisos por modulos
			/*$tabla_grupos = new table(false);
			//listado de grupos
			if ($this->get_groups($id)==0){
				$cadena=$cadena.$tabla_grupos->tabla_vacia('group_users');
				$variables_grupos=$tabla_grupos->nombres_variables;
			}
			else{					
				$cadena=$cadena.$tabla_grupos->make_tables('group_users',$this->groups_list,array('Nombre de grupo',75),array('id_group','name_web'),10,array('delete'),true);
				$variables_grupos=$tabla_grupos->nombres_variables;
			}*/
			$i=0;
			while($i<(count($variables_empleados)/*+count($variables_modulos)*/)){
				for($j=0;$j<count($variables_empleados);$j++)
				{
					$variables[$i]=$variables_empleados[$j];
					$i++;
				}
				/*for($k=0;$k<count($variables_modulos);$k++){
					$variables[$i]=$variables_modulos[$k];
					$i++;
				}*/
			}
			
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
		$nav_bar = '<a>Zona privada</a> :: '.$corp.' <a href="index.php?module=corps">Empresas</a>';
		$nav_bar=$nav_bar.$this->localice($method);
		return $nav_bar;
	}		

	function title($method,$corp){
		if ($corp != ""){
			$corp=$corp." ::";
		}
		$title = "Zona Privada :: $corp Empresas";
		$title=$title.$this->localice($method);		
		return $title;
	}		
	
	function localice($method){	
		switch($method){
						case 'add':
									$localice=" :: A&ntilde;adir Empresa";
									break;
						case 'list':
									$localice=" :: Buscar Empresas";
									break;
						case 'modify':
									$localice=" :: Modificar Empresa";
									break;
						case 'delete':
									$localice=" :: Borrar Empresa";
									break;
						case 'view':
									$localice=" :: Ver Empresa";									
									break;
						default:
									$localice=" :: Buscar Empresa";
									break;
		}
		return $localice;
	}
	  
}
?>