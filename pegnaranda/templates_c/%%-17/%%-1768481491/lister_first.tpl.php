<?php /* Smarty version 2.6.1, created on 2004-03-24 11:43:40
         compiled from lister_first.tpl */ ?>
<tr>
<?php if (isset($this->_sections['campo'])) unset($this->_sections['campo']);
$this->_sections['campo']['name'] = 'campo';
$this->_sections['campo']['loop'] = is_array($_loop=$this->_tpl_vars['titles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<th class="hpenaranda" width="<?php echo $this->_tpl_vars['titles'][$this->_sections['campo']['index']]['width']; ?>
">
	<?php echo $this->_tpl_vars['titles'][$this->_sections['campo']['index']]['label']; ?>

	<?php if ($this->_tpl_vars['titles'][$this->_sections['campo']['index']]['sortable'] === true): ?>
	<br>
		<center>
			<font style="font-size:11px;">
				<?php if ($this->_tpl_vars['titles'][$this->_sections['campo']['index']]['sort'] == 'ASC'): ?>
					A/<a link href="<?php echo $this->_tpl_vars['baseurl']; ?>
sf=<?php echo $this->_tpl_vars['titles'][$this->_sections['campo']['index']]['label']; ?>
&up=down">D</a>
				<?php else: ?>
					<?php if ($this->_tpl_vars['titles'][$this->_sections['campo']['index']]['sort'] == 'DESC'): ?>
					<a link href="<?php echo $this->_tpl_vars['baseurl']; ?>
sf=<?php echo $this->_tpl_vars['titles'][$this->_sections['campo']['index']]['label']; ?>
&up=up">A</a>/D
					<?php else: ?>
					<a link href="<?php echo $this->_tpl_vars['baseurl']; ?>
sf=<?php echo $this->_tpl_vars['titles'][$this->_sections['campo']['index']]['label']; ?>
&up=up">A</a>/<a link href="<?php echo $this->_tpl_vars['baseurl']; ?>
sf=<?php echo $this->_tpl_vars['titles'][$this->_sections['campo']['index']]['label']; ?>
&up=down">D</a>
					<?php endif; ?>
				<?php endif; ?>
			</font>
		</center>
	<?php endif; ?>
</th>
<?php endfor; endif; ?>
<th class="hpenaranda">
	Acciones
</th>
</tr>