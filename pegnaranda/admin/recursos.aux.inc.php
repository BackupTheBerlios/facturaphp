<?php

	require_once("../tools.php");
	require_once("../db.inc.php");
	require_once("../vardb.inc.php");
	require_once("../varsession.inc.php");
	Init();
	expire_vardb();

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
			$table=GetTable('archivos');
			$cols=GetCols('archivos');
			$dat=prepare_data_for_ADODB_replace($data,$table);
			$result=$conn->Replace($table,$dat,array($cols['aid']),false);
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

	function _delete_check($aid)
		{
			$table=GetTable['documentos'];
			$cols=GetCols['documehtos'];
			list($conn)=Getdb();
			$sql="SELECT * FROM $table WHERE $cols[aid]=$aid;";
			$rs=$conn->Execute($sql);
			$count=$rs->PO_RecordCount($table,"$cols[aid]=$aid");
			if ($count>0)
				{
					return true;}
			else
				{
					return false;}
			return false;
			}

	function _delete($aid)
		{
			if (_delete_check($aid)===false)
				{
					return false;}
			$table=GetTable['archivos'];
			$cols=GetCols['archivos'];
			list($conn)=Getdb();
			$sql="DELETE FROM $table WHERE $cols[aid]=$aid;";
			$rs=$conn->Execute($sql);
			//event_loger()
			if ($rs===false)
				{
					return false;}
			return true;
			}



?>

