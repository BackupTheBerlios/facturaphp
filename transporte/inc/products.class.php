<?php
//clase que da soporte a los productos del programa
//enlaza con la bbdd 
global $ADODB_DIR, $INSTALL_DIR;
require_once ($INSTALL_DIR.'inc/config.inc.php');
require_once ($INSTALL_DIR.'inc/table.class.php');
require_once ($ADODB_DIR."adodb.inc.php");
class products{
//internal vars
	var $id_product;
	var $id_corp;
	var $name;
	var $name_web;
	var $path_photo;
	var $pvp;
	var $tax;
	var $pvp_tax;
	var $minimun_stock;
	
//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $table_prefix;
	var $table_name='products';
	var $ddbb_id_product='id_product';
	var $ddbb_id_corp='id_corp';
	var $ddbb_name='name';
	var $ddbb_name_web='name_web';
	var $ddbb_path_photo='path_photo';
	var $ddbb_pvp='pvp';
	var $ddbb_tax='tax';
	var $ddbb_pvp_tax='pvp_tax';
	var $ddbb_minimun_stock='minimun_stock';
	var $db;
	var $result;  
	var $sql;
		
//variables complementarias	
  	var $products_list;
  	var $num;
  	var $fields_list;
  	var $error;
	var $method;
	var $table_names_modify=array();
	var $table_names_delete=array();
	var $prod_cat_list;
	
	

  	//constructor
	function products()
	{
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
		$this->fields_list->add($this->ddbb_id_product, $this->id_product, 'int', 11,0);
		$this->fields_list->add($this->ddbb_id_corp, $this->id_corp, 'int', 11,0);
		$this->fields_list->add($this->ddbb_name, $this->name, 'varchar', 50,0);
		$this->fields_list->add($this->ddbb_name_web, $this->name_web, 'varchar', 50,0);
		$this->fields_list->add($this->ddbb_pvp, $this->pvp, 'int', 11,0);
		$this->fields_list->add($this->ddbb_tax, $this->tax, 'int', 11,0);
		$this->fields_list->add($this->ddbb_pvp_tax, $this->pvp_tax, 'int', 11,0);
		$this->fields_list->add($this->ddbb_path_photo, $this->path_photo, 'varchar', 255,0);
		$this->fields_list->add($this->ddbb_minimun_stock, $this->minimun_stock, 'int', 11,0);
		//print_r($this);
		//se puede acceder a los grupos por numero de campo o por nombre de campo
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
		
		return $this->get_list_products();	 
		
	}
	
	function get_list_products (){
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
			$this->products_list[$this->num][$this->ddbb_id_product]=$this->result->fields[$this->ddbb_id_product];
			$this->products_list[$this->num][$this->ddbb_id_corp]=$this->result->fields[$this->ddbb_id_corp];
			$this->products_list[$this->num][$this->ddbb_name]=$this->result->fields[$this->ddbb_name];
			$this->products_list[$this->num][$this->ddbb_name_web]=$this->result->fields[$this->ddbb_name_web];
			$this->products_list[$this->num][$this->ddbb_id_pvp]=$this->result->fields[$this->ddbb_id_pvp];
			$this->products_list[$this->num][$this->ddbb_id_tax]=$this->result->fields[$this->ddbb_id_tax];
			$this->products_list[$this->num][$this->ddbb_id_pvp_tax]=$this->result->fields[$this->ddbb_id_pvp_tax];
			$this->products_list[$this->num][$this->ddbb_path_photo]=$this->result->fields[$this->ddbb_path_photo];
			$this->products_list[$this->num][$this->ddbb_minimun_stock]=$this->result->fields[$this->ddbb_minimun_stock];
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		return $this->num;
	
	}
	
	function listar($tpl){
		$num = $this->get_list_products();
		$tabla_listado = new table(true);
		$per = new permissions();
		$per->get_permissions_list('products');
		if ($num==0)
		{
			$cadena=''.$cadena.$tabla_listado->tabla_vacia('products', $per->add);
			$variables=$tabla_listado->nombres_variables;
		}
		else
		{	
			$cadena=''.$tabla_listado->make_tables('products',$this->products_list,array('Nombre',20,'Nombre Web',20,'Imagen',40),array($this->ddbb_id_cat_prod,$this->ddbb_name,$this->ddbb_name_web,$this->ddbb_path_photo),10,$per->permissions_module,$per->add);
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
										$tpl->assign("message","&nbsp;<br>Producto a&ntilde;adido correctamente<br>&nbsp;");
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
										$tpl->assign("message","&nbsp;<br>Producto modificado correctamente<br>&nbsp;");
									}
									$tpl->assign("objeto",$this);
									break;
						case 'delete':
									
									$this->read($_GET['id']);
									if ($this->remove($_GET['id'])!=0){
									
										$this->products_list="";
										$this->method="list";
										$tpl=$this->listar($tpl);
										$tpl->assign("message","&nbsp;<br>Producto borrado correctamente<br>&nbsp;");
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

				$tpl->assign('plantilla','products_'.$this->method.'.tpl');						
		
		return $tpl;
	}

	function bar($method,$corp){
		if ($method!=$this->method){
			$method = $this->method;
		}		
		if ($corp != ""){
			$corp='<a href="index.php?module=corps&method=view&id='.$_SESSION['ident_corp'].'">'.$corp.' ::';
		}
		$nav_bar = '<a>Zona Pública</a> :: '.$corp.' <a href="index.php?module=products">Productos</a>';
		
		return $nav_bar;
	}	
	
	function title($method,$corp)
	{
		if ($corp != "")
		{
			$corp=$corp." ::";
		}
		$title = "Zona Pública :: Productos";
		return $title;
	}		
	
	function verify_products($id){
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
			$this->prod_cat_list[$this->num]['id_emp']=$this->result->fields['id_emp'];
			$this->prod_cat_list[$this->num]['name']=$this->result->fields['name'];
			$this->prod_cat_list[$this->num]['last_name']=$this->result->fields['last_name'];
			$this->prod_cat_list[$this->num]['last_name2']=$this->result->fields['last_name2'];
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$this->num++;
		}
		$this->db->close();
		return $this->num;
	}
	
}
?>