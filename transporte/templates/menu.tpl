	
		<table width="90%" class="cajaMenu" cellpadding="3" cellspacing="0">
			<tr>
			  <td class="cabeceraMenu" colspan="2">.:Men&uacute; principal:.</td>
			 <!-- <td colspan="2"><img src="pics/menuPrincipal.gif"></td>-->
			</tr>
			<tr class="textoMenu">
			  <td width="10px">&nbsp;</td>
			  {php}
			  if(!isset($_SESSION['ident_corp']))
			  {
			  {/php}
			  <td>
			  	- <a href="index.php?" class="enlaceMenu">Inicio</a><br>
			  </td>
			  {php}
			  }
			  else
			  {
			  {/php}
			  
				  <td>
				  	- <a href="index.php?module=user_corps" class="enlaceMenu">Inicio</a><br>
				  </td>
			  {php}
			  }
			  {/php}
			</tr>
			{php}
				$module = new modules();
				$num = $module->get_list_public_modules();
				$i=0;
				while($i!=$num)
				{
				{/php}
				
					<tr class="textoMenu">
					<td width="10px">&nbsp;</td>
					<td>
				{php}
				
					$href ='- <a href ="index.php?module='.$module->public_modules[$i][0].'" class="enlaceMenu">';
				
				
					print $href;
					 print $module->public_modules[$i][2];{/php}
					</a><br></td></tr>
				
				{php}
					
					$i++;
					
				}

			{/php}
			
		</table>
		<br>
