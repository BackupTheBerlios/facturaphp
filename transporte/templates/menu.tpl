	
		<table width="90%" class="cajaMenu" cellpadding="3" cellspacing="0">
			<tr>
			  <td class="cabeceraMenu" colspan="2">.:Men&uacute; principal:.</td>
			 <!-- <td colspan="2"><img src="pics/menuPrincipal.gif"></td>-->
			</tr>
			<tr class="textoMenu">
			  <td width="10px">&nbsp;</td>
			  <td>
			  	- <a href="index.php?" class="enlaceMenu">Inicio</a><br>
			  </td>
			  
			{section name="indice" loop=$public_modules}
				<tr class="textoMenu">
					<td width="10px">&nbsp;</td>
					<td>
					- <a href={$public_modules[indice].path} class="enlaceMenu">{$public_modules[indice].name_web}</a>
					<br></td></tr>			
			{/section}
		</table>
		<br>
