<?php
require_once ("autorizaciones/autorizaciones.aux.inc.php");

	function render_autorizaciones($accion,$sujeto,$param)
	{
		$UserLevel=vwSessionGetVar("UserLevel");

		if ($UserLevel<500)
			{
				switch ($accion)
					{
						case 'add':
												$salida=render_user_add($param);
												break;
						case 'validaradd':
												$salida=render_user_validaradd($param);
												break;
						case 'ver':
												$salida=render_user_add($param);
												break;
						case 'editar':
												$salida=render_user_editar($param);
												break;
						case 'validaredicion':
												$salida=render_user_validaredicion($param);
												break;
						case 'vermis':
												$salida=render_user_vermis($param);
												break;
						case "okdel":
												$salida=render_admin_okdel($param);
												break;
						case "delautorizacion":
												$salida=render_admin_delautorizacion($param);
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
						case "listar":
												$salida=render_admin_listarautorizaciones($param);
												break;
						case "okdel":
												$salida=render_admin_okdel($param);
												break;
						case "delautorizacion":
												$salida=render_admin_delautorizacion($param);
												break;
						case "conceder":
												$salida=render_admin_autorizar($param);
												break;
						case "denegar":
												$salida=render_admin_denegar($param);
												break;
						default:
							header('Location: index.php');
							die();
							break;
						}
				};
		return $salida;
		}

	function render_user_add($param)
	{
		$resultado= SmartyInit();
		$resultado->assign("rid",$param['rid']);
		$resultado->assign("validaregistrourl","index.php?actor=autorizaciones&accion=validaradd");
		$plantilla="autorizacion/addautorizacion.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_user_validaradd($param)
		{
			return render_admin_validaradd($param);}

	function render_admin_validaradd($param)
		{
			$rid=	vwVarFromInput('rid');
			$uid=	vwSessionGetVar('uid');
			$razon=	vwVarFromInput('razon');
		// Comprobamos que el archivo no existe ya
		list($db)=Getdb();
		$tbl=GetTable('autorizaciones');
		$col=GetCols('autorizaciones');
		$sql="SELECT * FROM $tbl WHERE ".$col['rid']."='$rid' AND $col[uid]=$uid AND $col[estado]='P'";
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
			$param['mensaje']="Ya ha solicitado la autorizacion previamente";
			render($param);
			die();
			}
			// Insertamos el archivo en la base de datos

		$autorizacion=array (	$col['rid']		=>	$rid,
								$col['uid']		=>	$uid,
								$col['estado']	=> "'P'",
								$col['solicitud']	=> "".$db->DBTimeStamp(time())."",
								$col['razon']		=>	"'".htmlentities($razon)."'");
		//$autorizacion=fromcmstodb($autorizacion,"autorizaciones");
		print_r($autorizacion);
		//array_walk($autorizacion,'fixCode');
		$resultado=$db->Replace($tbl,$autorizacion,array(),false);
		if ($resultado !=2)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al introducir la solicitud de autorizacion en la bbdd.";
			render($param);
			die();
			}

		$mensaje="La secci&oacute;n ha sido introducida correctamente.";

		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);

		/*$resultado= SmartyInit();
		$resultado->assign("mensaje",$mensaje);
		$plantilla="mensaje.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida; */

	}

	function render_admin_editar($param)
	{
		list($db)=Getdb();
		$tbl=GetTable('autorizaciones');
		$col=GetCols('autorizaciones');

		$sql="SELECT * FROM $tbl WHERE $col[autid]='$param[autid]'";

		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
				$param['ruta']="error";
				$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
				render($param);
				die();
			}
		$autorizacion=$resultado->FetchRow();
		$autorizacion=fromdbtocms($autorizacion,'autorizaciones');
		$autorizacion=toHtml($autorizacion);
		$resultado= SmartyInit();
		$resultado->assign("datos",$autorizacion);
		$resultado->assign("validaregistrourl","index.php?actor=autorizaciones&accion=validaredicion");
		$plantilla="autorizacion/editautorizacion.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_user_editar($param)
	{
		list($db)=Getdb();
		$tbl=GetTable('autorizaciones');
		$col=GetCols('autorizaciones');

		$sql="SELECT * FROM $tbl WHERE $col[autid]='$param[autid]' AND $col[uid]=".vwSessionGetVar('uid');

		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
				$param['ruta']="error";
				$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
				render($param);
				die();
			}
		$autorizacion=$resultado->FetchRow();
		$autorizacion=fromdbtocms($autorizacion,'autorizaciones');
		$autorizacion=toHtml($autorizacion);
		$resultado= SmartyInit();
		$resultado->assign("datos",$autorizacion);
		$resultado->assign("validaregistrourl","index.php?actor=autorizaciones&accion=validaredicion");
		$plantilla="autorizacion/editautorizacion.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_user_validaredicion($param)
		{
			return render_admin_validaredicion($param);}

	function render_admin_validaredicion($param)
	{
		list ($autid,$razon)=	vwVarFromInput('autid','razon');
		list($db)=Getdb();
		$tbl=GetTable('autorizaciones');
		$col=GetCols('autorizaciones');

		$autorizacion=array (	'autid'	=>	$autid,
								'razon'	=>	"'".htmlentities($razon,ENT_QUOTES)."'");
		//array_walk($autorizacion,'fixCode');
		$autorizacion=fromcmstodb($autorizacion,"autorizaciones");
		$resultado=$db->Replace($tbl,$autorizacion,array($col['autid']),false);
		if ($resultado !=1)
			{
			$mensaje="Ha ocurrido un error al cambiar modificar la solicitud.";
			}
		else
			{
			$mensaje="Los datos de la solicitud han sido modificados correctamente";}

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

	function render_admin_listarautorizaciones($param)
	{
		require_once("lister.php");
		$sf=vwVarFromInput('sf');
		$start=vwVarFromInput('start');
		$up=vwVarFromInput('up');
		list($db)=Getdb();
		$tbl=GetTable('autorizaciones');
		$col=GetCols('autorizaciones');

		$sql="Select * from $tbl";
		$Cols=array(
					array ( "dbname"	=>	$col['autid'],
							"label"		=>	"id",
							"width"		=>	"45px",
							"sortable"	=>	false),
					array ( "dbname"	=>	$col['rid'],
							"label"		=>	"Recurso",
							"width"		=>	"70px",
							"sortable"	=>	false,
							"dropdown"	=>	true,
							"dropcall"		=>	array(	"funcion"	=> "cbzRecursos",
														"valor"		=>	$col['rid'])),
					array ( "dbname"	=>	$col['uid'],
							"label"		=>	"Usuario",
							"width"		=>	"45px",
							"sortable"	=>	false,
							"dropdown"	=>	true,
							"dropcall"		=>	array(	"funcion"	=> "cbzUsuarios",
														"valor"		=>	$col['uid'])),
					array ( "dbname"	=>	$col['estado'],
							"label"		=>	"Estado",
							"width"		=>	"45px",
							"sortable"	=>	false,
							'dropdown'	=>	true,
							'dropcall'	=>	array(	"funcion"	=>	"cbzEstados",
													"valor"		=>	$col['estado'])),
					array ( "dbname"	=>	$col['razon'],
							"label"		=>	"Nombre",
							"width"		=>	"200px",
							"sortable"	=>	true));

		$opciones=array(
						array(	"funcion"	=>	"cbautorizacionDelete",
								"valor"		=>	"$col[autid]"),
						array(	"funcion"	=>	"cbautorizacionConc",
								"valor"		=>	"$col[estado]"),
						array(	"funcion"	=>	"cbautorizacionDen",
								"valor"		=>	"$col[estado]"));

		$acciones=array();

		$archivList=new Lister("admAutorizaciones",$sql,25,$Cols,$col['autid'],$opciones,"dg-admautorizaciones.css");
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
				$aux=cbautorizacionAdmAdd();
				$listado="<br><center><a link href='$aux[url]'>$aux[etiqueta]</a></center>";}
		$resultado= SmartyInit();
		$plantilla="autorizacion/listarautorizacion.tpl";
		$resultado->assign("listado",$listado);
		$salida=$resultado->fetch($plantilla);

		vwSessionSetVar('urlantigua',CurrentUrl());
		return $salida;

	}

	function cbzRecursos($obj,$valor)
		{
			list($db)=Getdb();
			$tbl=GetTable('recursos');
			$col=GetCols('recursos');
			if (empty($obj->drops['recursos']))
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
							$obj->drops['recursos'][]=fromdbtocms($value,'recursos');}
					}

			foreach($obj->drops['recursos'] as $value)
				{
					if ($value['rid']==$valor)
						{
							return $value['titulo'];}
					}
			return "N/D";
			}

	function cbzEstados($obj,$valor)
		{
			switch($valor)
				{
					case "P":
								return "Pendiente";
								break;
					case "C":
								return "Concedida";
								break;
					case "D":
								return "Pendiente";
								break;
					}
			}

	function cbzUsuarios($obj,$valor)
		{
			list($db)=Getdb();
			$tbl=GetTable('usuarios');
			$col=GetCols('usuarios');
			if (empty($obj->drops['usuarios']))
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
							$obj->drops['usuarios'][]=fromdbtocms($value,'usuarios');}
					}

			foreach($obj->drops['usuarios'] as $value)
				{
					if ($value['uid']==$valor)
						{
							return $value['apellidos'].",".$value['nombre'];}
					}
			return "N/D";
			}

	function cbautorizacionConc ($key,$valor)
		{

			switch ($valor)
				{
					case 'P':
					case 'D':
								$exitz=array("etiqueta"=>"Autorizar","url"=>"index.php?actor=autorizaciones&accion=conceder&id=$key");
								break;
					default:
								$exitz=array("etiqueta"=>"","url"=>"");
								break;
					}
			return $exitz;
			};

	function cbautorizacionDen ($key,$valor)
		{

			switch ($valor)
				{
					case 'P':
					case 'A':
								$exitz=array("etiqueta"=>"Denegar","url"=>"index.php?actor=autorizaciones&accion=denegar&id=$key");
								break;
					default:
								$exitz=array("etiqueta"=>"","url"=>"");
								break;
					}
			return $exitz;
			};

	function cbautorizacionDelete ($key,$valor)
		{
			return array("etiqueta"=>"Borrar","url"=>"index.php?actor=autorizaciones&accion=okdel&id=$key");};

	function render_admin_okdel($param)
	{
		$resultado= SmartyInit();
		$plantilla="autorizacion/admdelcheck.tpl";
		$id=$param['autid'];
		$resultado->assign("confirmadelurl","index?actor=autorizaciones&accion=delautorizacion&id=$id");
		$resultado->assign("rechazadelurl","index.php?actor=autorizaciones&accion=listar");
		$resultado->assign("mensaje",$param['mensaje']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_delautorizacion($param)
	{
		$aid=$param['autid'];
		list($db)=Getdb();
		$tbl=GetTable('autorizaciones');
		$col=GetCols('autorizaciones');
		$sidcol=$col['autid'];

		$sql="DELETE FROM $tbl WHERE $sidcol='$aid'";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$mensaje="Ha ocurrido un error al borrar la autorizacion";
			}
		else
			{
			$mensaje="La autorizacion ha sido borrada correctamente";}

		/* $resultado= SmartyInit();
		$plantilla="mensaje.tpl";
		$resultado->assign("mensaje",$mensaje);
		$salida=$resultado->fetch($plantilla);
		return $salida; */

		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);
	}

	function render_admin_autorizar($param)
		{
			$autid=$param['autid'];
			$result=_conceder($autid);
			switch($result)
				{
					case 0:
							$param['ruta']="error";
							$param['mensaje']="Ha ocurrido un error severo.";
							render($param);
							die();
							break;
					case 1:
							$mensaje="La autorizacion ha sido introducida en el sistema correctamente";
							break;
					case 2:
							$param['ruta']="error";
							$param['mensaje']="Ha ocurrido un error severo.";
							render($param);
							die();
							break;
					}
					$resultado= SmartyInit();
			/*$plantilla="mensaje.tpl";
			$resultado->assign("mensaje",$mensaje);
			$salida=$resultado->fetch($plantilla);
			return $salida;*/

			$url=vwSessionGetVar('urlantigua');
			vwSessionDelVar('urlantigua');
			return render_msg($mensaje,3,$url);
			}

	function render_admin_denegar($param)
		{
			$autid=$param['autid'];
			$result=_denegar($autid);
			switch($result)
				{
					case 0:
							$param['ruta']="error";
							$param['mensaje']="Ha ocurrido un error severo.";
							render($param);
							die();
							break;
					case 1:
							$mensaje="La denegacion ha sido introducida en el sistema correctamente";
							break;
					case 2:
							$param['ruta']="error";
							$param['mensaje']="Ha ocurrido un error severo.";
							render($param);
							die();
							break;
					}

			/* $resultado= SmartyInit();
			$plantilla="mensaje.tpl";
			$resultado->assign("mensaje",$mensaje);
			$salida=$resultado->fetch($plantilla);
			return $salida; */

			$url=vwSessionGetVar('urlantigua');
			vwSessionDelVar('urlantigua');
			return render_msg($mensaje,3,$url);
			}

	function render_user_vermis($param)
	{
		require_once("lister.php");
		$sf=vwVarFromInput('sf');
		$start=vwVarFromInput('start');
		$up=vwVarFromInput('up');
		list($db)=Getdb();
		$tbl=GetTable('autorizaciones');
		$col=GetCols('autorizaciones');

		$sql="Select * from $tbl";
		$Cols=array(
					array ( "dbname"	=>	$col['autid'],
							"label"		=>	"id",
							"width"		=>	"45px",
							"sortable"	=>	false),
					array ( "dbname"	=>	$col['rid'],
							"label"		=>	"Recurso",
							"width"		=>	"70px",
							"sortable"	=>	false,
							"dropdown"	=>	true,
							"dropcall"		=>	array(	"funcion"	=> "cbzRecursos",
														"valor"		=>	$col['rid'])),
					array ( "dbname"	=>	$col['estado'],
							"label"		=>	"Estado",
							"width"		=>	"45px",
							"sortable"	=>	false,
							'dropdown'	=>	true,
							'dropcall'	=>	array(	"funcion"	=>	"cbzEstados",
													"valor"		=>	$col['estado'])),
					array ( "dbname"	=>	$col['razon'],
							"label"		=>	"Nombre",
							"width"		=>	"200px",
							"sortable"	=>	true));

		$opciones=array(
						array(	"funcion"	=>	"cbautorizacionUsrDelete",
								"valor"		=>	"$col[autid]"),
						array(	"funcion"	=>	"cbautorizacionUsrEditar",
								"valor"		=>	"$col[autid]"));

		$acciones=array();

		$archivList=new Lister("admAutorizaciones",$sql,25,$Cols,$col['autid'],$opciones,"dg-admautorizaciones.css");
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
				$aux=cbautorizacionAdmAdd();
				$listado="<br><center><a link href='$aux[url]'>$aux[etiqueta]</a></center>";}
		$resultado= SmartyInit();
		$plantilla="autorizacion/listarautorizacion.tpl";
		$resultado->assign("listado",$listado);
		$salida=$resultado->fetch($plantilla);

		vwSessionSetVar('urlantigua',CurrentUrl());
		return $salida;
	}

	function cbautorizacionUsrDelete ($key,$valor)
		{
			return array("etiqueta"=>"Borrar","url"=>"index.php?actor=autorizaciones&accion=okdel&id=$key");};

	function cbautorizacionUsrEditar ($key,$valor)
		{
			return array("etiqueta"=>"Editar","url"=>"index.php?actor=autorizaciones&accion=editar&id=$key");};

?>
