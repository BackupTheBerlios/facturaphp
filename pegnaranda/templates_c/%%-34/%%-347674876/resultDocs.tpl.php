<?php /* Smarty version 2.6.1, created on 2004-03-26 04:11:36
         compiled from resultDocs.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'resultDocs.tpl', 3, false),)), $this); ?>
<table border="0" cellspacing="0" cellpadding="0" style="margin: 6px;">
	<tr>
		<th><center>&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['registro']['ltxResumen'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 66, "...", false) : smarty_modifier_truncate($_tmp, 66, "...", false)); ?>
&nbsp;</center></th>
	</tr>
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>
					<td>Archivo:&nbsp;<?php echo $this->_tpl_vars['registro']['aid']; ?>
&nbsp;&nbsp;Secci&oacute;n:&nbsp;<?php echo $this->_tpl_vars['registro']['sid']; ?>
&nbsp;<br>
						Signatura:&nbsp;<?php echo $this->_tpl_vars['registro']['txtSignatura']; ?>
&nbsp;&nbsp;Folios:&nbsp;<?php echo $this->_tpl_vars['registro']['txtFolios']; ?>
&nbsp;Siglos:&nbsp;<?php echo $this->_tpl_vars['registro']['txtSiglos']; ?>
<br>
						Periodo Cr&oacute;nologico:&nbsp;<?php echo $this->_tpl_vars['registro']['txtPeriodoCronologico']; ?>

					</td>
					<?php if ($this->_tpl_vars['options'] == ""): ?>
					<?php else: ?>
					<td width="22">
						<?php echo $this->_tpl_vars['options']; ?>

					</td>
					<?php endif; ?>
				</tr>
		<?php if ($this->_tpl_vars['registro']['recursos'] == ""): ?>
		<?php else: ?>
				<tr>
					<?php if ($this->_tpl_vars['options'] == ""): ?>
						<td>
					<?php else: ?>
						 <td colspan="2">
					<?php endif; ?>
					Recursos:&nbsp;<?php echo $this->_tpl_vars['registro']['recursos']; ?>
</td>
				</tr>
		<?php endif; ?>
			</table>
		</td>
	</tr>
</table>