<?php
	require_once("db.inc.php");

	function vwSetVar($name,$value)
	{
		list($db)=Getdb();
		$tables=GetTables();
		$table=$tables['t']['vars'];
		$var['session_id']="'".session_id()."'";
		$var['name']="'".trim($name)."'";
		$var['value']="'".serialize($value)."'";

		$aux=$db->Replace($table,$var,array());

		if ($aux<1)
			{
				return false;}
		return true;
	};

	function vwGetVar($name)
	{
		list($db)=Getdb();
		$tables=GetTables();
		$table=$tables['t']['vars'];
		$cols=$tables['c']['vars'];
		$session_id="'".session_id()."'";
		$sql="SELECT * FROM $table
				 WHERE
				 			 $cols[session_id]='".session_id()."' AND
							 $cols[name]='".trim($name)."';";
		$rs=$db->Execute($sql);
		if (!$rs)
			{
				return;}
		$var=$rs->FetchRow();
		if ($var['session_id']!=session_id())
			{
				return;}
		else
			{
				return unserialize($var['value']);}
	};

	function vwDelVar($name)
	{
		list($db)=Getdb();
		$tables=GetTables();
		$table=$tables['t']['vars'];
		$cols=$tables['c']['vars'];
		$session_id="'".session_id()."'";
		$sql="DELETE FROM $table
				 WHERE	 $cols[session_id]='".session_id()."' AND
							 $cols[name]='".trim($name)."';";

		$rs=$db->Execute($sql);

		if (!$rs)
			{
				return false;}
		return true;
	};

?>