<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>{$Titulo}</title>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" >
		<meta name="GENERATOR" content="Quanta Plus" >
		<meta name="Keywords" content="Peñaranda,Penyaranda,Historia" >
		<link type="text/css" rel="stylesheet" href="penaranda.css" >
	{literal}
	<SCRIPT SRC="qformslib/qforms.js"></SCRIPT>
	<SCRIPT LANGUAGE="JavaScript">
	<!--//
	// set the path to the qForms directory
	qFormAPI.setLibraryPath("qformslib/");
	// this loads all the default libraries
	qFormAPI.include("*");
	qFormAPI.errorColor = "#c6a617";
	//-->
	</SCRIPT>
	<script language="JavaScript">function abrirpopup(nombre,ancho,alto){dat = 'width=' + ancho + ',height=' + alto + ',left=0,top=0,scrollbars=yes,resizable=1';window.open(nombre,'',dat)}</script>
	{/literal}
	{* Cargamos la libreria para los popup *}
	{popup_init src="javascript/overlib.js"}

	</head>
	<body>
	<table width="776" cellspacing="0" border="0" cellpadding="0">
		<tr>
			<td><div class="Cabecera" align="center">{$Cabecera}</div></td>
		</tr>
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td width="130" align="center" valign="top">
							{$Bloques}
						</td>
						<td align="center" valign="top">
							<div class="Contenido">{$Contenido}</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</body>
</html>
