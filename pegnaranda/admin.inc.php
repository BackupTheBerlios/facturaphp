<?php
/*
	function render_admin($accion,$sujeto,$param)
	{

		switch ($accion)
			{
				case "inicio":
								$salida=render_admin_inicio($param);
								break;
				case "listarusuarios":
								$salida=render_admin_listarusuarios($param);
								break;
				case "admusreditar":
								$salida=render_admin_admusreditar($param);
								break;
				case "validaadmusreditarurl":
								$salida=render_admin_validaadmusreditarurl($param);
								break;
				case "confirmadmusrdel":
								$salida=render_admin_confirmadmusrdel($param);
								break;
				case "delusr":
								$salida=render_admin_delusr($param);
								break;
				case "masinfo":
								$salida=render_admin_masinfo($param);
								break;


			};
		return $salida;
		}

	function render_admin_inicio($param)
	{
		$resultado= SmartyInit();
		$plantilla=$param['plantilla'].".tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}


	function render_admin_listarusuarios($param)
	{
		$resultado= SmartyInit();
		$plantilla=$param['plantilla'].".tpl";
		$resultado->assign("datos",$param['datos']);
		$resultado->assign("admusrediturl","admin.php?actor=usuarios&accion=admusreditar&uid=");
		$resultado->assign("admusrdelurl","admin.php?actor=usuarios&accion=confirmadmusrdel&uid=");
		$resultado->assign("masinfourl","admin.php?actor=usuarios&accion=masinfo&uid=");
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_admusreditar($param)
	{
		$resultado= SmartyInit();
		$plantilla=$param['plantilla'].".tpl";
		$resultado->assign("datos",$param['datos']);
		$resultado->assign("validaadmusreditarurl","admin.php?actor=usuarios&accion=validaadmusreditarurl");
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_validaadmusreditarurl($param)
	{
		$resultado= SmartyInit();
		$plantilla=$param['plantilla'].".tpl";
		$resultado->assign("mensaje",$param['mensaje']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_confirmadmusrdel($param)
	{
		$resultado= SmartyInit();
		$plantilla=$param['plantilla'].".tpl";
		$uid=$param['uid'];
		$resultado->assign("confirmadelurl","admin.php?actor=usuarios&accion=delusr&uid=$uid");
		$resultado->assign("rechazadelurl","admin.php?actor=usuarios&accion=listarusuarios");
		$resultado->assign("mensaje",$param['mensaje']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_delusr($param)
	{
		$resultado= SmartyInit();
		$plantilla=$param['plantilla'].".tpl";
		$resultado->assign("mensaje",$param['mensaje']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}

	function render_admin_masinfo($param)
	{
		$resultado= SmartyInit();
		$plantilla=$param['plantilla'].".tpl";
		$resultado->assign("datos",$param['datos']);
		$salida=$resultado->fetch($plantilla);
		return $salida;
	}


*/
?>
