<?php /* Smarty version 2.6.3, created on 2005-01-11 18:04:07
         compiled from menu_user.tpl */ ?>
		<table width="90%" class="cajaMenu" cellpadding="3" cellspacing="0">
			<tr>
			  <td class="cabeceraMenu" colspan="2">.:Men&uacute; principal:.</td>
			 <!-- <td colspan="2"><img src="pics/menuPrincipal.gif"></td>-->
			</tr>
			
			<tr class="textoMenu">
			<td width="10px">&nbsp;</td>
			<td>
			- <a href="index.php?module=user_corps" class="enlaceMenu">Inicio</a><br></td></tr>
					
			<?php unset($this->_sections['indice']);
$this->_sections['indice']['name'] = 'indice';
$this->_sections['indice']['loop'] = is_array($_loop=$this->_tpl_vars['public_modules']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<tr class="textoMenu">
					<td width="10px">&nbsp;</td>
					<td>
					- <a href=<?php echo $this->_tpl_vars['public_modules'][$this->_sections['indice']['index']]['path']; ?>
 class="enlaceMenu"><?php echo $this->_tpl_vars['public_modules'][$this->_sections['indice']['index']]['name_web']; ?>
</a>
					<br></td></tr>			
			<?php endfor; endif; ?>		
					
			
			
			<?php unset($this->_sections['indice']);
$this->_sections['indice']['name'] = 'indice';
$this->_sections['indice']['loop'] = is_array($_loop=$this->_tpl_vars['modules_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<?php if ($this->_tpl_vars['modules_list'][$this->_sections['indice']['index']]['parent'] == 0): ?>
				<tr class="textoMenu">
					<td width="10px">&nbsp;</td>
					<td>
					- <a href=<?php echo $this->_tpl_vars['modules_list'][$this->_sections['indice']['index']]['path']; ?>
 class="enlaceMenu"><?php echo $this->_tpl_vars['modules_list'][$this->_sections['indice']['index']]['name_web']; ?>
</a>
					<br></td></tr>	
				<?php endif; ?>	
			<?php unset($this->_sections['indice1']);
$this->_sections['indice1']['name'] = 'indice1';
$this->_sections['indice1']['loop'] = is_array($_loop=$this->_tpl_vars['modules_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['indice1']['show'] = true;
$this->_sections['indice1']['max'] = $this->_sections['indice1']['loop'];
$this->_sections['indice1']['step'] = 1;
$this->_sections['indice1']['start'] = $this->_sections['indice1']['step'] > 0 ? 0 : $this->_sections['indice1']['loop']-1;
if ($this->_sections['indice1']['show']) {
    $this->_sections['indice1']['total'] = $this->_sections['indice1']['loop'];
    if ($this->_sections['indice1']['total'] == 0)
        $this->_sections['indice1']['show'] = false;
} else
    $this->_sections['indice1']['total'] = 0;
if ($this->_sections['indice1']['show']):

            for ($this->_sections['indice1']['index'] = $this->_sections['indice1']['start'], $this->_sections['indice1']['iteration'] = 1;
                 $this->_sections['indice1']['iteration'] <= $this->_sections['indice1']['total'];
                 $this->_sections['indice1']['index'] += $this->_sections['indice1']['step'], $this->_sections['indice1']['iteration']++):
$this->_sections['indice1']['rownum'] = $this->_sections['indice1']['iteration'];
$this->_sections['indice1']['index_prev'] = $this->_sections['indice1']['index'] - $this->_sections['indice1']['step'];
$this->_sections['indice1']['index_next'] = $this->_sections['indice1']['index'] + $this->_sections['indice1']['step'];
$this->_sections['indice1']['first']      = ($this->_sections['indice1']['iteration'] == 1);
$this->_sections['indice1']['last']       = ($this->_sections['indice1']['iteration'] == $this->_sections['indice1']['total']);
?>
				
					<?php if ($this->_tpl_vars['modules_list'][$this->_sections['indice1']['index']]['parent'] == $this->_tpl_vars['modules_list'][$this->_sections['indice']['index']]['id_module']): ?>
					<tr class="textoMenu">
					<td width="10px">&nbsp;</td>
					<td>
					&nbsp;&nbsp;&nbsp;- <a href=<?php echo $this->_tpl_vars['modules_list'][$this->_sections['indice1']['index']]['path']; ?>
 class="enlaceMenu"><?php echo $this->_tpl_vars['modules_list'][$this->_sections['indice1']['index']]['name_web']; ?>
</a>
					<br></td></tr>	
					<?php endif; ?>		
			<?php endfor; endif; ?>				
			<?php endfor; endif; ?>	
		
			
			
					
			
		</table>
		<br>
		
		
		