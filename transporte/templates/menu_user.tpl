		<table width="90%" class="cajaMenu" cellpadding="3" cellspacing="0">
			<tr>
			  <td class="cabeceraMenu" colspan="2">.:Men&uacute; principal:.</td>
			 <!-- <td colspan="2"><img src="pics/menuPrincipal.gif"></td>-->
			</tr>
			<tr class="textoMenu">
			  <td width="10px">&nbsp;</td>
			  <td>
			  	- <a href="index.php?module=user_corps" class="enlaceMenu">Inicio</a><br>
			  </td>
			</tr>
			
			<tr class="textoMenu">
			  <td width="10px">&nbsp;</td>
			  <td>
			  	- <a href="index.php?module=news" class="enlaceMenu">Noticias</a><br>
			  </td>
			</tr>
			<tr class="textoMenu">
			  <td width="10px">&nbsp;</td>
			  <td>
			  	- <a href="index.php?module=contact" class="enlaceMenu">Contacto</a><br>
			  </td>
			</tr>		
			<tr class="textoMenu">
			  <td width="10px">&nbsp;</td>
			  <td>
			  	- <a href="index.php?module=products" class="enlaceMenu">Productos</a><br>
			  </td>
			</tr>
			<tr class="textoMenu">
			  <td width="10px">&nbsp;</td>
			  <td>
			  	- <a href="index.php?module=services" class="enlaceMenu">Servicios</a><br>
			  </td>
			</tr>
			{section name="i" loop=$user_menu->per_modules}
				{if $user_menu->per_modules[i]->per==1}
					<tr class="textoMenu">
						<td width="10px">&nbsp;</td>
								{if $user_menu->per_modules[i]->module_name == 'usuarios'}	
										<td>
										- <a href="index.php?module=users" class="enlaceMenu">Usuarios</a><br>
										</td></tr>
										
								{/if}
								{if $user_menu->per_modules[i]->module_name == 'clientes'}	
									<td>
									- <a href="index.php?module=clients" class="enlaceMenu">Clientes</a><br>
									</td></tr>
								{/if}
					        
				{/if}
			{/section}
		</table>
		<br>
		