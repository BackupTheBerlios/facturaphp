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
	var $method;
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
		else
		{
			$per = new permissions();
			$per->get_permissions_list('corps');
	
			$cadena=''.$tabla_listado->make_tables('corps',$this->corps_list,array('Nombre',20,'Nombre completo',20,'CIF|NIF',20,'Telefono',20),array($this->ddbb_id_corp,$this->ddbb_name,$this->ddbb_full_name,$this->ddbb_cif_nif,$this->ddbb_phone),20,$per->permissions_module,$per->add);
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
								$this->method=$method;
				switch($method){

						case 'add':
									if ($this->add() !=0){
										$this->method="list";
										$tpl=$this->listar($tpl);										
										$tpl->assign("message","&nbsp;<br>Empresa a&ntilde;adida correctamente<br>&nbsp;");
									}
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
										$tpl->assign("message","&nbsp;<br>Empresa modificada correctamente<br>&nbsp;");
									}
									$tpl->assign("objeto",$this);
									break;
						case 'delete':
									if ($_GET['id']==$_SESSION['ident_corp']){
										$this->emps_list="";
										$this->method="list";
										$tpl=$this->listar($tpl);
										$tpl->assign("message","&nbsp;<br>No se puede borrar la empresa por ser la empresa en uso. Desl&oacute;gese de esta empresa para poder borrarla.<br>&nbsp;");
										$tpl->assign("objeto",$this);
										break;
									}
									$this->read($_GET['id']);
									if ($this->remove($_GET['id'])!=0){				
										$this->corps_list="";
										$this->method="list";
										$tpl=$this->listar($tpl);
										$tpl->assign("message","&nbsp;<br>Empresa borrada correctamente<br>&nbsp;");
									}
									$tpl->assign("objeto",$this);
							
									break;
						case 'view':		
									if($_SESSION['super'] || $_SESSION['admin'])
									{
										$_SESSION['ident_corp'] = $_GET['id'];
									}							
									$tpl=$this->view($_GET['id'],$tpl);
									break;
						default:
									$this->method='list';
									$tpl=$this->listar($tpl);
									break;
					}
				$tpl->assign('plantilla','corps_'.$this->method.'.tpl');					
			}
		else
			{
			
			}
		return $tpl;
	}
	function add(){
			if (!isset($_POST['submit_add'])){
			//Mostrar plantilla vacía	

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
		
			}}
	}
	
	function get_fields_from_post(){
		
		//Cogemos los campos principales
		$this->name=$_POST[$this->ddbb_name];
		$this->full_name=$_POST[$this->ddbb_full_name];
		$this->address=$_POST[$this->ddbb_address];		
		$this->cif_nif=$_POST[$this->ddbb_cif_nif];		
		$this->fiscal_address=$_POST[$this->ddbb_fiscal_address];	
		$this->postal_address=$_POST[$this->ddbb_postal_address];
		$this->url=$_POST[$this->ddbb_url];
		$this->mail=$_POST[$this->ddbb_mail];
		$this->city=$_POST[$this->ddbb_city];
		$this->state=$_POST[$this->ddbb_state];
		$this->postal_code=$_POST[$this->ddbb_postal_code];
		$this->country=$_POST[$this->ddbb_country];
		$this->phone=$_POST[$this->ddbb_phone];
		$this->mobile_phone=$_POST[$this->ddbb_mobile_phone];
		$this->fax=$_POST[$this->ddbb_fax];
		$this->notes=$_POST[$this->ddbb_notes];


		return 0;
	}	
	
	function remove($id){
	if (!isset($_POST["submit_delete"])){
				
									
				return 0;
			}
			else{
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
			$this->make_remove($id);
			$this->error=0;
			$this->db->close();
			return 1;
			
		}
			}
	}
	
	function make_remove($id){
		
		//Borramos los empleados. Esto se irá haciendo con todos los módulos directamente
		//relacionados con la empresa que se este borrando.
		$empleados=new emps();
		$listado=$empleados->belong_corp($id);
		
		
		for ($i=0;$i<count($listado);$i++){
			
			$empleados->remove($listado[$i]["id_emp"]);
		}
		//Fin Borrado empleados	
	}
	
	function modify()
	{
		if (!isset($_POST['submit_modify'])){
			//Mostrar plantilla vacía		
			
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
			}}
	}
	
	function view ($id,$tpl)
	{
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
				
				$per = new permissions();
				$per->get_permissions_list('corps');
				$cadena=$cadena.$tabla_empleados->tabla_vacia('emps',$per->add);
				$variables_empleados=$tabla_empleados->nombres_variables;
			}
			else
			{	
				$per = new permissions();
				$per->get_permissions_list('corps');
							
				$cadena=''.$tabla_empleados->make_tables('emps',$empleados->emps_list,array('Nombre',20,'Primer Apellido',20,'Segundo Apellido',20),array('id_emp', 'name','last_name','last_name2'),10,$per->permissions_module,$per->add);
		
				$variables_empleados=$tabla_empleados->nombres_variables;
			}
			
			//Rellenamos de forma provisional las variables con un "no se puede mostrar"
			
			$clients = new table(false);
			$facturaspen= new table(false);
			$facturascob= new table(false);
			$products= new table(false);
			$services= new table(false);
			$gestionalm= new table(false);
			$partes= new table(false);
			
			$cadena=$cadena.$clients->dont_show('clients');
			$cadena=$cadena.$facturaspen->dont_show('facturaspen');
			$cadena=$cadena.$facturascob->dont_show('facturascob');
			$cadena=$cadena.$products->dont_show('products');
			$cadena=$cadena.$services->dont_show('services');
			$cadena=$cadena.$gestionalm->dont_show('gestionalm');
			$cadena=$cadena.$partes->dont_show('partes');
			
			$variables_clients=$clients->nombres_variables;
			$variables_facturaspen=$facturaspen->nombres_variables;
			$variables_facturascob=$facturascobs->nombres_variables;
			$variables_products=$products->nombres_variables;
			$variables_services=$services->nombres_variables;
			$variables_gestionalm=$gestionalm->nombres_variables;
			$variables_partes=$partes->nombres_variables;
			
			
			
			$i=0;
			while($i<(count($variables_empleados)+count($variables_clients)+count($variables_facturaspen)+count($variables_facturascob)+count($variables_products)+count($variables_services)+count($variables_gestionalm)+count($variables_partes)))
			{
				for($j=0;$j<count($variables_empleados);$j++)
				{
					$variables[$i]=$variables_empleados[$j];
					$i++;
				}
				for($j=0;$j<count($variables_clients);$j++)
				{
					$variables[$i]=$variables_clients[$j];
					$i++;
				}
				for($j=0;$j<count($variables_facturaspen);$j++)
				{
					$variables[$i]=$variables_facturaspen[$j];
					$i++;
				}
				for($j=0;$j<count($variables_facturascob);$j++)
				{
					$variables[$i]=$variables_facturascob[$j];
					$i++;
				}
				for($j=0;$j<count($variables_products);$j++)
				{
					$variables[$i]=$variables_products[$j];
					$i++;
				}
				for($j=0;$j<count($variables_services);$j++)
				{
					$variables[$i]=$variables_services[$j];
					$i++;
				}
				for($j=0;$j<count($variables_gestionalm);$j++)
				{
					$variables[$i]=$variables_gestionalm[$j];
					$i++;
				}
				for($j=0;$j<count($variables_partes);$j++)
				{
					$variables[$i]=$variables_partes[$j];
					$i++;
				}				
			}
			
			//Se comprueba si hay permiso para borrar o modificar
			$permisos_mod_del = new permissions();
			$permisos_mod_del->get_permissions_modify_delete($_SESSION['user'], 'corps');
			
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
			$corp='<a href="index.php?module=user_corps&method=select&id='.$_SESSION['ident_corp'].'">'.$corp.'</a> ::';
		}
		$nav_bar = '<a href="index.php?module=user_corps">Zona privada</a> :: '.$corp.' <a href="index.php?module=corps">Empresas</a>';
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