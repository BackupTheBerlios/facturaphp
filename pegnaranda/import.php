<?php
	include('adodb/adodb.inc.php');
	include('adodb/session/adodb-session.php');
	include('db.inc.php');
	include("tools.php");
	include("config.inc.php");
	include("media.inc.php");
	//Makedb();
	//SysToADO();

	//Installdb();
	Init();
	importMassRsc();
	die();
	function importar()
		{
			$tbl=GetTable('documentos');
			$col=GetCols('documentos');
			list($db)=Getdb();
			$sql="SELECT * from DocsConvert";
			$rs=$db->Execute($sql);
			if ($rs===false)
				{
					die("K-Pullo");}
			$data=$rs->GetRows();
			$sigz=-1;
			foreach($data as $registro)
				{
					$sigz++;
					// Hacemos limpieza de los Siglos
					list($sig1,$sig2)=explode("-",$registro['Siglos']);
					$registro['Siglos']="";
					$sep="";
					if ((trim($sig1)!="")&&($sig1<1))
						{
							$registro['Siglos']=$sig1;
							$sep="-";}
					if ((trim($sig2)!="")&&($sig2<1))
						{
							$registro['Siglos']=$registro['Siglos'].$sep.$sig2;}

					// Hacemos limpieza y transformamos adecuadamente el Periodo
					list($per1,$per2)=explode("-",$registro['Periodo']);
					$registro['Periodo']="";
					$sep="";
					if ((trim($per1)!="")&&($per1<1))
						{
							$registro['Periodo']=$per1;
							$sep="-";}
					if ((trim($per2)!="")&&($per2<1))
						{
							$registro['Periodo']=$registro['Periodo'].$sep.$per2;}
					$registro['Periodo']=ParsePeriod($registro['Periodo']);

					// Hacemos limpieza de las signaturas para que no se pierda nada
					if (trim($registro['Signatura'])=="")
						{
							$registro['Signatura']="AUX$sigz";}

					$documento=array(	$col['aid']		=>	$registro['aid'],
										$col['sid']		=>	$registro['sid'],
										$col['folios']	=>	"'".htmlentities($registro['Follios'],ENT_QUOTES)."'",
										$col['signatura']	=>	"'".htmlentities($registro['Signatura'],ENT_QUOTES)."'",
										$col['siglos']	=>	"'".$registro['Siglos']."'",
										$col['periodo']	=>	"'".$registro['Periodo']."'",
										$col['idantiguo']	=>	"'".$registro['Id_Doc']."'",
										$col['resumen']	=>	"'".htmlentities($registro['Resumen'],ENT_QUOTES)."'",
										$col['notas']		=>	"'".htmlentities($registro['Notas'],ENT_QUOTES)."'");

					$rx=$db->Replace($tbl,$documento,array(),false);
					if ($rx!=2)
						{
							echo " Registro $registro[Id_Doc] invalido<br>";}
					}
			echo " Fin Importacion";
			}

	function mportResource($resource_name,$path,$relpath)
		{
			global $rsc_dir;

			if ((isset($resource_name)))
				{
					$resource_name=$resource_name;
					$resourcetype=isAValidMedia($resource_name);

					if (!($resourcetype===false))
						{
							rename("/var/www/localhost/htdocs/hpenaranda/importar/$path/$resource_name","$rsc_dir$relpath/".$resource_name);
							chmod("$rsc_dir$relpath/".$resource_name,octdec("0777"));
							if (trim($resourcetype['funcion'])!="")
								{
									$previo=$resourcetype['funcion']($resource_name,$relpath);}
							return $previo;
							}
					else
						{
							return false;}
				}
			return false;
		}

	function importMassRsc()
		{
			$tblDoc=GetTable('documentos');
			$colDoc=GetCols('documentos');
			$tblRec=GetTable('recursos');
			$colRec=GetCols('recursos');
			list($db)=Getdb();
			$z=array("sxw"=>".sxw","rtf"=>".rtf","pdf"=>".pdf");
			$sql='SELECT * FROM `RecImportar` where Archivo<>""';
			$rs=$db->Execute($sql);
			if ($rs===false)
				{
					die("Error Fatal");}
			$Recursos=$rs->GetRows();
			foreach($Recursos as $recurso)
				{
					foreach($z as $k=>$v)
						{
							if (file_exists("importar/$k/$recurso[Archivo]$v"))
								{
									$sql2="SELECT * from $tblDoc WHERE $colDoc[idantiguo]=$recurso[IdAntiguo]";
									$did="";
									$rs2=$db->Execute($sql2);
									if(!($rs2===false))
										{
											$doc=$rs2->FetchRow();
											$did=$doc[$colDoc['did']];
											}
									if (trim($did)!="")
										{
											_startRsc($did);
											$restringido="'N'";
											if ($k!="pdf")
												{
													$restringido="'s'";}
											$aux=mportResource("$recurso[Archivo]$v",$k,$did);
											$x=$db->Replace($tblRec,array( $colRec['titulo'] => "'Documento $recurso[Archivo]$v'",
																			$colRec['did']	=>	$did,
																			$colRec['restringido'] => $restringido,
																			$colRec['archivo'] => "'$recurso[Archivo]$v'"),
																	array(),false);
											echo "$recurso[Archivo]$v importado<br>";
											}
									}
							}
					}
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

?>
