<?php

	require_once("tools.php");
	require_once("db.inc.php");
	require_once("vardb.inc.php");
	require_once("varsession.inc.php");

	function _insert($data)
		{
			return _insert_update($date);
			}

	function _update($data)
		{
			return _insert_update($date,false);
			}

	function _insert_update($data,$insert=true)
		{
			list($conn)=Getdb();
			$table=GetTable('usuarios');
			$cols=GetCols('usuarios');
			$dat=prepare_data_for_ADODB_replace($data,$table);
			$result=$conn->Replace($table,$dat,array($cols['uid']),false);
			switch ($insert)
				{
					case true:
								switch ($result)
									{
										case 2:
												$ret=true;
												break;
										case 1:
												$ret="Warning: Data Corruption!";
												break;
										case 0:
												$ret=false;
												break;
										}
								break;
					case false:
								switch ($result)
									{
										case 2:
												$ret="Warning: New data inserted!!";
												break;
										case 1:
												$ret=true;
												break;
										case 0:
												$ret=false;
												break;
										}
								break;
					}
			return $ret;
			}

	function _delete_check($uid)
		{
			$table=GetTable('autorizaciones');
			$cols=GetCols('autorizaciones');
			list($conn)=Getdb();
			$sql="SELECT * FROM $table WHERE $cols[uid]=$uid AND $cols[nivel]<100;";
			$rs=$conn->Execute($sql);
			$count=$rs->PO_RecordCount($table,"$cols[uid]=$uid");
			if ($count>0)
				{
					return true;}
			else
				{
					return false;}
			return false;
			}

	function _delete($uid)
		{
			if (_delete_check($uid)===false)
				{
					return false;}
			$table=GetTable('usuarios');
			$cols=GetCols('usuarios');
			list($conn)=Getdb();
			$sql="DELETE FROM $table WHERE $cols[uid]=$uid;";
			$rs=$conn->Execute($sql);
			//event_loger()
			if ($rs===false)
				{
					return false;}

			$table=GetTable('autorizaciones');
			$cols=GetCols('autorizaciones');
			$sql="DELETE FROM $table WHERE $cols[uid]=$uid;";
			$rs=$conn->Execute($sql);

			return true;
			}

?>

