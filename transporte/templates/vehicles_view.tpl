<td valign="top">

{$cadena}


{include file=capas.tpl}
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						<img src="pics/clientesico.png" width="32" height="32">
						</td>
						<td width="93%" valign="middle" nowrap>Detalle de veh&iacute;culo </td>
				</tr>
			  </table>
				<br>
				<TABLE width="95%" align="center">
					<tr class="cabeceraMultiLinea">
						<td width="50%" height="23" nowrap>Identificador de Veh&iacute;culo: {$objeto->id_vehicle}
						</td>
						<td nowrap width="50%">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<table width="100%" align="center">
                              <tr height="15px">
                                <td width="25%"  nowrap class="camposVistas">Alias:</td>
                                <td nowrap width="25%" class="datosVista">{$objeto->alias}</td>
								<td height="21" nowrap class="camposVistas">Identificador de Empresa:</td>
                                <td nowrap class="datosVista">{$objeto->id_corp}</td>
                                
                              </tr>
                              
                              <tr height="15px">
                                <td width="25%" nowrap class="camposVistas">Fotograf&iacute;a:</td>
                                <td width="25%" nowrap class="datosVista">{$objeto->path_photo}</td>
                          				<td><table align="center"><tr>
			      
				{section name="indice" loop=$acciones}
				
				<td>
				{if $acciones[indice]== 'modify'}
				<a href="index.php?module=groups&method={$acciones[indice]}&id={$objeto->id_vehicle}">
				<img src="pics/btn{$acciones[indice]}.gif" border="0"></a></td>
				{else}
				<td><a href="index.php?module=users&method={$acciones[indice]}&id={$objeto->id_vehicle}">
				<img src="pics/btn{$acciones[indice]}.gif" border="0" onClick="confirm('¿Desea borrar este registro?\nSi pulsa Sí se borrarán tambien los registros relacionados con este vehículo (p.ej: datos de vehículo)')"></a></td>
				{/if}
				
				{/section}

							</tr>	</table></td>
								<td></td>
                              </tr>
							 
                            </table>
					  <br>
					  <table align="center" width="400" cellpadding="0" cellspacing="0">
						  <tr><td><img src="pics/barra.gif"></td></tr>
					  </table>
					  <br>
					  
					  					  </td>
						
					</tr>
					
					<tr class="cabeceraMultiLinea">
						<td colspan="2">&nbsp;
						</td>
					</tr>
					
				</TABLE>
			</td>