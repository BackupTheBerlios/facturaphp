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
						<td width="125px" class="CampoFormulario">Alias:</td>
						<td > <input type="text" id="{$objeto->ddbb_alias}" name="{$objeto->ddbb_alias}" class="textoMenu" value="{$objeto->alias}"><font class="error">{$error_alias}</font></td>
				  </tr>
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Matr&iacute;cula:</td>
						<td> <input type="text" id="{$objeto->ddbb_number_plate}" name="{$objeto->ddbb_number_plate}" class="textoMenu" value="{$objeto->number_plate}"><font class="error">{$error_number_plate}</font></td>
				  </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Categor&iacute;a:</td>
						<td><select name="category">
						<input type="hidden" name="{$categoria->ddbb_id_cat_vehicle}" id="{$categoria->ddbb_id_cat_vehicle}" value="{$categoria->id_cat_vehicle}"}
						{section name="indice" loop=$categorias}
						  <option value="{$categorias[indice].id_cat_vehicle}"{if $objeto->id_cat_vehicle == $categorias[indice].id_cat_vehicle} selected{/if}>{$categorias[indice].name}</option>						 
						  {/section}
						</select></td>
				 </tr>
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Fotograf&iacute;a:</td>						
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
