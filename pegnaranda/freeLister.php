<?php
require_once("tools.php");
require_once("db.inc.php");

/*	Es una modificacion del objeto lister para mostrar resultados tabulados sin tabla asociada,
	el objetivo es mostrar de forma sencilla y rapida resultados de busquedas formateados correctamente
*/

class freeLister
	{
		var $sql; // Sentencia SQL Base
	 	var $cols; // nº de columnas a mostrar. Miembro privado. (Innecesario... a Borrar)
		var $rows; // nº de filas a presentar por pagina
		var $ColsToShow;
			/* 	Array que contiene las columnas que requieren un tratamiento especial
			   	de la siguiente forma:

				array(
						array(	'dbname'=>'Nombre del campo en la bbdd1', 'EXTRA' significa q no es un
																			campo real y se procesa al final...
								'showcall' => array que contiene el nombre de la funcion que devuelve
												el html que debe de ir en un punto determinado del template
												del registro a visualizar
												array (	'funcion' => 'nombrefuncion',
														'valor' => valor que se le pasa)
												La funcion llamada devuelve el valor visible que se quiere
												mostrar
								)
						array( ............
								........
								)
						)

				*/
		var $keycol; //
		var $options;
			/*	Array que contiene las funciones callback que van a devolver las opciones
				para un registro determinado. El array tiene el siguiente formato:
				array(
						array(	'funcion'	=> 'Nombre de la funcion a llamar',
								'valor'		=> 'Nombre del campo cuyo valor le pasamos')
						array(
								...........
								...)
						)

				Las funciones callback tienen el siguiente prototipo:
				function nombrefuncion($clave,$valor)
					{
						}

				Y devuelven un array del tipo:

				array(	'etiqueta' 	=>	'Lo que mostramos en lugar de la URL',
						'url'		=>	'la url a la que se refiere');

			*/
		var $idname;	// Id del bloque DIV en el que se van a mostrar los registros. La hoja de estilos que la
						// manejara depende de que se correspondan.
		var $StyleSheet; // Hoja de estilos que define el aspecto de la tabla.
		var $tplName;	// Nombre del template que se usara para renderizar cada registro
		var $GeneralActions; // Array que contiene el conjunto de acciones generales que se pueden realizar
							 // sobre la tabla. por ejemplo: añadir un nuevo registro..
							 // El formato del array es el siguiente:
							 //	array (
							 //			array ( 'funcion' => 'Nombre de la funcion a llamar' ),
							 //			array ( 'funcion' => 'Nombre de la funcion a llamar' )
							 //			...
							 //			)
							 // El callback tiene el siguiente formato
							 //		function callbak($idname)
							 // Se devuelve un array como este
							 // 	array(	'etiqueta' 	=>	'Lo que mostramos en lugar de la URL',
							 //				'url'		=>	'la url a la que se refiere');

		var $table; //Contiene el nombre de la tabla usada.
		var $total; //Contiene el numero total de elementos
		var $start; //contiene el punto de inicio
		var $where;
		var $drops;

		function freeLister($idname,$stylesheet,$tplName,$keycol,$rows,$ColsToShow,$options,$where,$sql)
			{
				if ((trim($sql)=="")||(trim($rows)=="")||($stylesheet=="")||(trim($options)=="")||
					(trim($ColsToShow)=="")||(trim($keycol)=="")||(trim($tplName)=="")
					||(trim($idname)=="")||($where==""))
					{
						print_r("Fatal Error: Void Parms");
						print_r("<br>$idname,$stylesheet,$tplName,$keycol,$rows,$ColsToShow,op$options,$where,$sql");
						die();
						}

				if ((!is_int($rows))||($rows<1))
					{
						print_r("Fatal Error: rows not a number or too few rows");
						die();
						}
				$this->sql=$sql;
				$this->rows=$rows;
				$this->ColsToShow=$ColsToShow;
				//$this->cols=count($ColsToShow)+1; Ahora no es necesario no generamos ninguna tabla...
				$this->keycol=$keycol;
				$this->options=$options;
				$this->StyleSheet=$stylesheet;
				$this->idname=$idname;
				$this->start=0;
				$this->tplName=$tplName;
			}

		function callerOptions($registro)
			{
				if (empty($this->options))
					{
						return null;}
				foreach($this->options as $option)
					{
						if (function_exists($option['funcion']))
							{
								$function=$option['funcion'];
								$z=$function($registro[$this->keycol],$registro[$option['valor']]);
								$exitz=$exitz."<a href='$z[url]'>$z[etiqueta]</a>&nbsp;";
								}
						}
				return $exitz;
				}

		function renderRow($registro)
			{
				$row=SmartyInit();
				$registro=toHtml($registro);
				$regaux=$registro;
				foreach($this->ColsToShow as $k=>$v)
					{
						if (trim($v['showcall']['funcion'])!="")
							{
								$funcion=$v['showcall']['funcion'];
								$auxv=$funcion(&$this,$registro[$v['showcall']['valor']]);
								if (is_array($auxv))
									{
										$regaux[$auxv['nombre']]=$auxv['valor'];}
								else
									{
										$regaux[$v['dbname']]=$auxv;}
								}
						else
							{
								$regaux[]=$registro[$v['dbname']];}
						}
				$row->assign('registro',$regaux);
				$opciones=$this->callerOptions($registro);
				$row->assign('options',$opciones);
				return ($row->fetch($this->tplName))."<br>";
				}

		function render()
			{
				list($db)=Getdb();
				$rs=$db->SelectLimit($this->sql,$this->rows,$this->start);

				if (!($rs===false))
					{
						while ($arr = $rs->FetchRow())
							{
								$salida=$salida.$this->renderRow($arr);}
						$salida=$salida.$this->renderPagerRow();
						}
				else
					{
						return null;}

				//$salida=$salida.renderPagerRow();
				//$salida=$salida.renderLastRow();
				$out=SmartyInit();
				$out->assign('contenido',$salida);
				$out->assign('style',$this->StyleSheet);
				$out->assign('idname',$this->idname);
				return $out->fetch("freeLister_tbl.tpl");
				}

	function renderPagerRow()
			{
				$row=SmartyInit();
				$CurrentUrl=CurrentUrl();
				if (!(strpos($CurrentUrl,"start=")===false))
					{
						$CurrentUrl=substr($CurrentUrl,0,strpos($CurrentUrl,"start=")-1);}

				if (strpos($CurrentUrl,"?")===false)
					{
						$CurrentUrl.="?";}
				else
					{
						if (strpos($CurrentUrl,"&",strlen($CurrentUrl)-1)===false)
							{
								$CurrentUrl.="&";}
						}
				list($db)=Getdb();
				$rs=$db->Execute($this->sql);
				if (!($rs===false))
					{
						$this->total=$rs->PO_RecordCount($this->table,$this->where);}
				else
					{
						return null;}

				$perpage=$this->rows;
				if ($perpage>=$this->total)
					{
						$PageArray[]=array('Page'=>1,'start'=>0,'Selected'=>1);}
				else
					{
						if ($start<=0)
							{
								$start=1;}
						$TotalPaginas=1+floor($this->total/$perpage);
						$PaginaActual=1+floor($this->start/$perpage);
						$PageArray=array();
						for($paginas=1;$paginas<$TotalPaginas+1;$paginas++)
							{
								$PageArray[]=array('Page'=>$paginas,
								'start'=>($paginas>1)?(($paginas-1)*$perpage):0,
								'Selected'=>($paginas==$PaginaActual)?1:0);
								}
						}
				$row->assign('Paginas',$PageArray);
				$row->assign('baseurl',$CurrentUrl);
				$Pager=$row->fetch("freeLister_pager.tpl");
				return $Pager;
				}

		function SetStart($valor)
			{
				if ($valor>-1)
					{
						$this->start=$valor;}
				else
					{
						$this->start=0;}
				}
		}
?>
