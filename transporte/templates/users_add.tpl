<td valign="top">
<form method="post" action="index.php?module=users&method=add">
	  	<table align="center" width="100%">
		<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						 <img src="pics/usuariosico.png" width="32" height="32">
						</td>
						<td width="93%" valign="middle"  nowrap>Alta/Modificaci&oacute;n de usuarios</td>
								</tr>
						</table>
						<br>
		<table width="250px" align="center">

					<tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos de Login:</td>
				  </tr>
					<tr>
						<td width="125px" align="right" class="CampoFormulario" nowrap>Login:</td>
						<td > <input type="text" id="{$objeto->ddbb_login}" name="{$objeto->ddbb_login}" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125px" class="CampoFormulario">Password:</td>
						<td > <input type="password" id="{$objeto->ddbb_passwd}" name="{$objeto->ddbb_passwd}" class="textoMenu"></td>
				  </tr>
				  <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos del Usuario:</td>
				  </tr>
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Nombre:</td>
						<td> <input type="text" id="{$objeto->ddbb_name}" name="{$objeto->ddbb_name}" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125px" class="CampoFormulario" >Primer Apellido:</td>
						<td > <input type="text" id="{$objeto->ddbb_last_name}" name="{$objeto->ddbb_last_name}" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">Segundo Apellido:</td>
						<td > <input type="text" id="{$objeto->ddbb_last_name2}" name="{$objeto->ddbb_last_name2}" class="textoMenu"></td>
				  </tr>
				   <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Otros datos: </td>
				  </tr>
				  <tr>
				  	<!--
					Colocarlo de forma que quede igual que con los listados de permisos más abajo puestos
					<td colspan="2"><table>
						
						</table></td>-->
						<td width="125px" class="CampoFormulario">Grupo:</td>
						<td > <select class="textoMenu" id="{$objeto->ddbb_id_group}" name="{$objeto->ddbb_id_group}">
							{foreach from=$groups_list item=group_element}
								<option value="{$group_element->id_group}">{$group_element->name_web}</option>
							/foreach}							
						</select></td>
				  </tr>
				</table>
</td>
		</tr>		
		<tr>

			<td valign="top">
			<br>
				<table width="75%" align="center" border="0">
				<tr class="cabeceraMultiLinea">
					<td width="40%">Nombre de Modulo
					</td>
					<td Colspan="4" width="60%">Permisos</td>
				</tr>
				<tr class="multiLinea1">

					<td width="40%" nowrap><input type="checkbox" name="checkbox" value="checkbox"> 
					Usuarios </td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox">
			        Listar</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> A&ntilde;adir</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Modificar</td>

					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Borrar</td>
				</tr>
				<tr class="multiLinea2">
					<td width="40%" nowrap><input type="checkbox" name="checkbox" value="checkbox"> 
					Camiones</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox">
				     Listar</td>

					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> A&ntilde;adir</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Modificar</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Borrar</td>
				</tr>			
				<tr class="multiLinea1">
					<td width="40%" nowrap><input type="checkbox" name="checkbox" value="checkbox"> 
					Nominas </td>

					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox">
				     Listar</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> A&ntilde;adir</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Modificar</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Borrar</td>

				</tr>	
				<tr class="multiLinea2">
					<td width="40%" nowrap><input type="checkbox" name="checkbox" value="checkbox"> 
					Clientes</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox">
				     Listar</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> A&ntilde;adir</td>

					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Modificar</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Borrar</td>
				</tr>		
			</table>			</td>
		</tr>
		<tr>
			<td align="center"><br><br><input type="submit" name="enviar" value="A&ntilde;adir/Modificar" class="botones">

			<input type="reset" Value="Borrar Datos" class="botones">
			</td>
		</tr>
	  	</table> 
	</form>
</td>