<style type="text/css">
	 @import url("rsc.css");
</style>
<div>
	<h2>Recursos en formato: {$tipo|capitalize} <img src="smallicons/{$tipo}.png"></h2>
	<table border="0" cellspacing="2" cellpadding="1">
	{section name=rsc loop=$recursos}
		{ if $prevs gt 0 }
		<tr valign="middle">
			{if $previo eq true}
			<td width="165">
			<a link href="index.php?actor=documentos&accion=ver-rsc&id={$recursos[rsc].rid}" target="_blank">
				<img src="previos/{$rel}/{$recursos[rsc].archivo}{$ext}" style="border: none;">
			</a>
			</td>
			{/if}
			<td width="165">
			{if $recursos[rsc].restringido eq "S"}
			<a link href="index.php?actor=autorizaciones&accion=add&id={$recursos[rsc].rid}" >
				{$recursos[rsc].titulo}
				</a>
				<br><b>Aviso: Este recurso esta restringido requiere una autorizacion.</b>
			{else}
			<a link href="index.php?actor=documentos&accion=ver-rsc&id={$recursos[rsc].rid}" target="_blank">
				{$recursos[rsc].titulo}
			</a>
			{/if}
			</td>
		</tr>
		{else}
		<tr valign="middle">
			{if $previo eq true}
			<td width="165">
			<a link href="index.php?actor=usuarios&accion=registro">
				<img src="previos/{$rel}/{$recursos[rsc].archivo}{$ext}" style="border: none;">
			</a>
			</td>
			{/if}
			<td width="165">
			{if $recursos[rsc].restringido eq "S"}
			<a link href="index.php?actor=usuarios&accion=registro">
				{$recursos[rsc].titulo}
				</a>
				<br><b>Aviso: Este recurso esta restringido requiere una autorizacion.</b>
			{else}
			<a link href="index.php?actor=usuarios&accion=registro">
				{$recursos[rsc].titulo}
			</a>
			{/if}
			</td>
		</tr>
		{/if}
	{/section}
	</table>
</div>
