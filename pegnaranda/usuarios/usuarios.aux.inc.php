<?php

	/*function render_usuario($accion,$sujeto,$param)
	{
		switch ($accion)
			{
				case "listarusuarios":
										$salida=render_admin_listarusuarios($param);
										break;
				case "admusreditar":
										$salida=render_admin_admusreditar($param);
										break;
				case "confirmadmusrdel":
										$salida=render_admin_confirmadmusrdel($param);
										break;
				case "delusr":
										$salida=render_admin_delusr($param);
										break;
				case "masinfo":
										$salida=render_admin_masinfo($param);
										break;
				default:
						$salida=render_admin_listarusuarios($param);
						break;

			};
		return $salida;
		}
*/

	function ExpireUser()
	{
		list($db)=Getdb();
		$tables=GetTables();
		$table=$tables['t']['usuarios'];
		$col=$tables['c']['usuarios'];
		$sql="SELECT $col[uid],$col[fechaLimite],$col[validado] FROM $table ".
				"WHERE (TO_DAYS($col[fechaLimite])-TO_DAYS(NOW())<=0) AND ($col[validado]<>'S');";
		$rs=$db->Execute($sql);
		if (!$rs)
			{
				die();
			}
		$n=0;

		while ($datos=$rs->FetchRow())
			{
				$uid=$datos['uid'];
				$sql="DELETE FROM $table WHERE $col[uid]=$uid";
				$help=$db->Execute($sql);
				if (!$help)
					{
						die();
					}
				$n++;
				}
		return $n;
	}

	function UsuarioPager($pagina_actual)
	{
		list($db)=Getdb();
		$tables=GetTables();
		$table=$tables['t']['usuarios'];
		$cols=$tables['c']['usuarios'];
		$rs=$db->Execute("Select * from $table");
		$items=($rs->PO_RecordCount($table," 1=1"))+0;
		$pages=ceil($items/10);
		if ($pages<=1)
			{
				return "";}
		for($i=1;$i<$pages+1;$i++)
			{
				$elementos[]['value']=$i;
				$elementos[]['url']="admin.php?actor=usuarios&accion=listarusuarios?pagina=$i";
				}
		$paginador=SmartyInit();
		$paginador->assign('PagActual',$pagina_actual);
		$paginador->assign('Paginas',$elementos);
		return $paginador->fetch('Secpaginador.tpl');
		};


	define("USER_LOGIN_OK",0);
	define("USER_BAD_LOGIN",1);
	define("USER_BAD_USER",2);
	define("USER_NOT_IN_SYSTEM",3);
	define("USER_IN_SYSTEM",4);
	define("USER_UNKNOWN_ERROR",5);
	define("USER_OPERATION_NOT_ALLOWED",6);

	function checkUser($uname,$passwd=NULL)
		{
			$uname=trim($uname); // Eliminamos espacios y demas gilipolleces
			if ($uname=="Anonimo")
				{
					if ($passwd===NULL)
						{
							return USER_IN_SYSTEM;} //El usuario anonimo SI es parte del sistema
					else
						{
							return USER_OPERATION_NOT_ALLOWED;}
				}
					//Un usuario anonimo no puede hacer login en el sistema
			list($db)=Getdb();
			$tables=GetTables();
			$table=$tables['t']['usuarios'];
			$cols=$tables['c']['usuarios'];
			if ($passwd===NULL)
				{
					$addon="";}
			else
				{
					$passwd=trim($passwd);
					$addon=" AND $cols[clave]='".md5($passwd)."'";}
			$rs=$db->Execute("Select * from $table WHERE $cols[uname] like '$uname' $addon");
			$items=($rs->PO_RecordCount($table," $cols[uname] like '$uname' $addon"))+0;
			switch($items)
				{
					case 0:		//El usuario no esta en la bbdd
								if ($passwd===NULL)
									{
										return USER_NOT_IN_SYSTEM;} //El usuario no existe en la bbdd, se puede añadir
								else
									{
										$rs=$db->Execute("Select * from $table WHERE $cols[uname] like '$uname' ");
										$items2=($rs->PO_RecordCount($table," $cols[uname] like '$uname'"))+0;
										switch ($items2)
											{
												case 0:
													return USER_BAD_USER; //El usuario no existe, y por lo tanto no puede entrar
												default:
													return USER_BAD_LOGIN; // El passwd es erroneo
													}
										}
					case 1:
								if ($passwd===NULL)
									{
										return USER_IN_SYSTEM;} //El usuario si esta en el sistema
								else
									{
										return USER_LOGIN_OK; // El login es correcto
										}
					default:
								return USER_UNKNOWN_ERROR; //Error desconocido
					}
			}

function logUserIn($uname)
	{
		$user=GetUserByUnamez($uname);
		$cols=GetCols('usuarios');
		if ($user===false)
			{
				$uid="0";
				vwSessionSetVar("uid",0);
				$UserName="Anonimo";
				vwSessionSetVar("UserName",$UserName);
				$UserLevel=1;
				vwSessionSetVar("UserLevel",$UserLevel);
				}
		else
			{
				vwSessionSetVar("uid",$user[$cols['uid']]);
				$UserName=$user[$cols['uname']];
				vwSessionSetVar("UserName",$UserName);
				$UserLevel=$user[$cols['nivel']];
				vwSessionSetVar("UserLevel",$UserLevel);
				};
		}

function logUserOut()
	{
		vwSessionVarsClean();
		$uid="0";
		vwSessionSetVar("uid",0);
		$UserName="Anonimo";
		vwSessionSetVar("UserName",$UserName);
		$UserLevel=1;
		vwSessionSetVar("UserLevel",$UserLevel);
		}

function GetUserByUnamez($uname)
	{
		list($conn)=Getdb();
		$table=GetTable('usuarios');
		$cols=GetCols('usuarios');
		$select="SELECT * from $table WHERE $cols[uname]='$uname'";
		$rs=$conn->Execute($select);
		$items=($rs->PO_RecordCount($table," $cols[uname]='$uname'"))+0;
		switch($items)
			{
				case 0:
						return false;
				case 1:
						$item=$rs->FetchRow();
						return $item;
				default:
						return false;
				}
		return false;
		}

?>
