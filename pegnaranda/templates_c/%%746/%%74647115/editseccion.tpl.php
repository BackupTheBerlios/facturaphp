<?php /* Smarty version 2.6.1, created on 2004-04-27 14:15:54
         compiled from seccion/editseccion.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['validaregistrourl']; ?>
" method="post" name="addseccion">
	<table border="0" cellspacing="1" cellpadding="1" width="589">
		<tr>
			<td align="center" colspan="3">
				Modifique los datos de la seccion.
			</td>
		</tr>
		<tr>
			<td align="center" colspan="3">
				&nbsp;
			</td>
		</tr>

		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Nombre:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="nombre" class="formulario" size="40" maxlength="255" value="<?php echo $this->_tpl_vars['datos']['nombre']; ?>
" >
			</td>
		</tr>
		<tr>
			<td align="center" colspan="3">&nbsp;</td>
		</tr>

		<tr>
			<td colspan="3" align="center">
				<input type="hidden" name="sid" value="<?php echo $this->_tpl_vars['datos']['sid']; ?>
">
				<input type="submit" value="Enviar">
			</td>
		</tr>

	</table>
</form>
<?php echo '
<SCRIPT LANGUAGE="JavaScript">
<!--//
// initialize the qForm object
objForm = new qForm("addseccion");

// Tenemos que poner a falso la propiedad "required" para poder mostrar un mensaje de error personalizado
objForm.nombre.required=false;
objForm.nombre.validateNotNull("Es necesario que introduzcas la abreviatura del archivo.");
objForm.nombre.validate=true;

//-->
</SCRIPT>

'; ?>
