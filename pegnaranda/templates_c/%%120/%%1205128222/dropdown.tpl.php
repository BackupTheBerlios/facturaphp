<?php /* Smarty version 2.6.1, created on 2004-03-24 18:38:41
         compiled from dropdown.tpl */ ?>
<select name="<?php echo $this->_tpl_vars['idElemento']; ?>
" class="formulario">
<?php if (isset($this->_sections['Elemento'])) unset($this->_sections['Elemento']);
$this->_sections['Elemento']['name'] = 'Elemento';
$this->_sections['Elemento']['loop'] = is_array($_loop=$this->_tpl_vars['Elementos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['Elemento']['show'] = true;
$this->_sections['Elemento']['max'] = $this->_sections['Elemento']['loop'];
$this->_sections['Elemento']['step'] = 1;
$this->_sections['Elemento']['start'] = $this->_sections['Elemento']['step'] > 0 ? 0 : $this->_sections['Elemento']['loop']-1;
if ($this->_sections['Elemento']['show']) {
    $this->_sections['Elemento']['total'] = $this->_sections['Elemento']['loop'];
    if ($this->_sections['Elemento']['total'] == 0)
        $this->_sections['Elemento']['show'] = false;
} else
    $this->_sections['Elemento']['total'] = 0;
if ($this->_sections['Elemento']['show']):

            for ($this->_sections['Elemento']['index'] = $this->_sections['Elemento']['start'], $this->_sections['Elemento']['iteration'] = 1;
                 $this->_sections['Elemento']['iteration'] <= $this->_sections['Elemento']['total'];
                 $this->_sections['Elemento']['index'] += $this->_sections['Elemento']['step'], $this->_sections['Elemento']['iteration']++):
$this->_sections['Elemento']['rownum'] = $this->_sections['Elemento']['iteration'];
$this->_sections['Elemento']['index_prev'] = $this->_sections['Elemento']['index'] - $this->_sections['Elemento']['step'];
$this->_sections['Elemento']['index_next'] = $this->_sections['Elemento']['index'] + $this->_sections['Elemento']['step'];
$this->_sections['Elemento']['first']      = ($this->_sections['Elemento']['iteration'] == 1);
$this->_sections['Elemento']['last']       = ($this->_sections['Elemento']['iteration'] == $this->_sections['Elemento']['total']);
?>
	<option value="<?php echo $this->_tpl_vars['Elementos'][$this->_sections['Elemento']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['idSel'] == $this->_tpl_vars['Elementos'][$this->_sections['Elemento']['index']]['id']): ?> Selected <?php endif; ?>><?php echo $this->_tpl_vars['Elementos'][$this->_sections['Elemento']['index']]['etiqueta']; ?>
</option>
<?php endfor; endif; ?>
</select>