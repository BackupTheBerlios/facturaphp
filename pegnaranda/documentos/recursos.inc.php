<?php
//require_once ("usuarios/usuarios.aux.inc.php");
require_once('media.inc.php');

	function render_admin_addrsc($param)
	{
		$resultado= SmartyInit();
		$resultado->assign("validaregistrourl","index.php?actor=documentos&accion=validarrsc");
		$plantilla="document/addrsc.tpl";
		$resultado->assign('did',$param['did']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_validarrsc($param)
	{
		$did=vwVarFromInput('did');
		_startRsc($did);
		list($titulo,$url,$restringido,$archivo,$archivo_name)=	vwVarFromInput('titulo','url','restringido','archivo','archivo_name');
		$titulo=trim($titulo);
		$url=trim($url);
		// Comprobamos que el recurso no existe ya
		list($db)=Getdb();
		$tbl=GetTable('recursos');
		$col=GetCols('recursos');
		$sql="SELECT ".$col['titulo']." FROM $tbl WHERE ".$col['titulo']."='$titulo' AND $col[did]=$did";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$mensaje="Ha ocurrido un error al leer de la base de datos comprobando los datos<br />$sql";
			return $mensaje;
			}
		if ($resultado->RecordCount()>0)
			{
			// El usuario existe ya
			$param['ruta']="error";
			$param['mensaje']="El recurso ya existe";
			render($param);
			die();
			}

		if ((trim($url)=="")&&(trim($archivo_name)==""))
			{
				$param['ruta']="error";
				$param['mensaje']="No se ha introducido ningun recurso. Un recurso debe ser bien un archivo o una URL.";
				render($param);
				die();
				}
		if ((trim($url)!="")&&(trim($archivo_name)!=""))
			{
				$param['ruta']="error";
				$param['mensaje']="Un recurso no puede ser una url y un archivo, debe de constar de un &uacute;nico elemento..";
				render($param);
				die();
				}

		if (trim($archivo_name)!="")
			{
				$media=isAValidMedia($archivo_name);
				if ($media===false)
					{
						$param['ruta']="error";
						$param['mensaje']="El archivo $archivo_name no es de un tipo admitido por el sistema.";
						render($param);
						die();
						}
				else
					{
						$test=UploadResource($archivo,$archivo_name,$did);
						if ($media['restricted'])
							{
								$restringido="S";}
						else
							{
								$restringido="N";}
						}
				}
		else
			{
				if (!is_url($url))
					{
						$param['ruta']="error";
						$param['mensaje']="La $url no es valida.";
						render($param);
						die();
						}
				if ($restringido!="S")
					{
						$restringido="N";}
				}

		$seccion=array (	$col['did']	=> $did,
							$col['titulo']	=>"'".htmlentities($titulo,ENT_QUOTES)."'",
							$col['url']	=>"'".htmlentities($url,ENT_QUOTES)."'",
							$col['restringido'] => "'".$restringido."'",
							$col['archivo']	=>"'$archivo_name'");

		array_walk($seccion,'fixCode');
		$resultado=$db->Replace($tbl,$seccion,array(),false);

		if ($resultado !=2)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al introducir el recurso en la base de datos ";
			render($param);
			die();
			}

		$sql="SELECT $col[rid] FROM $tbl WHERE $col[titulo]='".htmlentities($titulo,ENT_QUOTES)."'";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al leer de la base de datos";
			render($param);
			die();
			}
		$mensaje="El recurso ha sido introducido correctamente en la bbdd.";
		$usuario=$resultado->FetchRow();
		/* $resultado= SmartyInit();
		$resultado->assign("mensaje",$mensaje);
		$plantilla="mensaje.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida; */
		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);
	}

	function render_admin_editrsc($param)
	{
		list($db)=Getdb();
		$tbl=GetTable('recursos');
		$col=GetCols('recursos');

		$sql="SELECT * FROM $tbl WHERE $col[rid]='$param[rid]'";

		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
				$param['ruta']="error";
				$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
				render($param);
				die();
			}
		$seccion=$resultado->FetchRow();
		$seccion=fromdbtocms($seccion,'recursos');
		$seccion=toHtml($seccion);
		$resultado= SmartyInit();
		$resultado->assign("datos",$seccion);
		$resultado->assign("did",vwSessionGetVar('udid'));
		$resultado->assign("validaregistrourl","index.php?actor=documentos&accion=valedrsc");
		$plantilla="document/editrsc.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_valedrsc($param)
	{
		$did=	vwVarFromInput('did');
		$rid=	vwVarFromInput('rid');
		_startRsc($did);
		list($titulo,$url,$restringido,$archivo,$archivo_name,$oldarc_name)=	vwVarFromInput('titulo','url','restringido','archivo','archivo_name','oldarc_name');
		list($db)=Getdb();
		$tbl=GetTable('recursos');
		$col=GetCols('recursos');

		if ((trim($url)=="")&&(trim($archivo_name)==""))
			{
				$param['ruta']="error";
				$param['mensaje']="No se ha introducido ningun recurso. Un recurso debe ser bien un archivo o una URL.";
				render($param);
				die();
				}
		if ((trim($url)!="")&&(trim($archivo_name)!=""))
			{
				$param['ruta']="error";
				$param['mensaje']="Un recurso no puede ser una url y un archivo, debe de constar de un &uacute;nico elemento..";
				render($param);
				die();
				}

		if (trim($archivo_name)!="")
			{
				$media=isAValidMedia($archivo_name);
				if ($media===false)
					{
						$param['ruta']="error";
						$param['mensaje']="El archivo $archivo_name no es de un tipo admitido por el sistema.";
						render($param);
						die();
						}
				else
					{
						if (trim($archivo_name)!=$oldarc_name)
							{
								DelOldRsc($rid);
								$test=UploadResource($archivo,$archivo_name,$did);
								if ($media['restricted'])
									{
										$restringido="S";}
								else
									{
										$restringido="N";}
								}
						}
				}
		else
			{
				if ($url!="")
					{
						if (!is_url($url))
							{
								$param['ruta']="error";
								$param['mensaje']="La $url no es valida.";
								render($param);
								die();
								}
						if ($restringido!="S")
							{
								$restringido="N";}
						if (trim($oldarc_name)!="")
							{
								DelOldRsc($rid);}
						}
				}

		$seccion=array (	$col['did']	=>	$did,
							$col['rid']	=>	$rid,
							$col['titulo']	=>"'".htmlentities($titulo,ENT_QUOTES)."'",
							$col['url']	=>"'".htmlentities($url,ENT_QUOTES)."'",
							$col['restringido'] => "'".$restringido."'",
							$col['archivo']	=>"'$archivo_name'");

		array_walk($seccion,'fixCode');
		$resultado=$db->Replace($tbl,$seccion,array($col['rid']),false);

		if ($resultado !=1)
			{
			$mensaje="Ha ocurrido un error al cambiar los datos del recurso en la base de datos";
			}
		else
			{
			$mensaje="Los datos del recurso han sido cambiados correctamente";}

		/* $resultado= SmartyInit();
		$resultado->assign("mensaje",$mensaje);
		$plantilla="mensaje.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;*/
		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);
	}

	// Aqui empieza la definicion de las funciones referentes al administrador

	function render_admin_verrsc($param)
	{
		$did=$param['did'];
		if ($did<1)
			{
				$did=vwSessionGetVar('udid');}
		else
			{
				vwSessionSetVar('udid',$did);}

		if ($did<1)
			{
				header('Location: index.php');
				die();}
		require_once("lister.php");
		$sf=vwVarFromInput('sf');
		$start=vwVarFromInput('start');
		$up=vwVarFromInput('up');

		list($db)=Getdb();
		$tbl=GetTable('recursos');
		$col=GetCols('recursos');

		$sql="Select * from $tbl where $col[did]=$did";
		$Cols=array(
					array ( "dbname"	=>	$col['rid'],
							"label"		=>	"id",
							"width"		=>	"45px",
							"sortable"	=>	true),
					array ( "dbname"	=>	$col['titulo'],
							"label"		=>	"T&itulo",
							"width"		=>	"200px",
							"sortable"	=>	true),
					array ( "dbname"	=>	$col['url'],
							"label"		=>	"URL",
							"width"		=>	"200px",
							"sortable"	=>	false),
					array ( "dbname"	=>	$col['archivo'],
							'label'		=>	"Archivo",
							"width"		=>	"100px",
							"sortable"	=>	false) );

		$opciones=array(
						array(	"funcion"	=>	"cbRscEdit",
								"valor"		=>	"$col[rid]"),
						array(	"funcion"	=>	"cbRscDelete",
								"valor"		=>	"$col[rid]"));

		$acciones=array(
						array(	'funcion'=>"cbRscAdmAdd"));

		$archivList=new Lister("admRecursos",$sql,25,$Cols,$col['rid'],$opciones,"dg-admrecursos.css");
		$archivList->table="$tbl";
		$archivList->where="$col[did]=$did";
		$archivList->GeneralActions=$acciones;

		if ($sf!="")
			{
				$archivList->SetSort($sf,$up);}

		if ($start!="")
			{
				$archivList->SetStart($start);}

		$listado=$archivList->render();
		if (($listado===null)||(trim($listado)==""))
			{
				$aux=cbSeccionAdmAdd();
				$listado="<br><center><a link href='$aux[url]'>$aux[etiqueta]</a></center>";}
		$resultado= SmartyInit();
		$plantilla="document/listarsc.tpl";
		$resultado->assign("listado",$listado);
		$salida=$resultado->fetch($plantilla);
		vwSessionSetVar('urlantigua',CurrentUrl());
		return $salida;
	}


	function cbRscEdit ($key,$valor)
		{
			return array("etiqueta"=>"Editar","url"=>"index.php?actor=documentos&accion=editrsc&id=$valor");};

	function cbRscDelete ($key,$valor)
		{
			return array("etiqueta"=>"Borrar","url"=>"index.php?actor=documentos&accion=delrsc&id=$valor");};

	function cbRscAdmAdd()
		{
			$id=vwSessionGetVar('udid');
			return array("etiqueta"=>"A&ntilde;adir Recurso","url"=>"index.php?actor=documentos&accion=addrsc&id=$id");};

	function render_admin_delrsc($param)
	{
		$resultado= SmartyInit();
		$plantilla="document/admdelrsccheck.tpl";
		$id=$param['rid'];
		$resultado->assign("confirmadelurl","index?actor=documentos&accion=okdelrsc&id=$id");
		$resultado->assign("rechazadelurl","index.php?actor=documentos&accion=verrsc");
		$resultado->assign("mensaje",$param['mensaje']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_okdelrsc($param)
	{
		$aid=$param['rid'];
		list($db)=Getdb();
		$tbl=GetTable('recursos');
		$col=GetCols('recursos');
		$sidcol=$col['rid'];
		DelOldRsc($aid);
		$sql="DELETE FROM $tbl WHERE $sidcol='$aid'";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$mensaje="Ha ocurrido un error al borrar el recurso";
			}
		else
			{
			$mensaje="El recurso ha sido borrado correctamente";}

		$resultado= SmartyInit();
		$plantilla="mensaje.tpl";
		$resultado->assign("mensaje",$mensaje);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function importar()
	{
		list($db)=Getdb();
		$tbl=GetTable('recursos');
		$col=GetCols('recursos');
		$tbl2=GetTable('documentos');
		$col2=GetCols('documentos');
		$sqlGet="SELECT * FROM RecImportar WHERE Archivo<>''";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$mensaje="Ha ocurrido un error al leer de la base de datos comprobando los datos<br />$sql";
			return $mensaje;
			}
		$items=$rs->GetRows();
		foreach($items as $item)
			{
				$sql2="SELECT * from $tbl2 WHERE $col2[idantiguo]=$item[idAntiguo]";
				$rs2=$db->Execute($sql);
				if ($db->ErrorNo() != 0)
					{
					$mensaje="Ha ocurrido un error al leer de la base de datos comprobando los datos<br />$sql";
					return $mensaje;
					}
				$doc=$rs2->FetchRow();
				$did=$doc[$col2['did']];
				if (trim($did)!="")
					{
						$test1=ImportResource($item['Archivo'].".sxw","sxw",$did);
						$tit1="Transcripcion $item[Archivo].sxw";
						$rest1="S";
						$test2=ImportResource($item['Archivo'].".rtf","rtf",$did);
						$tit2="Transcripcion $item[Archivo].rtf";
						$rest2="S";
						$test3=ImportResource($item['Archivo'].".pdf","pdf",$did);
						$tit3="Transcripcion $item[Archivo].pdf";
						$rest3="N";
						$se1=array (	$col['did']	=> $did,
										$col['titulo']	=>"'".htmlentities($tit1,ENT_QUOTES)."'",
										$col['restringido'] => "'".$rest1."'",
										$col['archivo']	=>"'$item[Archivo].sxw'");
						$se2=array (	$col['did']	=> $did,
										$col['titulo']	=>"'".htmlentities($tit2,ENT_QUOTES)."'",
										$col['restringido'] => "'".$rest2."'",
										$col['archivo']	=>"'$item[Archivo].rtf'");
						$se3=array (	$col['did']	=> $did,
										$col['titulo']	=>"'".htmlentities($tit3,ENT_QUOTES)."'",
										$col['restringido'] => "'".$rest3."'",
										$col['archivo']	=>"'$item[Archivo].pdf'");

						$resultado=$db->Replace($tbl,$se1,array(),false);
						$resultado=$db->Replace($tbl,$se2,array(),false);
						$resultado=$db->Replace($tbl,$se3,array(),false);
						}
			}
	}

?>
