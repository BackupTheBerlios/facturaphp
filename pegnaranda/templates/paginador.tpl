<td colspan="{$Cols}">
<center>{section name=page loop=$Paginas}
{if $Paginas[page].Selected < 1}
	<a link href="{$baseurl}start={$Paginas[page].start}">{$Paginas[page].Page}</a>
{else}
	{$Paginas[page].Page}
{/if}
{if $smarty.section.page.last }{else}&nbsp;{/if}{/section}</center>
</td>