<td valign="top"><form>
<script src="inc/tbl_change.js" type="text/javascript" language="javascript"></script>
	 <table align="center" width="100%">
	<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						<img src="pics/clientesico.png" width="32" height="32">
						 <!--<img src="pics/usuariosico.png" width="32" height="32">-->
						</td>
						<td width="93%" valign="middle"  nowrap>Alta/Modificaci&oacute;n de empleados </td>
				</tr>
			  </table>
						<br>
	<table align="center" width="90%"><tr><td width ="40%"valign="top">
		<input type="hidden" name="id_emps">
		<input type="hidden" name="id_corp">
		<input type="hidden" name="id_user">

		<table width="250px" align="center">

					 <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos del empleado:</td>
				  </tr>
				  <tr>
						<td width="125" align="right" class="CampoFormulario">Nombre:</td>
						<td> <input type="text" id="name" name="name" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125" class="CampoFormulario" >Primer apellido: </td>
						<td > <input type="text" id="last_name" name="last_name" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Segundo apellido:</td>
						<td > <input type="text" id="last_name" name="last_name2" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125" class="CampoFormulario" nowrap>Fecha de nacimiento:</td>
						<td > <!--<input type="text" id="last_name" name="birthday" class="textoMenu">-->						
				 <input class="textoMenu" type="text" name="fields[multi_edit][0][up]" value="0000-00-00" size="20" maxlength="99" class="textfield" onchange="return unNullify('up', '0')" id="birthday"/>
                                    <script type="text/javascript">
                    <!--
                    document.write('<a title="Calendario" href="javascript:openCalendar(\'lang=es-utf-8&amp;server=1\', \'insertForm\', \'birthday\', \'date\')"><img class="calendar" src="pics/calendar.png" alt="Calendario"/></a>');
                    //-->
                    </script>
		    
						
						</td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Direcci&oacute;n:</td>
						<td > <input type="text" id="last_name" name="address" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">C&oacute;digo postal:</td>
						<td > <input type="text" id="last_name" name="postal_code" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Localidad:</td>
						<td > <input type="text" id="last_name" name="city" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Provincia:</td>
						<td > <input type="text" id="last_name" name="state" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Pa&iacute;s:</td>
						<td > <input type="text" id="last_name" name="country" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Tel&eacute;fono:</td>
						<td > <input type="text" id="last_name" name="phone" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Tel&eacute;fono m&oacute;vil:</td>
						<td > <input type="text" id="last_name" name="mobile_phone" class="textoMenu"></td>
				 </tr>
				<tr>
						<td width="125" class="CampoFormulario">Fax:</td>
						<td > <input type="text" id="last_name" name="fax" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">E-mail:</td>
						<td > <input name="mail" type="text" class="textoMenu" id="mail"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Categoria:</td>
						<td><select name="category">
						  <option>Administrador</option>
						  <option>Conductores</option>
						  <option>Nuevo...</option>
						</select></td>
				 </tr>
				</table>
			
			</td>
			<td width="60%" valign="top"><table width="250px" align="center">

					<table width="250px" align="center">

					<tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos de Login:</td>
				  </tr>
					<tr>
						<td width="125px" align="right" class="CampoFormulario" nowrap>Login:</td>
						<td > <input type="text" id="{$usuarios->ddbb_login}" name="{$usuarios->ddbb_login}" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125px" class="CampoFormulario">Password:</td>
						<td > <input type="password" id="{$usuarios->ddbb_passwd}" name="{$usuarios->ddbb_passwd}" class="textoMenu"></td>
				  </tr>
				  <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos del Usuario:</td>
				  </tr>
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Nombre:</td>
						<td> <input type="text" id="{$usuarios->ddbb_name}" name="{$usuarios->ddbb_name}" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125px" class="CampoFormulario" >Primer Apellido:</td>
						<td > <input type="text" id="{$usuarios->ddbb_last_name}" name="{$usuarios->ddbb_last_name}" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">Segundo Apellido:</td>
						<td > <input type="text" id="{$usuarios->ddbb_last_name2}" name="{$usuarios->ddbb_last_name2}" class="textoMenu"></td>
				  </tr>
				   <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Permisos: </td>
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
				 <tr>
						  <td colspan="2" class="cabeceraCampoFormulario">Grupos: </td>
				</tr>
				<tr class="cabeceraMultiLinea">
					<td width="100%" colspan="2">Grupos</td>				
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
				
				<table width="90%" align="center" border="0">
				 <tr>
						  <td colspan="2" class="cabeceraCampoFormulario">Permisos por modulos-metodos: </td>
				</tr>
				<tr class="cabeceraMultiLinea">
					<td width="30%">Nombre de Modulo</td>
					<td Colspan="4" width="70%">Metodos</td>
				</tr>
				
				{php}
					$linea = 0;
				{/php}
				{section name="indice" loop=$modulos->per_modules}
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
	
					{if $modulos->per_modules[indice]->per==1}
						<td nowrap><input type="checkbox" name="modulo_{$modulos->per_modules[indice]->id_module}" value="1" onClick="selectRow()" checked> {$modulos->per_modules[indice]->module_name}</td> 
					{else}
						<td nowrap><input type="checkbox" name="modulo_{$modulos->per_modules[indice]->id_module}" value="1" onClick="selectRow()"> {$modulos->per_modules[indice]->module_name}</td> 				
					{/if}
					<td nowrap>						
						<table width="100%"><tr class="{php}print($clase);{/php}">				
						 {section name="j" loop=$modulos->per_modules[indice]->per_methods}
							{if $modulos->per_modules[indice]->per_methods[j]->per==1}
								<td width="20%"><input type="checkbox" name="modulo_{$modulos->per_modules[indice]->id_module}_metodo_{$modulos->per_modules[indice]->per_methods[j]->id_method}" value="1" checked>{$modulos->per_modules[indice]->per_methods[j]->method_name_web}</td>
							{else}
								<td width="20%"><input type="checkbox" name="modulo_{$modulos->per_modules[indice]->id_module}_metodo_{$modulos->per_modules[indice]->per_methods[j]->id_method}" value="1">{$modulos->per_modules[indice]->per_methods[j]->method_name_web}</td>
							{/if}
						{/section}   
						</tr></table>
					</td>				
					</tr>				
				{/section}
				<tr  class="cabeceraMultiLinea"><td colspan="2">&nbsp;</td></tr>
				</table>												
			</td>
			</tr>
			</table>
		</td>
		</tr>				
		<tr>
			<td align="center"><br><br><input type="submit" name="enviar" value="A&ntilde;adir/Modificar" class="botones">
			<input type="reset" Value="Borrar Datos" class="botones">
			</td>
		</tr>
	  	</table> 
		</form></td>