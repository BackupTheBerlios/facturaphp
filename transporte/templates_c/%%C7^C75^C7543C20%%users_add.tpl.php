<?php /* Smarty version 2.6.3, created on 2004-08-27 12:19:43
         compiled from users_add.tpl */ ?>
<td valign="top">
<form method="post" action="index.php?module=users&method=add">
	  	<table align="center" width="100%">
		<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						 <img src="pics/usuariosico.png" width="32" height="32">
						</td>
						<td width="93%" valign="middle"  nowrap>Alta de usuarios</td>
			  </tr>
		  </table>
						<br>
		<table width="250px" align="center">

					<tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos de Login:</td>
				  </tr>
					<tr>
						<td width="125px" align="right" class="CampoFormulario" nowrap>Login:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_login; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_login; ?>
" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125px" class="CampoFormulario">Password:</td>
						<td > <input type="password" id="<?php echo $this->_tpl_vars['objeto']->ddbb_passwd; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_passwd; ?>
" class="textoMenu"></td>
				  </tr>
				  <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos del Usuario:</td>
				  </tr>
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Nombre:</td>
						<td> <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_name; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_name; ?>
" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125px" class="CampoFormulario" >Primer Apellido:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_last_name; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_last_name; ?>
" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">Segundo Apellido:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_last_name2; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_last_name2; ?>
" class="textoMenu"></td>
				  </tr>
				   <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Otros datos: </td>
				  </tr>
				  <tr>
				  	<!--
					Colocarlo de forma que quede igual que con los listados de permisos más abajo puestos
					<td colspan="2"><table border="0">
						
						</table></td>-->
						<td width="125px" class="CampoFormulario">Grupo:</td>
						<td > <select class="textoMenu" id="<?php echo $this->_tpl_vars['objeto']->ddbb_id_group; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_id_group; ?>
">
							<?php if (count($_from = (array)$this->_tpl_vars['groups_list'])):
    foreach ($_from as $this->_tpl_vars['group_element']):
?>
								<option value="<?php echo $this->_tpl_vars['group_element']->id_group; ?>
"><?php echo $this->_tpl_vars['group_element']->name_web; ?>
</option>
							<?php endforeach; unset($_from); endif; ?>							
						</select></td>
				  </tr>
				</table>
</td>
		</tr>		
		<tr>

			<td valign="top">
			<br>
				<table width="75%" align="center" border="0">
				<tr class="cabeceraMultiLinea">
					<td width="40%">Nombre de Modulo
					</td>
					<td Colspan="4" width="60%">Permisos</td>
				</tr>
			<?php 
				$linea=0;
			 ?>
			<?php if (count($_from = (array)$this->_tpl_vars['modules_list'])):
    foreach ($_from as $this->_tpl_vars['module_element']):
?>
				<?php if ($this->_tpl_vars['linea'] == 0): ?>
				<tr class="multiLinea1">
					<?php 
							$linea=1;
					 ?>
				<?php else: ?>
				<tr class="multiLinea2">
					<?php 
							$linea=0;
					 ?>
				<?php endif; ?>
				
					<td width="40%" nowrap><input type="checkbox" id="<?php echo $this->_tpl_vars['module_element']->id_module; ?>
" name="<?php echo $this->_tpl_vars['module_element']->name; ?>
" value="<?php echo $this->_tpl_vars['module_element']->id_module; ?>
"> 
					<?php echo $this->_tpl_vars['module_element']->name_web; ?>
 </td>

				<?php if (count($_from = (array)$this->_tpl_vars['methods_list'])):
    foreach ($_from as $this->_tpl_vars['method_element']):
?>
					<td width="15%"  nowrap><input type="checkbox" id="<?php echo $this->_tpl_vars['method_element']->id_method; ?>
" name="<?php echo $this->_tpl_vars['module_element']->name; ?>
_<?php echo $this->_tpl_vars['method_element']->name; ?>
" value="<?php echo $this->_tpl_vars['method_element']->id_method; ?>
">
			        Listar</td>
				<?php endforeach; unset($_from); endif; ?>
					<!--
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> A&ntilde;adir</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Modificar</td>

					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Borrar</td>
					-->
				</tr>
			<?php endforeach; unset($_from); endif; ?>
<!--
				<tr class="multiLinea2">
					<td width="40%" nowrap><input type="checkbox" name="checkbox" value="checkbox"> 
					Camiones</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox">
				     Listar</td>

					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> A&ntilde;adir</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Modificar</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Borrar</td>
				</tr>			
				<tr class="multiLinea1">
					<td width="40%" nowrap><input type="checkbox" name="checkbox" value="checkbox"> 
					Nominas </td>

					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox">
				     Listar</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> A&ntilde;adir</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Modificar</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Borrar</td>

				</tr>	
				<tr class="multiLinea2">
					<td width="40%" nowrap><input type="checkbox" name="checkbox" value="checkbox"> 
					Clientes</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox">
				     Listar</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> A&ntilde;adir</td>

					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Modificar</td>
					<td width="15%"  nowrap><input type="checkbox" name="checkbox" value="checkbox"> Borrar</td>
				</tr>		-->
			</table>			</td>
		</tr>
		<tr>
			<td align="center"><br><br><input type="submit" name="enviar" value="A&ntilde;adir/Modificar" class="botones">

			<input type="reset" Value="Borrar Datos" class="botones">
			</td>
		</tr>
	  	</table> 
	</form>
</td>