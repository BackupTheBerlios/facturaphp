<?php /* Smarty version 2.6.1, created on 2004-03-24 11:43:40
         compiled from lister_pager.tpl */ ?>
<tr>
<td colspan="<?php echo $this->_tpl_vars['Cols']; ?>
">
<center><?php if (isset($this->_sections['page'])) unset($this->_sections['page']);
$this->_sections['page']['name'] = 'page';
$this->_sections['page']['loop'] = is_array($_loop=$this->_tpl_vars['Paginas']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['page']['show'] = true;
$this->_sections['page']['max'] = $this->_sections['page']['loop'];
$this->_sections['page']['step'] = 1;
$this->_sections['page']['start'] = $this->_sections['page']['step'] > 0 ? 0 : $this->_sections['page']['loop']-1;
if ($this->_sections['page']['show']) {
    $this->_sections['page']['total'] = $this->_sections['page']['loop'];
    if ($this->_sections['page']['total'] == 0)
        $this->_sections['page']['show'] = false;
} else
    $this->_sections['page']['total'] = 0;
if ($this->_sections['page']['show']):

            for ($this->_sections['page']['index'] = $this->_sections['page']['start'], $this->_sections['page']['iteration'] = 1;
                 $this->_sections['page']['iteration'] <= $this->_sections['page']['total'];
                 $this->_sections['page']['index'] += $this->_sections['page']['step'], $this->_sections['page']['iteration']++):
$this->_sections['page']['rownum'] = $this->_sections['page']['iteration'];
$this->_sections['page']['index_prev'] = $this->_sections['page']['index'] - $this->_sections['page']['step'];
$this->_sections['page']['index_next'] = $this->_sections['page']['index'] + $this->_sections['page']['step'];
$this->_sections['page']['first']      = ($this->_sections['page']['iteration'] == 1);
$this->_sections['page']['last']       = ($this->_sections['page']['iteration'] == $this->_sections['page']['total']);
 if ($this->_tpl_vars['Paginas'][$this->_sections['page']['index']]['Selected'] < 1): ?>
	<a link href="<?php echo $this->_tpl_vars['baseurl']; ?>
start=<?php echo $this->_tpl_vars['Paginas'][$this->_sections['page']['index']]['start']; ?>
"><?php echo $this->_tpl_vars['Paginas'][$this->_sections['page']['index']]['Page']; ?>
</a>
<?php else: ?>
	<?php echo $this->_tpl_vars['Paginas'][$this->_sections['page']['index']]['Page']; ?>

<?php endif;  if ($this->_sections['page']['last']):  else: ?>&nbsp;<?php endif;  endfor; endif; ?></center>
</td>
</tr>