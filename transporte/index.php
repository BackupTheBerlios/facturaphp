<?php
require_once('inc/includes.php');
//comprueba si existe el fichero de configuraci—n
//Comprueba si existe la bbdd
//comprueba el usuario
//Comprueba las sesiones
//identifica el usuario el modulo la operaci—n y los permisos
//calcula la barra de navegaci—n y titulo de la pagina
$title="::Gesti&oacute;n::";
$nav_bar="::ZonaPrivada::";
$tpl= new template;
$tpl->assign('title',$title);
$tpl->assign('nav_bar',$nav_bar);
$tpl->display('index.tpl');
 
//elige la plantilla a presentar
//presenta las plantillas
?>