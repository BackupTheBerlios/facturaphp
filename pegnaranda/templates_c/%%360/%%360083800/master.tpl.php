<?php /* Smarty version 2.6.1, created on 2004-09-03 11:59:08
         compiled from master.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup_init', 'master.tpl', 24, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title><?php echo $this->_tpl_vars['Titulo']; ?>
</title>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" >
		<meta name="GENERATOR" content="Quanta Plus" >
		<meta name="Keywords" content="Pe�aranda,Penyaranda,Historia" >
		<!--<link type="text/css" rel="stylesheet" href="penaranda.css" >-->
		<script language="javascript" src="estiloEnlace.js"></script>
	<?php echo '
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
	<script language="JavaScript">function abrirpopup(nombre,ancho,alto){dat = \'width=\' + ancho + \',height=\' + alto + \',left=0,top=0,scrollbars=yes,resizable=1\';window.open(nombre,\'\',dat)}</script>
	'; ?>

		<?php echo smarty_function_popup_init(array('src' => "javascript/overlib.js"), $this);?>


	</head>
	<body style="font-family: Arial, Helvetica, sans-serif; color: #106010;	font-size:11px;	background-color: #fef4d7;font-weight: normal;	margin: 0;	padding: 0;">
	<table width="776" cellspacing="0" border="0" cellpadding="0">
		<tr>
			<td><div class="Cabecera" align="center"><?php echo $this->_tpl_vars['Cabecera']; ?>
</div></td>
		</tr>
		<tr>
			<td>
				<table cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td width="130" align="center" valign="top">
							<?php echo $this->_tpl_vars['Bloques']; ?>

						</td>
						<td align="center" valign="top">
						<!--Problema esta dentro de "contenido" y este tiene formato para "P" y "P>first-letter"-->
							<div style="text-align: justify;font-size: 1.1em;padding: 0.2em;"><?php echo $this->_tpl_vars['Contenido']; ?>
</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</body>
</html>