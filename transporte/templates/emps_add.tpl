<td valign="top">
<script>
{literal}
function enableDisable(value){
	if (value=='exist')
		action=true;
	else
		action=false;
	//Deshabilitamos/Habilitamos la lista desplegable
	document.getElementById("existUser").disabled = !(action);
	//Deshabilitamos/Habilitamos los campos de texto de usuarios
	document.getElementById("user_login").disabled = action;
	document.getElementById("user_passwd").disabled = action;
	document.getElementById("user_name").disabled = action;
	document.getElementById("user_last_name").disabled = action;
	document.getElementById("user_last_name2").disabled = action;
	//Deshabilitamos/Habilitamos los botones de las checkbox
	document.getElementById("selectAll").disabled = action;
	document.getElementById("unselectAll").disabled = action;
	
	for (var i=0;i<document.forms["form_central"].elements.length;i++){
			if(document.forms["form_central"].elements[i].type=="checkbox"){
				document.forms["form_central"].elements[i].disabled=action;
				}
		}
}

function hola(){
	alert(document.getElementById("birthday").value);
}

{/literal}
</script>
{include file = checkbox.tpl}

<form method="post" action="index.php?module=emps&method=add" name="form_central">
<script src="inc/calendar.js" type="text/javascript" language="javascript"></script>
	 <table align="center" width="100%">
	<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						<img src="pics/clientesico.png" width="32" height="32">
						 <!--<img src="pics/usuariosico.png" width="32" height="32">-->
						</td>
						<td width="93%" valign="middle"  nowrap>A&ntilde;adir empleado</td>
				</tr>
			  </table>
						<br>
	<table align="center" width="90%"><tr><td width ="40%"valign="top">
		<tr><td>
<!--		<input type="hidden" name="id_emps">
		<input type="hidden" name="id_corp">
		<input type="hidden" name="id_user">-->
		<table width="250px" align="center">

					 <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos del empleado:</td>
				  </tr>
				  <tr>
						<td width="125" align="right" class="CampoFormulario">Nombre:</td>
						<td> <input type="text" id="{$objeto->ddbb_name}" name="{$objeto->ddbb_name}" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125" class="CampoFormulario" >Primer apellido: </td>
						<td > <input type="text" id="{$objeto->ddbb_last_name}" name="{$objeto->ddbb_last_name}" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Segundo apellido:</td>
						<td > <input type="text" id="{$objeto->ddbb_last_name2}" name="{$objeto->ddbb_last_name2}" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125" class="CampoFormulario" nowrap>Fecha de nacimiento:</td>
						<td > <!--<input type="text" id="birthday"  name="fields[multi_edit][0][up]" class="textoMenu">-->						
				 <input class="textoMenu" type="text" name="dateChanged" value="00-00-0000" "size="15" maxlength="99" class="textfield" onchange="alert(this.value)" id="dateChanged" readonly>
				 <input class="textoMenu" type="hidden" name="{$objeto->ddbb_birthday}" value="0000-00-00" size="15" maxlength="99" class="textfield" onchange="alert(this.value)" id="{$objeto->ddbb_birthday}">
                                    <script type="text/javascript">
                                    
                    <!--
                    document.write('<a title="Calendario" href="javascript:openCalendar(\'lang=es-utf-8&amp;server=1\', \'form_central\', \'{$objeto->ddbb_birthday}\', \'dateChanged\', \'date\')"><img class="calendar" valign="center" src="pics/calendar.png" alt="Calendario"/></a>');
                    //-->
                    </script>
		    
						
						</td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Direcci&oacute;n:</td>
						<td > <input type="text" id="{$objeto->ddbb_address}" name="{$objeto->ddbb_address}" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">C&oacute;digo postal:</td>
						<td > <input type="text" id="{$objeto->ddbb_postal_code}" name="{$objeto->ddbb_postal_code}" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Localidad:</td>
						<td > <input type="text" id="{$objeto->ddbb_city}" name="{$objeto->ddbb_city}" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Provincia:</td>
						<td > <input type="text" id="{$objeto->ddbb_state}" name="{$objeto->ddbb_state}" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Pa&iacute;s:</td>
						<td > <input type="text" id="{$objeto->ddbb_country}" name="{$objeto->ddbb_country}" class="textoMenu"></td>
				 </tr>
				 
				</table>
			
			</td>
			<td width ="60%"valign="top">
			<table width="250px" align="center">
			<tr><td cospan="2" class="cabeceraCampoFormulario"></td></tr>
			 <tr>
						<td width="125" class="CampoFormulario">Tel&eacute;fono:</td>
						<td > <input type="text" id="{$objeto->ddbb_phone}" name="{$objeto->ddbb_phone}" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Tel&eacute;fono m&oacute;vil:</td>
						<td > <input type="text" id="{$objeto->ddbb_mobile_phone}" name="{$objeto->ddbb_mobile_phone}" class="textoMenu"></td>
				 </tr>
				<tr>
						<td width="125" class="CampoFormulario">Fax:</td>
						<td > <input type="text" id="{$objeto->ddbb_fax}" name="{$objeto->ddbb_fax}" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">E-mail:</td>
						<td > <input name="{$objeto->ddbb_mail}" type="text" class="textoMenu" id="{$objeto->ddbb_mail}"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Categoria:</td>
						<td><select name="category">
						{section name="indice" loop=$categorias}
						  <option value="{$categorias[indice].id_cat_emp}">{$categorias[indice].name}</option>						 
						  {/section}
						</select></td>
				 </tr>
			</table>
			<br>
			<table  width="250px" align="center">
			<tr class="textoMenu" align="center"><td>
				<input type="radio" checked name="user" id="user_exist" value="exist" onChange="enableDisable(this.value)"> Escoger un usuario existente
			</td></tr>
			<tr class="class="textoMenu" align="center"><td><select name="existUser" id="existUser">
						{section name="indice" loop=$listado_usuarios}
						  <option value="{$listado_usuarios[indice].id_user}">{$listado_usuarios[indice].login} :: {$listado_usuarios[indice].name} {$listado_usuarios[indice].last_name} {$listado_usuarios[indice].last_name2}</option>
					  {/section}
						</select></td>
			</tr>
			<tr class="textoMenu" align="center"><td>
				<input type="radio" name="user" id="new_user" value="new" onChange="enableDisable(this.value)"> Crear un nuevo usuario
			</td></tr>
			</table>
			</td>
</tr>	
		<tr>
		<td colspan="2">
		
		
		
		
		<table width="250px" align="center">

					<tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos de Login:</td>
				  </tr>
					<tr>
						<td width="125px" align="right" class="CampoFormulario" nowrap>Login:</td>
						<td > <input type="text" id="user_login{$objeto->ddbb_login}" name="{$objeto->ddbb_login}" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125px" class="CampoFormulario">Password:</td>
						<td > <input type="password" id="user_passwd{$objeto->ddbb_passwd}" name="{$objeto->ddbb_passwd}" class="textoMenu"></td>
				  </tr>
				  <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos del Usuario:</td>
				  </tr>
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Nombre:</td>
						<td> <input type="text" id="user_name"name="{$objeto->ddbb_name}" name="{$objeto->ddbb_name}" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125px" class="CampoFormulario" >Primer Apellido:</td>
						<td > <input type="text" id="user_last_name"name="{$objeto->ddbb_last_name}" name="{$objeto->ddbb_last_name}" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">Segundo Apellido:</td>
						<td > <input type="text" id="user_last_name2"name="{$objeto->ddbb_last_name2}" name="{$objeto->ddbb_last_name2}" class="textoMenu"></td>
				  </tr>
				   <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Permisos: </td>
				  </tr>
				  <tr>
				  	<td colspan="2">
				  		<input type="button" Value="Seleccionar Todos" id="selectAll" class="botones" onClick="selectAll();">
					<input type="button" Value="Deseleccionar Todos" id="unselectAll" class="botones" onClick="unselectAll();">
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
		<script>enableDisable('exist');</script>
		</td>
		</tr>	
		
		

		
		






		</td>
		</tr>
		<tr>
			<td align="center" colspan="2"><br><br><input type="submit" name="enviar" value="A&ntilde;adir" class="botones">
			<input type="reset" Value="Borrar Datos" class="botones">
			</td>
		</tr>
	  	</table> </td></tr></table>
		</form></td>