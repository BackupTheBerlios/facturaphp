<td valign="top">
{$cadena}
	

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
			  <tr><td valign="top"><form method="post" action="index.php?module=cat_vehicles&method=list">
			  	<table width="250px" align="center">
				 <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Criterios de b&uacute;squeda:</td>
				  </tr>
					 <tr>
						<td width="125px" class="CampoFormulario">Identificador de la categor�a del veh�culo:</td>
						<td > <input type="text" id="{$objeto->ddbb_id_cat_vehicle}" name="{$objeto->ddbb_id_cat_vehicle}" class="textoMenu"></td>
				  </tr>
				  <tr>
					
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Nombre de la Categor�a:</td>
						<td> <input type="text" id="{$objeto->ddbb_name}" name="{$objeto->ddbb_name}" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125px" class="CampoFormulario" >Nombre e la Categor�a en la web:</td>
						<td > <input type="text" id="{$objeto->ddbb_name_web}" name="{$objeto->ddbb_name_web}" class="textoMenu"></td>
				  </tr>				 
				  <tr>
						<td width="125" class="CampoFormulario">N� de Registros por p&aacute;gina:</td>
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
					  	document.getElementById("divMostrar").innerHTML = cat_vehicles_1;
					  </script>
			  </td></tr></table>
	  </td>
