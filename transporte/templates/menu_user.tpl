		<table width="90%" class="cajaMenu" cellpadding="3" cellspacing="0">
			<tr>
			  <td class="cabeceraMenu" colspan="2">.:Men&uacute; principal:.</td>
			 <!-- <td colspan="2"><img src="pics/menuPrincipal.gif"></td>-->
			</tr>
			
			<tr class="textoMenu">
			<td width="10px">&nbsp;</td>
			<td>
			- <a href="index.php?module=user_corps" class="enlaceMenu">Inicio</a><br></td></tr>
					
			{section name="indice" loop=$public_modules}
				<tr class="textoMenu">
					<td width="10px">&nbsp;</td>
					<td>
					- <a href={$public_modules[indice].path} class="enlaceMenu">{$public_modules[indice].name_web}</a>
					<br></td></tr>			
			{/section}		
					
			
			
			{section name="indice" loop=$modules_list}
				{if $modules_list[indice].parent == 0}
				<tr class="textoMenu">
					<td width="10px">&nbsp;</td>
					<td>
					- <a href={$modules_list[indice].path} class="enlaceMenu">{$modules_list[indice].name_web}</a>
					<br></td></tr>	
				{/if}	
			{section name="indice1" loop=$modules_list}
				
					{if $modules_list[indice1].parent == $modules_list[indice].id_module}
					<tr class="textoMenu">
					<td width="10px">&nbsp;</td>
					<td>
					&nbsp;&nbsp;&nbsp;- <a href={$modules_list[indice1].path} class="enlaceMenu">{$modules_list[indice1].name_web}</a>
					<br></td></tr>	
					{/if}		
			{/section}				
			{/section}	
		
			
			
					
			
		</table>
		<br>
		
		
		