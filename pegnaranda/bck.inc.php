<?php
	require_once("Archive/Tar.php");
	require_once('adodb/adodb.inc.php');
	require_once('adodb/session/adodb-session.php');
	require_once('db.inc.php');
	require_once('media.inc.php');
	require_once('tools.php');
	require_once('documentos/documentos.inc.php');

	/*

	SysToADO();
	Init();

	echo restoreSystem("/var/www/localhost/htdocs/copia/");*/

	function backupSystem($destino)
		{
			if (!previewToTar($destino))
				{
					return false;}

			if (!rscToTar($destino))
				{
					unlink($destino."public.tar");
					return false;}

			$tablas=saveTbls($destino);
			if (!$tablas['estatus'])
				{
					unlink($destino."*.*");
					return false;}
			return true;
			}

	function restoreSystem($destino)
		{
			if (!tarToPreview($destino))
				{
					return false;}

			if (!tarToRsc($destino))
				{
					return false;}

			$tablas=loadTbls($destino);
			if (!$tablas['estatus'])
				{
					return false;}
			return true;
			}

	/*	This function encodes a table into a csv file, with a significant difference
		with a regular csv file. This one is that every field is encoded with base64.
		returns true if the file was writen correctly, false if not.
	*/
	function tblToCSV($table,$destination)
		{
			$tbl=GetTable($table);
			$col=GetCols($table);

			$csv=fopen($destination."$table.csv","xb");

			list($db)=Getdb();

			$rs=$db->Execute("SELECT * FROM $tbl");

			if ($rs!=false)
				{
					while( $registro=$rs->FetchRow())
						{
							$aux=array();
							foreach($registro as $k=>$v)
								{
									$aux[$k]=base64_encode("'".$v."'");}
							$linea=implode($aux,";");
							$result=fwrite($csv,$linea."\n");
							}
					fclose($csv);
					@chmod($destination."$table.csv",octdec(0777));
					return true;
					}
			else
				{
					return false;}
			}

	/*	This function saves all tables to a csvs file, with a significant difference
		with a regular csv file. This one is that every field is encoded with base64.
		returns true if the file was writen correctly, false if not.
	*/

	function saveTbls($destination)
		{
			$tables=GetTables();
			$retur=true;
			foreach($tables['t'] as $k=>$v)
				{
					if (tblToCSV($k,$destination))
						{
							$tbls=$tbls."$k Salvada<br>";}
					else
						{
							$retur=false;
							$tbls=$tbls."Error en $k<br>";}
					}
			return array('estatus'=>$retur,'mensaje'=>$tbls);
			}

	function loadTbls($destination)
		{
			$tables=GetTables();
			$retur=true;
			foreach($tables['t'] as $k=>$v)
				{
					if (csvToTbl($k,$destination))
						{
							$tbls=$tbls."$k Restaurada<br>";}
					else
						{
							$retur=false;
							$tbls=$tbls."Error en $k<br>";}
					}
			return array('estatus'=>$retur,'mensaje'=>$tbls);
			}

	function csvToTbl($table,$destination)
		{
			$tbl=GetTable($table);
			$col=array_values(GetCols($table));

			$csv=file($destination."$table.csv");

			list($db)=Getdb();

			$rs=$db->Execute("DELETE FROM $tbl");

			foreach ($csv as $linea)
				{
					$campos=explode(';',$linea);
					$aux=array();
					$auxFld=-1;
					foreach($campos as $v)
						{
							$auxFld++;
							$fld=$col[$auxFld];
							$registro[$fld]=base64_decode($v);
							}
					$result=$db->Replace($tbl,$registro,array(),false);
					}
			return true;
			}

	function previewToTar($destination)
		{
			global $prev_dir;
			if (file_exists($destination."public.tar"))
				{
					unlink ($destination."public.tar");}
			$tarfile=new Archive_Tar($destination."public.tar");
			$res=$tarfile->createModify(array($prev_dir),"",$prev_dir);
			if (!$res)
				{
					return false;}
			chmod($destination."public.tar",octdec(0777));
			return true;
			}

	function rscToTar($destination)
		{
			global $rsc_dir;
			if (file_exists($destination."rsc.tar"))
				{
					unlink ($destination."rsc.tar");}
			$tarfile=new Archive_Tar($destination."rsc.tar");
			$res=$tarfile->createModify(array($rsc_dir),"",$rsc_dir);
			if (!$res)
				{
					return false;}
			chmod($destination."rsc.tar",octdec(0777));
			return true;
			}

	function tarToRsc($source)
		{
			global $rsc_dir;

			if (!file_exists($source."rsc.tar"))
				{
					return false;}
			$tarfile=new Archive_Tar($source."rsc.tar");
			$res=$tarfile->extract($rsc_dir);
			if (!$res)
				{
					return false;}
			return true;
			}

	function tarToPreview($source)
		{
			global $prev_dir;

			if (!file_exists($source."public.tar"))
				{
					return false;}
			$tarfile=new Archive_Tar($source."public.tar");
			$res=$tarfile->extract($prev_dir);
			if (!$res)
				{
					return false;}
			return true;
			}

?>