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
  	var $users_list;
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
		$this->db = NewADOConnection($this->db_type);
		$this->db->debug=false;
		$this->db->Connect($this->db_ip,$this->db_user,$this->db_passwd,$this->ddbb_prefix.$this->db_name);
		$this->sql="SELECT * FROM ".$this->table_name;
		$this->result = $this->db->Execute($this->sql);
		if ($this->result === false) die("failed");  
		while (!$this->result->EOF) {
		   for ($i=0, $max=$this->result->FieldCount(); $i < $max; $i++)
				  print $this->result->fields[$i].' ';
		   $this->result->MoveNext();
		   print "<br>";
		} 
		
	}
	
	function list_users (){
	
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