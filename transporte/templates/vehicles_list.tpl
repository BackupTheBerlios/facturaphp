<td valign="top">
{$cadena}
	{php}
		echo $this->_tpl_vars['cadena'];
	{/php}

{include file=capas.tpl}

	  <table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
                          <img src="pics/buscar.gif" width="32" height="31">						 
                          <!--<img src="pics/usuariosico.png" width="32" height="32">-->
						</td>
						<td width="93%" valign="middle"  nowrap>
						  Buscar veh&iacute;culos </td>
				</tr>
			  </table>
			  <table width="100%">
			  <tr><td class="message" align="center">{$message}</td></tr>
			  <tr><td valign="top"><form method="post" action="index.php?module=vehicles&method=list">
			  	<table width="250px" align="center">
				 <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Criterios de b&uacute;squeda:</td>
				  </tr>
					 <tr>
						<td width="125px" class="CampoFormulario">Identificador del veh&iacute;culo:</td>
						<td > <input type="text" id="{$objeto->ddbb_id_vehicle}" name="{$objeto->ddbb_id_vehicle}" class="textoMenu"></td>
				  </tr>
				<tr>
						<td width="125px" class="CampoFormulario" >Matr&iacute;cula:</td>
						<td > <input type="text" id="{$objeto->ddbb_number_plate}" name="{$objeto->ddbb_number_plate}" class="textoMenu"></td>
				  </tr>
					<tr>
						<td width="125px" class="CampoFormulario" >Alias:</td>
						<td > <input type="text" id="{$objeto->ddbb_alias}" name="{$objeto->ddbb_alias}" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125px" class="CampoFormulario" >Fotograf&iacute;a:</td>
						<td > <input type="text" id="{$objeto->ddbb_path_photo}" name="{$objeto->ddbb_path_photo}" class="textoMenu"></td>
				  </tr>
				    <tr>
						<td width="125" class="CampoFormulario">Nº de Registros por p&aacute;gina:</td>
						<td><select name="Registros">
						  <option selected>10</option>
						  <option>30</option>
						  <option>50</option>
						</select></td>
				 </tr>
				 <tr>
				 	<td align="center" colspan="2"><input type="submit" value="Buscar" name="Submit" class="botones"></td>
				 </tr>
				  </table>
				</form><br>
				  <div name="divMostrar" id="divMostrar" >
						
					</div>	
					 <script>	
					  	document.getElementById("divMostrar").innerHTML = vehicles_1;
					  </script>
			  </td></tr></table>
	  </td>
