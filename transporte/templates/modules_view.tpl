<td valign="top">
{$cadena}

{include file=capas.tpl}
	
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						<img src="pics/clientesico.png" width="32" height="32">
						 <!--<img src="pics/usuariosico.png" width="32" height="32">-->
						</td>
						<td width="93%" valign="middle" nowrap>Detalle de m&oacute;dulo</td>
				</tr>
			  </table>
				<br>
				<TABLE width="95%" align="center">
					<tr class="cabeceraMultiLinea">
						<td width="50%" height="23" nowrap>Identificador de M&oacute;dulo: {$objeto->id_module}
						</td>
						<td nowrap width="50%">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<table width="90%" align="center">
                              <tr height="15px">
                                <td width="25%"  nowrap class="camposVistas">Nombre:</td>
                                <td nowrap width="25%" class="datosVista">{$objeto->name}</td>
								<td height="21" nowrap class="camposVistas">Nombre Web:</td>
                                <td nowrap class="datosVista"> {$objeto->name_web}</td>
                                
                              </tr>
                              <tr>
                              	<td width="25%"  nowrap class="camposVistas">Ruta:</td>
	                            <td nowrap width="25%" class="datosVista">{$objeto->path}</td>
	                            <td width="25%"  nowrap class="camposVistas">Activo:</td>
	                            <td nowrap width="25%" class="datosVista">{if $objeto->active==1}S&iacute;{else}No{/if}</td>
                              </tr>
                              <tr>
                              	<td width="25%"  nowrap class="camposVistas">P&uacute;blico:</td>
								<td nowrap width="25%" class="datosVista">{if $objeto->publico==1}S&iacute;{else}No{/if}</td>
								<td width="25%"  nowrap class="camposVistas">Depende de:</td>
	                            <td nowrap width="25%" class="datosVista">{$padre}</td>
	                            

                              </tr>
                              <tr height="15px">
                                <td width="25%" nowrap class="camposVistas">M&eacute;todos:</td>
                                <td width="25%" nowrap class="datosVista">{$metodos}</td>
								 <td>
								 	<table align="center"><tr>
<!-- Elegir el modo a hacer-->	
											<!--{$acciones}-->
											<!--{section name="indice" loop=$acciones}
												<td>
												<a href="index.php?module=modules&method={$acciones[indice]}&id={$objeto->id_group}">
												<img src="pics/btn{$acciones[indice]}.gif" border="0"></a></td>
											{/section}-->
									</tr></table>
							</td>
								<td></td>
                              </tr>
                            
                            </table>
					
					
							
					  
  					  </td>
						
					</tr>
					
					<tr class="cabeceraMultiLinea">
						<td colspan="2">&nbsp;
						</td>
					</tr>
					
				</TABLE>
			</td>