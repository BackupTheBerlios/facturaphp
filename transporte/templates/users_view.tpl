<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						<img src="pics/clientesico.png" width="32" height="32">
						 <!--<img src="pics/usuariosico.png" width="32" height="32">-->
						</td>
						<td width="93%" valign="middle" nowrap>Detalle de usuarios </td>
				</tr>
			  </table>
				<br>
				<TABLE width="95%" align="center">
					<tr class="cabeceraMultiLinea">
						<td width="50%" height="23" nowrap>Identificador de Usuario: {$objeto->id_user}
						</td>
						<td nowrap width="50%">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<table width="90%" align="center">
                              <tr height="15px">
                                <td width="25%"  nowrap class="camposVistas">Login:</td>
                                <td nowrap width="25%" class="datosVista">{$objeto->login}</td>
								<td height="21" nowrap class="camposVistas">Contrase&ntilde;a:</td>
                                <td nowrap class="datosVista"> {$objeto->passwd}</td>
                                
                              </tr>
                              
                              <tr height="15px">
                                <td width="25%" nowrap class="camposVistas">Nombre:</td>
                                <td width="25%" nowrap class="datosVista">{$objeto->name}</td>
								 <td width="25%"  nowrap class="camposVistas">Primer Apellido: </td>
                                 <td width="25%" class="datosVista">{$objeto->last_name}</td>
                                
                              </tr>
                              <tr height="15px">                                <td height="21" nowrap class="camposVistas">Segundo Apellido: </td>
                                <td nowrap class="datosVista">{$objeto->last_name2}</td>
								<td><table align="center">
								<tr><td>
								<a href="index.php?module=users&method=modify&id={$objeto->id_user}"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="index.php?module=users&method=delete&id={$objeto->id_user}"><img src="pics/btnborrar.gif" border="0" onClick="confirm('¿Desea borrar este registro?\nSi pulsa Sí se borrarán tambien los registros relacionados con este cliente (p.ej: datos de usuario)')"></a></td>
								</tr>
								</table></td>
								<td></td>
                              </tr>
                            </table>
							<br>
							<p align="center" class="cabeceraCampoFormulario">Listados de por m&oacute;dulos y grupos</p>
							<br>
							
					  <table align="center" width="400" cellspacing="0" cellpadding="0">
					  <tr>
					  	<td width="50%" align="center">
					<img src="pics/pestagna-modulossobre.gif" width="71" height="23"  name="boton" id="Modulos" onClick="Ocultar(this,'Modulos')"> 					</td>
					  	<td width="50%"  align="center">
					<img src="pics/pestagna-grupos.gif" width="71" height="23" id="Grupos" name="boton" onClick="Ocultar(this,'Grupos')">
						</td>
					  	
					  </tr>
					  	<td align="center" colspan="2"><img src="pics/barra.gif"></td>
					  </table>

					  <br>
					 
					  <div name="divMostrar" id="divMostrar" >
						
					</div>					
					 <script>	
					  	document.getElementById("divMostrar").innerHTML = modulos;
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
					
				</TABLE><!--
                  <input type="hidden" name="id_client">
                          <input type="hidden" name="id_corp">

						<table width="250px" align="center">

					 <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos del Cliente:</td>
				  </tr>
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Nombre:</td>
						<td> <input type="text" id="name" name="name" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125px" class="CampoFormulario" >Nombre completo:</td>
						<td > <input type="text" id="full_name" name="full_name" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">CIF/NIF:</td>
						<td > <input type="text" id="last_name" name="cif_nif" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">Direcci&oacute;n:</td>
						<td > <input type="text" id="last_name" name="address" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">Direcci&oacute;n fiscal:</td>
						<td > <input type="text" id="last_name" name="fiscal_address" class="textoMenu"></td>
				 </tr>
				  <tr>
				    <td class="CampoFormulario">Direcci&oacute;n postal: </td>
				    <td ><input type="text" id="fiscal_address" name="postal_address" class="textoMenu"></td>
			    </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">C&oacute;digo postal:</td>
						<td > <input type="text" id="last_name" name="postal_code" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">Localidad:</td>
						<td > <input type="text" id="last_name" name="city" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">Provincia:</td>
						<td > <input type="text" id="last_name" name="state" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">Pa&iacute;s:</td>
						<td > <input type="text" id="last_name" name="country" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">Tel&eacute;fono:</td>
						<td > <input type="text" id="last_name" name="phone" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">Tel&eacute;fono m&oacute;vil:</td>
						<td > <input type="text" id="last_name" name="mobile_phone" class="textoMenu"></td>
				 </tr>
				<tr>
						<td width="125px" class="CampoFormulario">Fax:</td>
						<td > <input type="text" id="last_name" name="fax" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">URL:</td>
						<td > <input type="text" id="last_name" name="url" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">E-mail:</td>
						<td > <input name="mail" type="text" class="textoMenu" id="last_name"></td>
				 </tr>
 				  <tr>
						<td width="125px" class="CampoFormulario">Notas:</td>
						<td >&nbsp; </td>
				 </tr>
				 <tr><td colspan="2"><textarea name="notes" cols="28" rows="2" id="notes"></textarea></td></tr>
				</table>-->
			</td>