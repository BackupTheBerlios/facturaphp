<?php
	// 	Funciones de manejo de variables de session mejoradas y adaptadas al nuevo
	//	sistema de manejo de sesiones. Mantenemos el mismo api.

	function vwSessionGetVar($var)
		{
			if (isset($_SESSION))
				{
					$internal=&$_SESSION;}
			else
				{
					global $HTTP_SESSION_VARS;
					$internal=&$HTTP_SESSION_VARS;
					}
			$temp="v3w$var";
			if (isset($internal[$temp]))
				{
					return $internal[$temp];}
			else
				{
					return null;}
			return null;
			}

	function vwSessionSetVar($var,$val)
		{
			if (isset($_SESSION))
				{
					$internal=&$_SESSION;}
			else
				{
					global $HTTP_SESSION_VARS;
					$internal=&$HTTP_SESSION_VARS;
					}
			$temp="v3w$var";
			global $$temp;
			$$temp=$val;
			$internal[$temp]=$val;
			session_register($temp);
			return true;
			}

	function vwSessionDelVar($var)
		{
			if (isset($_SESSION))
				{
					$internal=&$_SESSION;}
			else
				{
					global $HTTP_SESSION_VARS;
					$internal=&$HTTP_SESSION_VARS;
					}
			$temp="v3w$var";
			unset($GLOBALS[$temp]);
			session_unregister($temp);
			return true;
			}

	function vwSessionVarsClean()
		{
			if (isset($_SESSION))
				{
					$internal=&$_SESSION;}
			else
				{
					global $HTTP_SESSION_VARS;
					$internal=&$HTTP_SESSION_VARS;
					}
			foreach($internal as $k=>$v)
				{
					if (strpos($v,"v3w")!=false)
						{
							unset($GLOBALS[$v]);
							session_unregister($v);}
					}
			return;
			}

?>