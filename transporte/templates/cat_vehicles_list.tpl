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
					  <td colspan="2" class="cabeceraCampoFormulario">B&uacute;squeda:</td>
				  </tr>
					 <tr>
						<td  width="125px" align="right" class="CampoFormulario">Introduzca su b&uacute;squeda:</td>
						<td><input type="text" id="{$objeto->ddbb_search}" name="{$objeto->ddbb_search}" value="{$objeto->search_query}" class="textoMenu"></td>
				  </tr>
				<tr>
				 	<td colspan="2"><input type="submit" value="Buscar" name="submit_cat_vehicles_search" class="botones"></td>
				 </tr>
			    <tr>
						<td width="125" class="CampoFormulario">N� de Registros por p&aacute;gina:</td>
						<td><select name="regs">
						  <option selected>10</option>
						  <option>30</option>
						  <option>50</option>
						</select></td>
				 </tr>
				  <tr>
				 	<td colspan="2"><input type="submit" value="Cambiar n� de registros" name="submit_cat_vehicles_reg" class="botones"></td>
				 </tr>  </table>
				</form><br>
				  <div name="divMostrar" id="divMostrar" >
						
					</div>	
					 <script>	
					  	document.getElementById("divMostrar").innerHTML = cat_vehicles_1;
					  </script>
			  </td></tr></table>
	  </td>
