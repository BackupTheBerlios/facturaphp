<?php

	/**********************************************************
	 ** The following are the engine configuration variables **
	 **********************************************************/
	$driver="mysql"; 			// Driver a usar para acceder a la bbdd
	$debug=false; 				//	Activar/Desactivar la depuracion de la bbdd
	$server="localhost";		// Servidor de BBDD
	$user="root";				// Usuario Usado en la conexion
	$passwd="kx12tc00";		// Password Usado por la BBDD
	$database="penaranda";			// Nombre de la BBDD a la que nos vamos a conectar.
	$gd2=false; //It tells if there's GD2 present

	/**********************************************************
	 ** The following are the smarty configuration variables **
	 **********************************************************/

	$base_dir="/var/www/localhost/htdocs/hpenaranda"; //Directorio base del proyecto
	$template_dir="$base_dir/templates/";
	$compile_dir="$base_dir/templates_c/";
	$config_dir="$base_dir/smarty/configs/";
	$plugins_dir="$base_dir/smarty/plugins/";

	/**********************************************************
	 ** The following are the resource paths                 **
	 **********************************************************/

	 $rsc_dir="/var/www/localhost/hpenaranda/"; // fuera del path de apache, pero con derechos de lectura/escritura
	 $prev_dir=$base_dir."/previos/"; // vistas previas.... solo imagenes y pdf

?>