<td valign="top">

{$cadena}


{include file=capas.tpl}
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						<img src="pics/clientesico.png" width="32" height="32">
						</td>
						<td width="93%" valign="middle" nowrap>Detalle de empresa </td>
				</tr>
			  </table>
				<br>
				<TABLE width="95%" align="center">
					<tr class="cabeceraMultiLinea">
						<td width="50%" height="23" nowrap>Identificador de Empresa: {$objeto->id_corp}
						</td>
						<td nowrap width="50%">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<table width="90%" align="center">
                              <tr height="15px">
                                <td width="25%"  nowrap class="camposVistas">Nombre:</td>
                                <td nowrap width="25%" class="datosVista">{$objeto->name}</td>
								<td height="21" nowrap class="camposVistas">Nombre Completo:</td>
                                <td nowrap class="datosVista">{$objeto->name}</td>
                                
                              </tr>
                              
                              <tr height="15px">
                                <td width="25%" nowrap class="camposVistas">CIF - NIF:</td>
                                <td width="25%" nowrap class="datosVista">{$objeto->cif_nif}</td>
								 <td width="25%"  nowrap class="camposVistas">Direcci&oacute;n:</td>
                                <td width="25%" class="datosVista">{$objeto->address}</td>
                                
                              </tr>
                              <tr height="15px">
                               <td height="21" nowrap class="camposVistas">Direcci&oacute;n Postal:</td>
                                <td nowrap class="datosVista">{$objeto->postal_address}</td>
                                <td height="21" nowrap class="camposVistas">Direcci&oacute;n Fiscal:</td>
                                <td class="datosVista">{$objeto->fiscal_address}</td>
                              </tr>
                              <tr height="15px">                                
                                <td height="21" nowrap class="camposVistas">C&oacute;digo Postal:</td>
                                <td nowrap class="datosVista">{$objeto->postal_code}</td>
								<td width="25%" nowrap class="camposVistas">Localidad:</td>
                                <td width="25%" nowrap class="datosVista">{$objeto->city}</td>
                              </tr>
                              <tr height="15px">                                
                                <td width="25%" nowrap class="camposVistas">Provincia:</td>
                                <td width="25%" nowrap class="datosVista">{$objeto->state}</td>
                                <td width="25%" nowrap class="camposVistas">Pa&iacute;s:</td>
                                <td width="25%" nowrap class="datosVista">{$objeto->country}</td>
                              </tr>
							  <tr height="15px">
                                <td width="25%"  nowrap class="camposVistas">Tel&eacute;fono:</td>
                                <td width="25%" class="datosVista">{$objeto->phone}</td>
                                <td height="21" nowrap class="camposVistas">Tel&eacute;fono m&oacute;vil:</td>
                                <td class="datosVista">{$objeto->mobile_phone}</td>
                              </tr>
                              <tr height="15px">
                                <td height="21" nowrap class="camposVistas">Fax:</td>
                                <td nowrap class="datosVista">{$objeto->fax}</td>
								<td width="25%" nowrap class="camposVistas">E-mail:</td>
                                <td width="25%" nowrap class="datosVista"><a href="mailto:{$objeto->mail}">{$objeto->mail}</a></td>
                              </tr>
                              <tr height="15px">                                <td height="21" nowrap class="camposVistas">Url:</td>
                                <td nowrap class="datosVista"><a href="{$objeto->url}">{$objeto->url}</a></td>
								<td><table align="center">
								<tr><td>
								<a href="formularioClientes.htm"><img src="pics/btnmodify.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btndelete.gif" border="0" onClick="confirm('¿Desea borrar este registro?\nSi pulsa Sí se borrarán tambien los registros relacionados con este cliente (p.ej: datos de usuario)')"></a></td>
								</tr>
								</table></td>
								<td></td>
                              </tr>
							  <tr>
							  <td height="21" nowrap class="camposVistas">Notas: </td>
							  <td colspan="3">&nbsp; </td>
							  </tr>
                            </table>
							<table class="cajaMenu" width="90%" align="center">
								<tr class="multiLinea1" ><td>{$objeto->notes}</td></tr>
					  </table>
					  <br>
					  <table align="center" width="400" cellspacing="0" cellpadding="0">
					  <tr>
					
					  	<td align="center" valign="baseline">
					<img src="pics/pestagna-personalsobre.gif" id="emps" onClick="Ocultar(this,'emps_1')" name="boton">
						</td>
						  	<td  align="center">
					<img src="pics/pestagna-clientes.gif" id="Clientes" onClick="Ocultar(this,'Clientes')" name="boton"> 					</td>
					  	<td   align="center" >
					<img src="pics/pestagna-facturaspen.gif" id="FacturasPen" onClick="Ocultar(this,'FacturasPen')" name="boton">
					</td>
					  	<td  align="center">
					<img src="pics/pestagna-facturascob.gif" id="FacturasCob" onClick="Ocultar(this,'FacturasCob')" name="boton">
					</td>
					</tr>
										  <tr>
					  	<td align="center" colspan="4"><img src="pics/barra.gif" height="15"></td>
				</tr>
					<tr>
					<td  align="center">
					<img src="pics/pestagna-productos.gif" id="Productos" onClick="Ocultar(this,'Productos')" name="boton"> 					</td>
					  	<td   align="center">
					<img src="pics/pestagna-servicios.gif" id="Servicios" onClick="Ocultar(this,'Servicios')" name="boton">
						</td>
					  	
					  	<td align="center">
					<img src="pics/pestagna-gestionAlm.gif" id="GestionAlm" onClick="Ocultar(this,'GestionAlm')" name="boton"> 					</td>
					<td  align="center" >
					<img src="pics/pestagna-partes.gif" id="Partes" onClick="Ocultar(this,'Partes')" name="boton">
					</td>
					  </tr>
					  <tr>
					  	<td align="center" colspan="4"><img src="pics/barra.gif" height="15"></td>
				</tr>
					  </table>

					
					 
					  <div name="divMostrar" id="divMostrar" >
						
					</div>					
					 <script>	
					  	document.getElementById("divMostrar").innerHTML = contactos;
					  </script>
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