<?php /* Smarty version 2.6.1, created on 2004-04-06 10:08:28
         compiled from document/document.tpl */ ?>
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
					<?php echo $this->_tpl_vars['dropDwArchivo']; ?>

				</td>
				<td width="13">&nbsp;</td>
				<td>
					<b>Seccion:</b>&nbsp;
				</td>
				<td>
					<?php echo $this->_tpl_vars['dropDwSeccion']; ?>

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
							<?php echo $this->_tpl_vars['datos']['signatura']; ?>

						</td>
						<td width="13">&nbsp;</td>
						<td >
							<b>Folios:</b>&nbsp;
						</td>
						<td>
							<?php echo $this->_tpl_vars['datos']['folios']; ?>

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
							<?php echo $this->_tpl_vars['datos']['siglos']; ?>

						</td>
						<td width="13">&nbsp;</td>
						<td >
							<b>Periodo Cr&oacute;nologico:</b>&nbsp;
						</td>
						<td>
							<?php echo $this->_tpl_vars['datos']['periodo']; ?>

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
							<textarea cols="60" rows="10" name="resumen"><?php echo $this->_tpl_vars['datos']['resumen']; ?>
</textarea>
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
							<textarea cols="40" rows="4" name="notas"><?php echo $this->_tpl_vars['datos']['notas']; ?>
</textarea>
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<td align="center">&nbsp;</td>
		</tr>
<?php if ($this->_tpl_vars['admin']): ?>
		<tr>
			<td  align="center" >
				<center><a link href="index.php?actor=documentos&accion=editar&id=<?php echo $this->_tpl_vars['datos']['did']; ?>
">Editar</a>&nbsp;
						<a link href="index.php?actor=documentos&accion=okdel&id=<?php echo $this->_tpl_vars['datos']['did']; ?>
">Borrar</a>&nbsp;
						<a link href="index.php?actor=documentos&accion=addrsc&id=<?php echo $this->_tpl_vars['datos']['did']; ?>
">A&ntilde;adir Recurso</a>&nbsp;
						<a link href="index.php?actor=documentos&accion=verrsc&id=<?php echo $this->_tpl_vars['datos']['did']; ?>
">Gestionar Recursos</a>&nbsp;
						</center>
			</td>
		</tr>
<?php endif; ?>
		<tr>
			<td  align="center">
				<?php echo $this->_tpl_vars['recursos']; ?>

			</td>
		</tr>
</table>