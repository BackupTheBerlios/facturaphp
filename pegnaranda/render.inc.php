<?php
	// Sistema Principal de Render
	// Se encarga de cargar el codigo necesario y hacer las llamadas adecuadas en funcion de cada objeto

	function render($param)
	{
		list($actor,$accion,$sujeto)=explode("/",$param['ruta']); // Descomponemos la ruta !!
		switch ($actor)
			{
				case 'static':
									require_once("static/static.inc.php");
									$contenido=render_static($accion,$sujeto,$param);
									break;
				case 'usuarios':
									require_once("usuarios/usuarios.inc.php");
									$contenido=render_usuario($accion,$sujeto,$param);
									break;
				case 'autorizaciones':
									require_once("autorizaciones/autorizaciones.inc.php");
									$contenido=render_autorizaciones($accion,$sujeto,$param);
									break;
				case 'archivos':
									require_once("archivos/archivos.inc.php");
									$contenido=render_archivo($accion,$sujeto,$param);
									break;
				case 'secciones':
									require_once("secciones/secciones.inc.php");
									$contenido=render_secciones($accion,$sujeto,$param);
									break;
				case 'documentos':
									require_once("documentos/documentos.inc.php");
									$contenido=render_documentos($accion,$sujeto,$param);
									break;
				case 'buscador':
									require_once("buscador.inc.php");
									$contenido=render_buscador($accion,$sujeto,$param);
									break;
				case 'error':
									$contenido=render_error($accion,$sujeto,$param);
									break;
				case 'backup':
									require_once("backup.inc.php");
									$contenido=render_backup($accion,$sujeto,$param);
									break;
				default:
									require_once("static/static.inc.php");
									$contenido=render_static("mostrar","inicio",$param);
									break;
				}
		$cabecera=render_cabecera($param);
		$pie=render_pie($param);
		$bloques=render_bloques($param);
		$pagina=SmartyInit();
		$pagina->assign('Titulo',"Historia de peñaranda de Bracamonte");
		$pagina->assign('Cabecera',$cabecera);
		$pagina->assign('Pie',$pie);
		$pagina->assign('Bloques',$bloques);
		$pagina->assign('Contenido',$contenido);
		$pagina->display('master.tpl');
		die();
	}

	function render_cabecera($param)
	{
		$resultado= SmartyInit();
		$salida=$resultado->fetch('cabecera.tpl');
		return $salida;
	}

	function render_pie($param)
	{
		$resultado= SmartyInit();
		$salida=$resultado->fetch('pie.tpl');
		return $salida;
	}

	function render_bloques($param)
	{
		$resultado= SmartyInit();
		$resultado->assign('BloquePrincipal',render_bloque1($param));
		$resultado->assign('BloqueMedio',render_bloque2($param));
		$resultado->assign('BloqueAdministracion',render_bloque3($param));
		$salida=$resultado->fetch('bloques.tpl');
		return $salida;
	}

	function render_bloque1($param)
	{
		$resultado= SmartyInit();
		$salida=$resultado->fetch("bl_principal.tpl");
		return $salida;
	}

	function render_bloque2($param)
	{
		$resultado= SmartyInit();
		$z=vwSessionGetVar("uid");
		if ($z==0)
			{
				$resultado->assign("loginurl","index.php?actor=usuarios&accion=login");
				$resultado->assign("registrourl","index.php?actor=usuarios&accion=registro");
				$plantilla="bl_login.tpl";
				}
		else
			{
				$resultado->assign("logout","index.php?actor=usuarios&accion=logout");
				$resultado->assign("editar","index.php?actor=usuarios&accion=editar");
				$resultado->assign("prefs","index.php?actor=usuarios&accion=prefs");
				if (vwSessionGetVar('UserLevel')<500)
					{
						$resultado->assign("autoriz","index.php?actor=autorizaciones&accion=vermis");}
				$plantilla="bl_logout.tpl";}
		$salida=$resultado->fetch($plantilla);
		return $salida;
		}

	function render_bloque3($param)
	{
		if (vwSessionGetVar("UserLevel")<500)
			{
			 return;}
		$resultado= SmartyInit();
		$salida=$resultado->fetch("bl_administracion.tpl");
		return $salida;

	}

	function render_error($accion,$sujeto,$param)
	{
		$resultado= SmartyInit();
		$timeout=$param['timeout'];
		$url=$param['url'];
		if ((($timeout+1)>1)&&(trim($url)!=""))
			{
				$resultado->assign("jscript",TimedRedirect($timeout,$url));}
		$resultado->assign('mensaje',$param['mensaje']);
		$salida=$resultado->fetch('error.tpl');
		return $salida;
	}

	function render_msg($mensaje, $timeout, $url)
	{
		$resultado= SmartyInit();
		$resultado->assign("mensaje",$mensaje);
		if ((($timeout+1)>1)&&(trim($url)!=""))
			{
				$resultado->assign("jscript",TimedRedirect($timeout,$url));}
		$plantilla="msgred.tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
		}

?>
