<td valign="top">

	<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
				<tr Class="CabeceraModulo">
						<td width="7%">
                          <img src="pics/buscar.gif" width="32" height="31">						 
                          <!--<img src="pics/usuariosico.png" width="32" height="32">-->
						</td>
						<td width="93%" valign="middle"  nowrap>
						  Borrar usuarios </td>
				</tr>
	</table>
			  <form action="index.php?module=delete&id={$objeto->id_user}">
			  
			  <br>
			  <br>
			  <p>Se va a proceder al borrado del usuario {$objeto->login}</p>
			  <p>Se borrar&aacute;n las relaciones con los grupos a los que pertenezca al igual que los permisos a modulos y metodos en los que esté relacionado</p>
			  <br>
			  {$mensaje}
			  <table align="center"><tr><td align="center"><input type="submit" name="submit_add" id =" name="submit_delete" "value="Borrar" class="botones"></td></tr></table>
			  </form>
			 
	  </td>
