<?php /* Smarty version 2.6.1, created on 2004-03-26 06:09:26
         compiled from autorizacion/addautorizacion.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['validaregistrourl']; ?>
" method="post" name="addseccion">
	<table border="0" cellspacing="1" cellpadding="1" width="589">
		<tr>
			<td align="center" colspan="3">
				Introduzca el motivo de solicitar la autorizacion.
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
				<b>Raz&oacute;n:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="razon" class="formulario" size="70" maxlength="255" >
			</td>
		</tr>
		<tr>
			<td align="center" colspan="3">&nbsp;</td>
		</tr>

		<tr>
			<td colspan="3" align="center">
				<input type="hidden" name="rid" value="<?php echo $this->_tpl_vars['rid']; ?>
">
				<input type="submit" value="Solicitar">
			</td>
		</tr>

	</table>
</form>
<?php echo '
<SCRIPT LANGUAGE="JavaScript">
<!--//
// initialize the qForm object
//objForm = new qForm("addseccion");

// Tenemos que poner a falso la propiedad "required" para poder mostrar un mensaje de error personalizado
//objForm.nombre.required=false;
//objForm.nombre.validateNotNull("Es necesario que introduzcas la abreviatura del archivo.");
//objForm.nombre.validate=true;

//-->
</SCRIPT>

'; ?>
