<?php /* Smarty version 2.6.1, created on 2004-03-26 11:12:44
         compiled from recursos.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'recursos.tpl', 5, false),)), $this); ?>
<style type="text/css">
	 @import url("rsc.css");
</style>
<div>
	<h2>Recursos en formato: <?php echo ((is_array($_tmp=$this->_tpl_vars['tipo'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 <img src="smallicons/<?php echo $this->_tpl_vars['tipo']; ?>
.png"></h2>
	<table border="0" cellspacing="2" cellpadding="1">
	<?php if (isset($this->_sections['rsc'])) unset($this->_sections['rsc']);
$this->_sections['rsc']['name'] = 'rsc';
$this->_sections['rsc']['loop'] = is_array($_loop=$this->_tpl_vars['recursos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rsc']['show'] = true;
$this->_sections['rsc']['max'] = $this->_sections['rsc']['loop'];
$this->_sections['rsc']['step'] = 1;
$this->_sections['rsc']['start'] = $this->_sections['rsc']['step'] > 0 ? 0 : $this->_sections['rsc']['loop']-1;
if ($this->_sections['rsc']['show']) {
    $this->_sections['rsc']['total'] = $this->_sections['rsc']['loop'];
    if ($this->_sections['rsc']['total'] == 0)
        $this->_sections['rsc']['show'] = false;
} else
    $this->_sections['rsc']['total'] = 0;
if ($this->_sections['rsc']['show']):

            for ($this->_sections['rsc']['index'] = $this->_sections['rsc']['start'], $this->_sections['rsc']['iteration'] = 1;
                 $this->_sections['rsc']['iteration'] <= $this->_sections['rsc']['total'];
                 $this->_sections['rsc']['index'] += $this->_sections['rsc']['step'], $this->_sections['rsc']['iteration']++):
$this->_sections['rsc']['rownum'] = $this->_sections['rsc']['iteration'];
$this->_sections['rsc']['index_prev'] = $this->_sections['rsc']['index'] - $this->_sections['rsc']['step'];
$this->_sections['rsc']['index_next'] = $this->_sections['rsc']['index'] + $this->_sections['rsc']['step'];
$this->_sections['rsc']['first']      = ($this->_sections['rsc']['iteration'] == 1);
$this->_sections['rsc']['last']       = ($this->_sections['rsc']['iteration'] == $this->_sections['rsc']['total']);
?>
		<?php if ($this->_tpl_vars['prevs'] > 0): ?>
		<tr valign="middle">
			<?php if ($this->_tpl_vars['previo'] == true): ?>
			<td width="165">
			<a link href="index.php?actor=documentos&accion=ver-rsc&id=<?php echo $this->_tpl_vars['recursos'][$this->_sections['rsc']['index']]['rid']; ?>
" target="_blank">
				<img src="previos/<?php echo $this->_tpl_vars['rel']; ?>
/<?php echo $this->_tpl_vars['recursos'][$this->_sections['rsc']['index']]['archivo'];  echo $this->_tpl_vars['ext']; ?>
" style="border: none;">
			</a>
			</td>
			<?php endif; ?>
			<td width="165">
			<?php if ($this->_tpl_vars['recursos'][$this->_sections['rsc']['index']]['restringido'] == 'S'): ?>
			<a link href="index.php?actor=autorizaciones&accion=add&id=<?php echo $this->_tpl_vars['recursos'][$this->_sections['rsc']['index']]['rid']; ?>
" >
				<?php echo $this->_tpl_vars['recursos'][$this->_sections['rsc']['index']]['titulo']; ?>

				</a>
				<br><b>Aviso: Este recurso esta restringido requiere una autorizacion.</b>
			<?php else: ?>
			<a link href="index.php?actor=documentos&accion=ver-rsc&id=<?php echo $this->_tpl_vars['recursos'][$this->_sections['rsc']['index']]['rid']; ?>
" target="_blank">
				<?php echo $this->_tpl_vars['recursos'][$this->_sections['rsc']['index']]['titulo']; ?>

			</a>
			<?php endif; ?>
			</td>
		</tr>
		<?php else: ?>
		<tr valign="middle">
			<?php if ($this->_tpl_vars['previo'] == true): ?>
			<td width="165">
			<a link href="index.php?actor=usuarios&accion=registro">
				<img src="previos/<?php echo $this->_tpl_vars['rel']; ?>
/<?php echo $this->_tpl_vars['recursos'][$this->_sections['rsc']['index']]['archivo'];  echo $this->_tpl_vars['ext']; ?>
" style="border: none;">
			</a>
			</td>
			<?php endif; ?>
			<td width="165">
			<?php if ($this->_tpl_vars['recursos'][$this->_sections['rsc']['index']]['restringido'] == 'S'): ?>
			<a link href="index.php?actor=usuarios&accion=registro">
				<?php echo $this->_tpl_vars['recursos'][$this->_sections['rsc']['index']]['titulo']; ?>

				</a>
				<br><b>Aviso: Este recurso esta restringido requiere una autorizacion.</b>
			<?php else: ?>
			<a link href="index.php?actor=usuarios&accion=registro">
				<?php echo $this->_tpl_vars['recursos'][$this->_sections['rsc']['index']]['titulo']; ?>

			</a>
			<?php endif; ?>
			</td>
		</tr>
		<?php endif; ?>
	<?php endfor; endif; ?>
	</table>
</div>