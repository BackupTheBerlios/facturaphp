{* Bloque de entrada de usuario *}
<div class="Bloque" align="left">
	<h1>Opciones de Usuario</h1>
		<a link href="{$logout}">Salida</a>
		<br>
		<a link href="{$editar}">Editar informaci&oacute;n</a>
		<br>
		<a link href="{$prefs}">Editar Preferencias</a>
		<br>
	{if $autoriz == "" }
	{else}
		<a link href="{$autoriz}">Gestionar Autorizaciones</a>
		<br>
	{/if}
</div>
