<?php
	include('adodb/adodb.inc.php');
	include('adodb/session/adodb-session.php');
	include('db.inc.php');
	Makedb();
	SysToADO();
	Installdb();
	echo '<center><font color="Blue" size="+6">Instalaci&oacute;n realizada con exito.</font><br>'
			.'<font color="blue" size="+4">Las tablas de la aplicaci&oacute;n han sido instaladas correctamente</font><br>'
			.'<font color="blue" size="+4">Elimine este archivo</font><br></center>';
	die();
?>
