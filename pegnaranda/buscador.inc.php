<?php
	require_once("freeLister.php");
	require_once("media.inc.php");
	// Buscador de documentos

		function render_buscador($accion,$sujeto,$param)
			{
				switch ($accion)
					{
						case 'buscar':
							$salida=render_user_buscar($param);
							break;
						case 'resultados':
							$salida=render_user_listarResultados($param);
							break;
						default:
							header('Location: index.php');
							die();
							break;
							}
				return $salida;
				}

		function render_user_buscar($param)
			{
				vwSessionSetVar('search','new');
				$resultado= SmartyInit();
				$resultado->assign("dropCond1",BoleanDropDown("cond1"," "));
				$resultado->assign("dropCond2",BoleanDropDown("cond2"," "));
				$resultado->assign("dropCond3",BoleanDropDown("cond3"," "));
				$resultado->assign("dropCond4",BoleanDropDown("cond4"," "));
				$resultado->assign("dropCond5",BoleanDropDown("cond5"," "));
				$resultado->assign("dropCond6",BoleanDropDown("cond6"," "));
				$resultado->assign("dropCond7",BoleanDropDown("cond7"," "));
				$resultado->assign("dropCond8",BoleanDropDown("cond8"," "));
				$resultado->assign('dropDwArchivo',html_entity_decode(ArchivosDropDown(),ENT_QUOTES));
				$resultado->assign('dropDwSeccion',html_entity_decode(SeccionesDropDown(),ENT_QUOTES));
				$resultado->assign("accion","index.php?actor=buscador&accion=resultados");
				$plantilla="busqueda.tpl";
				$salida=$resultado->fetch($plantilla);

				return $salida;

				}

		function render_user_listarResultados($param)
			{

				$col=GetCols('documentos');
				$tbl=GetTable('documentos');
				list($db)=Getdb();

				if (vwSessionGetVar('search')=="new")
					{
						list($cond1,$cond2,$cond3,$cond4,$cond5,$cond6,$cond7,$cond8)=
						vwVarFromInput('cond1','cond2','cond3','cond4',
										'cond5','cond6','cond7','cond8');
						list($aid,$sid,$signatura,$folios,$siglos,$periodo,$resumen,$notas)=
						vwVarFromInput('aid','sid','signatura','folios','siglos','periodo','resumen','notas');
						$ft1=true;
						$ft2=true;
						$condiciones=array();
						if (trim($aid)!="")
							{
								$semaforo=true;
								if ($cond1!="REQ")
									{
										$semaforo=false;}
								$condiciones[]=array(	"condicion"=>"$col[aid]=".trim($aid),
														"requerido"=>$semaforo);}

						if (trim($sid)!="")
							{
								$semaforo=true;
								if ($cond2!="REQ")
									{
										$semaforo=false;}
								$condiciones[]=array(	"condicion"=>"$col[sid]=".trim($sid),
														"requerido"=>$semaforo);}

						if (trim($signatura)!="")
							{
								$semaforo=true;
								if ($cond3!="REQ")
									{
										$semaforo=false;}
								$condiciones[]=array(	"condicion"=>"$col[signatura] like '%".htmlentities(trim($signatura),ENT_QUOTES)."%'",
														"requerido"=>$semaforo);}

						if (trim($folios)!="")
							{
								$semaforo=true;
								if ($cond4!="REQ")
									{
										$semaforo=false;}
								$condiciones[]=array(	"condicion"=>"$col[folios] like '%".htmlentities(trim($folios),ENT_QUOTES)."%'",
														"requerido"=>$semaforo);}

						if (trim($siglos)!="")
							{
								$semaforo=true;
								if ($cond5!="REQ")
									{
										$semaforo=false;}
								$condiciones[]=array(	"condicion"=>"$col[siglos] like '%".htmlentities(trim($siglos),ENT_QUOTES)."%'",
														"requerido"=>$semaforo);}

						if (trim($periodo)!="")
							{
								$semaforo=true;
								if ($cond6!="REQ")
									{
										$semaforo=false;}
								$items=ParsePeriodForSearch($periodo);
								$condicion="";
								$prev="";
								$semaforo1=false;
								foreach($items as $item)
									{
										if (!$semaforo1)
											{
												$semaforo1=true;
												$prev=" OR ";}
										$condicion=$condicion.$prev." $col[periodo] like '%$item%'";
										$semaforo1=true;
										}
								if (trim($condicion)!="")
									{
										$condiciones[]=array(	"condicion"=>"($condicion)",
																"requerido"=>$semaforo);}
								}

						if (trim($resumen)!="")
							{
								$resumen=str_replace("'","",$resumen);
								$semaforo=true;
								if ($cond7!="REQ")
									{
										$semaforo=false;}
								$condiciones[]=array(	"condicion"=>" MATCH ($col[resumen]) AGAINST ('".htmlentities(trim($resumen),ENT_NOQUOTES)."' IN BOOLEAN MODE)",
														"requerido"=>$semaforo);
								$ft1=" MATCH ($col[resumen]) AGAINST ('".htmlentities(trim($resumen),ENT_NOQUOTES)."' IN BOOLEAN MODE) AS puntuaje1";
								}

						if (trim($notas)!="")
							{
								$notas=str_replace("'","",$notas);
								$semaforo=true;
								if ($cond8!="REQ")
									{
										$semaforo=false;}
								$condiciones[]=array(	"condicion"=>" MATCH ($col[notas]) AGAINST ('".htmlentities(trim($notas),ENT_NOQUOTES)."' IN BOOLEAN MODE)",
														"requerido"=>$semaforo);
								$ft2=" MATCH ($col[notas]) AGAINST ('".htmlentities(trim($notas),ENT_NOQUOTES)."' IN BOOLEAN MODE) AS puntuaje2";
								}

						$sqlwhere="";
						$semaforo=false;
						foreach($condiciones as $condicion)
							{
								if (!$semaforo)
									{
										$sqlwhere=$condicion['condicion'];
										$semaforo=true;}
								else
									{
										switch ($condicion['requerido'])
											{
												case false:
															$sqlwhere=$sqlwhere." OR $condicion[condicion]";
															break;
												case true:
															$sqlwhere="($sqlwhere) AND $condicion[condicion]";
															break;
												}
										}
								}
						if (($ft1!=true)||($ft2!=true))
							{
								if (($ft1!=true)&&($ft2!=true))
									{
										$sql2="SELECT *, $ft1,$ft2 FROM $tbl WHERE $sqlwhere ORDER BY puntuaje1 desc, puntuaje2 desc;";}
								else
									{
										if ($ft2==true)
											{
												$sql2="SELECT *, $ft1 FROM $tbl WHERE $sqlwhere;";}
										else
											{
												$sql2="SELECT *, $ft2 FROM $tbl WHERE $sqlwhere;";}
										}
								}
						else
							{
								$sql2="SELECT * FROM $tbl WHERE $sqlwhere ";}
						vwSessionSetVar('sqlsearch',$sql2);
						//vwSessionSetVar('sqlbase',$sqlbase);
						vwSessionSetVar('sqlwhere',$sqlwhere);
						vwSessionSetVar('search',"no");
						}
				else
					{
						$sql2=vwSessionGetVar('sqlsearch');
						$sqlwhere=vwSessionGetVar('sqlwhere');
						}
				$sf=$param['start']+0;
				$rs=$db->SelectLimit($sql2,25,$sf);
				if ($rs===false)
					{
						$mensaje="Ha generado una busqueda incorrecta, revise los datos introducidos";}
				else
					{
						$items=$rs->GetRows();
						if (trim($items[0][$col['aid']]<1))
							{
								$mensaje="No hay registros que cumplan sus criterios de busqueda";}
						}
			/* Aqui comienza el uso del nuevo Lister .... */

				$Cols=array(
							array	(	"dbname"	=>	$col['aid'],
										"showcall"	=>	array(	"funcion"	=>'cbzArchivos',
																"valor"		=> $col['aid'])),
							array	(	"dbname"	=>	$col['sid'],
										"showcall"	=>	array(	"funcion"	=>'cbzSecciones',
																"valor"		=> $col['sid'])),
							array	(	"dbname"	=>	$col['periodo'],
										"showcall"	=>	array(	"funcion"	=>'cbzPeriodo',
																"valor"		=> $col['periodo'])),
							array	(	"dbname"	=> "EXTRA",
										"showcall"	=>	array(	"funcion"	=>'cbzRecursos',
																"valor"		=> $col['did']))
										);
				$options=array(
								array	(	'funcion'	=>	'cbzMasInfo',
											'valor'		=>	$col['did']));

				$lister=new freeLister("usrListado","freeLister1.css","resultDocs.tpl",$col['did'],
										25,$Cols,$options,$sqlwhere,$sql2);
				$lister->SetStart($param['start']+0);
				$z=$lister->render();
				return $z;
				}

	function cbzArchivos($obj,$valor)
		{
			list($db)=Getdb();
			$tbl=GetTable('archivos');
			$col=GetCols('archivos');
			if (empty($obj->drops['Archivos']))
				{
					$sql="Select * from $tbl";
					$rs=$db->Execute($sql);
					if ($db->ErrorNo() != 0)
						{
							$param['ruta']="error";
							$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
							render($param);
							die();
							}
					$aux=$rs->GetRows();
					foreach($aux as $value)
						{
							$obj->drops['Archivos'][]=fromdbtocms($value,'archivos');}
					}

			foreach($obj->drops['Archivos'] as $value)
				{
					if ($value['aid']==$valor)
						{
							return $value['abrev'];}
					}
			return "N/D";
			}

	function cbzSecciones($obj,$valor)
		{
			list($db)=Getdb();
			$tbl=GetTable('secciones');
			$col=GetCols('secciones');
			if (empty($obj->drops['Secciones']))
				{
					$sql="Select * from $tbl";
					$rs=$db->Execute($sql);
					if ($db->ErrorNo() != 0)
						{
							$param['ruta']="error";
							$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
							render($param);
							die();
							}
					$aux=$rs->GetRows();
					foreach($aux as $value)
						{
							$obj->drops['Secciones'][]=fromdbtocms($value,'secciones');}
					}

			foreach($obj->drops['Secciones'] as $value)
				{
					if ($value['sid']==$valor)
						{
							return $value['nombre'];}
					}
			return "N/D";
			}

	function cbzPeriodo($obj,$valor)
		{
			return InverseParsePeriod($valor);}

	function cbzRecursos($obj,$valor)
		{
			list($db)=Getdb();
			$tbl=GetTable('recursos');
			$col=GetCols('recursos');

			$sql="SELECT * FROM $tbl WHERE $col[did]=$valor";

			$rs=$db->Execute($sql);
			if ($db->ErrorNo() != 0)
				{
					$param['ruta']="error";
					$param['mensaje']="Ha ocurrido leer el archivo de la base de datos.";
					render($param);
					die();
					}
			$aux=$rs->GetRows();

			foreach($aux as $value)
				{
					if (trim($value[$col['url']])!="")
						{
							$total['url']=$total['url']+1;}
					else
						{
							$media=returnMedia($value[$col['archivo']]);
							$total[$media]=$total[$media]+1;}
					}

			$output="";
			if(trim($media)!="")
				{
					foreach($total as $k=>$v)
						{
							if ($v>0)
								{
									$output=$output.'<img src="smallicons/'.$k.'.png">'."$v&nbsp;";}
							}
					}
			if (trim($output)=="")
				{
					return "";}
			else
				{
					return array('nombre'=>"recursos",
									'valor'=>$output);}

			}

	function cbzMasInfo($key,$valor)
		{
			return array("url"=>"index.php?actor=documentos&accion=mostrar&id=$key",
							"etiqueta"=>"<img src='smallicons/masinfo.png'>");}
?>
