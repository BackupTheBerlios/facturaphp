<form action="{$valaeditarurl}" method="post" name="editusrdat">
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
				{$datos.uname}
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
				<input type="text" name="email" value="{$datos.email}" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Nombre:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="nombre" value="{$datos.nombre}" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Apellidos:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="apellidos" value="{$datos.apellidos}" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Direccion:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="calle" value="{$datos.calle}" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Poblacion:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="poblacion" value="{$datos.poblacion}" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Provincia:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="provincia" value="{$datos.provincia}" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Pa&iacute;s:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="pais" value="{$datos.pais}" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>C&oacute;digo postal:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="cpostal" value="{$datos.cpostal}" class="formulario" size="5" maxlength="5">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Actividad:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="actividad" value="{$datos.actividad}" class="formulario" size="30" maxlength="160">
			</td>
		</tr>
		<tr>
			<td align="center" colspan="3">&nbsp;<input type="hidden" name="oldid" value="{$datos.uid}"></td>
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

{/literal}
