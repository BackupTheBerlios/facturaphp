<?php
require_once ("usuarios/usuarios.aux.inc.php");

	function render_usuario($accion,$sujeto,$param)
	{
		$UserLevel=vwSessionGetVar("UserLevel");

		if ($UserLevel<500)
			{
				switch ($accion)
					{
						case 'registro':
												$salida=render_usuario_registro($param);
												break;
						case 'validaregistro':
												$salida=render_usuario_validaregistro($param);
												break;
						case 'editar':
												$salida=render_usuario_editar($param);
												break;
						case 'validaredicion':
												$salida=render_usuario_validaredicion($param);
												break;
						case 'prefs':
												$salida=render_usuario_showprefs($param);
												break;
						case 'changeprefs':
												$salida=render_usuario_fixprefs($param);
												break;

						default:
							header('Location: index.php');
							die();
							break;
						}
				}
		else
			{
				require_once("usuarios/usuarios.adm.inc.php");
				switch ($accion)
					{
						// Aqui empieza la parte correspondiente al administrador
						case "listar":
												$salida=render_admin_listarusuarios($param);
												break;
						case "aeditar":
												$salida=render_admin_aeditar($param);
												break;
						case "valaeditar":
												$salida=render_admin_valaeditar($param);
												break;
						case "okdel":
												$salida=render_admin_okdel($param);
												break;
						case "delusr":
												$salida=render_admin_delusr($param);
												break;
						case "promote":
												$salida=render_admin_promote($param);
												break;
						case "relevar":
												$salida=render_admin_relevar($param);
												break;
						case "okpromote":
												$salida=render_admin_okpromote($param);
												break;
						case "okrelevar":
												$salida=render_admin_okrelevar($param);
												break;
						case "masinfo":
												$salida=render_admin_masinfo($param);
												break;
						case 'editar':
												$salida=render_usuario_editar($param);
												break;
						case 'validaredicion':
												$salida=render_usuario_validaredicion($param);
												break;
						case 'registro':
												$salida=render_admin_registro($param);
												break;
						case 'validaregistro':
												$salida=render_admin_validaregistro($param);
												break;
						case 'prefs':
												$salida=render_usuario_showprefs($param);
												break;
						case 'changeprefs':
												$salida=render_usuario_fixprefs($param);
												break;
						default:
							header('Location: index.php');
							die();
							break;
						}
				};
		return $salida;
		}

	function render_usuario_registro($param)
	{
		$resultado= SmartyInit();
		$resultado->assign("validaregistrourl","index.php?actor=usuarios&accion=validaregistro");
		$plantilla="usuarios/adduser.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_usuario_validaregistro($param)
	{
		list ($uname,$clave,$clave2,$email,$nombre,$apellidos,$calle,$poblacion,$provincia,$pais,$cpostal,$actividad)=
		vwVarFromInput('uname','clave','clave2','email','nombre','apellidos','calle','poblacion','provincia','pais',
						'cpostal','actividad');
		// Comprobamos que el usuario no existe ya
		list($db)=Getdb();
		$tblusuarios=GetTable('usuarios');
		$cols_usuarios=GetCols('usuarios');
		$sql="SELECT ".$cols_usuarios['uname']." FROM $tblusuarios WHERE ".$cols_usuarios['uname']."='$uname'";
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
			$param['mensaje']="El usuario ya existe";
			render($param);
			die();
			}
			// Insertamos el usuario en la base de datos
		if ((empty($clave)) || ($clave!=$clave2))
				{
				$param['ruta']="error";
				$param['mensaje']="Las dos claves deben ser iguales.";
				render($param);
				die();
				}

		$usuario=array ($cols_usuarios['uname']=>"'$uname'",
						$cols_usuarios['clave']=>"'".md5($clave)."'",
						$cols_usuarios['nombre']=>"'".htmlentities($nombre,ENT_QUOTES)."'",
						$cols_usuarios['apellidos']=>"'".htmlentities($apellidos,ENT_QUOTES)."'",
						$cols_usuarios['calle']=>"'".htmlentities($calle,ENT_QUOTES)."'",
						$cols_usuarios['poblacion']=>"'".htmlentities($poblacion,ENT_QUOTES)."'",
						$cols_usuarios['provincia']=>"'".htmlentities($provincia,ENT_QUOTES)."'",
						$cols_usuarios['pais']=>"'".htmlentities($pais,ENT_QUOTES)."'",
						$cols_usuarios['cpostal']=>"'$cpostal'",
						$cols_usuarios['actividad']=>"'".htmlentities($actividad,ENT_QUOTES)."'",
						$cols_usuarios['nivel']=>"100");
		array_walk($usuario,'fixCode');
		$resultado=$db->Replace($tblusuarios,$usuario,array());
		if ($resultado !=2)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al introducir en la base de datos el usuario";
			render($param);
			die();
			}

		$sql="SELECT ".$cols_usuarios['uid']." FROM $tblusuarios WHERE ".$cols_usuarios['uname']."='$uname'";
		$resultado=$db->Execute($sql);

		if ($db->ErrorNo() != 0)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al leer de la base de datos";
			render($param);
			die();
			}
		$usuario=$resultado->FetchRow();
		$uid=$usuario['uid'];

		return render_msg("El usuario ha sido a&ntilde;adido correctamente en el sistema.",5,"index.php");


	}

	function render_usuario_editar($param)
	{
		list($db)=Getdb();
		$tblusuarios=GetTable('usuarios');
		$cols_usuarios=GetCols('usuarios');

		$sql="SELECT * FROM $tblusuarios WHERE ".$cols_usuarios['uid']."='".vwSessionGetVar('uid')."'";

		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
				$param['ruta']="error";
				$param['mensaje']="Ha ocurrido leer el usuario de la base de datos.";
				render($param);
				die();
			}
		$usuario=$resultado->FetchRow();
		$usuario=fromdbtocms($usuario,'usuarios');
		$usuario=toHtml($usuario);
		$resultado= SmartyInit();
		$resultado->assign("datos",$usuario);
		$resultado->assign("validaeditusrdaturl","index.php?actor=usuarios&accion=validaredicion");
		$plantilla="usuarios/edituser.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_usuario_validaredicion($param)
	{
		list ($uname,$clave,$clave2,$email,$nombre,$apellidos,$calle,$poblacion,$provincia,$pais,$cpostal,$actividad)=
		vwVarFromInput('uname','clave','clave2','email','nombre','apellidos','calle','poblacion','provincia','pais',
						'cpostal','actividad');

		if ($clave != $clave2)
			{
			$param['ruta']="error";
			$param['mensaje']="Los campos de Clave y Confirmaci&oacute;n de clave deben ser iguales";
			render($param);
			die();
			}

		list($db)=Getdb();
		$Total_tablas=GetTables();
		$tblusuarios=$Total_tablas['t']['usuarios'];
		$cols_usuarios=$Total_tablas['c']['usuarios'];
		$id=vwSessionGetVar('uid');
		if ((!empty($clave)) && ($clave==$clave2))
			{
				$usuario=array ($cols_usuarios['uid']=>"'$id'",
								$cols_usuarios['clave']=>"'".md5($clave)."'",
								$cols_usuarios['email']=>"'$email'",
								$cols_usuarios['nombre']=>"'".htmlentities($nombre,ENT_QUOTES)."'",
								$cols_usuarios['apellidos']=>"'".htmlentities($apellidos,ENT_QUOTES)."'",
								$cols_usuarios['calle']=>"'".htmlentities($calle,ENT_QUOTES)."'",
								$cols_usuarios['poblacion']=>"'".htmlentities($poblacion,ENT_QUOTES)."'",
								$cols_usuarios['provincia']=>"'".htmlentities($provincia,ENT_QUOTES)."'",
								$cols_usuarios['pais']=>"'".htmlentities($pais,ENT_QUOTES)."'",
								$cols_usuarios['cpostal']=>"'$cpostal'",
								$cols_usuarios['actividad']=>"'".htmlentities($actividad,ENT_QUOTES)."'");
				}
		else
			{
				$usuario=array ($cols_usuarios['uid']=>"'$id'",
								$cols_usuarios['email']=>"'$email'",
								$cols_usuarios['nombre']=>"'".htmlentities($nombre,ENT_QUOTES)."'",
								$cols_usuarios['apellidos']=>"'".htmlentities($apellidos,ENT_QUOTES)."'",
								$cols_usuarios['calle']=>"'".htmlentities($calle,ENT_QUOTES)."'",
								$cols_usuarios['poblacion']=>"'".htmlentities($poblacion,ENT_QUOTES)."'",
								$cols_usuarios['provincia']=>"'".htmlentities($provincia,ENT_QUOTES)."'",
								$cols_usuarios['pais']=>"'".htmlentities($pais,ENT_QUOTES)."'",
								$cols_usuarios['cpostal']=>"'$cpostal'",
								$cols_usuarios['actividad']=>"'".htmlentities($actividad,ENT_QUOTES)."'");
				}

		array_walk($usuario,'fixCode');
		$resultado=$db->Replace($tblusuarios,$usuario,$cols_usuarios['uid'],$autoquote=false);
		if ($resultado !=1)
			{
			$param['mensaje']="Ha ocurrido un error al cambiar los datos del usuario en la base de datos";
			$param['ruta']="error";
			render($param);
			die();
			}
		else
			{
			if (!empty($clave))
				{
					// Si se ha cambiado la clave obligamos a que vuelva a iniciar la sesion
					vwSessionVarsClean();
				}
			$mensaje="Los datos del usuario han sido cambiados correctamente";
			}

		return render_msg($mensaje,5,"index.php");
	}

	// Aqui empieza la definicion de las funciones referentes al administrador

	function render_admin_listarusuarios($param)
	{
		require_once("lister.php");
		$sf=vwVarFromInput('sf');
		$start=vwVarFromInput('start');
		$up=vwVarFromInput('up');

		list($db)=Getdb();
		$tblusuarios=GetTable('usuarios');
		$colsusuarios=GetCols('usuarios');

		$sql="Select * from $tblusuarios";
		$Cols=array(
					array ( "dbname"	=>	$colsusuarios['uid'],
							"label"		=>	"id",
							"width"		=>	"45px",
							"sortable"	=>	false),
					array ( "dbname"	=>	$colsusuarios['uname'],
							"label"		=>	"Usuario",
							"width"		=>	"80px",
							"sortable"	=>	false),
					array ( "dbname"	=>	$colsusuarios['nombre'],
							"label"		=>	"Nombre",
							"width"		=>	"100px",
							"sortable"	=>	true),
					array ( "dbname"	=>	$colsusuarios['apellidos'],
							"label"		=>	"Apellidos",
							"width"		=>	"120px",
							"sortable"	=>	true),
					array ( "dbname"	=>	$colsusuarios['nivel'],
							"label"		=>	"Nivel",
							"width"		=>	"45px",
							"sortable"	=>	false));

		$opciones=array(
						array(	"funcion"	=>	"cbUserPromote",
								"valor"		=>	"$colsusuarios[nivel]"),
						array(	"funcion"	=>	"cbUserEdit",
								"valor"		=>	"$colsusuarios[uid]"),
						array(	"funcion"	=>	"cbUserDelete",
								"valor"		=>	"$colsusuarios[uid]"),
						array(	"funcion"	=>	"cbUserMasInfo",
								"valor"		=>	"$colsusuarios[uid]"));

		$acciones=array(
						array(	'funcion'=>"cbUserAdmAdd"));

		$userList=new Lister("admUsuarios",$sql,25,$Cols,$colsusuarios['uid'],$opciones,"dg-admusers.css");
		$userList->table="$table";
		$userList->where="";
		$userList->GeneralActions=$acciones;

		if ($sf!="")
			{
				$userList->SetSort($sf,$up);}

		if ($start!="")
			{
				$userList->SetStart($start);}

		$listado=$userList->render();

		$resultado= SmartyInit();
		$plantilla="usuarios/listusers.tpl";
		$resultado->assign("listado",$listado);
		$salida=$resultado->fetch($plantilla);

		vwSessionSetVar('urlantigua',CurrentUrl());
		return $salida;
	}

	function cbUserPromote ($key,$valor)
		{
			if ($valor<500)
				{
					return array("etiqueta"=>"Promocionar","url"=>"index.php?actor=usuarios&accion=promote&id=$key");}
			else
				{
					return array("etiqueta"=>"Relevar","url"=>"index.php?actor=usuarios&accion=relevar&id=$key");}
			}

	function cbUserEdit ($key,$valor)
		{
			return array("etiqueta"=>"Editar","url"=>"index.php?actor=usuarios&accion=aeditar&id=$valor");};

	function cbUserDelete ($key,$valor)
		{
			return array("etiqueta"=>"Borrar","url"=>"index.php?actor=usuarios&accion=okdel&id=$valor");};

	function cbUserMasInfo ($key,$valor)
		{
			return array("etiqueta"=>"+ Informaci&oacute;n","url"=>"index.php?actor=usuarios&accion=masinfo&id=$valor");};

	function cbUserAdmAdd()
		{
			return array("etiqueta"=>"A&ntilde;adir Usuario","url"=>"index.php?actor=usuarios&accion=registro");};

	function render_admin_aeditar($param)
	{
		$uid=$param['uid'];
		list($db)=Getdb();
		$tblusuarios=GetTable('usuarios');
		$cols_usuarios=GetCols('usuarios');

		if ((vwSessionGetVar('UserLevel')>499)&&($param['rl']===true))
			{
				$sql="SELECT * FROM $tblusuarios WHERE ".$cols_usuarios['uid']."='".$param['uid']."'";}
		else
			{
				$sql="SELECT * FROM $tblusuarios WHERE ".$cols_usuarios['uname']."='".vwSessionGetVar('UserName')."'";}

		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
				$param['ruta']="error";
				$param['mensaje']="Ha ocurrido leer el usuario de la base de datos.<br>$sql";
				render($param);
				die();
			}
		$usuario=$resultado->FetchRow();
		$usuario=toHtml($usuario);
		$usuario=fromdbtocms($usuario,'usuarios');
		$resultado= SmartyInit();
		$plantilla="usuarios/admedituser.tpl";
		$resultado->assign("datos",$usuario);
		$resultado->assign("valaeditarurl","index.php?actor=usuarios&accion=valaeditar");
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_valaeditar($param)
	{
	list ($uname,$clave,$clave2,$email,$nombre,$apellidos,$calle,$poblacion,$provincia,$pais,$cpostal,$actividad,$id)=
		vwVarFromInput('uname','clave','clave2','email','nombre','apellidos','calle','poblacion','provincia','pais',
						'cpostal','actividad','oldid');
	list($olduname,$clave,$clave2)=vwVarFromInput('olduname','clave','clave2');

		// Comprobamos si se ha producido un cambio
		// en el nombre de usuario
		if ($uname!=$olduname)
			{
			// Comprobamos que el usuario no existe ya
			list($db)=Getdb();
			$Total_tablas=GetTables();
			$tblusuarios=$Total_tablas['t']['usuarios'];
			$cols_usuarios=$Total_tablas['c']['usuarios'];
			$sql="SELECT ".$cols_usuarios['uname']." FROM $tblusuarios WHERE ".$cols_usuarios['uname']."='$uname'";
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
				$param['mensaje']="El usuario ya existe";
				render($param);
				die();
				}
			}
		if ($clave != $clave2)
			{
				$param['ruta']="error";
				$param['mensaje']="Los campos de Clave y Confirmaci&oacute;n de clave deben ser iguales";
				render($param);
				die();
			}

		list($db)=Getdb();
		$Total_tablas=GetTables();
		$tblusuarios=$Total_tablas['t']['usuarios'];
		$cols_usuarios=$Total_tablas['c']['usuarios'];

		if ((!empty($clave)) && ($clave==$clave2))
			{
				$usuario=array ($cols_usuarios['uid']=>"'$id'",
								$cols_usuarios['clave']=>"'".md5($clave)."'",
								$cols_usuarios['email']=>"'$email'",
								$cols_usuarios['nombre']=>"'".htmlentities($nombre,ENT_QUOTES)."'",
								$cols_usuarios['apellidos']=>"'".htmlentities($apellidos,ENT_QUOTES)."'",
								$cols_usuarios['calle']=>"'".htmlentities($calle,ENT_QUOTES)."'",
								$cols_usuarios['poblacion']=>"'".htmlentities($poblacion,ENT_QUOTES)."'",
								$cols_usuarios['provincia']=>"'".htmlentities($provincia,ENT_QUOTES)."'",
								$cols_usuarios['pais']=>"'".htmlentities($pais,ENT_QUOTES)."'",
								$cols_usuarios['cpostal']=>"'$cpostal'",
								$cols_usuarios['actividad']=>"'".htmlentities($actividad,ENT_QUOTES)."'");
				}
		else
			{
				$usuario=array ($cols_usuarios['uid']=>"'$id'",
								$cols_usuarios['email']=>"'$email'",
								$cols_usuarios['nombre']=>"'".htmlentities($nombre,ENT_QUOTES)."'",
								$cols_usuarios['apellidos']=>"'".htmlentities($apellidos,ENT_QUOTES)."'",
								$cols_usuarios['calle']=>"'".htmlentities($calle,ENT_QUOTES)."'",
								$cols_usuarios['poblacion']=>"'".htmlentities($poblacion,ENT_QUOTES)."'",
								$cols_usuarios['provincia']=>"'".htmlentities($provincia,ENT_QUOTES)."'",
								$cols_usuarios['pais']=>"'".htmlentities($pais,ENT_QUOTES)."'",
								$cols_usuarios['cpostal']=>"'$cpostal'",
								$cols_usuarios['actividad']=>"'".htmlentities($actividad,ENT_QUOTES)."'");
				}

		array_walk($usuario,'fixCode');

		$resultado=$db->Replace($tblusuarios,$usuario,array($cols_usuarios['uid']),$autoquote=false);
		if ($resultado !=1)
			{
			$mensaje="Ha ocurrido un error al cambiar los datos del usuario en la base de datos";
			}
		else
			{
			$mensaje="Los datos del usuario han sido cambiados correctamente";
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

	function render_admin_okdel($param)
	{
		$resultado= SmartyInit();
		$plantilla="usuarios/admdelcheck.tpl";
		$id=$param['uid'];
		$resultado->assign("confirmadelurl","index?actor=usuarios&accion=delusr&id=$id");
		$resultado->assign("rechazadelurl","index.php?actor=usuarios&accion=listar");
		$resultado->assign("mensaje",$param['mensaje']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_delusr($param)
	{
		$uid=$param['uid'];
		list($db)=Getdb();
		$Total_tablas=GetTables();
		$tblusuarios=$Total_tablas['t']['usuarios'];
		$cols_usuarios=$Total_tablas['c']['usuarios'];
		$uidcol=$cols_usuarios['uid'];

		$sql="DELETE FROM $tblusuarios WHERE $uidcol='$uid'";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$mensaje="Ha ocurrido un error al borrar el registro";
			}
		else
			{
			$mensaje="Se ha borrado el usuario correctamente";
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

	function render_admin_masinfo($param)
	{
		$id=$param['uid'];
		list($db)=Getdb();
		$Total_tablas=GetTables();
		$tblusuarios=$Total_tablas['t']['usuarios'];
		$cols_usuarios=$Total_tablas['c']['usuarios'];

		$sql="SELECT * FROM $tblusuarios WHERE ".$cols_usuarios['uid']."='$id'";

		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
				$param['ruta']="error";
				$param['mensaje']="Ha ocurrido leer el usuario de la base de datos.";
				render($param);
				die();
			}
		$usuario=$resultado->FetchRow();
		$usuario=toHtml($usuario);
		$usuario=fromdbtocms($usuario,'usuarios');
		$resultado= SmartyInit();
		$plantilla="usuarios/usrmasinfo.tpl";
		$resultado->assign("datos",$usuario);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_promote($param)
	{
		$resultado= SmartyInit();
		$plantilla="usuarios/admpromocheck.tpl";
		$id=$param['uid'];
		$resultado->assign("confpromocion","index?actor=usuarios&accion=okpromote&id=$id");
		$resultado->assign("rechazarpromocionurl","index.php?actor=usuarios&accion=listar");
		$resultado->assign("mensaje",$param['mensaje']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_okpromote($param)
	{
		$id=$param['uid'];
		list($db)=Getdb();
		$Total_tablas=GetTables();
		$tblusuarios=$Total_tablas['t']['usuarios'];
		$cols_usuarios=$Total_tablas['c']['usuarios'];
		$uidcol=$cols_usuarios['uid'];

		$sql="UPDATE $tblusuarios SET $cols_usuarios[nivel]=500 WHERE $uidcol='$id'";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$mensaje="Ha ocurrido un error al actualizar el registro";
			}
		else
			{
			$mensaje="El usuario ha sido promocionado correctamente";}

		/* $resultado= SmartyInit();
		$plantilla="mensaje.tpl";
		$resultado->assign("mensaje",$mensaje);
		$salida=$resultado->fetch($plantilla);
		return $salida; */

		$url=vwSessionGetVar('urlantigua');
		vwSessionDelVar('urlantigua');
		return render_msg($mensaje,3,$url);
	}

	function render_admin_relevar($param)
	{
		$resultado= SmartyInit();
		$plantilla="usuarios/admrelevcheck.tpl";
		$id=$param['uid'];
		$resultado->assign("confirmrelev","index?actor=usuarios&accion=okrelevar&id=$id");
		$resultado->assign("rechazrelev","index.php?actor=usuarios&accion=listar");
		$resultado->assign("mensaje",$param['mensaje']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_okrelevar($param)
	{
		$id=$param['uid'];
		list($db)=Getdb();
		$Total_tablas=GetTables();
		$tblusuarios=$Total_tablas['t']['usuarios'];
		$cols_usuarios=$Total_tablas['c']['usuarios'];
		$uidcol=$cols_usuarios['uid'];

		$sql="UPDATE $tblusuarios SET $cols_usuarios[nivel]=100 WHERE $uidcol='$id'";
		$resultado=$db->Execute($sql);
		if ($db->ErrorNo() != 0)
			{
			$mensaje="Ha ocurrido un error al relevar el usuario";
			}
		else
			{
			$mensaje="El usuario ha sido relevado como administrador correctamente";
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

	function render_admin_registro($param)
	{
		$resultado= SmartyInit();
		$resultado->assign("validaregistrourl","index.php?actor=usuarios&accion=validaregistro");
		$plantilla="usuarios/adduser.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_validaregistro($param)
	{
		list ($uname,$clave,$clave2,$email,$nombre,$apellidos,$calle,$poblacion,$provincia,$pais,$cpostal,$actividad)=
		vwVarFromInput('uname','clave','clave2','email','nombre','apellidos','calle','poblacion','provincia','pais',
						'cpostal','actividad');
		// Comprobamos que el usuario no existe ya
		list($db)=Getdb();
		$tblusuarios=GetTable('usuarios');
		$cols_usuarios=GetCols('usuarios');
		$sql="SELECT ".$cols_usuarios['uname']." FROM $tblusuarios WHERE ".$cols_usuarios['uname']."='$uname'";
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
			$param['mensaje']="El usuario ya existe";
			render($param);
			die();
			}
			// Insertamos el usuario en la base de datos
		if ((empty($clave)) || ($clave!=$clave2))
				{
				$param['ruta']="error";
				$param['mensaje']="Las dos claves deben ser iguales.";
				render($param);
				die();
				}

		$usuario=array ($cols_usuarios['uname']=>"'$uname'",
						$cols_usuarios['clave']=>"'".md5($clave)."'",
						$cols_usuarios['nombre']=>"'".htmlentities($nombre,ENT_QUOTES)."'",
						$cols_usuarios['apellidos']=>"'".htmlentities($apellidos,ENT_QUOTES)."'",
						$cols_usuarios['calle']=>"'".htmlentities($calle,ENT_QUOTES)."'",
						$cols_usuarios['poblacion']=>"'".htmlentities($poblacion,ENT_QUOTES)."'",
						$cols_usuarios['provincia']=>"'".htmlentities($provincia,ENT_QUOTES)."'",
						$cols_usuarios['pais']=>"'".htmlentities($pais,ENT_QUOTES)."'",
						$cols_usuarios['cpostal']=>"'$cpostal'",
						$cols_usuarios['actividad']=>"'".htmlentities($actividad,ENT_QUOTES)."'",
						$cols_usuarios['nivel']=>"100");
		array_walk($usuario,'fixCode');
		$resultado=$db->Replace($tblusuarios,$usuario,array());
		if ($resultado !=2)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al introducir en la base de datos el usuario";
			render($param);
			die();
			}

		$sql="SELECT ".$cols_usuarios['uid']." FROM $tblusuarios WHERE ".$cols_usuarios['uname']."='$uname'";
		$resultado=$db->Execute($sql);

		if ($db->ErrorNo() != 0)
			{
			$param['ruta']="error";
			$param['mensaje']="Ha ocurrido un error al leer de la base de datos";
			render($param);
			die();
			}
		else
			{
				$mensaje="El usuario ha sido registrado correctamente";}

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

	// Items por pagina
	// Aviso de recepcion de autorizacion o denegacion

function render_usuario_showprefs($param)
	{
		$id=vwSessionGetVar('uid');
		list($db)=Getdb();
		$tblUsuarios=GetTable('usuarios');
		$colUsuarios=GetCols('usuarios');

		$sql="SELECT $colUsuarios[preferencias] from $tblUsuarios where $colUsuarios[uid]=".$id;

		$rs=$db->Execute($sql);
		if ($rs===false)
			{
				// Error
					die($sql);
				};

		$z=$rs->FetchRow();
		$preferencias=compact($z);

		if (trim($preferencias)=="")
			{
				$preferencias="Items=25\nNotify=false";}

		$pref=explode("\n",$preferencias);

		list($notify)=explode("=",$pref[2]);
		$notify=($notify=="true"?true:false);
		list($items)=explode("=",$pref[1]);
		if ($items<5)
			{
				$items=25;}

		$resultado= SmartyInit();
		$resultado->assign("accion",$mensaje);
		$resultado->assign("items",$items);
		$resultado->assign("notify",$notify);
		$resultado->assign("uidz",vwSessionGetVar('uid'));
		$plantilla="usuarios/usrprefs.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
		}

function render_usuario_fixprefs($param)
	{
		list($notify,$items,$uid)=vwVarFromInput('notify','items','uid');}
?>
