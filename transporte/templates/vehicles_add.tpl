<td valign="top">
{include file=checkbox.tpl}

<form method="post" action="index.php?module=vehicles&method=add" name="form_central" enctype="multipart/form-data">
	  	<table align="center" width="100%">
		<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						 <img src="pics/usuariosico.png" width="32" height="32">
						</td>
						<td width="93%" valign="middle"  nowrap>Alta de veh&iacute;culos</td>
			  </tr>
		  </table>
						<br>
		<table width="250px" align="center">

				<tr>
					<td colspan="2" class="cabeceraCampoFormulario">Datos del veh&iacute;culo:</td>
				</tr>
				<tr>
					<td width="125px" class="CampoFormulario">Identificador de empresa propietaria:</td>
					<td > <input type="text" id="{$objeto->ddbb_id_corp}" name="{$objeto->ddbb_id_corp}" value = "{$objeto->id_corp}" class="textoMenu"></td>
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
				 	<td width="125px" class="CampoFormulario" >Fotograf&iacute;a:</td>
					<td><input type="file" name="{$objeto->ddbb_path_photo}"></input></td>	
				</tr>
				<tr>
					<td colspan="2" class="cabeceraCampoFormulario">Categor&iacute;as: </td>
				</tr>
				<tr>
					<td colspan="2">
					<input type="button" Value="Seleccionar Todos" class="botones" onClick="selectAll();">
					<input type="button" Value="Deseleccionar Todos" class="botones" onClick="unselectAll();">
					</td>
				</tr>

				<tr>
		<td valign="top" colspan="2">
			<br>
			<table width="100%" align="center" border="0">
			
			<tr class="cabeceraMultiLinea">
				<td width="100%" colspan="2">Categor&iacute;as</td>				
			</tr>
			
			{php}
				$linea = 0;
			{/php}
			{section name="indice" loop=$grupos}
				{php}
				if ($linea==0){
					$clase="multiLinea1";
					$linea=1;
				}				
				else{
					$clase="multiLinea2";	
					$linea=0;
				}				
				print('<tr class="'.$clase.'">');
				{/php}
				<td>
				<input type="checkbox" value="1" name="grupo_{$grupos[indice]->id_group}" {if $grupos[indice]->belong==true}checked{/if}>{$grupos[indice]->name_web}
				{php}$this->_sections['indice']['index']+=1;
					$this->_sections['indice']['iteration']+=1;{/php}
				
				</td>
				{if !$smarty.section.indice.last}
				<td>
				<input type="checkbox" value="1" name="grupo_{$grupos[indice]->id_group}" {if $grupos[indice]->belong==true}checked{/if}>{$grupos[indice]->name_web}
				</td>
				{else}
				<td>
				&nbsp;
				</td>
				{/if}
				</tr>
			{/section}
			<tr class="cabeceraMultilinea"><td colspan="2">&nbsp</td></tr>
			</table>
		</td>
		</tr>	
				</table>
		</td>
		</tr>	
		
		<tr>

			<td valign="top">
			<br>
			<br> 
											
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
