<?php

//require_once("db.inc.php");
//require_once("render.inc.php");
/*echo BoleanDropDown("zzz","Y");
die();*/
if (phpversion() >= "4.2.0") {
	if ( ini_get('register_globals') != 1 ) {
		$supers = array('_REQUEST',
                                '_ENV',
                                '_SERVER',
                                '_POST',
                                '_GET',
                                '_COOKIE',
                                '_SESSION',
                                '_FILES',
                                '_GLOBALS' );

		foreach( $supers as $__s) {
			if ( (isset($$__s) == true) && (is_array( $$__s ) == true) ) extract( $$__s, EXTR_OVERWRITE );
		}
		unset($supers);
	}
} else {
	if ( ini_get('register_globals') != 1 ) {

		$supers = array('HTTP_POST_VARS',
                                'HTTP_GET_VARS',
                                'HTTP_COOKIE_VARS',
                                'GLOBALS',
                                'HTTP_SESSION_VARS',
                                'HTTP_SERVER_VARS',
                                'HTTP_ENV_VARS'
                                 );

		foreach( $supers as $__s) {
			if ( (isset($$__s) == true) && (is_array( $$__s ) == true) ) extract( $$__s, EXTR_OVERWRITE );
		}
		unset($supers);
	}
}

/* Funcion: ValidCIF ($cif)
 * Devuelve verdadero si la cadena pasada como parÃÂÃÂ¡metro es un CIF valido, falso si no lo es.
 * Autor: V. Werner */

function ValidCIF($cif)
{
	if (strlen($cif)!=9)
		{
			return false;};
	$cif=strtoupper($cif);
	$letra=substr($cif,0,1);
	$digitos=substr($cif,1,7);
	$control=substr($cif,8,1);

	if (stristr("TRWAGMYFPDXBNJZSQVHLCKE",$letra)=="")
		{
			return false;}

	if (stristr("1234567890ABCDEFGHIJ",$control)=="")
		{
			return false;}
	else
		{
		 if (stristr("1234567890",$control)!="")
		 	{
				$ctrl=true;}
		 else
		 	{
				$ctrl=false;};

	if (strlen(($digitos*2)/2)!=(strlen($digitos+0)==7?7:6))
		{
			return false;}

	$sumaA=0;
	$sumaB=0;
	$AA="";
	$BB="";
	for($i=0;$i<7;$i++)
		{
			if ($i%2!=0)
				{
					$sumaA+=(substr($digitos,$i,1)+0);
					$AA.=substr($digitos,$i,1)." ";}
			else
				{
					$auxnum=(substr($digitos,$i,1)+0)*2;
					$sumaB+=(floor($auxnum/10)+($auxnum%10));
					$BB.=substr($digitos,$i,1)." ";}
			}

	$sumaC=$sumaA+$sumaB;

	$sumaD=10-($sumaC%10);

	if (!$ctrl)
		{
			$sumaD=substr("JABCDEFGHI",$sumaD,1);};

	if ($sumaD==$control)
		{
			return true;}
	else
		{
			return false;};
	}
}


function vwVarFromInput()
{
    $search = array('|</?\s*SCRIPT.*?>|si',
                    '|</?\s*FRAME.*?>|si',
                    '|</?\s*OBJECT.*?>|si',
                    '|</?\s*META.*?>|si',
                    '|</?\s*APPLET.*?>|si',
                    '|</?\s*LINK.*?>|si',
                    '|</?\s*IFRAME.*?>|si',
                    '|STYLE\s*=\s*"[^"]*"|si');

    $replace = array('');

    $resarray = array();
    foreach (func_get_args() as $var)
		{
        	// Get var
        	global $$var;
        	if (empty($var))
				{
            		return;}
        	$ourvar = $$var;
        	if (!isset($ourvar))
				{
            	array_push($resarray, NULL);
            	continue;}

        	if (empty($ourvar))
				{
            		array_push($resarray, $ourvar);
            		continue;}
	        // Clean var
    	    if (get_magic_quotes_gpc())
				{
            		vwStripslashes($ourvar); }

	        // Add to result array
    	    array_push($resarray, $ourvar);
    	}

    // Return vars
    if (func_num_args() == 1)
		{
        	return $resarray[0];}
	else
		{
        	return $resarray;}
};

/**
 * strip slashes
 *
 * stripslashes on multidimensional arrays.
 * Used in conjunction with pnVarCleanFromInput
 * @access private
 * @param any variables or arrays to be stripslashed
 */
function vwStripslashes (&$value)
	{
    	if(!is_array($value))
			{
        		$value = stripslashes($value);}
		else
			{
        	array_walk($value,'auxStripslashes');}
	};

function SmartyInit()
{
	include("config.inc.php");
	global $base_dir,$template_dir,$compile_dir,$config_dir,$plugins_dir,$smarty_dir;
	//define("SMARTY_DIR","$base_dir/smarty/");
    require_once($smarty_dir."Smarty.class.php");
    $smarty = new Smarty;

    $smarty->template_dir=$template_dir;
    $smarty->compile_dir=$compile_dir;
    $smarty->config_dir=$config_dir;
    $smarty->plugins_dir=$plugins_dir;
    return $smarty;
};


function GeneratevKey()
{
 global $HTTP_SESSION_VARS;
 session_register('KeyRand');
 $tamano=15;
 $diccionario=array(400);

 $caracteres="ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
 if ($HTTP_SESSION_VARS["KeyRand"]<>"OK")
 	{
     	srand((double)microtime()*346234);
	 	$HTTP_SESSION_VARS["KeyRand"]="OK";}
 for($i=0;$i<400;$i++)
 	{$diccionario[$i]= substr($caracteres,rand(1,strlen($caracteres)),1);
	 $diccionario[$i].=substr($caracteres,rand(1,strlen($caracteres)),1);
	 }
 $key="";
 for($i=0;$i<$tamano;$i++)
 	{$key.=$diccionario[rand(0,400)];}
 return $key;
};

// Funcion que envia un email html a $destino utilizando la plantilla definida en $plantilla y pasandole un array asociativo
// en la variable $variables para los diferentes valores de la plantilla. Esto mail ira con un subject especificado por $subject
// y que tendra como direccion de origen $origen. Tambien puede recibir un array con los nombres de los archivos de imagenes ($imagenes)
// y el directorio en el cual estan ($imgdir) para meterlas embebidas en el correo.
// Una posible llamada a la funcion seria:
/*
	$variables=array("uname"=>"","password"=>"","email"=>"","nombreEmpresa"=>"",
				 "telefonoEmpresa"=>"","fax"=>"","movilContacto"=>"","nombreContacto"=>"",
				 "cif"=>"","calle"=>"","poblacion"=>"","provincia"=>"",
				 "cpostal"=>"","telefonoContacto"=>"","actividad"=>"");

	$imagenes=array();
	$imagenes[]="Correo_usuario.jpg";
	$imagenes[]="Menu_sup_cen.gif";
	$imagenes[]="Pixel.gif";
	$imagenes[]="Correo_usr_sup_dch.jpg";
	$imagenes[]="Correo_usr_cen_izq.jpg";
	$imagenes[]="Correo_usr_cen_dch.jpg";
	$imagenes[]="Menu_inf_izq.gif";
	$imagenes[]="Menu_inf_cen.gif";
	$imagenes[]="Menu_inf_dch.gif";

	$resultado=SendHtmlEmail ("datusrmail.tpl",$variables,"Alta en la web","info@pacheco.com","pepe@yo.com",$imagenes,"img");
*/

function SendHtmlEmail($plantilla,$variables,$subject,$destino,$origen="presupuestos@pachecoforja.com",$imagenes=NULL,$imgdir="img",$html=NULL)
{
	require_once ('mail.php');
	if (!$html)
		{
		$smarty = SmartyInit();
		$smarty->assign("variables",$variables);
		$body=$smarty->fetch($plantilla);
		}
	else
		{
		$body=$html;
		}
	$mail = new htmlMimeMail();

	// Definimos el html
	$mail->setHtml($body);

	// Comprobamos si hay imagenes embebidas en el correo
	if ($imagenes!=NULL)
		{
		// Leemos todos los ficheros y los aadimos al correo

		foreach ($imagenes as $imagen)
			{
			$len=strlen($imagen);
			$extension=substr($imagen,$len-3,3);
			if ($extension=="gif")
				{
				$tipo="image/gif";
				}
			if ($extension=="jpg")
				{
				$tipo="image/jpg";
				}
			$fichero=$imgdir."/".$imagen;
			$temp=$mail->getFile($fichero);
			$mail->addHtmlImage($temp,$imagen,$tipo);
			}
		}

	// Definimos las cabeceras de los mensajes

	$mail->setReturnPath($origen);
	$mail->setFrom($origen);
	$mail->setSubject($subject);
	$mail->setHeader('X-Mailer','Correo enviado por pachecoforja.com');

	// Enviamos el correo
	$result = $mail->send(array($destino), 'smtp');
	if (!$result)
		{
			return $mail->errors;

		}
	else
		{
			return true;
		}

};

function check_login($uname,$pass)
{
$encriptpass=md5($pass);

list($db)=Getdb();
$Total_tablas=GetTables();
$tblusuarios=$Total_tablas['t']['usuarios'];
$cols_usuarios=$Total_tablas['c']['usuarios'];

$sql="SELECT ".$cols_usuarios['uname']." FROM $tblusuarios WHERE ".$cols_usuarios['uname']."='$uname' AND ".$cols_usuarios['validado']."='S'";
$resultado=$db->Execute($sql);
if ($db->ErrorNo() != 0)
	{
	$mensaje="Ha ocurrido un error al leer de la base de datos";
	return $mensaje;
	}

if ($resultado->RecordCount()=="0")
	{
	// El usuario no esta validado
	return false;
	}

$sql="SELECT ".$cols_usuarios['uname']." FROM $tblusuarios WHERE ".$cols_usuarios['uname']."='$uname' AND ".$cols_usuarios['clave']."='$encriptpass'";
$resultado=$db->Execute($sql);
if ($db->ErrorNo() != 0)
	{
	$mensaje="Ha ocurrido un error al leer de la base de datos";
	return $mensaje;
	}
if ($resultado->RecordCount()=="1")
	{
	return true; // El usuario existe
	}
else
	{
	return false; // El usuario no existe
	}


}

// Funcion que devuelve la direccion actual que tenemos en el navegador con variables incluidas
// Ejemplo de devolucion: " http://www.enlinux.com/index.php?inicio=true&vista=usuario

function actualaddr()
	{
	$query=getenv("QUERY_STRING");
	if (!empty($query))
		{
		return "http://". getenv("SERVER_NAME"). getenv("SCRIPT_NAME") ."?". $query;
		}
	else
		{
		return "http://". getenv("SERVER_NAME"). getenv("SCRIPT_NAME");
		}
	}

function fixCode(&$item,$key)
{
	$item=str_replace("\\","\\\\",$item);
	$item=htmlentities($item,ENT_COMPAT);
}

function fixSingleCode($item)
{
	$item=str_replace("\\","\\\\",$item);
	$item=htmlentities($item,ENT_COMPAT);
	return $item;
}
function GenerateUniqName($filename)
{
	$base=md5($filename);
	$base=base64_encode($base);
	$base=substr($base,floor((strlen($base)/5)*2),floor((strlen($base)/5)*2)-1);
	$fix=microtime();
	$fix2=md5($fix);
	$fix2=substr($fix2,-5);
	$fix=substr($fix,floor((strlen($fix)/5)*3));
	$finalname=$base.$fix2.$fix.(substr($filename,strrpos($filename,'.')));
	$finalname=str_replace(' ','ug',$finalname);
	return $finalname;
	}

function GetUserByUname($uname)
{
	list($db)=Getdb();
	$table=GetTable('usuarios');
	$cols=GetCols('usuarios');

	$sql="SELECT $cols[uid] FROM $table WHERE $cols[uname]='$uname'";
	$rs=$db->Execute($sql);
	if (!$db)
		{
	    	return false;
		}
	$data=$rs->FetchRow();

	return $data['uid'];
}

function TimedRedirect($time,$url)
{
	$var='<script language="javascript">
			redirTime = "'.($time*1000).'";
			redirURL = "'.$url.'";
			redirTimer();
			function redirTimer()
				{
					self.setTimeout("self.location.href = redirURL;",redirTime); }
			//  End -->
			</script>';
	return $var;
 }

function prepare_data_for_ADODB_Replace($data,$table)
	{
		$cols=GetCols($table);
		foreach($data as $k=>$v)
			{
				$exit[$cols[$k]]="'$v'";}
		return $exit;
		}

function limpiar()
	{
		if (rand() % 100 == 0)
			{
				adodb_sess_gc(100);}
		return;
		}

// Transforma un array asociativo con nombres de campo
// pertenecientes a una bbdd en otro identico, pero con
// nombres de campo pertenecientes al sistema.
// Hace innecesaria la transformacion manual de las columnas
// devueltas por un FetchRow al esquema del sistema.
function fromdbtocms($array,$table)
	{
		$cols=GetCols($table);
		$exit=array();
		foreach($cols as $k=>$v)
			{
				$exit[$k]=$array[$v];}
		return $exit;
		}

// Transforma un array asociativo con nombres de campo
// pertenecientes al sistema en otro identico, pero con
// nombres de campo pertenecientes a la bbdd
// Nos permite trasnsforma sentencias como
// $datos=array( "$cols[nombre]" => "blah");
// En:
// $datos=array('uid'=> "blah");
// $datos=fromcmstodb($datos,'yujo');
function fromcmstodb($array,$table)
	{
		$cols=GetCols($table);
		$exit=array();
		foreach($cols as $k=>$v)
			{
				if (trim($array[$k])!="")
					{
						$exit[$v]=$array[$k];}
				}
		return $exit;
		}

define("SNT_ALLOW_ALL",0); // No sanity check;
define("SNT_ALLOW_SQL_BLSEARCH",1); // Don't allow ; and escape secuences
define("SNT_ALLOW_ALPHANUMERIC",2); // Just 0-9, a-z A-Z & entities of the form: &[a,e,i,o,u] and puctuation marks
define("SNT_ALLOW_INTEGER",2); // An integer
define("SNT_ALLOW_FLOAT",3); // Just 0-9 chars
define("SNT_ALLOW_ALPHABETIC",4); // Just a-z A-Z & entities of the form: &[a,e,i,o,u]
define("SNT_ALLOW_PATH_FILE",5); // it must be a correct path / file -no ;-
define("SNT_ALLOW_PATH",6); // a valid path
define("SNT_ALLOW_FILE",7); // A valid filename
//define("SNT_ALLOW_ALPHA_NOT_PUNCT",8);
define("SNT_ALLOW_ALPHA_NOT_PUNCT",9);


/*function sanitize_string($mode, $string)
	{
		$regexp[SNT_ALLOW_ALL]="[]*";
		$regexp[SNT_ALLOW_FLOAT]="[0-9]*\,[0-9]*";
		$regexp[SNT_ALLOW_INTEGER]="[0-9]*";
		$regexp[SNT_ALPHABETHIC]="";
		$regexp[SNT_SQL_BLSEARCH]='[^\";]*';

		switch ($mode)
			{
				case :}

		return $string;
	}*/

function ArchivosDropDown($id=-1)
	{
		$table=GetTable('archivos');
		$cols=GetCols('archivos');
		$sql="SELECT $cols[aid] AS id, $cols[nombre] AS etiqueta FROM $table ORDER BY $cols[aid] ASC";
		return GenDropDwn('aid',$sql,$id);
		}

function SeccionesDropDown($id=-1)
	{
		$table=GetTable('secciones');
		$cols=GetCols('secciones');
		$sql="SELECT $cols[sid] AS id, $cols[nombre] AS etiqueta FROM $table ORDER BY $cols[sid] ASC";
		return GenDropDwn('sid',$sql,$id);
		}

function BoleanDropDown($idname,$value)
	{
		$smarty = SmartyInit();
		$Elementos= array(
							array ( 'id' => "NRQ", "etiqueta" => " No requerido " ),
							array ( 'id' => "REQ", "etiqueta" => " Requerido " ));
		$DropDown="dropdown.tpl";
		$smarty->assign('Elementos',$Elementos);
		//quitado de momento
		//$smarty->assign('idSel',$id);
		$smarty->assign('idElemento',$idname);
		return $smarty->fetch($DropDown);
	}

/*
function BoleanDropDown($idname,$value)
	{
		$smarty = SmartyInit();
		$Elementos= array(
							array ( 'id' => "AND", "etiqueta" => " Y " ),
							array ( 'id' => "AND NOT ", "etiqueta" => " Y NO " ),
							array ( 'id' => " OR ", "etiqueta" => " O " ));
		$DropDown="dropdown.tpl";
		$smarty->assign('Elementos',$Elementos);
		$smarty->assign('idSel',$id);
		$smarty->assign('idElemento',$idname);
		return $smarty->fetch($DropDown);
	}
*/
function GenDropDwn($idElemento,$sql,$id=-1,$null=false)
	{
		if ((trim($idElemento)=="")||(trim($sql)==""))
			{
				return null;}
		list($db)=Getdb();
		$rs=$db->Execute($sql);
		if ($rs===false)
			{
				return null;}
		$Elementos=$rs->GetRows();
		if ($null)
			{
				$Elementos[]=array('id'=>'','etiqueta'=>"Vacio");}

		$smarty = SmartyInit();
		$DropDown="dropdown.tpl";
		$smarty->assign('Elementos',$Elementos);
		$smarty->assign('idSel',$id);
		$smarty->assign('idElemento',$idElemento);
		return $smarty->fetch($DropDown);
	}

function CurrentUrl($host=true, $querystring=true)
	{
		$url="";
		if ($host)
			{
				if ( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on') ||
					(!empty($_ENV['HTTPS']) && $_ENV['HTTPS']=='on') )
						{
							$url = 'https://';}
				else
					{
						$url = 'http://';}
				$url .= !empty($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST']:$_SERVER['SERVER_NAME'];
				//if((int)$_SERVER['SERVER_PORT']!=80) $url .= ':'.$_SERVER['SERVER_PORT'];
				}
		//$url .= $_SERVER['SCRIPT_NAME'];
		//if($querystring && !empty($_SERVER['QUERY_STRING'])) $url .= '?' .$_SERVER['QUERY_STRING'];
		if($querystring)
			{
				$url .= $_SERVER['REQUEST_URI'];}
		else
			{
				$url .= $_SERVER['PHP_SELF'];}
		return $url;
		}

function toHtml($array)
	{
		foreach($array as $k=>$v)
			{
				$exi[$k]=html_entity_decode($v,ENT_QUOTES);}
		return $exi;
		}

function DeleteFile($ruta)
{
	unlink($ruta);
	rmdir($ruta);
	}

function ParsePeriod($string)
	{
		$arrayz=ParsePeriodForSearch($string);
		$sep="";
		foreach($arrayz as $year)
			{
				$exiz=$exiz.$sep.$year;
				$sep=",";
				}
		return $exiz;
		}

function InverseParsePeriod($string)
	{
		$arrayz=explode(",",$string);
		if (count($arrayz)<=1)
			{
				return $string;}
		$periodstarted=false;
		$coma="";
		$exitz="";
		for($aux=0;$aux<count($arrayz);$aux++)
			{
				if ($periodstarted==false)
					{
						$startperiod=$arrayz[$aux];
						$endperiod=$arrayz[$aux];
						$periodstarted=true;}
				else
					{
						if(($arrayz[$aux]-$endperiod)==1)
							{
								$endperiod=$endperiod+1;}
						else
							{
								$exitz=$exitz.$coma;
								$coma=",";
								if ($startperiod==$endperiod)
									{
											$exitz=$exitz.$startperiod;}
								else
									{
										$exitz=$exitz.$startperiod."-".$endperiod;}
								$startperiod=$arrayz[$aux];
								$endperiod=$arrayz[$aux];
								$periodstarted=true;
								}
						}
				}
		$exitz=$exitz.$coma;
		if ($startperiod==$endperiod)
			{
				$exitz=$exitz.$startperiod;}
		else
			{
				$exitz=$exitz.$startperiod."-".$endperiod;}

		return $exitz;
		}

function ParsePeriodForSearch($string)
	{
		$exploded=explode(",",$string);
		$exiz=array();
		$first=true;
		foreach($exploded as $might)
			{
				if (strpos($might,"-")!=false)
					{
						$explo=explode("-",$might);
						$inicio=$explo[0];
						$final=(int)$explo[1];
						if ((trim($inicio)=="")||(trim($final)=="")||
							($inicio<=999)||($final<=999)||($inicio>=2020)||($final>=2020))
							{
								}
						else
							{
								if ($inicio>$final)
									{
										$aux=$final;
										$final=$inicio;
										$inicio=$aux;}

								while($inicio<=$final)
									{
										$exiz[]=$inicio;
										$inicio++;
										}
								}
						}
				else
					{
						if ((trim($might)=="")||($might<=999)||($might>=2020))
							{
								}
						else
							{
								$exiz[]=$might;}
						}
				}
		return $exiz;
		}

	function is_url($url)
		{
    		if (!preg_match('#^http\\:\\/\\/[a-z0-9\-]+\.([a-z0-9\-]+\.)?[a-z]+#i', $url))
				{
        			return false;}
			else {
        			return true;}
    		}

	function DelOldRsc($rid)
		{
			global $rsc_dir,$prev_dir;
			$aid=$param['rid'];
			list($db)=Getdb();
			$tbl=GetTable('recursos');
			$col=GetCols('recursos');
			$sql="Select * from $tbl WHERE $col[rid]=$rid";
			$resultado=$db->Execute($sql);
			if ($db->ErrorNo() != 0)
				{
					$mensaje="Ha ocurrido un error al leer un viejo registro";
					print_r($mensaje);
					die();}
			$datos=$resultado->FetchRow();
			$datos=fromdbtocms($datos,'recursos');
			$type=returnMedia($datos['archivo']);
			if ($type['preview']==true)
				{
					if (($type['extension']==".jpg")||($type['extension']==".png"))
						{
							$datos['archivo']=basename($datos['archivo'],'.jpg');
							$datos['archivo']=basename($datos['archivo'],'.png');
							}
					DeleteFile($prev_dir.$datos['did']."/".$datos['archivo'].".jpg");
					}
			DeleteFile($rsc_dir.$datos['did']."/".$datos['archivo']);
			}
?>
