<table border="0" cellspacing="0" cellpadding="0" style="margin: 6px;">
	<tr>
		<th><center>&nbsp;{$registro.ltxResumen|truncate:66:"...":false}&nbsp;</center></th>
	</tr>
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td>Archivo:&nbsp;{$registro.aid}&nbsp;&nbsp;Secci&oacute;n:&nbsp;{$registro.sid}&nbsp;<br>
						Signatura:&nbsp;{$registro.txtSignatura}&nbsp;&nbsp;Folios:&nbsp;{$registro.txtFolios}&nbsp;Siglos:&nbsp;{$registro.txtSiglos}<br>
						Periodo Cr&oacute;nologico:&nbsp;{$registro.txtPeriodoCronologico}
					</td>
					{if $options eq "" }
					{else}
					<td width="22">
						{$options}
					</td>
					{/if}
				</tr>
		{if $registro.recursos eq "" }
		{else}
				<tr>
					{if $options eq "" }
						<td>
					{else}
						 <td colspan="2">
					{/if}
					Recursos:&nbsp;{$registro.recursos}</td>
				</tr>
		{/if}
			</table>
		</td>
	</tr>
</table>