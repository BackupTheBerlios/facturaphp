


<tr>
	  <td width="150px" valign="top">
		{include file=users.tpl}
		
		{php}
			if((isset($_SESSION['user']))&&(isset($_SESSION['corp'])))
			{
				{/php}
					{include file=menu_corp.tpl}
				{php}
			}
			else
				if((isset($_SESSION['user']))&&(!isset($_SESSION['corp'])))
				{
					{/php}
						{include file=menu_user.tpl}
					{php}
				}
				else
				{
					{/php}
						{include file=menu.tpl}
					{php}
				}
		{/php}
				
		{include file=sessions.tpl}
	  </td>
	  
	  