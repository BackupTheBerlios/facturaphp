<?php
//require_once ("usuarios/usuarios.aux.inc.php");

	function render_secciones($accion,$sujeto,$param)
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

				switch ($accion)
					{
						// Aqui empieza la parte correspondiente al administrador
						case "listar":
												$salida=render_admin_listarsecciones($param);
												break;
						case "okdel":
												$salida=render_admin_okdel($param);
												break;
						case "delseccion":
												$salida=render_admin_delseccion($param);
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
		$resultado->assign("validaregistrourl","index.php?actor=secciones&accion=validaradd");
		$plantilla="seccion/addseccion.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_validaradd($param)
	{
		$nombre=	vwVarFromInput('nombre');
		// Comprobamos que el archivo no existe ya
		list($db)=Getdb();
		$tbl=GetTable('secciones');
		$col=GetCols('secciones');
		$sql="SELECT ".$col['nombre']." FROM $tbl WHERE ".$col['nombre']."='$nombre'";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$mensaje="Ha ocurrido un error al leer de la base de datos";
			return $mensaje;
			}
		if ($resultado->RecordCount()>0)
			{
			// El usuario existe ya
			$param['ruta']="error";
			$param['mensaje']="La secci&oacute;n ya existe";
			render($param);
			die();
			}
			// Insertamos el archivo en la base de datos

		$seccion=array (	$col['nombre']=>"'".htmlentities($nombre,ENT_QUOTES)."'");

		array_walk($seccion,'fixCode');
		$resultado=$db->Replace($tbl,$seccion,array(),false);
		if ($resultado !=2)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al introducir la secci&oacute;n en la base de datos ";
			render($param);
			die();
			}

		$sql="SELECT $col[sid] FROM $tbl WHERE $col[nombre]='$nombre'";
		$resultado=$db->Execute($sql);

		if ($db->ErrorNo() != 0)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al leer de la base de datos";
			render($param);
			die();
			}
		$mensaje="La secci&oacute;n ha sido introducida correctamente.";
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

	function render_admin_editar($param)
	{
		list($db)=Getdb();
		$tbl=GetTable('secciones');
		$col=GetCols('secciones');

		$sql="SELECT * FROM $tbl WHERE $col[sid]='$param[sid]'";

		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
				$param['ruta']="error";
				$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
				render($param);
				die();
			}
		$seccion=$resultado->FetchRow();
		$seccion=fromdbtocms($seccion,'secciones');
		$seccion=toHtml($seccion);
		$resultado= SmartyInit();
		$resultado->assign("datos",$seccion);
		$resultado->assign("validaregistrourl","index.php?actor=secciones&accion=validaredicion");
		$plantilla="seccion/editseccion.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_validaredicion($param)
	{
		list ($sid,$nombre)=	vwVarFromInput('sid','nombre');

		list($db)=Getdb();
		$tbl=GetTable('secciones');
		$col=GetCols('secciones');

		$seccion=array (	$col['sid']=>"'$sid'",
							$col['nombre']=>"'".htmlentities($nombre,ENT_QUOTES)."'");

		array_walk($seccion,'fixCode');
		$resultado=$db->Replace($tbl,$seccion,array($col['sid']),$autoquote=false);
		if ($resultado !=1)
			{
			$mensaje="Ha ocurrido un error al cambiar los datos del archivo en la base de datos";
			}
		else
			{
			$mensaje="Los datos del archivo han sido cambiados correctamente";}

		/* $resultado= SmartyInit();
		$resultado->assign("mensaje",$mensaje);
		$plantilla="mensaje.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida; */

		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);

	}

	// Aqui empieza la definicion de las funciones referentes al administrador

	function render_admin_listarsecciones($param)
	{
		require_once("lister.php");
		$sf=vwVarFromInput('sf');
		$start=vwVarFromInput('start');
		$up=vwVarFromInput('up');

		list($db)=Getdb();
		$tbl=GetTable('secciones');
		$col=GetCols('secciones');

		$sql="Select * from $tbl";
		$Cols=array(
					array ( "dbname"	=>	$col['sid'],
							"label"		=>	"id",
							"width"		=>	"45px",
							"sortable"	=>	false),
					array ( "dbname"	=>	$col['nombre'],
							"label"		=>	"Nombre",
							"width"		=>	"200px",
							"sortable"	=>	true));

		$opciones=array(
						array(	"funcion"	=>	"cbSeccionEdit",
								"valor"		=>	"$col[sid]"),
						array(	"funcion"	=>	"cbSeccionDelete",
								"valor"		=>	"$col[sid]"));

		$acciones=array(
						array(	'funcion'=>"cbSeccionAdmAdd"));

		$archivList=new Lister("admSecciones",$sql,25,$Cols,$col['sid'],$opciones,"dg-admsecciones.css");
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
				$aux=cbSeccionAdmAdd();
				$listado="<br><center><a link href='$aux[url]'>$aux[etiqueta]</a></center>";}
		$resultado= SmartyInit();
		$plantilla="seccion/listarseccion.tpl";
		$resultado->assign("listado",$listado);
		$salida=$resultado->fetch($plantilla);

		vwSessionSetVar('urlantigua',CurrentUrl());
		return $salida;
	}


	function cbSeccionEdit ($key,$valor)
		{
			return array("etiqueta"=>"Editar","url"=>"index.php?actor=secciones&accion=editar&id=$valor");};

	function cbSeccionDelete ($key,$valor)
		{
			return array("etiqueta"=>"Borrar","url"=>"index.php?actor=secciones&accion=okdel&id=$valor");};

	function cbSeccionAdmAdd()
		{
			return array("etiqueta"=>"A&ntilde;adir Seccion","url"=>"index.php?actor=secciones&accion=add");};

	function render_admin_okdel($param)
	{
		$resultado= SmartyInit();
		$plantilla="seccion/admdelcheck.tpl";
		$id=$param['sid'];
		$resultado->assign("confirmadelurl","index?actor=secciones&accion=delseccion&id=$id");
		$resultado->assign("rechazadelurl","index.php?actor=secciones&accion=listar");
		$resultado->assign("mensaje",$param['mensaje']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_delseccion($param)
	{
		$aid=$param['sid'];
		list($db)=Getdb();
		$tbl=GetTable('secciones');
		$col=GetCols('secciones');
		$sidcol=$col['sid'];

		$sql="DELETE FROM $tbl WHERE $sidcol='$aid'";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$mensaje="Ha ocurrido un error al borrar la seccion";
			}
		else
			{
			$mensaje="La seccion ha sido borrada correctamente";}

		/* $resultado= SmartyInit();
		$plantilla="mensaje.tpl";
		$resultado->assign("mensaje",$mensaje);
		$salida=$resultado->fetch($plantilla);
		return $salida; */

		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);
	}

?>
