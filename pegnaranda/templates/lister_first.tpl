<tr>
{section name=campo loop=$titles}
<th class="hpenaranda" width="{$titles[campo].width}">
	{$titles[campo].label}
	{if $titles[campo].sortable===true}
	<br>
		<center>
			<font style="font-size:11px;">
				{if $titles[campo].sort eq "ASC"}
					A/<a link href="{$baseurl}sf={$titles[campo].label}&up=down">D</a>
				{else}
					{if $titles[campo].sort eq "DESC"}
					<a link href="{$baseurl}sf={$titles[campo].label}&up=up">A</a>/D
					{else}
					<a link href="{$baseurl}sf={$titles[campo].label}&up=up">A</a>/<a link href="{$baseurl}sf={$titles[campo].label}&up=down">D</a>
					{/if}
				{/if}
			</font>
		</center>
	{/if}
</th>
{/section}
<th class="hpenaranda">
	Acciones
</th>
</tr>
