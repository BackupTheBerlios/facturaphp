


<tr>
	  <td width="150px" valign="top">
		{include file=users.tpl}
		
		{php}
		
		
			if(isset($_SESSION['user']))
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
	  
	  