<td valign="top">
	  <table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
                          <img src="pics/buscar.gif" width="32" height="31">						 
                          <!--<img src="pics/usuariosico.png" width="32" height="32">-->
						</td>
						<td width="93%" valign="middle"  nowrap>
						  Buscar usuarios </td>
				</tr>
			  </table>
			  <table width="100%">
			  <tr><td valign="top"><form method="post" action="index.php?module=users&method=view">
			  	<table width="250px" align="center">
				 <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Criterios de b&uacute;squeda:</td>
				  </tr>
					 <tr>
						<td width="125px" class="CampoFormulario">Login:</td>
						<td > <input type="text" id="{$objeto->login}" name="{$objeto->login}" class="textoMenu"></td>
				  </tr>
				  <tr>
					
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Nombre:</td>
						<td> <input type="text" id="{$objeto->name}" name="{$objeto->name}" class="textoMenu"></td>
				</tr>
					<tr>
						<td width="125px" class="CampoFormulario" >Primer apellido:</td>
						<td > <input type="text" id="{$objeto->last_name}" name="{$objeto->last_name}" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125px" class="CampoFormulario" >Segundo apellido:</td>
						<td > <input type="text" id="{$objeto->last_name2}" name="{$objeto->last_name2}" class="textoMenu"></td>
				  </tr>
				    <tr>
						<td width="125" class="CampoFormulario">Nº de Registros por p&aacute;gina:</td>
						<td><select name="Registros">
						  <option selected>10</option>
						  <option>30</option>
						  <option>50</option>
						</select></td>
				 </tr>
				 <tr>
				 	<td align="center" colspan="2"><input type="submit" value="Buscar" name="Submit" class="botones"></td>
				 </tr>
				  </table>
				</form><br>
				  <table align="center">
				  	<tr>
						<td><a href="formularioAltaClientes.htm"><img src="pics/btnNuevo.gif" border="0"></a></td>
					</tr>
				  </table>

				  <table align="center" width="80%">
				  	<tr>
						<td colspan="7" class="cabeceraCampoFormulario">Listado:</td>
					</tr>
							<tr class="cabeceraMultiLinea">
								<td width="20%">Login</td>
								<td width="20%">Nombre</td>
								<td width="20%">Primer apellido </td>
								<td width="20%">Segundo apellido </td>								
								<td width="20%" colspan="3">Acciones</td>
							</tr>
			{php}
				$linea=0;
			{/php}
			{foreach from=$users_list item=user_element}
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
							
								<td>{$user_element->login}</td>
								<td>{$user_element->name}</td>
								<td>{$user_element->last_name}</td>
								<td>{$user_element->last_name2}</td>
								<td><a href="index.php?module=users&method=view&id={$user_element->id_user}"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="index.php?module=users&method=modify&id={$user_element->id_user}"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="index.php?module=users&method=delete&id={$user_element->id_user}"><img src="pics/btnborrar.gif" border="0" onClick="confirm('¿Desea borrar este registro?\nSi pulsa Sí se borrarán tambien los registros relacionados con este cliente (p.ej: datos de usuario)')"></a></td>		
							</tr>
				{/foreach}
<!--
							<tr class="multiLinea2">
								<td>Demetrio</td>
								<td>Daniel</td>
								<td>Gonz&aacute;lez</td>
								<td>Zaballos</td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea1">
								<td>Uni</td>
								<td>Enrique</td>
								<td>Gomez</td>
								<td>Rodriguez</td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea2">
								<td>Public</td>
								<td>Alberto</td>
								<td>Perez</td>
								<td>Carabias</td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea1">
								<td>ElMerch</td>
								<td>Eduardo</td>
								<td>Merch&aacute;n</td>
								<td>Avila</td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea2">
								<td>Talia</td>
								<td>Maria</td>
								<td>Perez</td>
								<td>Blanco</td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea1">
								<td>Mewiwi</td>
								<td>Marta</td>
								<td>Lopez</td>
								<td>Becerro</td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea2">
								<td>Ginger</td>
								<td>Beatriz</td>
								<td>Alonso</td>
								<td>Mart&iacute;n</td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea1">
								<td>Kurgan</td>
								<td>Miguel</td>
								<td>Sanchez</td>
								<td>Gomez</td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea2">
								<td>Flipi</td>
								<td>Alejandro</td>
								<td>Ledesma</td>
								<td>Labrador</td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>		
							</tr>-->
							<tr class="cabeceraMultiLinea">
								<td colspan="7">&nbsp;</td>
							</tr>
						</table>	
  
						<table align="center">
						<tr><td colspan="3" class="cabeceraCampoFormulario">Ir a la página:</td></tr>
						<tr class="NumerosBuscar">
							<td><a href="#">Primera</a></td>
							<td><a href="#">1</a> <a href="#">2</a> <b>3</b> <a href="#">4</a> <a href="#">5</a></td>
							<td><a href="#">&Uacute;ltima</a></td>
						</tr>

						</table>
				  
			  </td></tr></table>
	  </td>
