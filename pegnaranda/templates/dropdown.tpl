<select name="{$idElemento}" class="formulario">
{section name=Elemento loop=$Elementos}
	<option value="{$Elementos[Elemento].id}" {if $idSel == $Elementos[Elemento].id} Selected {/if}>{$Elementos[Elemento].etiqueta}</option>
{/section}
</select>
