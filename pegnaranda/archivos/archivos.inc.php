<?php
require_once ("usuarios/usuarios.aux.inc.php");

	function render_archivo($accion,$sujeto,$param)
	{
		$UserLevel=vwSessionGetVar("UserLevel");

		if ($UserLevel<500)
			{
					header('Location: index.php');
					die();
					break;
				}
		else
			{
				//require_once("archivos/archivos.adm.inc.php");
				switch ($accion)
					{
						// Aqui empieza la parte correspondiente al administrador
						case "listar":
												$salida=render_admin_listararchivos($param);
												break;
						case "okdel":
												$salida=render_admin_okdel($param);
												break;
						case "delarchivo":
												$salida=render_admin_delarchivo($param);
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

						default:
							header('Location: index.php');
							die();
							break;
						}
				};
		return $salida;
		}

	function render_admin_add($param)
	{
		$resultado= SmartyInit();
		$resultado->assign("validaregistrourl","index.php?actor=archivos&accion=validaradd");
		$plantilla="archivos/addarchivo.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_validaradd($param)
	{
		list ($abrev,$nombre)=	vwVarFromInput('abrev','nombre');
		// Comprobamos que el archivo no existe ya
		list($db)=Getdb();
		$tbl=GetTable('archivos');
		$col=GetCols('archivos');
		$sql="SELECT ".$col['abrev']." FROM $tbl WHERE ".$col['abrev']."='$abrev'";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al leer de la base de datos";
			render($param);
			die();
			}
		if ($resultado->RecordCount()>0)
			{
			// El usuario existe ya
			$param['ruta']="error";
			$param['mensaje']="El archivo ya existe";
			render($param);
			die();
			}
			// Insertamos el archivo en la base de datos

		$archivos=array (	$col['abrev']=>"'$abrev'",
					$col['nombre']=>"'".htmlentities($nombre,ENT_QUOTES)."'");

		array_walk($archivos,'fixCode');
		$resultado=$db->Replace($tbl,$archivos,array(),false);
		if ($resultado !=2)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al introducir el archivo en la base de datos ";
			render($param);
			die();
			}

		$sql="SELECT $col[aid] FROM $tbl WHERE $col[abrev]='$abrev'";
		$resultado=$db->Execute($sql);

		if ($db->ErrorNo() != 0)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al leer de la base de datos";
			render($param);
			die();
			}
		$mensaje="El archivo ha sido introducido correctamente.";
		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);

	}

	function render_admin_editar($param)
	{
		list($db)=Getdb();
		$tbl=GetTable('archivos');
		$col=GetCols('archivos');

		$sql="SELECT * FROM $tbl WHERE $col[aid]='$param[aid]'";

		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
				$param['ruta']="error";
				$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
				render($param);
				die();
			}
		$archivo=$resultado->FetchRow();
		$archivo=fromdbtocms($archivo,'archivos');
		$archivo=toHtml($archivo);
		$resultado= SmartyInit();
		$resultado->assign("datos",$archivo);
		$resultado->assign("validaregistrourl","index.php?actor=archivos&accion=validaredicion");
		$plantilla="archivos/editarchivo.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_validaredicion($param)
	{
		list ($aid,$abrev,$nombre)=	vwVarFromInput('aid','abrev','nombre');

		list($db)=Getdb();
		$tbl=GetTable('archivos');
		$col=GetCols('archivos');

		$archivos=array (	$col['aid']=>"'$aid'",
							$col['abrev']=>"'$abrev'",
							$col['nombre']=>"'".htmlentities($nombre,ENT_QUOTES)."'");

		array_walk($archivos,'fixCode');

		$resultado=$db->Replace($tbl,$archivos,array($col['aid']),$autoquote=false);
		if ($resultado !=1)
			{
			$mensaje="Ha ocurrido un error al cambiar los datos del archivo en la base de datos";
			}
		else
			{
			if (!empty($clave))
				{
					// Si se ha cambiado la clave obligamos a que vuelva a iniciar la sesion
					vwSessionVarsClean();
				}
			$mensaje="Los datos del archivo han sido cambiados correctamente";
			}

		//$resultado= SmartyInit();
		//$resultado->assign("mensaje",$mensaje);
		//$plantilla="mensaje.tpl";
		//$salida=$resultado->fetch($plantilla);
		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);

		//return $salida;
	}

	// Aqui empieza la definicion de las funciones referentes al administrador

	function render_admin_listararchivos($param)
	{
		require_once("lister.php");
		$sf=vwVarFromInput('sf');
		$start=vwVarFromInput('start');
		$up=vwVarFromInput('up');

		list($db)=Getdb();
		$tbl=GetTable('archivos');
		$col=GetCols('archivos');

		$sql="Select * from $tbl";
		$Cols=array(
					array ( "dbname"	=>	$col['aid'],
							"label"		=>	"id",
							"width"		=>	"45px",
							"sortable"	=>	false),
					array ( "dbname"	=>	$col['abrev'],
							"label"		=>	"Abreviatura",
							"width"		=>	"50px",
							"sortable"	=>	true),
					array ( "dbname"	=>	$col['nombre'],
							"label"		=>	"Nombre",
							"width"		=>	"200px",
							"sortable"	=>	true));

		$opciones=array(
						array(	"funcion"	=>	"cbArchivoEdit",
								"valor"		=>	"$col[aid]"),
						array(	"funcion"	=>	"cbArchivoDelete",
								"valor"		=>	"$col[aid]"));

		$acciones=array(
						array(	'funcion'=>"cbArchivoAdmAdd"));

		$archivList=new Lister("admArchivos",$sql,25,$Cols,$col['aid'],$opciones,"dg-admarchivos.css");
		$archivList->table="$tbl";
		$archivList->where="";
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
				$aux=cbArchivoAdmAdd();
				$listado="<br><center><a link href='$aux[url]'>$aux[etiqueta]</a></center>";}
		$resultado= SmartyInit();
		$plantilla="archivos/listarchivos.tpl";
		$resultado->assign("listado",$listado);
		$salida=$resultado->fetch($plantilla);

		vwSessionSetVar('urlantigua',CurrentUrl());
		return $salida;

	}


	function cbArchivoEdit ($key,$valor)
		{
			return array("etiqueta"=>"Editar","url"=>"index.php?actor=archivos&accion=editar&id=$valor");};

	function cbArchivoDelete ($key,$valor)
		{
			return array("etiqueta"=>"Borrar","url"=>"index.php?actor=archivos&accion=okdel&id=$valor");};

	function cbArchivoAdmAdd()
		{
			return array("etiqueta"=>"A&ntilde;adir Archivo","url"=>"index.php?actor=archivos&accion=add");};

	function render_admin_okdel($param)
	{
		$resultado= SmartyInit();
		$plantilla="archivos/admdelcheck.tpl";
		$id=$param['aid'];
		$resultado->assign("confirmadelurl","index?actor=archivos&accion=delarchivo&id=$id");
		$resultado->assign("rechazadelurl","index.php?actor=archivos&accion=listar");
		$resultado->assign("mensaje",$param['mensaje']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_delarchivo($param)
	{
		$aid=$param['aid'];
		list($db)=Getdb();
		$tbl=GetTable('archivos');
		$col=GetCols('archivos');
		$aidcol=$col['aid'];

		$sql="DELETE FROM $tbl WHERE $aidcol='$aid'";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$mensaje="Ha ocurrido un error al borrar el archivo";
			}
		else
			{
			$mensaje="El archivo ha sido borrado correctamente";}

		//$resultado= SmartyInit();
		//$plantilla="mensaje.tpl";
		//$resultado->assign("mensaje",$mensaje);
		//$salida=$resultado->fetch($plantilla);
		//return $salida;
		
		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);


	}

?>
