<form action="{$accion}" method="post" name="busqueda">
	<table border="0" cellspacing="1" cellpadding="1" width="589">
		<tr>
			<td >
				<center>Introduzca condiciones de la busqueda.</center>
			</td>
		</tr>
		<tr>
			<td >
				&nbsp;
			</td>
		</tr>

		<tr>
			<td>
				<table border="0" cellspacing="1" cellpadding="1" >
				<TR>
				<td width="13">&nbsp;</td>
				<td >{$dropCond1}</td>
				<td >
					<b>Archivo:</b>&nbsp;
				</td>
				<td>
					{$dropDwArchivo}
				</td>
				<td width="60">{$dropCond2}</td>
				<td>
					<b>Seccion:</b>&nbsp;
				</td>
				<td>
					{$dropDwSeccion}
				</td>
				</TR>
				</TABLE>
			</td>
		</tr>
		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="13">&nbsp;</td>
						<td width="60">{$dropCond3}</td>
						<td >
							<b>Signatura:</b>&nbsp;
						</td>
						<td>
							<input type="text" name="signatura" class="formulario" size="10" maxlength="32" >
						</td>
						<td width="60">{$dropCond4}</td>
						<td >
							<b>Folios:</b>&nbsp;
						</td>
						<td>
							<input type="text" name="folios" class="formulario" size="10" maxlength="32" >
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="13">&nbsp;</td>
						<td width="60">{$dropCond5}</td>
						<td >
							<b>Siglos:</b>&nbsp;
						</td>
						<td>
							<input type="text" name="siglos" class="formulario" size="10" maxlength="32" >
						</td>
						<td width="60">{$dropCond6}</td>
						<td >
							<b>Periodo Cr&oacute;nologico:</b>&nbsp;
						</td>
						<td>
							<input type="text" name="periodo" class="formulario" size="10" maxlength="32" >
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="13">&nbsp;</td>
						<td width="60">{$dropCond7}</td>
						<td >
							<b>Resumen:</b>&nbsp;
						</td>
						<td>
							<textarea cols="40" rows="3" name="resumen"></textarea>
						</td>
					</tr>
				</table>
			</td>
		</tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="13">&nbsp;</td>
						<td width="60">{$dropCond8}</td>
						<td >
							<b>Notas:</b>&nbsp;
						</td>
						<td>
							<textarea cols="40" rows="2" name="notas"></textarea>
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td align="center">&nbsp;</td>
		</tr>

		<tr>
			<td  align="center">
				<input type="submit" value="Buscar!">
			</td>
		</tr>

	</table>
</form>
{literal}
<SCRIPT LANGUAGE="JavaScript">
<!--//
// initialize the qForm object
//objForm = new qForm("adddocument");

// Tenemos que poner a falso la propiedad "required" para poder mostrar un mensaje de error personalizado
//objForm.signatura.required=false;
//objForm.signatura.validateNotNull("Es necesario que introduzcas la signatura del documento.");
//objForm.signatura.validate=true;
//
//objForm.siglos.required=false;
//objForm.siglos.validateNotNull("Es necesario que introduzcas los siglos que abarca el documento.");
//objForm.siglos.validate=true;
//
//objForm.resumen.required=false;
//objForm.resumen.validateNotNull("Es necesario que introduzcas el resumen del documento.");
//objForm.resumen.validate=true;
//
//-->
</SCRIPT>

{/literal}
