<?php /* Smarty version 2.6.1, created on 2004-09-03 19:17:06
         compiled from bl_logout.tpl */ ?>
<div style="background-color: #feeab1; color: #106010; width: 140px;" align="left">
	<h1 style="background-color: #106010; color:#fdcf51; font-weight: bold; text-align: left; font-size: 13px;">Opciones de Usuario</h1>
		<a onMouseOver="enlaceEntra(this);" onMouseOut="enlaceSale(this);" style="color: #106010; font-size:11px; text-decoration: none; margin: 2px;" link href="<?php echo $this->_tpl_vars['logout']; ?>
">Salida</a>
		<br>
		<a onMouseOver="enlaceEntra(this);" onMouseOut="enlaceSale(this);" style="color: #106010; font-size:11px; text-decoration: none; margin: 2px;" link href="<?php echo $this->_tpl_vars['editar']; ?>
">Editar informaci&oacute;n</a>
		<br>
		<a onMouseOver="enlaceEntra(this);" onMouseOut="enlaceSale(this);" style="color: #106010; font-size:11px; text-decoration: none; margin: 2px;" link href="<?php echo $this->_tpl_vars['prefs']; ?>
">Editar Preferencias</a>
		<br>
	<?php if ($this->_tpl_vars['autoriz'] == ""): ?>
	<?php else: ?>
		<a onMouseOver="enlaceEntra(this);" onMouseOut="enlaceSale(this);" style="color: #106010; font-size:11px; text-decoration: none; margin: 2px;" link href="<?php echo $this->_tpl_vars['autoriz']; ?>
">Gestionar Autorizaciones</a>
		<br>
	<?php endif; ?>
</div>