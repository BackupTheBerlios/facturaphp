<?php
	include('adodb/adodb.inc.php');
	include('adodb/session/adodb-session.php');
	include('db.inc.php');
	include('media.inc.php');
	include('tools.php');
	include('documentos/documentos.inc.php');
	//include('documentos/recursos.inc.php');
	//Makedb();
	SysToADO();
	Init();
	importar();
	echo '<center><font color="Blue" size="+6">Instalaci&oacute;n realizada con exito.</font><br>'
			.'<font color="blue" size="+4">Las tablas de la aplicaci&oacute;n han sido instaladas correctamente</font><br>'
			.'<font color="blue" size="+4">Elimine este archivo</font><br></center>';
	die();

?>