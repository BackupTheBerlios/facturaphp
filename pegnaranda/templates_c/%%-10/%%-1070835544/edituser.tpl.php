<?php /* Smarty version 2.6.1, created on 2004-04-07 10:48:16
         compiled from usuarios/edituser.tpl */ ?>
<form action="<?php echo $this->_tpl_vars['validaeditusrdaturl']; ?>
" method="post" name="editusrdat">
	<table border="0" cellspacing="1" cellpadding="1" width="589">
		<tr>
			<td align="center" colspan="3">
				Introduzca sus datos para darse de alta
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
				<b>Nombre de usuario:</b>&nbsp;
			</td>
			<td>
				<?php echo $this->_tpl_vars['datos']['uname']; ?>

			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Clave:</b>&nbsp;
			</td>
			<td>
				<input type="password" name="clave" class="formulario" size="10" maxlength="32">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Corfirmar clave:</b>&nbsp;
			</td>
			<td>
				<input type="password" name="clave2" class="formulario" size="10" maxlength="32">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>E-mail:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="email" value="<?php echo $this->_tpl_vars['datos']['email']; ?>
" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Nombre:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="nombre" value="<?php echo $this->_tpl_vars['datos']['nombre']; ?>
" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Apellidos:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="apellidos" value="<?php echo $this->_tpl_vars['datos']['apellidos']; ?>
" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Direccion:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="calle" value="<?php echo $this->_tpl_vars['datos']['calle']; ?>
" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Poblacion:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="poblacion" value="<?php echo $this->_tpl_vars['datos']['poblacion']; ?>
" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Provincia:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="provincia" value="<?php echo $this->_tpl_vars['datos']['provincia']; ?>
" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Pa&iacute;s:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="pais" value="<?php echo $this->_tpl_vars['datos']['pais']; ?>
" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>C&oacute;digo postal:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="cpostal" value="<?php echo $this->_tpl_vars['datos']['cpostal']; ?>
" class="formulario" size="5" maxlength="5">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Actividad:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="actividad" value="<?php echo $this->_tpl_vars['datos']['actividad']; ?>
" class="formulario" size="30" maxlength="160">
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
	<input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['datos']['uid']; ?>
">
</form>
<?php echo '
<SCRIPT LANGUAGE="JavaScript">
<!--//
// initialize the qForm object
objForm = new qForm("editusrdat");

objForm.email.required=false;
objForm.email.validate=true;
objForm.email.validateNotNull("Es necesario que introduzca un email.");
objForm.email.validateEmail();

objForm.emailContacto.validateEmail();

objForm.nombre.required=false;
objForm.nombre.validateNotNull("Es necesario que introduzca su nombre.");
objForm.nombre.validate=true;

objForm.apellidos.required=false;
objForm.apellidos.validateNotNull("Es necesario que introduzca sus apellidos.");
objForm.apellidos.validate=true;

objForm.cpostal.validate=true;
objForm.cpostal.validateFormat("Zip5");

//function dependencia()
//{
//	if (objForm.clave.isNotEmpty() == true)
//		{
//		objForm.clave2.required=false;
//		objForm.clave2.validateNotNull("Es necesario que introduzca la confirmacion de la clave.");
//		}
//	else
//		{
//		alert("entra");
//		}
//}


//function comparapass()
//	{
//	if (objForm.clave.isNotEmpty() == false)
//		{
//		objForm.clave2.required=true;
//		objForm.clave2.required=false;
//		}
//	if (objForm.clave.obj.value!=objForm.clave2.obj.value)
//			{
//			alert("Las claves son diferentes");
//			}
//	}
//-->
</SCRIPT>

'; ?>
