	  	<table width="90%" class="cajaMenu" cellpadding="3" cellspacing="0">
			<tr >
			  <td class="cabeceraMenu">.:Login:.</td>
			</tr>
			<tr class="textoMenuUsuarios">
				<form action="index.php" method=post>
				<td>
				
				{if $login == 1 }
				
				{if $error == 1}
				Usuario o contrase–a invalidos<br>
				Vuelva a intentarlo<br>
				{/if}
				Usuario:<br> 
				<input type="text" class="textoMenuUsuarios"  name="user" id="user"><br>
					
			      Contrase&ntilde;a: <br> <input type="password" class="textoMenuUsuarios" name="passwd" id="pass"><br><br>
				  <input type="submit" name="submit" value="Entrar" class="botones"><br>
				  <a href="#">Recordar su contrase&ntilde;a</a>
				{/if}
				{if $login == 0 }
				
				Usuario:<br><br><b>Elena</b><br><br> 
				<input type="submit" name="submit" value="Desconectar" class="botones">
			 	{/if}
			 	</td>
				</form>
			</tr>
		</table>
		<br>
