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
				<TABLE width="100%">			
					<tr>
						<td valign="top">
							<table width="100%">
							<tr class="cabeceraMultiLinea">
								<td colspan="2" height="23" nowrap>Identificador de Veh&iacute;culo: {$objeto->id_vehicle}</td>
							</tr>
                              <tr height="15px">
                                <td width="25%"  nowrap class="camposVistas">Alias:</td>
                                <td nowrap width="25%" class="datosVista">{$objeto->alias}</td>
                              </tr>
                              <tr>
								<td height="21" nowrap class="camposVistas">Matr&iacute;cula:</td>
                                <td nowrap class="datosVista">{$objeto->number_plate}</td>
                                
                              </tr>
                    		  <tr>      
			      				<td align="center">
									{section name="indice" loop=$acciones}			
									{if $acciones[indice]== 'modify'}
										<a href="index.php?module=vehicles&method={$acciones[indice]}&id={$objeto->id_vehicle}">
											<img src="pics/btn{$acciones[indice]}.gif" border="0"></a>
									{else}
										<a href="index.php?module=vehicles&method={$acciones[indice]}&id={$objeto->id_vehicle}">
											<img src="pics/btn{$acciones[indice]}.gif" border="0" onClick="confirm('¿Desea borrar este registro?\nSi pulsa Sí se borrarán tambien los registros relacionados con este vehículo (p.ej: datos de vehículo)')"></a>
									{/if}	
									{/section}
								</td>
							 </tr>
							 <tr class="cabeceraMultiLinea">
								<td colspan="2">&nbsp;</td>
							</tr>	
						 	</table>
					   	</td>
					   <td>
                               <a href="index.php?module=vehicles&method=show&id={$objeto->id_vehicle}"><img src="{$objeto->path_photo}" height="120"></a>
					   </td>
					</tr>	
			 </TABLE>
</td>
						
					
					