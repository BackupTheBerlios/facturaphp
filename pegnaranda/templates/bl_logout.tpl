{* Bloque de entrada de usuario *}
<div style="background-color: #feeab1; color: #106010; width: 140px;" align="left">
	<h1 style="background-color: #106010; color:#fdcf51; font-weight: bold; text-align: left; font-size: 13px;">Opciones de Usuario</h1>
		<a onMouseOver="enlaceEntra(this);" onMouseOut="enlaceSale(this);" style="color: #106010; font-size:11px; text-decoration: none; margin: 2px;" link href="{$logout}">Salida</a>
		<br>
		<a onMouseOver="enlaceEntra(this);" onMouseOut="enlaceSale(this);" style="color: #106010; font-size:11px; text-decoration: none; margin: 2px;" link href="{$editar}">Editar informaci&oacute;n</a>
		<br>
		<a onMouseOver="enlaceEntra(this);" onMouseOut="enlaceSale(this);" style="color: #106010; font-size:11px; text-decoration: none; margin: 2px;" link href="{$prefs}">Editar Preferencias</a>
		<br>
	{if $autoriz == "" }
	{else}
		<a onMouseOver="enlaceEntra(this);" onMouseOut="enlaceSale(this);" style="color: #106010; font-size:11px; text-decoration: none; margin: 2px;" link href="{$autoriz}">Gestionar Autorizaciones</a>
		<br>
	{/if}
</div>
