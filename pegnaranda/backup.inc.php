<?php
require_once ("bck.inc.php");

	function render_backup($accion,$sujeto,$param)
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
						case "opciones":
												$salida=render_admin_opciones($param);
												break;
						case "backup":
												$salida=render_admin_backup($param);
												break;
						case "backupstart":
												$salida=render_admin_backupStart($param);
												break;
						case 'restore':
												$salida=render_admin_restore($param);
												break;
						case 'restorestart':
												$salida=render_admin_restoreStart($param);
												break;
						default:
							header('Location: index.php');
							die();
							break;
						}
				};
		return $salida;
		}

	function render_admin_opciones($param)
		{
			$resultado= SmartyInit();
			$plantilla="backupop.tpl";
			$salida=$resultado->fetch($plantilla);
			return $salida;
			}


	function render_admin_backup($param)
		{
			$resultado= SmartyInit();
			$plantilla="backup.tpl";
			$resultado->assign("accion","index?actor=backup&accion=backupstart");
			$salida=$resultado->fetch($plantilla);
			return $salida;
			}

	function render_admin_restore($param)
		{
			$resultado= SmartyInit();
			$plantilla="restore.tpl";
			$resultado->assign("accion","index?actor=backup&accion=restorestart");
			$salida=$resultado->fetch($plantilla);
			return $salida;
			}

	function render_admin_backupStart($param)
		{
			$error=false;
			$destino=vwVarFromInput('directorio');
			if (!file_exists($destino))
				{
					$error="Archivo o Directorio inexistente<br>";}
			else
				{
					if (!is_dir($destino))
						{
							$error="No ha especificado un directorio correcto";}
					else
						{
							if (!is_writable($destino))
								{
									$error="Lo siento pero no tiene los permisos adecuados";}
							else
								{
									$resultado=backupSystem($destino);
									if (!$resultado)
										{
											$error="Ha habido un fallo en la salvaguarda de los datos";}
									}
							}
					}
			if (!($error===false))
				{
					$param['ruta']="error";
					$param['mensaje']="$error";
					$param['timeout']="10";
					render($param);
					die();
					}
			else
				{
					return render_msg("La copia del sistema ha sido realizada con exito.",5,"index.php");}
			die();
		}

	function render_admin_restoreStart($param)
		{
			$error=false;
			$destino=vwVarFromInput('directorio');
			if (!file_exists($destino))
				{
					$error="Archivo o Directorio inexistente<br>";}
			else
				{
					if (!is_dir($destino))
						{
							$error="No ha especificado un directorio correcto";}
					else
						{
							if (!is_readable($destino))
								{
									$error="Lo siento pero no tiene los permisos adecuados";}
							else
								{
									$resultado=restoreSystem($destino);
									if (!$resultado)
										{
											$error="Ha habido un fallo en la restauracion de los datos";}
									}
							}
					}
			if (!($error===false))
				{
					$param['ruta']="error";
					$param['mensaje']="$error";
					$param['timeout']="10";
					render($param);
					die();
					}
			else
				{
					return render_msg("La restauracion del sistema ha sido realizada con exito.",5,"index.php");}
			die();
		}
?>
