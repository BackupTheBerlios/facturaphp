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

	function _autorizar($data)
		{
			return _insert_update($data,false);
			}

	function _insert_update($data,$insert=true)
		{
			list($conn)=Getdb();
			$table=GetTable('autorizaciones');
			$cols=GetCols('autorizaciones');
			$dat=prepare_data_for_ADODB_replace($data,$table);
			$result=$conn->Replace($table,$dat,($insert)?array():array($cols['autid']),false);
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
			$table=GetTable('autorizaciones');
			$cols=GetCols('autorizaciones');
			list($conn)=Getdb();
			$sql="SELECT * FROM $table WHERE $cols[autid]=$aid;";
			$rs=$conn->Execute($sql);
			$count=$rs->PO_RecordCount($table,"$cols[autid]=$aid");
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
			$table=GetTable('autorizaciones');
			$cols=GetCols('autorizaciones');
			list($conn)=Getdb();
			$sql="DELETE FROM $table WHERE $cols[autid]=$aid;";
			$rs=$conn->Execute($sql);
			//event_loger()
			if ($rs===false)
				{
					return false;}
			return true;
			}

	function _conceder($autid)
		{
			$table=GetTable('autorizaciones');
			$cols=GetCols('autorizaciones');
			list($conn)=Getdb();
			$data=array( $cols['autid']		=>	$autid,
						$cols['estado']	=>	"'A'",
						$cols['resolucion']	=> $conn->DBTimeStamp(time()));
			//$data=fromcmstodb($data,'autorizaciones');
			$rs=$conn->Replace($table,$data,array($cols['autid']),false);
			return $rs;
			}

	function _denegar($autid)
		{
			$table=GetTable('autorizaciones');
			$cols=GetCols('autorizaciones');
			list($conn)=Getdb();
			$data=array( 'autid'		=>	$autid,
					'estado'	=>	"'D'",
					'resolucion'	=> $conn->DBTimeStamp(time()));
			$data=fromcmstodb($data,'autorizaciones');
			$rs=$conn->Replace($table,$data,array($cols['autid']),false);
			return $rs;
			}

?>
