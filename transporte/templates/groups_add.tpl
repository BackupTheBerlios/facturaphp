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
						<td width="93%" valign="middle"  nowrap>Alta de grupos</td>
			  </tr>
		  </table>
						<br>
		<table width="250px" align="center">

					<tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos del grupo :</td>
				  </tr>
					<tr>
						<td width="125" align="right" class="CampoFormulario" nowrap>Nombre:</td>
						<td > <input type="text" id="{$objeto->ddbb_name}" name="{$objeto->ddbb_name}" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125" class="CampoFormulario">Nombre web: </td>
						<td > <input type="password" id="{$objeto->ddbb_name_web}" name="{$objeto->ddbb_name_web}" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125" align="right" class="CampoFormulario">Descripcion:</td>
						<td rowspan="2" ><textarea name="{$objeto->ddbb_descrip}" class="textoMenu" id="{$objeto->ddbb_descrip}"></textarea> </td>
					</tr>
					<tr>						
						<td >&nbsp;</td>
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
			{php}
				$linea=0;
			{/php}
			{foreach from=$modules_list item=module_element}
				{if $linea==0}
				<tr class="multiLinea1">
					{php}
							$linea=1;
					{/php}
				{else}
				<tr class="multiLinea2">
					{php}
							$linea=0;
					{/php}
				{/if}
				
					<td width="40%" nowrap><input type="checkbox" id="{$module_element->id_module}" name="{$module_element->name}" value="{$module_element->id_module}"> 
					{$module_element->name_web} </td>

				{foreach from=$methods_list item=method_element}
					<td width="15%"  nowrap><input type="checkbox" id="{$method_element->id_method}" name="{$module_element->name}_{$method_element->name}" value="{$method_element->id_method}">
			        Listar</td>
				{/foreach}
					<!--
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> A&ntilde;adir</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Modificar</td>

					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Borrar</td>
					-->
				</tr>
			{/foreach}
<!--
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
				</tr>		-->
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