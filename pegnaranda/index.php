<?php
	// Principal
//**********************************************************
	require_once("tools.php");
	require_once("db.inc.php");
	require_once("vardb.inc.php");
	require_once("varsession.inc.php");
	require_once("render.inc.php");
	Init();
	limpiar();

	$uid=vwSessionGetVar("uid"); // Obtenemos el uid del usuario
 	if (is_null($uid)) //Si es nulo, lo pasamos por usuario anonimo
		{
			$uid="0";
			vwSessionSetVar("uid",0);
			$UserName="Anonimo";
			vwSessionSetVar("UserName",$UserName);
			$UserLevel=1;
			vwSessionSetVar("UserLevel",$UserLevel);
			}
	else
		{ //Si no lo es obtenemos su nombre de usuario y su nivel
			$UserLevel=vwSessionGetVar("UserLevel");
			$UserName=vwSessionGetVar("UserName");
			}

	if (!isset($actor)|| (isset($actor)&& $actor=="")) // Si no se especifica actor alguno, se va a la pantalla de inicio
		{
			$actor="static";
			$accion="mostrar";
			$sujeto="inicio";
			}

	switch ($actor)
		{
			case "static":
				if (trim($accion)=="mostrar")
					{
						switch ($sujeto)
							{
									// Pantallas estaticas válidas
								case "equipo":
								case "ayuda":
								case "inicio":
									$param['ruta']="$actor/$accion/$sujeto";
									break;
									// Si no es de las validas, va al inicio
								default:
									$param['ruta']="$actor/$accion/inicio";
									break;
								}
					}
				else
					{
						$param['ruta']="error";
						$param['mensaje']="Accion no soportada";
						}
				render($param);
				die();
				break;
			case "usuarios":
				require_once('usuarios/usuarios.aux.inc.php'); // cargamos las funciones auxiliares...
				switch($accion)
					{
						case "login":
							// funcion de login
							list($uname,$passwd)=vwVarFromInput('uname','clave');
							$result=checkUser($uname,$passwd);
							if ($result!=USER_LOGIN_OK)
								{
									// Si no es un usuario del sistema devolvemos un error
									$param['ruta']="error";
									switch($result)
										{
											case USER_BAD_LOGIN:
																$param['mensaje']="La clave introducida es incorrecta, vuelva a intentarlo.";
																$param['retry']=true;
																break;
											case USER_BAD_USER:
																$param['mensaje']="El usuario no existe en el sistema.";
																$param['retry']=true;
																break;
											case USER_UNKNOWN_ERROR:
																$param['mensaje']="";
																$param['retry']=false;
																$param['debug']=true;
																break;
											case USER_OPERATION_NOT_ALLOWED:
																$param['mensaje']="El usuario anonimo no requiere entrar al sistema.";
																break;
											}
									render($param);
									die();
									}
							logUserIn($uname);
							header("Location: index.php");
							die();
							break;

						case "logout":
							logUserOut();
							header("Location: index.php");
							die();
							break;
						case "registro":
							$param["ruta"]="$actor/registro";
							render($param);
							die();
							break;
						case "validaregistro":
							$param["ruta"]="$actor/validaregistro";
							render($param);
							die();
							break;
						case "editar":
							$param["ruta"]="$actor/editar";
							render($param);
							die();
							break;
						case "validaredicion":
							$param["ruta"]="$actor/validaredicion";
							render($param);
							die();
							break;
						case "listar":
							$param["ruta"]="$actor/listar";
							render($param);
							die();
							break;
						case "aeditar":
							$param["ruta"]="$actor/aeditar";
							$param['uid']=$id;
							$param['rl']=true;
							render($param);
							die();
							break;
						case "valaeditar":
							$param["ruta"]="$actor/valaeditar";
							render($param);
							die();
							break;
						case "okdel":
							$param["ruta"]="$actor/okdel";
							$param['uid']=$id;
							render($param);
							die();
							break;
						case "delusr":
							$param["ruta"]="$actor/delusr";
							$param['uid']=$id;
							render($param);
							die();
							break;
						case "okpromote":
							$param["ruta"]="$actor/okpromote";
							$param['uid']=$id;
							render($param);
							die();
							break;
						case "promote":
							$param["ruta"]="$actor/promote";
							$param['uid']=$id;
							render($param);
							die();
							break;
						case "relevar":
							$param["ruta"]="$actor/relevar";
							$param['uid']=$id;
							render($param);
							die();
							break;
						case "okrelevar":
							$param["ruta"]="$actor/okrelevar";
							$param['uid']=$id;
							render($param);
							die();
							break;
						case "masinfo":
							$param["ruta"]="$actor/masinfo";
							$param['uid']=$id;
							render($param);
							die();
							break;
						case 'prefs':
							$param["ruta"]="$actor/prefs";
							render($param);
							die();
							break;
						case 'changeprefs':
							$param["ruta"]="$actor/changeprefs";
							render($param);
							die();
							break;
						}
				break;
			case 'archivos':
				switch($accion)
					{
						case "listar":
							$param["ruta"]="$actor/listar";
							render($param);
							die();
							break;
						case "okdel":
							$param["ruta"]="$actor/okdel";
							$param['aid']=$id;
							render($param);
							die();
							break;
						case "delarchivo":
							$param["ruta"]="$actor/delarchivo";
							$param['aid']=$id;
							render($param);
							die();
							break;
						case 'editar':
							$param["ruta"]="$actor/editar";
							$param['aid']=$id;
							render($param);
							die();
							break;
						case 'validaredicion':
							$param["ruta"]="$actor/validaredicion";
							$param['aid']=$id;
							render($param);
							die();
							break;
						case 'add':
							$param["ruta"]="$actor/add";
							render($param);
							die();
							break;
						case 'validaradd':
							$param["ruta"]="$actor/validaradd";
							$param['uid']=$id;
							render($param);
							die();
							break;
						}
				break;
			case 'secciones':
				switch($accion)
					{
						case "listar":
							$param["ruta"]="$actor/listar";
							render($param);
							die();
							break;
						case "okdel":
							$param["ruta"]="$actor/okdel";
							$param['sid']=$id;
							render($param);
							die();
							break;
						case "delseccion":
							$param["ruta"]="$actor/delseccion";
							$param['sid']=$id;
							render($param);
							die();
							break;
						case 'editar':
							$param["ruta"]="$actor/editar";
							$param['sid']=$id;
							render($param);
							die();
							break;
						case 'validaredicion':
							$param["ruta"]="$actor/validaredicion";
							$param['sid']=$id;
							render($param);
							die();
							break;
						case 'add':
							$param["ruta"]="$actor/add";
							render($param);
							die();
							break;
						case 'validaradd':
							$param["ruta"]="$actor/validaradd";
							$param['sid']=$id;
							render($param);
							die();
							break;
						}
				break;
			case 'documentos':
				switch($accion)
					{
						case "listar":
							$param["ruta"]="$actor/listar";
							render($param);
							die();
							break;
						case "titulos":
							$param["ruta"]="$actor/titulos";
							render($param);
							die();
							break;
						case "okdel":
							$param["ruta"]="$actor/okdel";
							$param['did']=$id;
							render($param);
							die();
							break;
						case "deldoc":
							$param["ruta"]="$actor/deldoc";
							$param['did']=$id;
							render($param);
							die();
							break;
						case 'editar':
							$param["ruta"]="$actor/editar";
							$param['did']=$id;
							render($param);
							die();
							break;
						case 'validaredicion':
							$param["ruta"]="$actor/validaredicion";
							$param['did']=$id;
							render($param);
							die();
							break;
						case 'add':
							$param["ruta"]="$actor/add";
							render($param);
							die();
							break;
						case 'validaradd':
							$param["ruta"]="$actor/validaradd";
							$param['did']=$id;
							render($param);
							die();
							break;
						case 'mostrar':
							$param["ruta"]="$actor/mostrar";
							$param['did']=$id;
							render($param);
							die();
							break;
						case 'addrsc':
							$param["ruta"]="$actor/addrsc";
							$param['did']=$id;
							render($param);
							die();
							break;
						case 'validarrsc':
							$param["ruta"]="$actor/validarrsc";
							$param['did']=$id;
							render($param);
							die();
							break;
						case 'editrsc':
							$param["ruta"]="$actor/editrsc";
							$param['rid']=$id;
							render($param);
							die();
							break;
						case 'valedrsc':
							$param["ruta"]="$actor/valedrsc";
							$param['rid']=$id;
							render($param);
							die();
							break;
						case 'delrsc':
							$param["ruta"]="$actor/delrsc";
							$param['rid']=$id;
							render($param);
							die();
							break;
						case 'okdelrsc':
							$param["ruta"]="$actor/okdelrsc";
							$param['rid']=$id;
							render($param);
							die();
							break;
						case 'verrsc':
							$param["ruta"]="$actor/verrsc";
							$param['did']=$id;
							render($param);
							die();
							break;
						case "ver-rsc":
							$param["ruta"]="$actor/ver-rsc";
							$param['rid']=$id;
							render($param);
							die();
							break;
						}
				break;
			case "autorizaciones":
				switch ($accion)
					{
						case "listar":
							$param["ruta"]="$actor/$accion";
							render($param);
							die();
							break;
						case "okdel":
							$param["ruta"]="$actor/$accion";
							$param['autid']=$id;
							render($param);
							die();
							break;
						case "delautorizacion":
							$param["ruta"]="$actor/$accion";
							$param['autid']=$id;
							render($param);
							die();
							break;
						case "conceder":
							$param["ruta"]="$actor/$accion";
							$param['autid']=$id;
							render($param);
							die();
							break;
						case "denegar":
							$param["ruta"]="$actor/$accion";
							$param['autid']=$id;
							render($param);
							die();
							break;
						case 'add':
							$param["ruta"]="$actor/$accion";
							$param['rid']=$id;
							render($param);
							die();
							break;
						case 'validaradd':
							$param["ruta"]="$actor/$accion";
							render($param);
							die();
							break;
						case 'ver':
							$param["ruta"]="$actor/$accion";
							$param['autid']=$id;
							render($param);
							die();
							break;
						case 'editar':
							$param["ruta"]="$actor/$accion";
							$param['autid']=$id;
							render($param);
							die();
							break;
						case 'validaredicion':
							$param["ruta"]="$actor/$accion";
							$param['autid']=$id;
							render($param);
							die();
							break;
						case 'mostrar':
							$param["ruta"]="$actor/$accion";
							$param['did']=$id;
							render($param);
							die();
							break;
						case 'vermis':
							$param["ruta"]="$actor/$accion";
							render($param);
							die();
							break;

						}
				break;
			case 'buscador':
				switch($accion)
					{
						case "resultados":
							$param["ruta"]="$actor/$accion";
							$param['start']=$start;
							render($param);
							die();
							break;
						default:
							$param["ruta"]="$actor/buscar";
							//quitado de momento
							//$param['autid']=$id;
							render($param);
							die();
							break;
						}
			case 'backup':
				switch($accion)
					{
						case "backup":
						case "backupstart":
						case "restorestart":
						case "restore":
							$param["ruta"]="$actor/$accion";
							$param['start']=$start;
							render($param);
							die();
							break;
						case 'opciones':
						default:
							$param["ruta"]="$actor/opciones";
							$param['start']=$start;
							render($param);
							die();
							break;
						}
				break;
			}

?>
