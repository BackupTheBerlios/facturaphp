<?php /* Smarty version 2.6.1, created on 2004-03-26 17:59:29
         compiled from document/adddocument.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['validaregistrourl']; ?>
" method="post" name="adddocument">
	<table border="0" cellspacing="1" cellpadding="1" width="589">
		<tr>
			<td align="center" colspan="3">
				Introduzca los datos del archivo.
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
				<b>Archivo:</b>&nbsp;
			</td>
			<td>
				<?php echo $this->_tpl_vars['dropDwArchivo']; ?>

			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Seccion:</b>&nbsp;
			</td>
			<td>
				<?php echo $this->_tpl_vars['dropDwSeccion']; ?>

			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Signatura:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="signatura" class="formulario" size="10" maxlength="32" >
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Folios:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="folios" class="formulario" size="10" maxlength="32" >
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Siglos:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="siglos" class="formulario" size="10" maxlength="32" >
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Periodo Cr&oacute;nologico:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="periodo" class="formulario" size="10" maxlength="32" >
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Resumen:</b>&nbsp;
			</td>
			<td>
				<textarea cols="70" rows="15" name="resumen"></textarea>
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Notas:</b>&nbsp;
			</td>
			<td>
				<textarea cols="70" rows="7" name="notas"></textarea>
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
objForm = new qForm("adddocument");

// Tenemos que poner a falso la propiedad "required" para poder mostrar un mensaje de error personalizado
objForm.signatura.required=false;
objForm.signatura.validateNotNull("Es necesario que introduzcas la signatura del documento.");
objForm.signatura.validate=true;

objForm.siglos.required=false;
objForm.siglos.validateNotNull("Es necesario que introduzcas los siglos que abarca el documento.");
objForm.siglos.validate=true;

objForm.resumen.required=false;
objForm.resumen.validateNotNull("Es necesario que introduzcas el resumen del documento.");
objForm.resumen.validate=true;

//-->
</SCRIPT>

'; ?>
