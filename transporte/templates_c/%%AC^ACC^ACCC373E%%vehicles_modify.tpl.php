<?php /* Smarty version 2.6.3, created on 2005-03-22 12:40:54
         compiled from vehicles_modify.tpl */ ?>
<td valign="top">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "checkbox.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form method="post" action="index.php?module=vehicles&method=modify&id=<?php echo $this->_tpl_vars['objeto']->id_vehicle; ?>
" name="form_central" enctype="multipart/form-data">
	  	<table align="center" width="100%">
		<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						 <img src="pics/usuariosico.png" width="32" height="32">
						</td>
						<td width="93%" valign="middle"  nowrap>Modificaci&oacute;n de veh&iacute;culos</td>
								</tr>
						</table>
						<br>
		<table width="250px" align="center">

					<tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos del veh&iacute;culo:</td>
				  </tr>
					<tr>
						<td width="125px" class="CampoFormulario">Alias:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_alias; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_alias; ?>
" class="textoMenu" value="<?php echo $this->_tpl_vars['objeto']->alias; ?>
"><font class="error"><?php echo $this->_tpl_vars['error_alias']; ?>
</font></td>
				  </tr>
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Matr&iacute;cula:</td>
						<td> <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_number_plate; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_number_plate; ?>
" class="textoMenu" value="<?php echo $this->_tpl_vars['objeto']->number_plate; ?>
"><font class="error"><?php echo $this->_tpl_vars['error_number_plate']; ?>
</font></td>
				  </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Categor&iacute;a:</td>
						<td><select name="category">
						<input type="hidden" name="<?php echo $this->_tpl_vars['categoria']->ddbb_id_cat_vehicle; ?>
" id="<?php echo $this->_tpl_vars['categoria']->ddbb_id_cat_vehicle; ?>
" value="<?php echo $this->_tpl_vars['categoria']->id_cat_vehicle; ?>
"}
						<?php unset($this->_sections['indice']);
$this->_sections['indice']['name'] = 'indice';
$this->_sections['indice']['loop'] = is_array($_loop=$this->_tpl_vars['categorias']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['indice']['show'] = true;
$this->_sections['indice']['max'] = $this->_sections['indice']['loop'];
$this->_sections['indice']['step'] = 1;
$this->_sections['indice']['start'] = $this->_sections['indice']['step'] > 0 ? 0 : $this->_sections['indice']['loop']-1;
if ($this->_sections['indice']['show']) {
    $this->_sections['indice']['total'] = $this->_sections['indice']['loop'];
    if ($this->_sections['indice']['total'] == 0)
        $this->_sections['indice']['show'] = false;
} else
    $this->_sections['indice']['total'] = 0;
if ($this->_sections['indice']['show']):

            for ($this->_sections['indice']['index'] = $this->_sections['indice']['start'], $this->_sections['indice']['iteration'] = 1;
                 $this->_sections['indice']['iteration'] <= $this->_sections['indice']['total'];
                 $this->_sections['indice']['index'] += $this->_sections['indice']['step'], $this->_sections['indice']['iteration']++):
$this->_sections['indice']['rownum'] = $this->_sections['indice']['iteration'];
$this->_sections['indice']['index_prev'] = $this->_sections['indice']['index'] - $this->_sections['indice']['step'];
$this->_sections['indice']['index_next'] = $this->_sections['indice']['index'] + $this->_sections['indice']['step'];
$this->_sections['indice']['first']      = ($this->_sections['indice']['iteration'] == 1);
$this->_sections['indice']['last']       = ($this->_sections['indice']['iteration'] == $this->_sections['indice']['total']);
?>
						  <option value="<?php echo $this->_tpl_vars['categorias'][$this->_sections['indice']['index']]['id_cat_vehicle']; ?>
"<?php if ($this->_tpl_vars['categoria']->id_cat_vehicle == $this->_tpl_vars['categorias'][$this->_sections['indice']['index']]['id_cat_vehicle']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['categorias'][$this->_sections['indice']['index']]['name']; ?>
</option>						 
						  <?php endfor; endif; ?>
						</select></td>
				 </tr>
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Fotograf&iacute;a:</td>
						<td><a href="index.php?module=vehicles&method=show&id=<?php echo $this->_tpl_vars['objeto']->id_vehicle; ?>
"><img src="<?php echo $this->_tpl_vars['objeto']->path_photo; ?>
" width="80" height="80"></a></td>
						<td><input type="file" name="<?php echo $this->_tpl_vars['objeto']->ddbb_path_photo; ?>
"></input></td>	
				  </tr>
				
				</table>
		</td>
		</tr>				
		<tr>
			<td align="center"><br><br><input type="submit" name="submit_modify" value="Modificar" class="botones">

			<input type="reset" Value="Borrar Datos" class="botones">
			</td>
		</tr>
	
	  	</table> 
	</form>
</td>