<?php /* Smarty version 2.6.3, created on 2004-09-23 17:20:36
         compiled from users_view.tpl */ ?>
<td valign="top">

	<?php 
		$mi_modulo=$this->_tpl_vars['objeto'];
		echo $this->_tpl_vars['cadena'];	
	 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "capas.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						<img src="pics/clientesico.png" width="32" height="32">
						 <!--<img src="pics/usuariosico.png" width="32" height="32">-->
						</td>
						<td width="93%" valign="middle" nowrap>Detalle de usuarios </td>
				</tr>
			  </table>
				<br>
				<TABLE width="95%" align="center">
					<tr class="cabeceraMultiLinea">
						<td width="50%" height="23" nowrap>Identificador de Usuario: <?php echo $this->_tpl_vars['objeto']->id_user; ?>

						</td>
						<td nowrap width="50%">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<table width="90%" align="center">
                              <tr height="15px">
                                <td width="25%"  nowrap class="camposVistas">Login:</td>
                                <td nowrap width="25%" class="datosVista"><?php echo $this->_tpl_vars['objeto']->login; ?>
</td>
								<td height="21" nowrap class="camposVistas">Contrase&ntilde;a:</td>
                                <td nowrap class="datosVista"> <?php echo $this->_tpl_vars['objeto']->passwd; ?>
</td>
                                
                              </tr>
                              
                              <tr height="15px">
                                <td width="25%" nowrap class="camposVistas">Nombre:</td>
                                <td width="25%" nowrap class="datosVista"><?php echo $this->_tpl_vars['objeto']->name; ?>
</td>
								 <td width="25%"  nowrap class="camposVistas">Primer Apellido: </td>
                                 <td width="25%" class="datosVista"><?php echo $this->_tpl_vars['objeto']->last_name; ?>
</td>
                                
                              </tr>
                              <tr height="15px">                                <td height="21" nowrap class="camposVistas">Segundo Apellido: </td>
                                <td nowrap class="datosVista"><?php echo $this->_tpl_vars['objeto']->last_name2; ?>
</td>
								<td><table align="center">
								<tr><td>
								<a href="index.php?module=users&method=modify&id=<?php echo $this->_tpl_vars['objeto']->id_user; ?>
"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="index.php?module=users&method=delete&id=<?php echo $this->_tpl_vars['objeto']->id_user; ?>
"><img src="pics/btnborrar.gif" border="0" onClick="confirm('¿Desea borrar este registro?\nSi pulsa Sí se borrarán tambien los registros relacionados con este cliente (p.ej: datos de usuario)')"></a></td>
								</tr>
								</table></td>
								<td></td>
                              </tr>
                            </table>
							<br>
							<p align="center" class="cabeceraCampoFormulario">Listados de por m&oacute;dulos y grupos</p>
							<br>
					<a name="listado">
					  <table align="center" width="400" cellspacing="0" cellpadding="0">
					  <tr>
					  	<td width="50%" align="center">
					<img src="pics/pestagna-modulessobre.gif" width="71" height="23"  name="boton" id="modules" onClick="Ocultar(this,'modules_1')"> 					</td>
					  	<td width="50%"  align="center">
					<img src="pics/pestagna-group_users.gif" width="71" height="23" id="group_users" name="boton" onClick="Ocultar(this,'group_users_1')">
						</td>
					  	
					  </tr>
					  	<td align="center" colspan="2"><img src="pics/barra.gif"></td>
					  </table>

					  <br>
					 
					  <div name="divMostrar" id="divMostrar" >
						
					</div>					
					 <script>	
					  	document.getElementById("divMostrar").innerHTML = modules_1;
					  </script>
					  <br>
					  <table align="center" width="400" cellpadding="0" cellspacing="0">
						  <tr><td><img src="pics/barra.gif"></td></tr>
					  </table>
					  <br>
					  
  					  </td>
						
					</tr>
					
					<tr class="cabeceraMultiLinea">
						<td colspan="2">&nbsp;
						</td>
					</tr>
					
				</TABLE>
			</td>