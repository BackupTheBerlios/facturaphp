<td valign="top">

	<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
				<tr Class="CabeceraModulo">
						<td width="7%">
                          <img src="pics/buscar.gif" width="32" height="31">						 
                          <!--<img src="pics/usuariosico.png" width="32" height="32">-->
						</td>
						<td width="93%" valign="middle"  nowrap>
						  Borrar Contactos </td>
				</tr>
	</table>
			  <form method="post" action="index.php?module=contacts&method=delete&id={$objeto->id_contact}">			  
			  
			  <br>
			  <p>Se va a proceder al borrado del Contacto: {$objeto->name} {$objeto->last_name} {$objeto->last_name2}</p>
			  <p>Se borrar&aacute;n las relaciones con las categorias, y altas y bajas a las que pertenezca.</p>
			  {$message}
  			  <br>
			  <table align="center"><tr><td align="center"><input type="submit" name="submit_delete" value="Borrar" class="botones"></td></tr></table>
			  </form>
			 
	  </td>
