<?php /* Smarty version 2.6.1, created on 2004-04-06 20:14:15
         compiled from bl_logout.tpl */ ?>
<div class="Bloque" align="left">
	<h1>Opciones de Usuario</h1>
		<a link href="<?php echo $this->_tpl_vars['logout']; ?>
">Salida</a>
		<br>
		<a link href="<?php echo $this->_tpl_vars['editar']; ?>
">Editar informaci&oacute;n</a>
		<br>
		<a link href="<?php echo $this->_tpl_vars['prefs']; ?>
">Editar Preferencias</a>
		<br>
	<?php if ($this->_tpl_vars['autoriz'] == ""): ?>
	<?php else: ?>
		<a link href="<?php echo $this->_tpl_vars['autoriz']; ?>
">Gestionar Autorizaciones</a>
		<br>
	<?php endif; ?>
</div>