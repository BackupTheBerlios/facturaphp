<form action="{$validaregistrourl}" method="post" name="addrsc" enctype="multipart/form-data">
	<table border="0" cellspacing="1" cellpadding="1" width="589">
		<tr>
			<td align="center" colspan="3">
				Introduzca los datos del recurso.
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
				<b>T&iacute;tulo:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="titulo" class="formulario" size="30" maxlength="255" value="{$datos.titulo}">
			</td>
		</tr>
		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>URL:</b>&nbsp;
			</td>
			<td>
				<input type="text" name="url" class="formulario" size="50" maxlength="255" value="{$datos.url}">
			</td>
		</tr>

		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Require Autorizaci&oacute;n:</b>&nbsp;
			</td>
			<td>
				<input type="checkbox" name="restringido" value="S" class="formulario" {if $datos.restringido eq "S" } cheked="true" {/if}>
			</td>
		</tr>

		<tr>
			<td width="130">&nbsp;</td>
			<td width="175">
				<b>Fichero a subir:</b>&nbsp;
			</td>
			<td>
				{$datos.archivo}<br>
				<input type="file" name="archivo" class="formulario" >
			</td>
		</tr>

		<tr>
			<td align="center" colspan="3">&nbsp;</td>
		</tr>

		<tr>
			<td colspan="3" align="center">
				<input type="hidden" name="did" value="{$did}"
				<input type="hidden" name="oldarc_name" value="{$datos.archivo}"
				<input type="hidden" name="rid" value="{$datos.rid}"
				<input type="submit" value="Enviar">
			</td>
		</tr>

	</table>
</form>
{literal}
<SCRIPT LANGUAGE="JavaScript">
<!--//
// initialize the qForm object
objForm = new qForm("addrsc");

// Tenemos que poner a falso la propiedad "required" para poder mostrar un mensaje de error personalizado
objForm.titulo.required=false;
objForm.titulo.validateNotNull("Es necesario que introduzcas el título del recurso.");
objForm.titulo.validate=true;

//-->
</SCRIPT>

{/literal}
