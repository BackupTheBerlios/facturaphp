<?php

require_once("adodb/adodb-sessions.inc.php");
require_once("tools.php");
require_once("db.inc.php");
require_once("vardb.inc.php");
require_once("render.admin.inc.php");
Init(); // Inicializa las conexiones a la BBDD

// Comprobamos la tabla de usuarios para ver si ha expirado algun usuario
if (!vwSessionGetVar("expireuser"))
		{
		vwSessionSetVar("expireuser","si");
		require_once("usuario.aux.inc.php");
		ExpireUser();
		}

$key=vwSessionGetVar("key");

// Comprobamos si hay hackeo de la pagina

if ($key != "asd654fasd64f6as54fas654f3as21fr4awe31vgsdf3a84g31adv38gv1we6agh13b1f36t432g1b3d54fgh3ea")
	{
	$param['ruta']="error";
	$param['mensaje']='No puedes entrar al menu de administraci&oacute;n sin entrar en el sistema como administrador';
	render($param);
	die();
	}
$param=array();

switch ($actor)
	{
	case "usuarios":
					switch ($accion)
    				 {
							case "listarusuarios":
											$param['ruta']="$actor/$accion";
											$param['plantilla']="admusuarios";
											render_admin($param);
											break;

							case "admusreditar":
											$param['plantilla']=$accion;
											$param['ruta']="$actor/$accion";
											$param['uid']=$uid;
											render_admin($param);
											break;

							case "validaadmusreditarurl":
															$param['plantilla']=$accion;
															$param['ruta']="$actor/$accion";
															render_admin($param);
															break;
							case "confirmadmusrdel":
															$param['plantilla']=$accion;
															$param['ruta']="$actor/$accion";
															$param['uid']=$uid;
															render_admin($param);
														break;
							case "delusr":
											$param['plantilla']=$accion;
											$param['ruta']="$actor/$accion";
											$param['uid']=$uid;
											render_admin($param);
											break;
							case "masinfo":
											$param['ruta']="$actor/$accion";
											$param['plantilla']="$accion";
											$param['uid']=$uid;
											render_admin($param);
											break;
					}
	case "catalogo":
					$param['ruta']="admin/catalogo";
					$param['plantilla']="admcatalogo";
					break;
	case "secciones":
					switch ($accion)
						{
						case "add":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="addSeccion";
										render_admin($param);
										break;
						case "validar":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['previa']=$previa;
										$param['sid']=$sid;
										render_admin($param);
										break;
						case "listar":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['sid']=$sid;
										$param['pagina']=$pagina;
										render_admin($param);
										break;
						case "edit":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['sid']=$sid;
										render_admin($param);
										break;
						case "confirm":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['sid']=$sid;
										render_admin($param);
										break;
						case "del":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['sid']=$sid;
										render_admin($param);
										break;
						case "entrar":
										$sid=vwVarFromInput('sid');
										header("location:admin.php?actor=clases&accion=listar&sid=$sid");
										die();
										break;
						}
					break;
	case "clases":
					require_once("navbar.admin.inc.php");
					$barra=navbar(vwSessionGetVar('adminsid'),-1);
					$param['barra']=$barra;
					switch ($accion)
						{
						case "listar":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['sid']=$sid;
										$param['pagina']=$pagina;
										require_once("navbar.admin.inc.php");
										$barra=navbar($sid,-1);
										$param['barra']=$barra;
										render_admin($param);
										break;
						case "add":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['sid']=$sid;
										render_admin($param);
										break;
						case "validar":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['previa']=$previa;
										$param['sid']=$sid;
										render_admin($param);
										break;
						case "edit":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['cid']=$cid;
										render_admin($param);
										break;
						case "entrar":
										$cid=vwVarFromInput('cid');
										header("location:admin.php?actor=articulos&accion=listar&cid=$cid");
										die();
										break;
						case "confirm":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['cid']=$cid;
										render_admin($param);
										break;
						case "del":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['cid']=$cid;
										render_admin($param);
										break;

						}
					break;
	case "articulos":
					require_once("navbar.admin.inc.php");
					$barra=navbar(vwSessionGetVar('adminsid'),vwSessionGetVar('admincid'));
					$param['barra']=$barra;

					switch ($accion)
						{
						case "listar":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['cid']=$cid;
										$param['pagina']=$pagina;
										$sid=vwSessionGetVar('adminsid');
										require_once("navbar.admin.inc.php");
										$barra=navbar($sid,$cid);
										$param['barra']=$barra;
										render_admin($param);
										break;
						case "add":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['previa']=$previa;
										$param['cid']=$cid;
										render_admin($param);
										break;
						case "validar":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['previa']=$previa;
										$param['aid']=$aid;
										render_admin($param);
										break;
						case "edit":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['previa']=$previa;
										$param['aid']=$aid;
										render_admin($param);
										break;
						case "masinfo":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['aid']=$aid;
										$sid=vwSessionGetVar('adminsid');
										$cid=vwSessionGetVar('admincid');
										require_once("navbar.admin.inc.php");
										$barra=navbar($sid,$cid);
										$param['barra']=$barra;
										render_admin($param);
										break;
						case "confirm":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['aid']=$aid;
										render_admin($param);
										break;
						case "del":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['aid']=$aid;
										render_admin($param);
										break;

						}
					break;
	case "ejemplos":
					switch ($accion)
						{
						case "listar":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['pagina']=$pagina;
										render_admin($param);
										break;
						case "add":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										render_admin($param);
										break;
						case "validar":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['previa']=$previa;
										$param['eid']=$eid;
										render_admin($param);
										break;
						case "edit":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['eid']=$eid;
										render_admin($param);
										break;
						case "confirm":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['eid']=$eid;
										render_admin($param);
										break;
						case "del":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['eid']=$eid;
										render_admin($param);
										break;

						}
					break;
	case "referencias":
					require_once("navbar.admin.inc.php");
					$barra=navbar(vwSessionGetVar('adminsid'),vwSessionGetVar('admincid'));
					$param['barra']=$barra;

					switch ($accion)
						{
						case "add":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['aid']=$aid;
										render_admin($param);
										break;
						case "validar":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['previa']=$previa;
										$param['aid']=$aid;
										$param['rid']=$rid;
										render_admin($param);
										break;
						case "edit":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['rid']=$rid;
										render_admin($param);
										break;
						case "confirm":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['rid']=$rid;
										$param['aid']=$aid;
										render_admin($param);
										break;
						case "del":
										$param['ruta']="$actor/$accion";
										$param['plantilla']="$accion";
										$param['rid']=$rid;
										render_admin($param);
										break;

						}
					break;
	case "cambiopass":
							$param['ruta']="$actor/$accion";
							render_admin($param);
							break;
	default:
				$param['ruta']="inicio";
				$param['plantilla']="admin";
				render_admin($param);
				break;

	}


?>
