<?php
//clase que da soporte a los grupos del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');
require_once ($ADODB_DIR.'adodb.inc.php');
class cat_servs{
//internal vars
	var $id_cat_serv;
	var $name;
	var $descrip;
	var	$id_parent_cat;
	var $path_photo;
	var $theme;

//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $table_prefix;
	var $table_name='cat_servs';
	var $ddbb_id_cat_serv='id_cat_serv';
	var $ddbb_name='name';
	var	$ddbb_id_parent_cat='id_parent_cat';
	var $ddbb_path_photo='path_photo';
	var $ddbb_descrip='descrip';
	var $db;
	var $result;  	
//variables complementarias	
  	var $cat_servs_list;
  	var $num;
  	var $fields_list;
  	var $error;
	var $method;
	var $var_name = "id_cat_serv";	
	var $table_names_modify;
	var $table_names_delete = array ("rel_cat_servs");
  	//constructor
	function cat_servs(){
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
		$this->fields_list->add($this->ddbb_id_cat_serv, $this->id_cat_serv, 'int', 11,0);
		$this->fields_list->add($this->ddbb_name, $this->name, 'varchar', 50,0,1);
		$this->fields_list->add($this->ddbb_id_parent_cat, $this->id_parent_cat, 'int', 11,0);
		$this->fields_list->add($this->ddbb_path_photo, $this->path_photo, 'varchar', 255,0);
		$this->fields_list->add($this->ddbb_descrip, $this->descrip, 'text', 255,0);
		//print_r($this);
		//se puede acceder a los grupos por numero de campo o por nombre de campo
	/*	$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
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
		$this->db->close();*/
		return $this/*->get_list_cat_servs()*/;	 
		
	}
	
	function get_list_cat_servs (){
		//se puede acceder a los grupos_usuarios por numero de campo o por nombre de campo
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
		
		$this->num=0;
		while (!$this->result->EOF) {
			//cogemos los datos del usuario
			$this->cat_servs_list[$this->num][$this->ddbb_id_cat_serv]=$this->result->fields[$this->ddbb_id_cat_serv];
			$this->cat_servs_list[$this->num][$this->ddbb_name]=$this->result->fields[$this->ddbb_name];
			$this->cat_servs_list[$this->num][$this->ddbb_id_parent_cat]=$this->result->fields[$this->ddbb_id_parent_cat];
			$this->cat_servs_list[$this->num][$this->ddbb_path_photo]=$this->result->fields[$this->ddbb_path_photo];
			$this->cat_servs_list[$this->num][$this->ddbb_descrip]=$this->result->fields[$this->ddbb_descrip];
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
	
		//se puede acceder a los gruposs por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name." WHERE ".$this->ddbb_id_cat_serv."= \"".$id."\"";
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$error=1;
			return 0;
			$this->db->close();
		}else{
			$this->id_cat_serv=$id;
			$this->name=$this->result->fields[$this->ddbb_name];
			$this->id_parent_cat=$this->result->fields[$this->ddbb_id_parent_cat];
			$this->path_photo=$this->result->fields[$this->ddbb_path_photo];
			$this->descrip=$this->result->fields[$this->ddbb_descrip];
			$this->db->close();
			return 1;
		}
		
	
	}
	
	function add(){
		//Miramos a ver si esta definida el "submit_add" y si no lo esta, pasamos directamente a mostrar la plantilla
		if (!isset($_POST['submit_add'])){
			//Mostrar plantilla vac�a	
			
			return 0;
		}
		//en el caso de que SI este definido submit_add
		else{
						
			//Introducir los datos de post.
			$this->get_fields_from_post();	
						
			$this->id_cat_serv=0;
			$this->fields_list->modify_value($this->ddbb_id_cat_serv,$this->id_cat_serv);
			$this->fields_list->modify_value($this->ddbb_id_parent_cat,$this->id_parent_cat);
			$this->fields_list->modify_value($this->ddbb_name,$this->name);
			$this->fields_list->modify_value($this->ddbb_descrip,$this->descrip);
			//validamos
			$return=$this->fields_list->validate();	
			$return=$return && $this->validate_categories();
			if (!$return){
				//Mostrar plantilla con datos erroneos
				return -1;
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
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_cat_serv." = -1" ;
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
		$record[$this->ddbb_descrip]=$this->descrip;
		$record[$this->ddbb_path_photo]=$this->path_photo;
		$record[$this->ddbb_id_parent_cat]=$this->id_parent_cat;
		//calculamos la sql de insercin respecto a los atributos
		$this->sql = $this->db->GetInsertSQL($this->result, $record);
		
		//print($this->sql);
		//insertamos el registro
		$this->db->Execute($this->sql);
		//si se ha insertado una fila
		if($this->db->Insert_ID()>=0){
			//capturammos el id de la linea insertada
			$this->id_cat_serv=$this->db->Insert_ID();
			//print("<pre>::".$this->descrip."::</pre>");
			//devolvemos el id de la tabla ya que todo ha ido bien
			$this->db->close();
			if($_SESSION['ruta_temporal'] != "")
			{
   				$file = new upload_file( $_SESSION['nombre_photo'], $_SESSION['ruta_temporal'], $_SESSION['tamanno_photo'], $this->id_cat_serv);
   				$result = $file->upload( "images/cat_servs/" );
   				if($result == 1)
   				{
   					//modificar ruta de la foto
					$this->modify_photo($this->id_cat_serv);
				}
 			}	
			else
			{
				$direccion = "images/cat_servs/".$this->id_cat_serv.".gif";
				//Copiar fichero con no imagen
				if (!copy("pics/no-image.gif",$direccion))
				{
   					print("Error al copiar el fichero");
				}
				else
				{
					$_SESSION['ruta_photo'] = "images/cat_servs/".$this->id_cat_serv.".gif";
					//modificar ruta de la foto
					$this->modify_photo($this->id_cat_serv);
				}
			}
			return $this->id_cat_serv;
		}else {
			//devolvemos 0 ya que no se ha insertado el registro
			$this->error=-1;
			$this->db->close();
			return 0;
		}	
		}
		}				
	}
	
	function validate_categories(){
	/**********************
	 * Posibilidades:
	 * 		1-	Si es categoria padre, no puede elegir
	 * 			categorias hijas,nietas... como su cateogoria
	 * 			padre
	 * 		2-	
	 */
	return true;
	}
	
	function modify_photo($id_cat_serv)
	{
	
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexin con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexin de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexin permanente con la bbdd
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
		//mete la consulta para coger los campos de la bbdd
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_cat_serv." = \"".$this->id_cat_serv."\"" ;
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
		$record[$this->ddbb_id_cat_serv]=$this->id_cat_serv;
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
			return $this->id_cat_serv;
		}
		else 
		{
			//devolvemos 0 ya que no se ha insertado el registro
			$this->error=-1;
			$this->db->close();
			return 0;
		}
	}
	
	function remove($id){
	if (!isset($_POST["submit_delete"])){
				//Miramos a ver si hay algun servicio que tenga esta categoria
				$this->view_servs($this->id_cat_serv);					
							
				return 0;
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
		//calcula la consulta de borrado.
		$this->sql="DELETE FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_cat_serv." = ".$id." LIMIT 1";
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->db->Affected_Rows() == 0){
			$this->error=1;
			$this->db->close();
			return 0;
		}else{
			//Borramos la foto
			if($this->path_photo != "")
				unlink($this->path_photo);
			//Fin del borrado de la foto
			$this->make_remove($this->id_cat_serv);
			$this->error=0;
			$this->db->close();
			return 1;
			
		}
			}
	}
	
	function make_remove($id){
		//modificamos todos aquellos registros en los que hay un id_user;
		for ($i=0;$i<count($this->table_names_modify);$i++){
			$this->modify_all_id_cat_serv($id,$this->table_names_modify[$i]);
		}
		//borramos todos aquellos registros en los que hay un id_user;		
		for ($i=0;$i<count($this->table_names_delete);$i++){
			$this->delete_all_id_cat_serv($id,$this->table_names_delete[$i]);
		}
		$this->modify_parent_cats($id,$this->table_name);
	}
	
	function modify_all_id_cat_serv($id,$table){
			$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
			//crea una nueva conexi�n con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexi�n permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.
			$this->sql="UPDATE ".$table. " SET id_cat_serv = 0 WHERE id_cat_serv = ".$id;
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
	//Modificamos todos aquellos registros que tengan como padre la categoria que se ha borrado
	function modify_parent_cats($id,$table){
			$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
			//crea una nueva conexi�n con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexi�n permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.
			$this->sql="UPDATE ".$table. " SET id_parent_cat = 0 WHERE id_parent_cat = ".$id;
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
	
	function delete_all_id_cat_serv($id,$table){
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
			//crea una nueva conexi�n con una bbdd (mysql)
			$this->db = NewADOConnection($this->db_type);
			//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
			$this->db->debug=false;
			//realiza una conexi�n permanente con la bbdd
			$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->db_name);
			//mete la consulta para coger los campos de la bbdd
			//calcula la consulta de borrado.

			$this->sql="DELETE FROM ".$table. " WHERE id_cat_serv = ".$id;
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
	
	function view_servs($id){
		
			$service = new services();	
				
				$result=$service->verify_services($id);
				$this->servicios="";
				if ($result!=0){
					$this->servicios="<p>Atenci�n este categor&iacute;a tiene asignados los siguientes servicios:";
					$this->servicios.="<br><br>";
					for($i=0;$i<$result;$i++){
						$this->servicios.="&nbsp;&nbsp;&nbsp;";
						$this->servicios.=$service->serv_cat_list[$i]["name"]."&nbsp;";					
					}
					$this->servicios.="<br>";
					$this->servicios.="Si borra esta categor&iacute;a, se borrar&aacute; la relaci&oacute;n con estos servicios";
					$this->servicios.="</p>";
				}			
	}
	
	function modify(){
	if (!isset($_POST['submit_modify'])){
			//Mostrar plantilla vac�a		
			
			return 0;
		}
		else{
			//Introducir los datos de post.
			//Si se modific� la foto
			if($_SESSION['ruta_temporal'] != "")
				{
   				$file = new upload_file( $_SESSION['nombre_photo'], $_SESSION['ruta_temporal'], $_SESSION['tamanno_photo'], $this->id_vehicle, $this->path_photo);
   				$result = $file->upload( "images/cat_servs/" );
   				}	
			

			$this->get_fields_from_post();
			//$this->insert_post();
			
			//Validacion
			//$return=validate_fields();
			$this->fields_list->modify_value($this->ddbb_id_cat_serv,$this->id_cat_serv);
			$this->fields_list->modify_value($this->ddbb_id_parent_cat,$this->id_parent_cat);
			$this->fields_list->modify_value($this->ddbb_name,$this->name);
			$this->fields_list->modify_value($this->ddbb_descrip,$this->descrip);
			//validamos
			$return=$this->fields_list->validate();	
			$return=$return && $this->validate_categories();
			//En caso de que la validacion haya sido fallida se muestra la plantilla
			//con los campos erroneos marcados con un *
			
			
			if (!$return){
				//Mostrar plantilla con datos erroneos
				return -1;	
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
		$this->sql="SELECT * FROM ".$this->table_prefix.$this->table_name. " WHERE ".$this->ddbb_id_cat_serv." = \"".$this->id_cat_serv."\"" ;
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
		$record[$this->ddbb_id_cat_serv]=$this->id_cat_serv;
		$record[$this->ddbb_name]=$this->name;
		$record[$this->ddbb_descrip]=$this->descrip;				
		//calculamos la sql de insercin respecto a los atributos
		$this->sql = $this->db->GetUpdateSQL($this->result, $record);
		//insertamos el registro
		$this->db->Execute($this->sql);
		//si se ha insertado una fila
		if($this->db->Affected_Rows()==1){
			//capturammos el id de la linea insertada
			$this->db->close();
			//devolvemos el id de la tabla ya que todo ha ido bien
			return $this->id_cat_serv;
		}else {
			//devolvemos 0 ya que no se ha insertado el registro
			$this->error=-1;
			$this->db->close();
			return 0;
		}
	}}
	
	}
	  
	function show($id, $tpl)
	{
		$this->read($id);
		$tpl->assign('objeto', $this);
		return $tpl;
	}
	
	function listar($tpl){
		$num = $this->get_list_cat_servs();
		$tabla_listado = new table(true);
		$per = new permissions();
		$per->get_permissions_list('cat_servs');
		if ($num==0)
		{
			$cadena=''.$cadena.$tabla_listado->tabla_vacia('cat_servs', $per->add);
			$variables=$tabla_listado->nombres_variables;
		}
		else
		{	
			$cadena=''.$tabla_listado->make_tables('cat_servs',$this->cat_servs_list,array('Nombre',20,'Descripci&oacute;n',60),array($this->ddbb_id_cat_serv,$this->ddbb_name,$this->ddbb_descrip),10,$per->permissions_module,$per->add);
			$variables=$tabla_listado->nombres_variables;
		}		
		$tpl->assign('variables',$variables);
		$tpl->assign('cadena',$cadena);		
		return $tpl;
	}
	
	function view ($id, $tpl){
	$this->read($id);
		$tpl->assign('objeto',$this);
	
			//Se comprueba si hay permiso para borrar o modificar
			$permisos_mod_del = new permissions();
			$permisos_mod_del->get_permissions_modify_delete('cat_servs');

			$tpl->assign('acciones',$permisos_mod_del->per_mod_del);

	return $tpl;
	}
	
	function get_fields_from_post(){
		
		//Cogemos los campos principales
		$this->name=htmlentities($_POST[$this->ddbb_name]);
		$this->descrip=htmlentities($_POST[$this->ddbb_descrip]);
		$this->path_photo = $_SESSION['ruta_photo'];
		$this->id_parent_cat=$_POST[$this->ddbb_id_parent_cat];
		//Colocar de manera provisional hasta que se haga la validacion de fields
		

		//Cogemos los checkbox de grupos

		return 0;
	}	
	
	function calculate_tpl($method, $tpl){
		$this->method=$method;
				switch($method){
						case 'add':									
									$return=$this->add();
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
												$tpl->assign("message","&nbsp;<br>Categoria de servicio a&ntilde;adida correctamente<br>&nbsp;");
												break;
									}
									$this->get_list_cat_servs();
									$tpl->assign("objeto",$this);
									break;
									
						case 'list':
									$tpl=$this->listar($tpl);
									break;
						case 'modify':
									$this->read($_GET['id']);
									$return=$this->modify();
									switch ($return){										
										case 0: //por defecto
												//$tpl->assign("tabla_checkbox",$this->table_categories(false));
												break;
										case -1: //Errores al intentar a�adir datos
												for ($i=0;$i<count($this->fields_list->array_error);$i+=2){
													$tpl->assign("error_".$this->fields_list->array_error[$i],$this->fields_list->array_error[$i+1]);
												}
												//$tpl->assign("tabla_checkbox",$this->table_categories(false));
												break;
										default: //Si se ha a�adido
												$this->method="list";
												$tpl=$this->listar($tpl);										
												$tpl->assign("message","&nbsp;<br>Categor&iacute;a de servicio modificada correctamente<br>&nbsp;");
												break;
									}
									$this->get_list_cat_servs();
									$tpl->assign("objeto",$this);
									break;
						case 'delete':
									
									$this->read($_GET['id']);
									if ($this->remove($_GET['id'])==0){
										$tpl->assign("message",$this->servicios);
									}
									else{
										$this->cat_servs_list="";
										$this->method="list";
										$tpl=$this->listar($tpl);
										$tpl->assign("message","&nbsp;<br>Categor&iacute;a borrada correctamente<br>&nbsp;");
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
									$this->method='list';
									$tpl=$this->listar($tpl);
									break;
					}

				$tpl->assign('plantilla','cat_servs_'.$this->method.'.tpl');					
		
		return $tpl;
	}
		
	/*function view_emps($id){
		
			$emp = new rel_emps_cats();
			$emp->get_list_rel_emps_cats();				
				$result=$emp->verify_servives($id);
				$this->empleados="";
				if ($result!=0){
					$this->empleados="<p>Atenci�n esta categor&iacute;a tiene asignados los siguientes empleados:";
					$this->empleados.="<br><br>";
					for($i=0;$i<$result;$i++){
						$this->empleados.="&nbsp;&nbsp;&nbsp;";
						$this->empleados.=$emp->emps_cats_list[$i]["name"]."&nbsp;";
						$this->empleados.=$emp->emps_cats_list[$i]["last_name"]."&nbsp;";
						$this->empleados.=$emp->emps_cats_list[$i]["last_name2"]."<br>";
					}
					$this->empleados.="<br>";
					$this->empleados.="Si borra esta categor&iacute;a, se borrar&aacute; la relaci&oacute;n con estos empleados";
					$this->empleados.="</p>";
				}			
	}*/
	
	function bar($method,$corp){
		if ($method!=$this->method){
			$method = $this->method;
		}		
		if ($corp != ""){
			$corp='<a href="index.php?module=corps&method=view&id='.$_SESSION['ident_corp'].'">'.$corp.'</a> ::';
		}
		$nav_bar = '<a href="index.php?module=user_corps">Zona privada</a> :: '.$corp.' <a href="index.php?module=cat_servs">Categor&iacute;a de servicios</a>';
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
		$title = "Zona Privada :: $corp Categor&iacute;a de servicios";
		$title=$title.$this->localice($method);		
		return $title;
	}		
	
	
	
	function localice($method){	
		switch($method){
						case 'add':
									$localice=" :: A&ntilde;adir Categor&iacute;a";
									break;
						case 'list':
									$localice=" :: Buscar Categor&iacute;a";
									break;
						case 'modify':
									$localice=" :: Modificar Categor&iacute;a";
									break;
						case 'delete':
									$localice=" :: Borrar Categor&iacute;a";
									break;
						case 'view':
									$localice=" :: Ver Categor&iacute;a";									
									break;
						case 'show':
									$localice=" :: Ver foto de la Categor&iacute;a";	
									break;
						default:
									$localice=" :: Buscar Categor&iacute;a";
									break;
		}
		return $localice;
	}

}

?>