<?php
require_once ("documentos/documentos.aux.inc.php");
require_once ("documentos/recursos.inc.php");
require_once ("db.inc.php");
require_once ("media.inc.php");

	function render_documentos($accion,$sujeto,$param)
	{
		$UserLevel=vwSessionGetVar("UserLevel");

		if ($UserLevel<500)
			{
				switch ($accion)
					{
						case "mostrar":
							$salida=render_user_mostrardocumento($param);
							break;
						case "buscar":
							$salida=render_user_buscardocumento($param);
							break;
						case "ver":
							$salida=render_user_var($param);
							break;
						case "ver-rsc":
							$salida=render_user_verrsc($param);
							break;
						default:
							header('Location: index.php');
							die();
							break;
						}
				}
		else
			{

				switch ($accion)
					{
						// Aqui empieza la parte correspondiente al administrador
						case "titulos":
							$salida=render_admin_titulos($param);
							break;
						
						case "listar":
							$salida=render_admin_listardocumentos($param);
							break;
						case "okdel":
							$salida=render_admin_okdel($param);
							break;
						case "deldoc":
							$salida=render_admin_deldoc($param);
							break;
						case 'editar':
							$salida=render_admin_editar($param);
							break;
						case 'validaredicion':
							$salida=render_admin_validaredicion($param);
							break;
						case 'add':
							$salida=render_admin_add($param);
							break;
						case 'validaradd':
							$salida=render_admin_validaradd($param);
							break;
						case 'addrsc':
							require_once("documentos/recursos.inc.php");
							$salida=render_admin_addrsc($param);
							break;
						case 'validarrsc':
							require_once("documentos/recursos.inc.php");
							$salida=render_admin_validarrsc($param);
							break;
						case 'editrsc':
							require_once("documentos/recursos.inc.php");
							$salida=render_admin_editrsc($param);
							break;
						case 'valedrsc':
							require_once("documentos/recursos.inc.php");
							$salida=render_admin_valedrsc($param);
							break;
						case 'delrsc':
							require_once("documentos/recursos.inc.php");
							$salida=render_admin_delrsc($param);
							break;
						case 'okdelrsc':
							require_once("documentos/recursos.inc.php");
							$salida=render_admin_okdelrsc($param);
							break;
						case 'verrsc':
							require_once("documentos/recursos.inc.php");
							$salida=render_admin_verrsc($param);
							break;
						case "ver":
							$salida=render_user_var($param);
							break;
						case "ver-rsc":
							$salida=render_user_verrsc($param);
							break;
						case "mostrar":
							$salida=render_user_mostrardocumento($param);
							break;
						default:
							header('Location: index.php');
							die();
							break;

						}
				};
		return $salida;
		}
	function render_admin_titulos($param)
	{
			list($db)=Getdb();
			$tbl=GetTable('documentos');
			$col=GetCols('documentos');
			$sql="Select * from $tbl";
			$rs=$db->Execute($sql);
			while (!$rs->EOF) 
				{
					$titulo=explode("\n",$rs->fields[$col['resumen']]);
					echo $titulo[4]."<br>";
					$rs->MoveNext();}
			die();
		}
		
	function render_admin_listardocumentos($param)
		{
			require_once("lister.php");

			$sf=vwVarFromInput('sf');
			$start=vwVarFromInput('start');
			$up=vwVarFromInput('up');

			list($db)=Getdb();
			$tbl=GetTable('documentos');
			$col=GetCols('documentos');
			$sql="Select * from $tbl";
			$Cols=array(
						array 	(	"dbname"	=>	$col['did'],
									"label"		=>	"id",
									"width"		=>	"45px",
									"sortable"	=>	true),
						array 	(	"dbname"	=>	$col['aid'],
									"label"		=>	"Archivo",
									"width"		=>	"70px",
									"sortable"	=>	true,
									"dropdown"	=>	true,
									"dropcall"		=>	array(	"funcion"	=> "cbzArchivos",
																"valor"		=>	$col['aid'])),
						array 	(	"dbname"	=>	$col['sid'],
									"label"		=>	"Secci&oacute;n",
									"width"		=>	"100px",
									"sortable"	=>	false,
									"dropdown"	=>	true,
									"dropcall"		=>	array(	"funcion"	=> "cbzSecciones",
																"valor"		=>	$col['sid'])),
						array	(	"dbname"	=>	$col['signatura'],
									"label"		=>	"Signatura",
									"width"		=>	"70px",
									"sortable"	=>	true),
						array	(	"dbname"	=>	$col['folios'],
									"label"		=>	"Folios",
									"width"		=>	"70px",
									"sortable"	=>	"false"));

			$opciones=array(
							array(	"funcion"	=>	"cbDocumentoEdit",
									"valor"		=>	"$col[did]"),
							array(	"funcion"	=>	"cbDocumentoDelete",
									"valor"		=>	"$col[did]"),
							array(	"funcion"	=>	"cbDocumentoSeeRsc",
									"valor"		=>	"$col[did]"),
							array(	"funcion"	=>	"cbDocumentoAddRsc",
									"valor"		=>	"$col[did]"));

			$acciones=array(
							array(	'funcion'=>"cbDocumentoAdmAdd"));

			$documentList=new Lister("admDocumentos",$sql,25,$Cols,$col['did'],$opciones,"dg-admdocumentos.css");
			$documentList->table="$tbl";
			$documentList->where="";
			$documentList->GeneralActions=$acciones;

			if ($sf!="")
				{
					$documentList->SetSort($sf,$up);}

			if ($start!="")
				{
					$documentList->SetStart($start);}

			$listado=$documentList->render();
			if (($listado===null)||(trim($listado)==""))
				{
					$aux=cbDocumentoAdmAdd();
					$listado="<br><center><a link href='$aux[url]'>$aux[etiqueta]</a></center>";}
			$resultado= SmartyInit();
			$plantilla="document/listardocument.tpl";
			$resultado->assign("listado",$listado);
			$salida=$resultado->fetch($plantilla);

			vwSessionSetVar('urlantigua',CurrentUrl());
			return $salida;
			};

	function cbzArchivos($obj,$valor)
		{
			list($db)=Getdb();
			$tbl=GetTable('archivos');
			$col=GetCols('archivos');
			if (empty($obj->drops['Archivos']))
				{
					$sql="Select * from $tbl";
					$rs=$db->Execute($sql);
					if ($db->ErrorNo() != 0)
						{
							$param['ruta']="error";
							$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
							render($param);
							die();
							}
					$aux=$rs->GetRows();
					foreach($aux as $value)
						{
							$obj->drops['Archivos'][]=fromdbtocms($value,'archivos');}
					}

			foreach($obj->drops['Archivos'] as $value)
				{
					if ($value['aid']==$valor)
						{
							return $value['abrev'];}
					}
			return "N/D";
			}

	function cbzSecciones($obj,$valor)
		{
			list($db)=Getdb();
			$tbl=GetTable('secciones');
			$col=GetCols('secciones');
			if (empty($obj->drops['Secciones']))
				{
					$sql="Select * from $tbl";
					$rs=$db->Execute($sql);
					if ($db->ErrorNo() != 0)
						{
							$param['ruta']="error";
							$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
							render($param);
							die();
							}
					$aux=$rs->GetRows();
					foreach($aux as $value)
						{
							$obj->drops['Secciones'][]=fromdbtocms($value,'secciones');}
					}

			foreach($obj->drops['Secciones'] as $value)
				{
					if ($value['sid']==$valor)
						{
							return $value['nombre'];}
					}
			return "N/D";
			}

	function cbDocumentoEdit ($key,$valor)
		{
			return array("etiqueta"=>"Editar","url"=>"index.php?actor=documentos&accion=editar&id=$valor");};

	function cbDocumentoDelete ($key,$valor)
		{
			return array("etiqueta"=>"Borrar","url"=>"index.php?actor=documentos&accion=okdel&id=$valor");};

	function cbDocumentoAdmAdd()
		{
			return array("etiqueta"=>"A&ntilde;adir Documento","url"=>"index.php?actor=documentos&accion=add");};

	function cbDocumentoAddRsc($key,$valor)
		{
			return array("etiqueta"=>"A&ntilde;adir Recurso","url"=>"index.php?actor=documentos&accion=addrsc&id=$valor");};

	function cbDocumentoSeeRsc($key,$valor)
		{
			return array("etiqueta"=>"Gestionar Recursos","url"=>"index.php?actor=documentos&accion=verrsc&id=$valor");};

	function render_admin_add($param)
	{
		$resultado= SmartyInit();
		$resultado->assign("validaregistrourl","index.php?actor=documentos&accion=validaradd");
		$plantilla="document/adddocument.tpl";
		$resultado->assign('dropDwArchivo',html_entity_decode(ArchivosDropDown(),ENT_QUOTES));
		$resultado->assign('dropDwSeccion',html_entity_decode(SeccionesDropDown(),ENT_QUOTES));
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_validaradd($param)
	{
		list($aid,$sid,$folios,$signatura,$siglos,$periodo,$resumen,$notas)=
		vwVarFromInput("aid","sid","folios","signatura","siglos","periodo","resumen","notas");

		// Comprobamos que el documento no existe ya
		list($db)=Getdb();
		$tbl=GetTable('documentos');
		$col=GetCols('documentos');
		$sql="SELECT $col[signatura],$col[did] FROM $tbl WHERE $col[signatura]='$signatura' and $col[folios]='$folios'";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$mensaje="Ha ocurrido un error al leer de la base de datos";
			return $mensaje;
			}
		if ($resultado->RecordCount()>0)
			{
			// El documento ya existe
			$param['ruta']="error";
			$param['mensaje']="El documento ya existe.Redireccionando a la edicion del documento ya existente";
			$param['timeout']="3";
			$res=$resultado->FetchRow();
			$param['url']='index.php?actor=documentos&accion=editar&id='.$res[$col['did']];
			render($param);
			die();
			}
			// Insertamos el archivo en la base de datos

		$seccion=array (	"aid"	=>	$aid,
							"sid"	=>	$sid,
							"folios"	=>	htmlentities($folios,ENT_QUOTES),
							"signatura"	=>	htmlentities($signatura,ENT_QUOTES),
							"siglos"	=>	htmlentities($siglos,ENT_QUOTES),
							"periodo"	=>	ParsePeriod($periodo),
							"resumen"	=>	htmlentities($resumen,ENT_QUOTES),
							"notas"		=>	htmlentities($notas,ENT_QUOTES));
		//$seccion=fromcmstodb($seccion,'documentos');
		$result=_insert($seccion);
		if ($result!=true)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al introducir la secci&oacute;n en la base de datos <br>$result";
			render($param);
			die();
			}

		$mensaje="La secci&oacute;n ha sido introducida correctamente.";
		/* $resultado= SmartyInit();
		$resultado->assign("mensaje",$mensaje);
		$plantilla="mensaje.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;  */

		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);

	}

	function render_admin_editar($param)
	{
		list($db)=Getdb();
		$tbl=GetTable('documentos');
		$col=GetCols('documentos');

		$sql="SELECT * FROM $tbl WHERE $col[did]='$param[did]'";

		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
				$param['ruta']="error";
				$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
				render($param);
				die();
			}
		$documento=$resultado->FetchRow();
		$documento=fromdbtocms($documento,'documentos');
		$documento=toHtml($documento);
		$resultado= SmartyInit();
		$resultado->assign("datos",$documento);
		$resultado->assign("validaregistrourl","index.php?actor=documentos&accion=validaredicion");
		$resultado->assign('dropDwArchivo',html_entity_decode(ArchivosDropDown($documento['aid']),ENT_QUOTES));
		$resultado->assign('dropDwSeccion',html_entity_decode(SeccionesDropDown($documento['sid']),ENT_QUOTES));
		$plantilla="document/editdocument.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_validaredicion($param)
	{
		list($aid,$sid,$folios,$signatura,$siglos,$periodo,$resumen,$notas,$oldid)=
		vwVarFromInput("aid","sid","folios","signatura","siglos","periodo","resumen","notas",'oldid');

		// Comprobamos que el documento no existe ya
		list($db)=Getdb();
		$tbl=GetTable('documentos');
		$col=GetCols('documentos');

		$seccion=array (	"did"	=>	$oldid,
							"aid"	=>	$aid,
							"sid"	=>	$sid,
							"folios"	=>	htmlentities($folios,ENT_QUOTES),
							"signatura"	=>	htmlentities($signatura,ENT_QUOTES),
							"siglos"	=>	htmlentities($siglos,ENT_QUOTES),
							"periodo"	=>	ParsePeriod($periodo),
							"resumen"	=>	htmlentities($resumen,ENT_QUOTES),
							"notas"		=>	htmlentities($notas,ENT_QUOTES));
		//$seccion=fromcmstodb($seccion,'documentos');
		$result=_update($seccion);

		if ($result)
			{
				$mensaje="Los datos del archivo han sido cambiados correctamente";}
		else
			{
				$mensaje="Ha habido un error en la actualizaci&oacute;n de los datos.<br>$result";}

		/* $resultado= SmartyInit();
		$resultado->assign("mensaje",$mensaje);
		$plantilla="mensaje.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida; */

		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);
	}

	function render_admin_okdel($param)
	{
		$resultado= SmartyInit();
		$plantilla="document/admdelcheck.tpl";
		$id=$param['did'];
		$resultado->assign("confirmadelurl","index?actor=documentos&accion=deldoc&id=$id");
		$resultado->assign("rechazadelurl","index.php?actor=documentos&accion=listar");
		$resultado->assign("mensaje",$param['mensaje']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_deldoc($param)
	{
		$aid=$param['did'];
		list($db)=Getdb();
		$tbl=GetTable('documentos');
		$col=GetCols('documentos');
		$sidcol=$col['did'];

		$sql="DELETE FROM $tbl WHERE $sidcol='$aid'";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$mensaje="Ha ocurrido un error al borrar el documento";
			}
		else
			{
			$mensaje="El documento ha sido borrado correctamente";}

		/* $resultado= SmartyInit();
		$plantilla="mensaje.tpl";
		$resultado->assign("mensaje",$mensaje);
		$salida=$resultado->fetch($plantilla);
		return $salida; */

		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);
	}

	function render_user_mostrardocumento($param)
		{
			list($db)=Getdb();
			$col=GetCols('documentos');
			$tbl=GetTable('documentos');
			$sql="SELECT * FROM $tbl WHERE $col[did]=$param[did]";
			$rs=$db->Execute($sql);
			$result=$rs->FetchRow();
			$result=fromdbtocms($result,'documentos');
			$result['periodo']=InverseParsePeriod($result['periodo']);
			$result=toHtml($result);
			$resultado= SmartyInit();
			$plantilla="document/document.tpl";
			$resultado->assign('datos',$result);
			$resultado->assign('dropDwArchivo',html_entity_decode(getArchivo($result['aid']),ENT_QUOTES));
			$resultado->assign('dropDwSeccion',html_entity_decode(getSeccion($result['sid']),ENT_QUOTES));
			$resultado->assign('recursos',MostrarRecursos($param['did']));
			if (vwSessionGetVar('UserLevel')>499)
				{
					$resultado->assign('admin',true);}
			else
				{
					$resultado->assign('admin',false);}
			$salida=$resultado->fetch($plantilla);
			return $salida;
			}

	function getArchivo($valor)
		{
			list($db)=Getdb();
			$tbl=GetTable('archivos');
			$col=GetCols('archivos');
			$sql="Select * from $tbl where $col[aid]=$valor;";
			$rs=$db->Execute($sql);
			if ($db->ErrorNo() != 0)
				{
					$param['ruta']="error";
					$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
					render($param);
					die();
					}
			$aux=$rs->FetchRow();
			$aux=fromdbtocms($aux,'archivos');
			return $aux['abrev'];
			}

	function getSeccion($valor)
		{
			list($db)=Getdb();
			$tbl=GetTable('secciones');
			$col=GetCols('secciones');
			$sql="Select * from $tbl where $col[sid]=$valor;";
			$rs=$db->Execute($sql);
			if ($db->ErrorNo() != 0)
				{
					$param['ruta']="error";
					$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
					render($param);
					die();
					}
			$aux=$rs->FetchRow();
			$aux=fromdbtocms($aux,'secciones');
			return $aux['nombre'];
			}

	function MostrarRecursos($did)
		{
			list($db)=Getdb();
			$tbl=GetTable('recursos');
			$col=GetCols('recursos');

			$sql="SELECT * FROM $tbl WHERE $col[did]=$did";

			$rs=$db->Execute($sql);
			if ($db->ErrorNo() != 0)
				{
					$param['ruta']="error";
					$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
					render($param);
					die();
					}
			$aux=$rs->GetRows();

			foreach($aux as $value)
				{
					$value=fromdbtocms($value,"recursos");
					if (trim($value['url'])!="")
						{
							$total['url']['total']=$total['url']['total']+1;
							$total['url']['rsc'][]=$value;
							$total['url']['prv']=false;}
					else
						{
							$media=returnMedia($value['archivo']);
							if (!isset($total[$media]['prv']))
								{
									$aux=isAValidMedia($value["archivo"]);
									$total[$media]['prev']=$aux['preview'];
									if ($media=="pdf")
										{
											$total['prevext']=".pdf.jpg";}
									else
										{
											$total['prevext']=".jpg";}
									}

							$value['archivo']=substr($value['archivo'],0,strrpos($value['archivo'],'.'));
							$total[$media]['total']=$total[$media]['total']+1;
							$total[$media]['rsc'][]=$value;
							}
					}
			$output="";
			$resultado= SmartyInit();
			if (trim($media)!="")
				{
					foreach($total as $k=>$v)
						{
							if ($v['total']>0)
								{
									$resultado->assign('tipo',$k);
									$resultado->assign('recursos',$v['rsc']);
									$resultado->assign('numero',$v['total']);
									$resultado->assign('previo',$v['prev']);
									$resultado->assign('rel',$did);
									$resultado->assign('ext',$v['prevext']);
									$resultado->assign('prevs',vwSessionGetVar('uid'));
									$output=$output.$resultado->fetch("recursos.tpl");}
							}
					}
			if (trim($output)=="")
				{
					return "";}
			else
				{
					return $output;}
			}

	function render_user_verrsc($param)
		{
			$tbl=GetTable('recursos');
			$col=GetCols('recursos');
			list($db)=Getdb();
			$rid=$param['rid'];
			$rs=$db->Execute("SELECT * from $tbl WHERE $col[rid]=$rid");
			if ($db->ErrorNo() != 0)
				{
					$param['ruta']="error";
					$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
					render($param);
					die();
					}
			$recurso=$rs->FetchRow();
			$recurso=fromdbtocms($recurso,'recursos');
			$ul=vwSessionGetVar('UserLevel');
			if ($ul<1)
				{
					$param['ruta']="error";
					$param['mensaje']="No tiene nivel para acceder a los recursos. Registrese.";
					render($param);
					die();
					}
			else
				{
					if ($ul<500)
						{
							if ($recurso['restringido']=="S")
								{
									$tbl=GetTable('autorizaciones');
									$col=GetCols('autorizaciones');
									list($db)=Getdb();
									$rid=$param['rid'];
									$sql="SELECT * FROM $tbl where $col[rid]=$valor AND $col[uid]=".vwSessionGetVar('uid')." ORDER BY $col[resolucion] desc";
									$rs=$db->Execute($sql);
									if ($db->ErrorNo() != 0)
										{
											$param['ruta']="error";
											$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
											render($param);
											die();
											}
									$aut=$rs->FetchRow();
									$aut=fromdbtocms($aut,'autorizaciones');
									if ($aut['estado']!='C')
										{
											$param['ruta']="error";
											$param['mensaje']="No dispone de autorizacion para descargar el recurso.";
											render($param);
											die();
											}
									}
							}
						outputFile($recurso['archivo'],$recurso['did']);
						die();
						}
			die();
		}



?>
