<?php
	// Configuracin
	require_once('config.inc.php');
	require_once('adodb/adodb.inc.php');

/****************************************************
 ** Nombre de la Funci�n :  Initdb                                                                      **
 ** Parametros :  Ninguno                                                                                  **
 ** Devuelve :                                                                                                    **
 **                 True si consigue conectar                                                            **
 **                 Falla terminando la aplicación en caso contrario                          **
 ** Autor :  Vicente Antonio Sánchez Werner                                                    **
 ** Fecha :  23/7/2k3                                                                                        **
 ** Comentarios :                                                                                              **
 **                                                                                                                    **
 ****************************************************/
function Initdb()
	{
		global $db,$driver,$debug,$server,$user,$passwd,$database;
		list($db) = Getdb();
		$db->debug = $debug;
		$dbaux=$db->Execute("USE $database;");
		if (!$dbaux)
			{
				echo '<center><font color="red" size="+6">Fallo Total.</font><br>'
						.'<font color="red" size="+4">Imposible conectarse a la bbdd.</font><br>'
						.'<font color="red" size="+4">Por favor compruebe la configuraci&oacute;n.</font><br></center>';
				die();
				}
		return true;
	}

function Initconn()
	{
		global $db,$driver,$debug,$server,$user,$passwd,$database;
		$db = ADONewConnection($driver);
		$db->debug = $debug;
		$dbaux=$db->Connect($server, $user, $passwd, "");
		if (!$dbaux)
			{
				echo '<center><font color="red" size="+6">Fallo Total.</font><br>'
						.'<font color="red" size="+4">Imposible conectarse al servidor.</font><br>'
						.'<font color="red" size="+4">Por favor compruebe la configuraci&oacute;n.</font><br></center>';
				die();
				}
		$db->SetFetchMode(ADODB_FETCH_ASSOC); // Nos garantiza que SIEMPRE vamos a recibir las cosas como un array asociativo.
		return true;
	}

/******************************************
 ** Nombre de la Función : Getdb                                             **
 ** Parametros :  Ninguno                                                        **
 ** Devuelve :   La lista de conexiones disponibles                   **
 ** Autor :  Vicente A. Sanchez Werner                                    **
 ** Fecha :  23/7/2k3                                                                **
 ******************************************/
	function Getdb()
		{
			global $db;
			return array($db);
			}


	function GetTables()
		{
			global $vwTables;
			if ($vwTables['Load']!="YES")
				{
				 require_once ('tables.inc.php');
				 $error="MONAG";
				 @$error=InitTables();
				 if ($error=="MONAG")
				 	{
						echo '<center><font color="red" size="+6">Fallo Total.</font><br>'
								.'<font color="red" size="+4">Imposible leer las tablas.</font><br>'
								.'<font color="red" size="+4">Por favor compruebe la configuraci&oacute;n.</font><br></center>';
						die();
						}
				 $vwTables=$error;
				 $vwTables['Load']="YES";
				};
			return $vwTables;
			}

	function GetTable($name)
		{
			$tables=GetTables();
			if ($tables['t']["$name"]." "!=" ")
				{
					return $tables['t']["$name"];}
			else
				{
					return false;}
			}

	function GetCols($name)
		{
			$tables=GetTables();
			if ($tables['t']["$name"]." "!=" ")
				{
					return $tables['c']["$name"];}
			else
				{
					return false;}
			}


	function Makedb()
		{
			global $db,$driver,$debug,$server,$user,$passwd,$database;
			$db = ADONewConnection($driver);
			$db->debug = $debug;
			$dbaux=$db->Connect($server, $user, $passwd, "");
			if (!$dbaux)
			{
				echo '<center><font color="red" size="+6">Fallo Total.</font><br>'
						.'<font color="red" size="+4">Imposible conectarse a la bbdd.</font><br>'
						.'<font color="red" size="+4">Por favor compruebe la configuraci&oacute;n.</font><br></center>';
				die();
				}
			$dbaux=$db->Execute("SHOW DATABASES;");
			$aux=$dbaux->GetArray();
			$delta=count($aux);
			$create=true;
			for($i=0;$i<$delta;$i++)
			{
				if ($database==trim($aux[$i]['Database']))
					{
						$create==false;
						break;}
				}
			if ($create)
				{
					$db->Execute("CREATE DATABASE $database");}
			else
				{
					echo '<center><font color="red" size="+6">Fallo Total.</font><br>'
							.'<font color="red" size="+4">La BBDD ya ha sido creada.</font><br>'
							.'<font color="red" size="+4">Por favor compruebe que desea instalar sobre la BBDD $database.</font><br></center>';
					die();};
			$db->Execute("USE $database");
	}

	function Installdb($modName="")
		{
			if ($modName=="")
				{
					$fileInc='install.inc.php';}
			else
				{
					$fileInc="$modName/install.inc.php";}
			require_once ($fileInc);
			$querys=install_db();
			list($conn)=Getdb();

			$error=false;
			$aux=0;
    		foreach($querys['sql'] as $insert)
    			{
					$conn->Execute($insert);
	  	 			if ($conn->ErrorNo() != 0)
             			{
							$error=true;
	     	  				break;}
	     			$aux++;};

			if ($error==true)
				{
					for($aux2=$aux-1;$aux2>-1;$aux2--)
						{
							$conn->Execute("DROP TABLE ".$querys['drop'][$aux2]);}
							echo '<center><font color="red" size="+6">Fallo Total.</font><br>'
									.'<font color="red" size="+4">Imposible Instalar las tablas'.(($modName!="")?" del modulo $modName":".").'</font><br>'
									.'<font color="red" size="+4">Por favor compruebe la configuraci&oacute;n.</font><br></center>';
							echo $querys['sql'][$aux];
					die();
					return false;};
			if (isset($modname) && $modname=="")
				{
					MakeSessionTable();}
			installdbData($modName);
			return true;
		}

	function installdbData($modName="")
		{
			if ($modName=="")
				{
					$fileInc='install.inc.php';}
			else
				{
					$fileInc="$modName/install.inc.php";}
			require_once ($fileInc);
			$querys=install_dbdata();
			list($conn)=Getdb();

			$error=false;
			$aux=0;
    		foreach($querys as $insert)
    			{
					$conn->Execute($insert);
	  	 			if ($conn->ErrorNo() != 0)
             			{
							$error=true;
	     	  				break;}
	     			$aux++;};

			if ($error==true)
				{
					echo '<center><font color="red" size="+6">Fallo Parcial.</font><br>'
						.'<font color="red" size="+4">Imposible Instalar los datos iniciales'.(($modName!="")?" del modulo $modName":".").'</font><br>'
						.'<font color="red" size="+4">Por favor compruebe la configuraci&oacute;n.</font><br></center>';
					echo $querys['sql'][$aux];
					die();
					return false;};
			return true;
		}

	function UnInstalldb($modName="")
		{
			if ($modName=="")
				{
					$fileInc='install.inc.php';}
			else
				{
					$fileInc="$modName/install.inc.php";}
			require_once ($fileInc);
			$querys=install_db();
			list($conn)=Getdb();
			$error=false;
			$aux=0;
    		foreach($querys['drop'] as $insert)
    			{
					$conn->Execute("DROP TABLE $insert");
	  	 			if ($conn->ErrorNo() != 0)
             			{
							$error=true;
	     	  				break;}
	     			$aux++;};

			if ($error==true)
				{
					echo '<center><font color="red" size="+6">Fallo Total.</font><br>'
							.'<font color="red" size="+4">Imposible desinstalar las tablas'.(($modName!="")?" del modulo $modName":".").'</font><br>'
							.'<font color="red" size="+4">Por favor compruebe la configuraci&oacute;n.</font><br></center>';
					echo $querys['drop'][$aux];
					die();
					return false;};
			return true;
		}

	function SysToADO()
		{
			global $db,$driver,$debug,$server,$user,$passwd,$database;
			global $ADODB_SESSION_DRIVER, $ADODB_SESSION_USER, $ADODB_SESSION_PWD,
						$ADODB_SESSION_DB,$ADODB_SESS_DEBUG,$ADODB_SESSION_CONNECT,
						$ADODB_SESSION_EXPIRE_NOTIFY,$ADODB_SESS_LIFE;
			$ADODB_SESSION_DB=$database;
			$ADODB_SESSION_DRIVER=$driver;
			$ADODB_SESSION_PWD=$passwd;
			$ADODB_SESSION_USER=$user;
			$ADODB_SESS_DEBUG=$debug;
			$ADODB_SESSION_CONNECT=$server;
    		$ADODB_SESSION_TBL = 'sessions';
			$ADODB_SESS_LIFE = 25*60;
			};

	function Init()
		{
			Initconn();
			Initdb();
			require_once('adodb/session/adodb-session.php');
			SysToADO();
			adodb_sess_open(false,false,false);
    		session_start();
		};

	function InitAux()
		{
			Initconn();
			Initdb();
			SysToADO();
		};

	function MakeSessionTable ($name="sessions")
		{
			global $ADODB_SESSION_DRIVER, $ADODB_SESSION_USER, $ADODB_SESSION_PWD,
						$ADODB_SESSION_DB,$ADODB_SESS_DEBUG,$ADODB_SESSION_CONNECT,
						$ADODB_SESSION_EXPIRE_NOTIFY;

			//require_once("session.conf.inc.php");
			switch ($ADODB_SESSION_DRIVER)
				{
					case 'mysql':
									$sql="CREATE TABLE $name
											(
												SESSKEY char(32) not null,
												EXPIRY int(11) unsigned not null,
												EXPIREREF varchar(64),
												DATA text not null,
												primary key (SESSKEY));";
									break;
					default:
							my_fatal_error();
							die;
					}
			list($conn)=Getdb();
			$conn->Execute($sql);
 			if ($conn->ErrorNo() != 0)
             			{
							my_fatal_error();
	     	  				die();}
		return true;
		 }

function NotifyExpire($ref,$key)
{
	//Do whathever we must
	return;
}

?>
