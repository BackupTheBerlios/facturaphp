<form action="{$validaregistrourl}" method="post" name="adduser">
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
				<input type="text" name="uname" class="formulario" size="10" maxlength="32">
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
				<input type="text" name="email" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Nombre:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="nombre" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Apellidos:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="apellidos" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Direccion:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="calle" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Poblacion:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="poblacion" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Provincia:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="provincia" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Pa&iacute;s:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="pais" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>C&oacute;digo postal:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="cpostal" class="formulario" size="5" maxlength="5">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Actividad:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="actividad" class="formulario" size="30" maxlength="160">
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
{literal}
<SCRIPT LANGUAGE="JavaScript">
<!--//
// initialize the qForm object
objForm = new qForm("adduser");

objForm.uname.required=false;
objForm.uname.validate=true;
objForm.uname.validateNotNull("Es necesario que introduzca su nombre de usuario.");
objForm.uname.addEvent("onblur","objForm.uname.setValue(objForm.uname.getValue().toLowerCase(),null,false);");

objForm.email.required=false;
objForm.email.validate=true;
objForm.email.validateNotNull("Es necesario que introduzca un email.");
objForm.email.validateEmail();

objForm.nombre.required=false;
objForm.nombre.validate=true;
objForm.nombre.validateNotNull("Es necesario que introduzca su nombre.");


objForm.apellidos.required=false;
objForm.apellidos.validate=true;
objForm.apellidos.validateNotNull("Es necesario que introduzca sus apellidos.");


objForm.cpostal.validate=true;
objForm.cpostal.validateFormat("Zip5");

-->
</SCRIPT>

{/literal}
