<form action="{$validaregistrourl}" method="post" name="adddocument">
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
				<b>Archivo:</b>&nbsp;
			</td>
			<td>
				{$dropDwArchivo}
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Seccion:</b>&nbsp;
			</td>
			<td>
				{$dropDwSeccion}
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Signatura:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="signatura" class="formulario" size="10" maxlength="32" value="{$datos.signatura}">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Folios:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="folios" class="formulario" size="10" maxlength="32" value="{$datos.folios}">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Siglos:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="siglos" class="formulario" size="10" maxlength="32" value="{$datos.siglos}">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Periodo Cr&oacute;nologico:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="periodo" class="formulario" size="10" maxlength="32" value="{$datos.periodo}" >
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Resumen:</b>&nbsp;
			</td>
			<td>
				<textarea cols="70" rows="15" name="resumen">{$datos.resumen}</textarea>
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Notas:</b>&nbsp;
			</td>
			<td>
				<textarea cols="70" rows="7" name="notas">{$datos.notas}</textarea>
			</td>
		</tr>

		<tr>
			<td align="center" colspan="3">&nbsp;</td>
		</tr>

		<tr>
			<td colspan="3" align="center">
				<input type="hidden" value="{$datos.did}" name="oldid">
				<input type="submit" value="Enviar">
			</td>
		</tr>

	</table>
</form>
<br>


<center>{if $datos.did != 1 }<a href="index.php?actor=documentos&accion=editar&id={$datos.did-1}" >Anterior</a>{/if}&nbsp;&nbsp;<a href="index.php?actor=documentos&accion=editar&id={$datos.did+1}">Siguiente</a></center>
{literal}
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

{/literal}
