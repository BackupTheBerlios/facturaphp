<td valign="top">
{$cadena}
	{php}
		echo $this->_tpl_vars['cadena'];
	{/php}

{include file=capas.tpl}

	  <table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%"> 
                          <!--<img src="pics/usuariosico.png" width="32" height="32">-->
						</td>
						<td width="93%" valign="middle"  nowrap>
						  Listado sesiones </td>
				</tr>
			  </table>
			  <table width="100%">
			  <tr><td class="message" align="center">{$message}</td></tr>
			  <tr><td valign="top"><form method="post" action="index.php?module=sessions&method=list">
			  	
				</form><br>
				  <div name="divMostrar" id="divMostrar" >
						
					</div>	
					 <script>	
					  	document.getElementById("divMostrar").innerHTML = sessions_1;
					  </script>
			  </td></tr></table>
	  </td>
