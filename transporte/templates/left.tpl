


<tr>
	  <td width="150px" valign="top">
		{include file=users.tpl}
		
		{php}
			if(!isset($_SESSION['user']))
			{//Usuario sin logear
				{/php}
					{include file=menu.tpl}
				{php}
			}
			else
			{
				if($_SESSION['ident_corp'] == 0)
				{//Se va a elegir empresa
					{/php}
						{include file=menu_corp.tpl}
					{php}

				}
				else
				{//Usuario logeado y eligió empresa
					{/php}
						{include file=menu_user.tpl}
					{php}
				}
			}
		{/php}
				
		{include file=sessions.tpl}
	  </td>
	  
	  