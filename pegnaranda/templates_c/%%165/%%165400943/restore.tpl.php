<?php /* Smarty version 2.6.1, created on 2004-07-07 17:36:21
         compiled from restore.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['accion']; ?>
" method="post" name="restore">
	<table border="0" cellspacing="1" cellpadding="1" width="589">
		<tr>
			<td align="center" colspan="3">
				Introduzca el directorio en el que residen los datos a restaurar.
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
				<b>Directorio:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="directorio" class="formulario" size="50" maxlength="255" >
			</td>
		</tr>
		<tr>
			<td align="center" colspan="3">&nbsp;</td>
		</tr>

		<tr>
			<td colspan="3" align="center">
				<input type="submit" value="Enviar">
			</td>
		</tr>

	</table>
</form>
<?php echo '
<SCRIPT LANGUAGE="JavaScript">
<!--//
// initialize the qForm object
objForm = new qForm("backup");

// Tenemos que poner a falso la propiedad "required" para poder mostrar un mensaje de error personalizado
objForm.directorio.required=false;
objForm.directorio.validateNotNull("Es necesario que introduzcas un directorio.");
objForm.nombre.validate=true;

//-->
</SCRIPT>

'; ?>
