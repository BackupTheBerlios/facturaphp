<?php /* Smarty version 2.6.1, created on 2004-03-24 11:42:40
         compiled from master.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup_init', 'master.tpl', 23, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title><?php echo $this->_tpl_vars['Titulo']; ?>
</title>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" >
		<meta name="GENERATOR" content="Quanta Plus" >
		<meta name="Keywords" content="Peñaranda,Penyaranda,Historia" >
		<link type="text/css" rel="stylesheet" href="penaranda.css" >
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
	<body>
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
							<div class="Contenido"><?php echo $this->_tpl_vars['Contenido']; ?>
</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</body>
</html>