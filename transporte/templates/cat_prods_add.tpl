<td valign="top">
<form method="post" action="index.php?module=cat_prods&method=add" name="form_central">
	  	<table align="center" width="100%">
		<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						 <img src="pics/usuariosico.png" width="32" height="32">
						</td>
						<td width="93%" valign="middle"  nowrap>A&ntilde;adir Catego&iacute;a de Producto</td>
			  </tr>
		  </table>
						<br>
		<table width="250px" align="center">

					<tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos de la categoria:</td>
				  </tr>
					
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Nombre:</td>
						<td> <input type="text" id="{$objeto->ddbb_name}" name="{$objeto->ddbb_name}" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125px" align="right" class="CampoFormulario">Ruta de la foto:</td>
						<td> <input type="text" id="{$objeto->ddbb_path_photo}" name="{$objeto->ddbb_path_photo}" class="textoMenu"></td>
					</tr>
					 <tr>
						<td width="125px" align="right" class="CampoFormulario">Categoria Padre:</td>
						<td> <select id="{$objeto->ddbb_id_cat_emp}" name="{$objeto->ddbb_id_cat_emp}">
						<option value="0" selected>Ninguna</option>
						
						{section name="nombre" loop=$objeto->list_cat_prods}
							<option value="{$objeto->list_cat_prods[nombre].id_cat_prod}">
								{$objeto->list_cat_prods[nombre].name}
							</option>
						{/section}						
						</td>
					</tr>
					  <tr>
						<td width="125" align="right" class="CampoFormulario">Descripcion:</td>
						<td rowspan="2" ><textarea name="{$objeto->ddbb_descrip}" class="textoMenu" id="{$objeto->ddbb_descrip}"></textarea> </td>
					</tr>
		</table>
		</td>
		</tr>	

		<tr>
			<td align="center"><br><br>
			<input type="submit" name="submit_add" id =" name="submit_add" "value="A&ntilde;adir" class="botones">			
			<input type="reset" Value="Limpiar Datos" class="botones">
			</td>
		</tr>
	  	</table>
	</form>
</td>