<?php /* Smarty version 2.6.3, created on 2004-07-08 01:33:43
         compiled from users.tpl */ ?>
	  	<table width="90%" class="cajaMenu" cellpadding="3" cellspacing="0">
			<tr >
			  <td class="cabeceraMenu">.:Login:.</td>
			</tr>
			<tr class="textoMenuUsuarios">
				<form action="index.php" method=post>
				<td>
				
				<?php if ($this->_tpl_vars['login'] == 1): ?>
				
				<?php if ($this->_tpl_vars['error'] == 1): ?>
				Usuario o contrase&ntilde;a inv&aacute;lidos<br>
				Vuelva a intentarlo<br>
				<?php endif; ?>
				Usuario:<br> 
				<input type="text" class="textoMenuUsuarios"  name="user" id="user"><br>
					
			      Contrase&ntilde;a: <br> <input type="password" class="textoMenuUsuarios" name="passwd" id="pass"><br><br>
				  <input type="submit" name="submit" value="Entrar" class="botones"><br>
				  <a href="#">Recordar su contrase&ntilde;a</a>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['login'] == 0): ?>
				
				Usuario:<br><br><b><?php echo $this->_tpl_vars['user_name']; ?>
</b><br><br> 
				<input type="submit" name="submit" value="Desconectar" class="botones">
			 	<?php endif; ?>
			 	</td>
				</form>
			</tr>
		</table>
		<br>