<?php
	/* Objeto Estatico: paginas estaticas */
	function render_static($accion,$sujeto,$param)
	{
	 	switch($accion)
			{
				case 'mostrar':
										$resultado=render_static_mostrar($sujeto,$param);
										break;
				default:
										die();
				};
		return $resultado;
		}

	function render_static_mostrar($sujeto,$param)
	{
		$resultado= SmartyInit();
		$plantilla="static/".$sujeto.".tpl";
		$salida=$resultado->fetch($plantilla);
		return $salida;
		}

?>
