<table border="0" cellspacing="1" cellpadding="1" width="589">
	<tr>
		<td >
			<center>Ficha del Documento.</center>
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
				<td >
					<b>Archivo:</b>&nbsp;
				</td>
				<td>
					{$dropDwArchivo}
				</td>
				<td width="13">&nbsp;</td>
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
						<td >
							<b>Signatura:</b>&nbsp;
						</td>
						<td>
							{$datos.signatura}
						</td>
						<td width="13">&nbsp;</td>
						<td >
							<b>Folios:</b>&nbsp;
						</td>
						<td>
							{$datos.folios}
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
						<td >
							<b>Siglos:</b>&nbsp;
						</td>
						<td>
							{$datos.siglos}
						</td>
						<td width="13">&nbsp;</td>
						<td >
							<b>Periodo Cr&oacute;nologico:</b>&nbsp;
						</td>
						<td>
							{$datos.periodo}
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
						<td >
							<b>Resumen:</b>&nbsp;
						</td>
						<td>
							<textarea cols="60" rows="10" name="resumen">{$datos.resumen}</textarea>
						</td>
					</tr>
				</table>
			</td>
		</tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="13">&nbsp;</td>
						<td >
							<b>Notas:</b>&nbsp;
						</td>
						<td>
							<textarea cols="40" rows="4" name="notas">{$datos.notas}</textarea>
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td align="center">&nbsp;</td>
		</tr>
{if $admin }
		<tr>
			<td  align="center" >
				<center><a link href="index.php?actor=documentos&accion=editar&id={$datos.did}">Editar</a>&nbsp;
						<a link href="index.php?actor=documentos&accion=okdel&id={$datos.did}">Borrar</a>&nbsp;
						<a link href="index.php?actor=documentos&accion=addrsc&id={$datos.did}">A&ntilde;adir Recurso</a>&nbsp;
						<a link href="index.php?actor=documentos&accion=verrsc&id={$datos.did}">Gestionar Recursos</a>&nbsp;
						</center>
			</td>
		</tr>
{/if}
		<tr>
			<td  align="center">
				{$recursos}
			</td>
		</tr>
</table>
