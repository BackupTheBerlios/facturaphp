


<tr>
	  <td width="150px" valign="top">
		{include file=users.tpl}
		
		{php}
			if(isset($_SESSION['user']))
			{
				$post_user= new users(); 
				$id_user = $post_user->get_id($_SESSION['user']);
				$post_user->validate_per_user($id_user);
				//inicializa una plantilla
				$tpl= new template;
				$tpl->assign('user_menu',$post_user);
				$tpl->display('menu_user.tpl');
			{/php}	
				
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
	  
	  