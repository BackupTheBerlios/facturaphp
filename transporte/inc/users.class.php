<?php
//clase que da soporte a los usuarios del programa
//enlaza con la bbdd 
require_once ('config.inc.php');
require_once ("/Users/david/Sites/transporte/inc/adodb/adodb.inc.php");
class users{
//internal vars
	var $id_user;
	var $login;
	var $passwd;
	var $name;
	var $last_name;
	var $last_name2;
	var $full_name;
	var $theme;
//BBDD name vars
	var $db_name;
	var $db_ip;
	var $db_user;
	var $db_passwd;
	var $db_port;
	var $db_type;
	var $ddbb_prefix;
	var $table_name='users';
	var $ddbb_id_user='id_user';
  	var $ddbb_login='login';
  	var $ddbb_passwd='passwd';
  	var $ddbb_name='name';
  	var $ddbb_last_name='last_name';
  	var $ddbb_last_name2='last_name2';
  	var $ddbb_full_name='full_name';
  	var $ddbb_theme='theme';
	var $db;
	var $result;  	
//variables complementarias	
  	var $users_list;
  	var $num;
  	//constructor
	function users(){
		global $DDBB_TYPE, $DDBB_NAME, $IP_DDBB, $DDBB_USER, $DDBB_PASS, $DDBB_PORT, $DDBB_PREFIX;
		//echo "<br>en el objeto<br>";
		$this->db_type=$DDBB_TYPE;
		$this->db_name=$DDBB_NAME;
		$this->db_ip=$IP_DDBB;
		$this->db_user=$DDBB_USER;
		$this->db_passwd=$DDBB_PASS;
		$this->db_port=$DDBB_PORT;
		$this->db_prefix=$DDBB_PREFIX;
		//print_r($this);
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi�n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi�n permanente con la bbdd
		$this->db->PConnect($this->db_ip,$this->db_user,$this->db_passwd,$this->ddbb_prefix.$this->db_name);
		//mete la consulta
		$this->sql="SELECT * FROM ".$this->table_name;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$error=1;
			return 0;
		}  
		return list_users();	 
		
	}
	
	function list_users (){
		//se puede acceder a los usuarios por numero de campo o por nombre de campo
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		//crea una nueva conexi�n con una bbdd (mysql)
		$this->db = NewADOConnection($this->db_type);
		//le dice que no salgan los errores de conexi�n de la ddbb por pantalla
		$this->db->debug=false;
		//realiza una conexi�n permanente con la bbdd
		$this->db->PConnect($this->db_ip,$this->db_user,$this->db_passwd,$this->ddbb_prefix.$this->db_name);
		//mete la consulta
		$this->sql="SELECT * FROM ".$this->table_name;
		//la ejecuta y guarda los resultados
		$this->result = $this->db->Execute($this->sql);
		//si falla 
		if ($this->result === false){
			$error=1;
			return 0;
		}  
		
		$this->num=0;
		while (!$this->result->EOF) {
			//cogemos los datos del usuario
			$this->users_list[$this->num][$field_id_user]=$this->result->fields[$field_id_user];
			$this->users_list[$this->num][$field_login]=$this->result->fields[$field_login];
			$this->users_list[$this->num][$field_passwd]=$this->result->fields[$field_passwd];
			$this->users_list[$this->num][$field_name]=$this->result->fields[$field_name];
			$this->users_list[$this->num][$field_last_name]=$this->result->fields[$field_last_name];
			$this->users_list[$this->num][$field_last_name2]=$this->result->fields[$field_last_name2];
			$this->users_list[$this->num][$field_full_name]=$this->result->fields[$field_full_name];
			//nos movemos hasta el siguiente registro de resultado de la consulta
			$this->result->MoveNext();
			$num++;
		}
		return $num;
	
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
	
	function add(){
	
	}
	
	function remove(){
	
	}
	
	function modify(){
	
	}
	
	function view (){
	
	}  
	
	function admin (){
	
	}
}
?>