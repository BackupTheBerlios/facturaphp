<?php
//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');
require_once ($ADODB_DIR."adodb.inc.php");

class laborers{
//internal vars
	var $id_laborer;
	var $id_emp;
	var $id_vehicle;
	var $name;
	var $last_name;
	var $last_name2;
	var $num_vehicles;
	var $date="00-00-0000";
//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $table_prefix;
	var $table_name='laborers';
	var $ddbb_id_laborer = 'id_laborer';
	var $ddbb_id_emp = 'id_emp';
	var $ddbb_id_vehicle = 'id_vehicle';
	var $ddbb_alias = 'alias';
	var $ddbb_path_photo = 'path_photo';
	var $ddbb_date = 'date';
//Informaci�n necesaria sobre empleado conductor y veh�culo conducido
	var $ddbb_name = 'name';
	var $ddbb_last_name = 'last_name';
	var $ddbb_last_name2 = 'last_name2';
//Consultas a la BBDD
	var $db;
	var $result; 
	var $result1; 
	var $sql;
		
//variables complementarias	
	var $emps_trans;
  	var $laborers_list;
	var $vehicles_list;
	var $vehicles_corp;
	var $fecha_cambiada;
  	var $num;
  	var $fields_list;
  	var $error;
	var $laborers_emps_list;
	var $obj_emp;
	var $come;
	var $method;
	
  	//constructor
	function laborers(){
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
		$this->fields_list->add($this->ddbb_id_laborer, $this->id_laborer, 'int', 11,0,1);
		$this->fields_list->add($this->ddbb_id_emp, $this->id_emp, 'int', 11,0,1);
		$this->fields_list->add($this->ddbb_id_vehicle, $this->id_vehicle, 'int', 11,0,1);
		$this->fields_list->add($this->ddbb_date, $this->date, 'date', 20,0);
	
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
/*		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
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
*/		
		/*******************************/
	
		return $this/*->get_list_laborers()*/;	 
		
	}
	
	function get_list_laborers ()
	{
		
		//Buscar los empleados de la empresa en la que se est� y coincidencia en id con los id de emps en drivers
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT laborers.* FROM emps, laborers WHERE emps.id_corp =".$_SESSION['ident_corp']." AND emps.id_emp=laborers.id_emp";

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
		$temp = null;
		$this->laborers_list = null;
		while (!$this->result->EOF) 
		{
			//Si hay m�s de un id_driver asociado a un empleado de la empresa evitamos que salga m�s de una vez, 
			//para ello por cada emp nuevo se incrementa en uno su contador
			$temp[$num_emps][$this->ddbb_id_laborer]=$this->result->fields[$this->ddbb_id_laborer];
			$temp[$num_emps][$this->ddbb_id_emp]=$this->result->fields[$this->ddbb_id_emp];
			$temp[$num_emps][$this->ddbb_id_vehicle]=$this->result->fields[$this->ddbb_id_vehicle];
			$temp[$num_emps][$this->ddbb_id_date]=$this->result->fields[$this->ddbb_id_date];

			$laborers[$temp[$num_emps][$this->ddbb_id_emp]]['cont']++;

		
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$num_emps++;		
		}	//while
		
		for($i=0; $i<=$num_emps;$i++)
		{
			if(($laborers[$temp[$i][$this->ddbb_id_emp]]['cont'] == 1))
			{
				//Si aparece y cont es 1 entonces es la primera vez que aparece
				//cogemos los datos del conductor (directamente de la BBDD)
				$this->laborers_list[$this->num][$this->ddbb_id_laborer]=$temp[$i][$this->ddbb_id_laborer];
				$this->laborers_list[$this->num][$this->ddbb_id_emp]=$temp[$i][$this->ddbb_id_emp];
				$this->laborers_list[$this->num][$this->ddbb_id_vehicle]=$temp[$i][$this->ddbb_id_vehicle];
				$this->laborers_list[$this->num][$this->ddbb_id_date]=$temp[$i][$this->ddbb_id_date];
			
				//Tratamos los datos para poder presentarselos al usuario
				$this->preparar_datos($this->laborers_list[$this->num][$this->ddbb_id_emp], $this->laborers_list[$this->num][$this->ddbb_id_vehicle]);
	
				$this->num++;
			}
			else
				$laborers[$temp[$i][$this->ddbb_id_emp]]['cont'] --;
		}
		
		$this->db->close();
		return $this->num;
	
	}
	
	function get_list_laborers_vehicle ($id_vehicle)
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
			$this->laborers_list[$this->num][$this->ddbb_id_laborer]=$this->result->fields[$this->ddbb_id_laborer];
			$this->laborers_list[$this->num][$this->ddbb_id_emp]=$this->result->fields[$this->ddbb_id_emp];
			$this->laborers_list[$this->num][$this->ddbb_id_vehicle]=$this->result->fields[$this->ddbb_id_vehicle];
			$this->laborers_list[$this->num][$this->ddbb_id_date]=$this->result->fields[$this->ddbb_id_date];
			
			//Tratamos los datos para poder presentarselos al usuario
			$this->preparar_datos($this->laborers_list[$this->num][$this->ddbb_id_emp], $this->laborers_list[$this->num][$this->ddbb_id_vehicle]);
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
		$this->laborers_list[$this->num][$this->ddbb_name] = $empleado->name;
		$this->laborers_list[$this->num][$this->ddbb_last_name] = $empleado->last_name;
		$this->laborers_list[$this->num][$this->ddbb_last_name2] = $empleado->last_name2;
		
		$this->name = $empleado->name;
		$this->last_name = $empleado->last_name;
		$this->last_name2 = $empleado->last_name2;
		
		$this->get_list_vehicles($id_emp);
		
	}
	
	function get_list_emps_trans()
	{
		//Buscar todos los empleados con categor�a transportista

		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);

		//mete la consulta
		$this->sql='SELECT emps.id_emp, emps.name, emps.last_name, emps.last_name2 FROM emps WHERE emps.id_corp = '.$_SESSION['ident_corp'];

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
			$this->emps_trans[$this->num][$this->ddbb_id_emp]=$this->result->fields[$this->ddbb_id_emp];
			$this->emps_trans[$this->num][$this->ddbb_name]=$this->result->fields[$this->ddbb_name];
			$this->emps_trans[$this->num][$this->ddbb_last_name]=$this->result->fields[$this->ddbb_last_name];
			$this->emps_trans[$this->num][$this->ddbb_last_name2]=$this->result->fields[$this->ddbb_last_name2];
			$this->emps_trans[$this->num]['nombre_completo'] = $this->emps_trans[$this->num][$this->ddbb_name]." ".$this->emps_trans[$this->num][$this->ddbb_last_name]." ".$this->emps_trans[$this->num][$this->ddbb_last_name2];
		
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		return $this->num;
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
		$this->sql="SELECT id_vehicle, id_laborer, date FROM ".$this->table_prefix.$this->table_name." WHERE id_emp = ".$id_emp;

		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$this->error=1;
			$this->db->close();

			return 0;
		}  
		$this->vehicles_list = null;
		$this->num_vehicles=0;
		while (!$this->result->EOF) {
			//cogemos los datos del conductor (directamente de la BBDD)
			$this->vehicles_list[$this->num_vehicles][$this->ddbb_id_laborer]=$this->result->fields[$this->ddbb_id_laborer];
			$this->vehicles_list[$this->num_vehicles][$this->ddbb_alias]=$this->result->fields[$this->ddbb_id_emp];
			$this->vehicles_list[$this->num_vehicles][$this->ddbb_id_vehicle]=$this->result->fields[$this->ddbb_id_vehicle];
			$this->vehicles_list[$this->num_vehicles][$this->ddbb_date]=$this->result->fields[$this->ddbb_date];
			
			//Por cada uno buscar el alias y dem�s datos (enlazar con veh�culos)
			$vehiculo = new vehicles();
			$vehiculo->read($this->vehicles_list[$this->num_vehicles][$this->ddbb_id_vehicle]);
			//A�adir veh�culo al listado		
			$this->vehicles_list[$this->num_vehicles][$this->ddbb_alias]=$vehiculo->alias;
			$this->vehicles_list[$this->num_vehicles][$this->ddbb_path_photo]=$vehiculo->path_photo;

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
	
	function add(){
		
		//Miramos a ver si esta definida el "submit_add" y si no lo esta, pasamos directamente a mostrar la plantilla
		if (!isset($_POST['submit_add'])){
			//Mostrar plantilla vac�a	
			//Buscar los empleados de la empresa en cuesti�n, que tengan categor�a de conductores (transportistas)
			
			return 0;
		}
		//en el caso de que SI este definido submit_add
		else{
						
			//Introducir los datos de post.
			$this->get_fields_from_post();	
						
			//Validacion
			
			//Modificamos los todos los valores del objeto fields con los nuevos datos del objeto product, exceptuando path_photo que eso se deberia hacer mediante la clase upload.
			//Al id_product se le da 0 por quse neecesita un valor para que 
			$this->id_laborer=0;
			$this->fields_list->modify_value($this->ddbb_id_laborer,$this->id_laborer);
			$this->fields_list->modify_value($this->ddbb_id_emp,$this->id_emp);
			$this->fields_list->modify_value($this->ddbb_id_vehicle,$this->id_vehicle);
			$this->fields_list->modify_value($this->ddbb_date,$this->date);
			//validamos
			$return=$this->fields_list->validate();	//Para pruebas dejar esta linea sin comentar

			if (!$return){
				//Mostrar plantilla con datos erroneos
				return -1;
			}
		    else{
				//Si todo es correcto si meten los datos
				$this->date=$this->fields_list->change_date($this->date,"en");
				
				$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
				//crea una nueva conexin con una bbdd (mysql)
				$this->db = NewADOConnection($this->db_type);
				//le dice que no salgan los errores de conexin de la ddbb por pantalla
				$this->db->debug=false;
				//realiza una conexin permanente con la bbdd
				$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
				//mete la consulta para coger los campos de la bbdd
				$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_laborer." = -1" ;
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
				$record[$this->ddbb_id_vehicle]=$this->id_vehicle;
				$record[$this->ddbb_date]=$this->date;
					
				//calculamos la sql de insercin respecto a los atributos
				$this->sql = $this->db->GetInsertSQL($this->result, $record);
				//print($this->sql);
				//insertamos el registro
				$this->db->Execute($this->sql);
				//si se ha insertado una fila
				if($this->db->Insert_ID()>=0){
					//Cogemos el id del conductor insertado.					
					$this->id_laborer=$this->db->Insert_ID();
				
					//devolvemos el id de la tabla ya que todo ha ido bien
					$this->db->close();
					return $this->id_laborer;
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
		if (!isset($_POST['submit_modify'])){
			$this->date=$this->fields_list->change_date($this->date,"es");
			//Mostrar plantilla vac�a				
			
			return 0;
		}
		else{
			//Introducir los datos de post.
			$this->get_fields_from_post();
			//$this->insert_post();
			

			$this->fields_list->modify_value($this->ddbb_id_laborer,$this->id_laborer);
			$this->fields_list->modify_value($this->ddbb_id_emp,$this->id_emp);
			$this->fields_list->modify_value($this->ddbb_id_vehicle,$this->id_vehicle);
			$this->fields_list->modify_value($this->ddbb_date,$this->date);
			//validamos
			$return=$this->fields_list->validate();	//Para pruebas dejar esta linea sin comentar

			if (!$return){
				//Mostrar plantilla con datos erroneos
				return -1;
			}
			else{
				$this->date=$this->fields_list->change_date($this->date,"en");
				$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
				//crea una nueva conexin con una bbdd (mysql)
				$this->db = NewADOConnection($this->db_type);
				//le dice que no salgan los errores de conexin de la ddbb por pantalla
				$this->db->debug=false;
				//realiza una conexin permanente con la bbdd
				$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
				//mete la consulta para coger los campos de la bbdd
				$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_laborer." = \"".$this->id_laborer."\"" ;
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
				$record[$this->ddbb_id_vehicle]=$this->id_vehicle;
				$record[$this->ddbb_date]=$this->date;

				//calculamos la sql de insercin respecto a los atributos
				$this->sql = $this->db->GetUpdateSQL($this->result, $record);
				//insertamos el registro
				$this->db->Execute($this->sql);
				//si se ha insertado una fila
				$Affected_Rows=$this->db->Affected_Rows();
					
				if(($Affected_Rows==1)||($this->sql=="")){
					//capturammos el id de la linea insertada
					$this->db->close();
					//devolvemos el id de la tabla ya que todo ha ido bien
					return $this->id_laborer;
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
			if (!isset($_POST["submit_delete"])){
				
									
				return 0;
			}
			else{
			//HAY QUE VERIFICAR EN LAS COMPROBACIONES QUE NO SE ELIMINE EL MISMO USUARIO
			//QUE ESTA CONECTADO EN ESTE MOMENTO.
			$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
			//crea una nueva conexi�n con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexi�n permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.
			$this->sql="DELETE FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_laborer." = ".$id;
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
		$this->sql="SELECT * FROM `laborers` WHERE `id_laborer`=".$id;
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
			$this->id_laborer = $id;
			$this->id_emp = $this->result->fields[$this->ddbb_id_emp];
			$this->id_vehicle = $this->result->fields[$this->ddbb_id_vehicle];
			$this->date = $this->result->fields[$this->ddbb_date];
			//Prepara datos
			$this->preparar_datos($this->id_emp);
			
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
				$tpl->assign("emp_laborer","Sin Usuario");
			}
			else
			{
				$usuario = new users();
				$usuario->read($empleado->id_user);
				$tpl->assign("emp_laborer",$usuario->login);
			}
			
			
			
			//Como puede que un mismo empleado tenga a su cargo m�s de un veh�culo, no se podr� optar por este camino a borrar o modificar
			/*$permisos_mod_del = new permissions();
			$permisos_mod_del->get_permissions_modify_delete('drivers');
			$tpl->assign('acciones',$permisos_mod_del->per_mod_del);*/
			
			//Para borrar o modificar se debe acceder mediante la tabla
			
			//Se prepara la lista de vehiculos
			$tabla_listado = new table(true);
			$per = new permissions();
			$per->get_permissions_list('laborers');
	
				
			//Toda persona con permso podr� modificar o borrar los datos del conductor, podr� hacerlo
			$j=0;
			for ($i=0;$i<count($per->permissions_module);$i++)
			{
				if(($per->permissions_module[$i]=="modify")||($per->permissions_module[$i]=="delete"))
				{
					$permisos[$j]=$per->permissions_module[$i];
					$j++;
				} 
			}

		
			if ($this->num_vehicles==0)
			{
				$cadena=''.$cadena.$tabla_listado->tabla_vacia('laborers', $per->add);
				$variables=$tabla_listado->nombres_variables;
			}
			else
			{	
				$cadena=''.$tabla_listado->make_tables('laborers',$this->vehicles_list,array('Alias del veh�culo',60,'Fecha de asignacion',20),array($this->ddbb_id_laborer, $this->ddbb_alias, 'fecha_cambiada'),10,$permisos,$per->add);
				$variables=$tabla_listado->nombres_variables;	
			}				
			$tpl->assign('variables',$variables);
			$tpl->assign('cadena',$cadena);		
						
			return $tpl;
				
	}
	
	function listar($tpl)
	{
		$num = $this->get_list_laborers();
	
		$tabla_listado = new table(true);
		$per = new permissions();
		$num_per = $per->get_permissions_list('laborers');
			
		$per_vi_del = null;
		for($i=0; $i<$num_per;$i++)
			if($per->permissions_module[$i] == 'view')
				$per_vi_del = array($per->permissions_module[$i]);	
		
		if ($num==0)
		{
			$cadena=''.$cadena.$tabla_listado->tabla_vacia('laborers', $per->add);
			$variables=$tabla_listado->nombres_variables;
		}
		else
		{	
			$cadena=''.$tabla_listado->make_tables('laborers',$this->laborers_list,array('Nombre',20,'Primer Apellido',20,'Segundo Apellido',20),array($this->ddbb_id_laborer, $this->ddbb_name, $this->ddbb_last_name, $this->ddbb_last_name2),10,$per_vi_del,$per->add);
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
							$this->get_list_emps_trans();
							$this->vehicles_corp = new vehicles();
							$this->vehicles_corp->get_list_vehicles($_SESSION['ident_corp']);
							$return=$this->add();
							switch ($return){										
								case 0:
										$tpl->assign("empleados",$this->emps_trans);
										$tpl->assign("vehiculos", $this->vehicles_corp->vehicles_list);											
										break;
								case -1: //Errores al intentar a�adir datos
										for ($i=0;$i<count($this->fields_list->array_error);$i+=2){
											$tpl->assign("error_".$this->fields_list->array_error[$i],$this->fields_list->array_error[$i+1]);
										}												
										$tpl->assign("empleados",$this->emps_trans);
										$tpl->assign("vehiculos", $this->vehicles_corp->vehicles_list);
										break;
								default: //Si se ha a�adido
										$this->method="list";
										$tpl=$this->listar($tpl);										
										$tpl->assign("message","&nbsp;<br>Pe&oacute;n a&ntilde;adido correctamente<br>&nbsp;");										
										break;
								}
							//esto se hace independientemetne del valor que se obtenga
									
							$tpl->assign("objeto",$this);
							break;
							
				case 'list':
							$tpl=$this->listar($tpl);
							break;
				case 'modify':
							$this->get_list_emps_trans();
							$this->vehicles_corp = new vehicles();
							$this->vehicles_corp->get_list_vehicles($_SESSION['ident_corp']);
							$this->read($_GET['id']);
							$return=$this->modify();
							switch ($return){										
								case 0: //por defecto												
										break;
								case -1: //Errores al intentar a�adir datos
										for ($i=0;$i<count($this->fields_list->array_error);$i+=2){
											$tpl->assign("error_".$this->fields_list->array_error[$i],$this->fields_list->array_error[$i+1]);
										}												
										break;
								default: //Si se ha a�adido
										$this->method="list";
										$tpl=$this->listar($tpl);										
										$tpl->assign("message","&nbsp;<br>Pe&oacute;n modificado correctamente<br>&nbsp;");
										break;
							}
							$tpl->assign("empleados",$this->emps_trans);
							$tpl->assign("vehiculos", $this->vehicles_corp->vehicles_list);
							$tpl->assign("objeto",$this);
							break;
							
				case 'delete':
							$this->read($_GET['id']);
							if ($this->remove($_GET['id'])==0){
								$tpl->assign("message",$this->conductores);
							}
							else{
								
								$this->method="list";
								$tpl=$this->listar($tpl);
								$tpl->assign("message","&nbsp;<br>Pe&oacute;n borrado correctamente<br>&nbsp;");
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
		$tpl->assign('plantilla','laborers_'.$this->method.'.tpl');					
		
		return $tpl;
	}
	
	function get_fields_from_post()
	{		
		//Cogemos la fecha de asignaci�n
		$this->date=$_POST["date"];
		//Si el usuario ya estaba creado, se lo asignamos		
		$this->id_emp=$_POST["empleados"];
		//Cogemos el veh�culo
		$this->id_vehicle=$_POST["vehiculos"];
	}

	function bar($method,$corp){	
		if ($method!=$this->method){
			$method=$this->method;
		}	
		if ($corp != ""){
			$corp='<a href="index.php?module=corps&method=view&id='.$_SESSION['ident_corp'].'">'.$corp.'</a> ::';
		}
		$nav_bar = '<a href="index.php?module=user_corps">Zona privada</a> :: '.$corp.' <a href="index.php?module=laborers">Peones de carga</a>';
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
		$title = "Zona Privada :: $corp Peones de carga";
		$title=$title.$this->localice($method);		
		return $title;
	}		
	
	
	function localice($method){	
		switch($method){
						case 'add':
									$localice=" :: A&ntilde;adir Peones";
									break;
						case 'list':
									$localice=" :: Buscar Peones";
									break;
						case 'modify':
									$localice=" :: Modificar Peones";
									break;
						case 'delete':
									$localice=" :: Borrar Peones";
									break;
						case 'view':
									$localice=" :: Ver Pe&oacute;n";									
									break;
						default:
									$localice=" :: Buscar Peones";
									break;
		}
		return $localice;
	}
	
	function verify_laborers($id){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql='SELECT * FROM `laborers` WHERE `id_emp` = \''.$id.'\'';
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
			$this->laborers_emps_list[$this->num]['id_laborer']=$this->result->fields['id_laborer'];
			$this->laborers_emps_list[$this->num]['id_emp']=$this->result->fields['id_emp'];
			$this->laborers_emps_list[$this->num]['id_vehicle']=$this->result->fields['id_vehicle'];
			$this->laborers_emps_list[$this->num]['date']=$this->result->fields['date'];
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