<td valign="top">
{include file=checkbox.tpl}

<form method="post" action="index.php?module=vehicles&method=add" name="form_central" enctype="multipart/form-data">
	  	<table align="center" width="100%">
		<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
				<tr Class="CabeceraModulo">
				<td width="7%"><img src="pics/usuariosico.png" width="32" height="32"></td>
				<td width="93%" valign="middle"  nowrap>Alta de veh&iacute;culos</td>
			  	</tr>
		    </table>
		    <br>
		    <table width="250px" align="center">
				<tr>
					<td colspan="2" class="cabeceraCampoFormulario">Datos del veh&iacute;culo:</td>
				</tr> 
				<tr>
					<td width="125px" align="right" class="CampoFormulario">Matr&iacute;cula:</td>
					<td> <input type="text" id="{$objeto->ddbb_number_plate}" name="{$objeto->ddbb_number_plate}" value = "{$objeto->number_plate}" class="textoMenu"></td>
				</tr>
				<tr>
					<td width="125px" class="CampoFormulario" >Alias:</td>
					<td > <input type="text" id="{$objeto->ddbb_alias}" name="{$objeto->ddbb_alias}" value = "{$objeto->alias}" class="textoMenu"></td>		
				 </tr>
				 <tr>
						<td " class="CampoFormulario">Categor&iacute;a:</td>
						<td width="125px"><select name="category">
						{section name="indice" loop=$categorias}
						  <option value="{$categorias[indice].id_cat_vehicle}">{$categorias[indice].name}</option>						 
						  {/section}
						</select></td>
				 </tr>
				 <tr>
				 	<td width="125px" class="CampoFormulario" >Fotograf&iacute;a:</td>
					<td><input type="file" name="{$objeto->ddbb_path_photo}"></input></td>	
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
