<?php /* Smarty version 2.6.1, created on 2004-04-07 16:13:03
         compiled from usuarios/usrprefs.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['accion']; ?>
" method="post" name="usrprefs">
	<table border="0" cellspacing="1" cellpadding="1" width="589">
		<tr>
			<td align="center" colspan="3">
				Preferencias de Usuario
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
				<b>Elementos Visibles:</b>&nbsp;
			</td>
			<td>
				<select name="items" size="1">
					<option value="<?php echo $this->_tpl_vars['items']; ?>
" selected="true"><?php echo $this->_tpl_vars['items']; ?>
</option>
					<option value="5" >5</option>
					<option value="10" >10</option>
					<option value="15" >15</option>
					<option value="20" >20</option>
					<option value="25" >25</option>
					<option value="30" >30</option>
					<option value="35" >35</option>
					<option value="40" >40</option>
					<option value="45" >45</option>
					<option value="50" >50</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Recibir notificaci&oacute;n cuando una <bR />autorizaci&oacute;n sea aceptada o denegada:</b>&nbsp;
			</td>
			<td>
				<input type="checkbox" value="S" <?php if ($this->_tpl_vars['notify']): ?> checked="true" <?php endif; ?> >
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
//objForm = new qForm("addseccion");

// Tenemos que poner a falso la propiedad "required" para poder mostrar un mensaje de error personalizado
//objForm.nombre.required=false;
//objForm.nombre.validateNotNull("Es necesario que introduzcas la abreviatura del archivo.");
//objForm.nombre.validate=true;

//-->
</SCRIPT>

'; ?>
