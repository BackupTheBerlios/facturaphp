<?php
require_once("tools.php");
require_once("db.inc.php");


class Lister
	{
		var $sql; // Sentencia SQL Base
		var $cols; // nº de columnas a mostrar. Miembro privado.
		var $rows; // nº de filas a presentar por pagina
		var $ColsToShow;
			/* 	Array que contiene las columnas a mostrar y sus respectivas etiquetas
			   	de la siguiente forma:

				array(
						array(	'dbname'=>'Nombre del campo en la bbdd1',
								'label'=>'Etiqueta a mostrar',
								'width' => Anchura,
								'dropdown' => True o False. Indica si el campo se muestra como
												un desplegable
								'dropcall' => array que contiene el nombre de la funcion que devuelve
												la lista de valores.
												array (	'funcion' => 'nombrefuncion',
														'valor' => valor que se le pasa)
												La funcion llamada devuelve el valor visible que se quiere
												mostrar
								'sortable'=> Si o no se puede ordenar por el campo (Y|N),
								'sort' => (A|D) -sentido ),
						array( ............
								........
								)
						)

				*/
		var $keycol; //Columna clave
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
		var $orden;
			/* array que contiene el estado de ordenacion de los campos y el sentido de los mismos
				formato:
						array ( 'field' => 'Nombre del campo'.
								'estado' => 'ASC'|'DESC'|'');
			*/
		var $idname;	// Id del bloque DIV en el que va incluida la tabla. La hoja de estilos que la
						// manejara depende de que se correspondan.
		var $StyleSheet; // Hoja de estilos que define el aspecto de la tabla.
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
		var $where; //Contiene las condiciones aplicadas
		var $total; //Contiene el numero total de elementos
		var $start; //contiene el punto de inicio
		var $drops; //cache interna con los valores "cacheables" a usar por los callbacks que
					//generan los dropdowns
		function Lister($idname,$sql,$rows,$ColsToShow,$keycol,$options,$stylesheet='datagrid-a.css')
			{
				if (/*(trim($sql)=="")||*/(trim($rows)=="")||(trim($ColsToShow)=="")||(trim($keycol)=="")||(trim($options)=="")||(trim($idname)==""))
					{
						print_r("Fatal Error: Void Parms");
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
				$this->cols=count($ColsToShow)+1;
				$this->keycol=$keycol;
				$this->options=$options;
				$this->StyleSheet=$stylesheet;
				$this->idname=$idname;
				$this->start=0;
				}

		function caller($registro)
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

		function callerGeneral()
			{
				if (empty($this->GeneralActions))
					{
						return null;}
				foreach($this->GeneralActions as $option)
					{
						if (function_exists($option['funcion']))
							{
								$function=$option['funcion'];
								$z=$function();
								$exitz=$exitz."<a href='$z[url]'>$z[etiqueta]</a>&nbsp;";
								}
						}
				return $exitz;
				}
		function renderRow2($registro)
			{
				$row=SmartyInit();
				$regaux=array();
				$registro=toHtml($registro);
			foreach($this->ColsToShow as $k=>$v)
					{

						if (trim($v['dropcall']['funcion'])!="")
							{

								$funcion=$v['dropcall']['funcion'];
								$auxv=$funcion(&$this,$registro[$v['dropcall']['valor']]);
								$regaux[]=$auxv;
								}
						else
							{


								$regaux[]=$registro[$v['dbname']];}
						}
				$row->assign('data',$regaux);
				$opciones=$this->caller($registro);
				$row->assign('options',$opciones);
				return $row->fetch("lister_rows.tpl");
				}
				
		function renderRow($registro)
			{
				$row=SmartyInit();
				$regaux=array();
				$registro=toHtml($registro);
	
	
				foreach($this->ColsToShow as $k=>$v)
					{
						if (trim($v['dropcall']['funcion'])!="")
							{
								$funcion=$v['dropcall']['funcion'];
								$auxv=$funcion(&$this,$registro[$v['dropcall']['valor']]);
								$regaux[]=$auxv;
								}
						else
							{
	
								$regaux[]=$registro[$v['dbname']];}
						}
				$row->assign('data',$regaux);
				$opciones=$this->caller($registro);
				$row->assign('options',$opciones);
				return $row->fetch("lister_rows.tpl");
				}

		function renderFirstRow()
			{
				$row=SmartyInit();
				$row->assign('titles',$this->ColsToShow);
				$row->assign('ordenado',$this->orden);
				$CurrentUrl=CurrentUrl();
				if (!(strpos($CurrentUrl,"sf=")===false))
					{
						$CurrentUrl=substr($CurrentUrl,0,strpos($CurrentUrl,"sf=")-1);}

				if (strpos($CurrentUrl,"?")===false)
					{
						$CurrentUrl.="?";}
				else
					{
						if (strpos($CurrentUrl,"&",strlen($CurrentUrl)-1)===false)
							{
								$CurrentUrl.="&";}
						}
				$row->assign('baseurl',$CurrentUrl);
				return $row->fetch("lister_first.tpl");
				}

		function renderGeneralActions()
			{
				$row=SmartyInit();
				$row->assign('Cols',$this->cols);
				$row->assign('actions',$this->callerGeneral());
				return $row->fetch("lister_general.tpl");
				}

		function sorteval()
			{
				$orden=" ORDER BY ".$this->orden['field']." ";
				if ($this->orden['estado']=="")
					{
						return null;}
				else
					{
						$orden=$orden.$this->orden['estado'];}
				return $orden;
				}

		function render2()
			{
				//$finalsql=$this->sql.$this->sorteval();
				//list($db)=Getdb();
				$salida=$this->renderFirstRow();
			/*	$rs=$db->SelectLimit($finalsql,$this->rows,$this->start);

				if (!($rs===false))
					{
						while ($arr = $rs->FetchRow())
							{
								$salida=$salida.$this->renderRow($arr);}
						$salida=$salida.$this->renderPagerRow();
						$salida=$salida.$this->renderGeneralActions();
						}
				else
					{
						return null;}*/
				//OJO AQUI $THIS->SQL SE REFIERE A LAS ROWS PASADAS POR LA FUNCION DE EVENT.INC.PHP
				//lastNEntriesAction
				if (count($this->sql)>0){
					foreach ($this->sql as $arr){
							$salida=$salida.$this->renderRow2($arr);
						}
						$salida=$salida.$this->renderPagerRow2();
						$salida=$salida.$this->renderGeneralActions();
				}else{	
						return null;
				}

				//$salida=$salida.renderPagerRow();
				//$salida=$salida.renderLastRow();
				$out=SmartyInit();
				$out->assign('rows',$salida);
				$out->assign('style',$this->StyleSheet);
				$out->assign('idname',$this->idname);
				$out->assign('rows',$salida);
				return $out->fetch("lister_tbl.tpl");
				}				
		function render()
			{
				$finalsql=$this->sql.$this->sorteval();
				list($db)=Getdb();
				$salida=$this->renderFirstRow();
				$rs=$db->SelectLimit($finalsql,$this->rows,$this->start);

				if (!($rs===false))
					{
						while ($arr = $rs->FetchRow())
							{
								$salida=$salida.$this->renderRow($arr);}
						$salida=$salida.$this->renderPagerRow();
						$salida=$salida.$this->renderGeneralActions();
						}
				else
					{
						return null;}
				//$salida=$salida.renderPagerRow();
				//$salida=$salida.renderLastRow();
				$out=SmartyInit();
				$out->assign('rows',$salida);
				$out->assign('style',$this->StyleSheet);
				$out->assign('idname',$this->idname);
				$out->assign('rows',$salida);
				return $out->fetch("lister_tbl.tpl");
				}

		function renderEvento()
			{
				$salida=$this->renderFirstRow();
				$rs=$db->SelectLimit($finalsql,$this->rows,$this->start);

				if (!($rs===false))
					{
						while ($arr = $rs->FetchRow())
							{
								$salida=$salida.$this->renderRow($arr);}
						$salida=$salida.$this->renderPagerRow();
						$salida=$salida.$this->renderGeneralActions();
						}
				else
					{
						return null;}
				//$salida=$salida.renderPagerRow();
				//$salida=$salida.renderLastRow();
				$out=SmartyInit();
				$out->assign('rows',$salida);
				$out->assign('style',$this->StyleSheet);
				$out->assign('idname',$this->idname);
				$out->assign('rows',$salida);
				return $out->fetch("lister_tbl.tpl");
				}
				
		function SetSort($label,$sentido)
			{
				foreach($this->ColsToShow as $col)
					{
						if ($col['sortable']===true)
							{
								$col['sort']="";}
						}
				$z=0;
				foreach($this->ColsToShow as $col)
					{
						if ($col['label']==$label)
							{
								$field=$col;
								break;}
						$z++;
						}

				if ($field['dbname']=="")
					{
						return;}
				if ($sentido=="up")
					{
						$sentido="ASC";}
				else
					{
						if ($sentido=="down")
							{
								$sentido="DESC";}
						else
							{
								return;}
						}
				$this->ColsToShow[$z]['sort']=$sentido;
				$this->orden=array('field'=>$field['dbname'],'estado'=>$sentido);
				}

	function renderPagerRow()
			{
				$row=SmartyInit();
				$row->assign('titles',$this->ColsToShow);
				$row->assign('ordenado',$this->orden);
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
				$row->assign('Cols',$this->cols);
				$Pager=$row->fetch("lister_pager.tpl");
				return $Pager;
				}
function renderPagerRow2()
			{
				$row=SmartyInit();
				$row->assign('titles',$this->ColsToShow);
				$row->assign('ordenado',$this->orden);
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
				if	(isset($this->sql)&& count($this->sql)>=0){
						$this->total=count($this->sql);}
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
				$row->assign('Cols',$this->cols);
				$Pager=$row->fetch("lister_pager.tpl");
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