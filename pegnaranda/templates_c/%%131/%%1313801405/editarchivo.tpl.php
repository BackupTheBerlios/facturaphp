<?php /* Smarty version 2.6.1, created on 2004-04-27 17:48:26
         compiled from archivos/editarchivo.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['validaregistrourl']; ?>
" method="post" name="addarchivo">
	<table border="0" cellspacing="1" cellpadding="1" width="589">
		<tr>
			<td align="center" colspan="3">
				Modifique los datos del archivo.
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
				<b>Abreviatura:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="abrev" class="formulario" size="10" maxlength="32" value="<?php echo $this->_tpl_vars['datos']['abrev']; ?>
">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Nombre:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="nombre" class="formulario" size="30" maxlength="255" value="<?php echo $this->_tpl_vars['datos']['nombre']; ?>
">
			</td>
		</tr>
		<tr>
			<td align="center" colspan="3">&nbsp;</td>
		</tr>

		<tr>
			<td colspan="3" align="center">
				<input type="hidden" name="aid" value="<?php echo $this->_tpl_vars['datos']['aid']; ?>
"
				<input type="submit" value="Enviar">
			</td>
		</tr>

	</table>
</form>
<?php echo '
<SCRIPT LANGUAGE="JavaScript">
<!--//
// initialize the qForm object
objForm = new qForm("addarchivo");

// Tenemos que poner a falso la propiedad "required" para poder mostrar un mensaje de error personalizado
objForm.abrev.required=false;
objForm.abrev.validateNotNull("Es necesario que introduzcas la abreviatura del archivo.");
// Pasamos a mininusculas el nombre de usuario
objForm.abrev.addEvent("onblur","objForm.abrev.setValue(objForm.abrev.getValue().toUpperCase(),null,false);");


objForm.abrev.validate=true;

//-->
</SCRIPT>

'; ?>
