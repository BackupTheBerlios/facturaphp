<?php

require_once('inc/fields.class.php');
$campos=new fields();
$campos= new fields();
$campos->add($this->ddbb_id_user, $this->id_login, 'int', 11,0);
$campos->add($this->ddbb_login, $this->login, 'varchar', 20,0);
$campos->add($this->ddbb_passwd, $this->passwd, 'varchar', 20,0);
$campos->add($this->ddbb_name, $this->name, 'varchar', 20,0);
$campos->add($this->ddbb_last_name, $this->last_name, 'varchar', 20,0);
$campos->add($this->ddbb_last_name2, $this->last_name2, 'varchar', 20,0 );
$campos->add($this->ddbb_full_name, $this->full_name, 'varchar', 100,0);		
$campos->add($this->ddbb_internal, $this->internal, 'tinyint', 3,0 );
$campos->add($this->ddbb_active, $this->active, 'tinyint', 3,0 );

?>