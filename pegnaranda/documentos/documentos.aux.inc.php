<?php

	require_once("tools.php");
	require_once("db.inc.php");
	require_once("vardb.inc.php");
	require_once("varsession.inc.php");

	function _insert($data)
		{
			return _insert_update($data);
			}

	function _update($data)
		{
			return _insert_update($data,false);
			}

	function _insert_update($data,$insert=true)
		{
			list($conn)=Getdb();
			$table=GetTable('documentos');
			$cols=GetCols('documentos');
			$dat=prepare_data_for_ADODB_replace($data,'documentos');
			$result=$conn->Replace($table,$dat,($insert)?array():array($cols['did']),false);
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
			$table=GetTable('documentos');
			$cols=GetCols('documehtos');
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
			$table=GetTable('archivos');
			$cols=GetCols('archivos');
			list($conn)=Getdb();
			$sql="DELETE FROM $table WHERE $cols[aid]=$aid;";
			$rs=$conn->Execute($sql);
			//event_loger()
			if ($rs===false)
				{
					return false;}
			return true;
			}

	function _startRsc($did)
		{
			global $rsc_dir;
			global $prev_dir;
			$rsccreate=false;
			$prevcreate=false;
			if (file_exists($rsc_dir.$did))
				{
					if (!is_dir($rsc_dir.$did))
						{
							unlink ($rsc_dir.$did);
							$rsccreate=true;}
					}
			else
				{
					$rsccreate=true;}
			if (file_exists($prev_dir.$did))
				{
					if (!is_dir($prev_dir.$did))
						{
							unlink ($prev_dir.$did);
							$prevcreate=true;}
					}
			else
				{
					$prevcreate=true;}
			if ($rsccreate)
				{
					mkdir($rsc_dir.$did,0777);}
			if ($prevcreate)
				{
					mkdir($prev_dir.$did,0777);}
			}

	function _rscDir($did)
		{
			global $rsc_dir;
			if (is_int($did))
				{
					return $rsc_dir.$did."/";}
			else
				{
					return "Error: Not a valid DID";}
			return "Unknown Error";
			}

	function _prevDir($did)
		{
			global $prev_dir;
			if (is_int($did))
				{
					return $prev_dir.$did."/";}
			else
				{
					return "Error: Not a valid DID";}
			return "Unknown Error";
			}

?>
