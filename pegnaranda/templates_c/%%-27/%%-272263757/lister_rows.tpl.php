<?php /* Smarty version 2.6.1, created on 2004-03-24 11:43:40
         compiled from lister_rows.tpl */ ?>
<tr>
<?php if (isset($this->_sections['campo'])) unset($this->_sections['campo']);
$this->_sections['campo']['name'] = 'campo';
$this->_sections['campo']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['campo']['show'] = true;
$this->_sections['campo']['max'] = $this->_sections['campo']['loop'];
$this->_sections['campo']['step'] = 1;
$this->_sections['campo']['start'] = $this->_sections['campo']['step'] > 0 ? 0 : $this->_sections['campo']['loop']-1;
if ($this->_sections['campo']['show']) {
    $this->_sections['campo']['total'] = $this->_sections['campo']['loop'];
    if ($this->_sections['campo']['total'] == 0)
        $this->_sections['campo']['show'] = false;
} else
    $this->_sections['campo']['total'] = 0;
if ($this->_sections['campo']['show']):

            for ($this->_sections['campo']['index'] = $this->_sections['campo']['start'], $this->_sections['campo']['iteration'] = 1;
                 $this->_sections['campo']['iteration'] <= $this->_sections['campo']['total'];
                 $this->_sections['campo']['index'] += $this->_sections['campo']['step'], $this->_sections['campo']['iteration']++):
$this->_sections['campo']['rownum'] = $this->_sections['campo']['iteration'];
$this->_sections['campo']['index_prev'] = $this->_sections['campo']['index'] - $this->_sections['campo']['step'];
$this->_sections['campo']['index_next'] = $this->_sections['campo']['index'] + $this->_sections['campo']['step'];
$this->_sections['campo']['first']      = ($this->_sections['campo']['iteration'] == 1);
$this->_sections['campo']['last']       = ($this->_sections['campo']['iteration'] == $this->_sections['campo']['total']);
?>
<td class="restrow">
	<?php echo $this->_tpl_vars['data'][$this->_sections['campo']['index']]; ?>

</td>
<?php endfor; endif; ?>
<td class="restrow"><?php echo $this->_tpl_vars['options']; ?>
</td>
</tr>