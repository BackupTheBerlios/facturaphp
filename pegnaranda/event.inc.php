<?php
	// Funciones de bitacora.
	global $comandos;
	//Definimos los comandos que pueden entrar en la bitacora
	
	$comandos=array( 
						array ( "accion" => "solicitud",
								"parametros" => array( "rid","uid","msg")),
						array ( "accion" => "verdoc",
								"parametros" => array( "did","uid")),
						array ( "accion" => "verrsc",
								"parametros" => array( "rid","uid","restringido")),
						array ( "accion" => "conceder",
								"parametros" => array( "rid","uid")),
						array ( "accion" => "registro",
								"parametros" => array ( 'uid','uname','clave','email','nombre',
														'apellidos','calle','poblacion','provincia',
														'pais','cpostal','actividad','nivel',
														'preferencias')),
						array ( "accion" => "editar",
								"parametros" => array ( 'uid','uname','clave','email','nombre',
														'apellidos','calle','poblacion','provincia',
														'pais','cpostal','actividad','nivel',
														'preferencias'))
						
						);
	
	global $cmd;
	foreach($comandos as $comando)
		{
			$cmd[$comando['accion']]=base64_encode($comando['accion']);}
			
	// Tests de funcionamiento
	/*
		require_once("tools.php");
		require_once("db.inc.php");
		require_once("vardb.inc.php");
		require_once("varsession.inc.php");
		require_once("render.inc.php");
		Init();
		$z=eventToMsg("solicitud",array ("rid"=>"88","uid"=>"199","msg"=>"HOLA probando...."));
		echo $z;
		echo "<br>";
		print_r(msgToEvent($z));
		echo "<br>";
		addLogEntry($z);
		//print_r(topNEntriesAction("solicitud",5,"uid"));
		echo "<br>";
		die();
	*/
	// Añade una entrada de bitacora el mensaje debe de haber sido parseado previamente
	function addLogEntry($mensaje)
		{
			list($conn)=Getdb();
			$table=GetTable('eventos');
			$columns=GetCols('eventos');

			$insert=array(	"$columns[suceso]"=>"'$mensaje'",
							"$columns[fecha]"=>"now()");

			$rs=$conn->Replace($table,$insert,array(),false);

			}

	function lastNEntries($total)
		{
			list($conn)=Getdb();
			$table=GetTable('eventos');
			$columns=GetCols('eventos');
			$sql="SELECT * FROM $table ORDER BY $columns[eid] desc Limit $total";
			$rs=$conn->Execute($sql);
			$data=$rs->GetRows();
			return $data;
			}

	function lastNEntriesAction($accion,$total)
		{
			global $cmd;
			list($conn)=Getdb();
			$table=GetTable('eventos');
			$columns=GetCols('eventos');
			$sql="SELECT * FROM $table WHERE $columns[suceso] like '$cmd[$accion]@%' ORDER BY $columns[eid] desc Limit $total";
			$rs=$conn->Execute($sql);
			$data=$rs->GetRows();
			return $data;
			}
			
	function topNentriesAction($accion,$total,$parametro)
		{
			global $cmd;
			list($conn)=Getdb();
			$table=GetTable('eventos');
			$columns=GetCols('eventos');
			$sql="SELECT *, count(*) as total FROM $table WHERE $columns[suceso] like '$cmd[$accion]@%' and  $columns[suceso] like '%@".base64_encode($parametro)."%' group by $columns[suceso] ORDER BY total desc limit $total";
			$rs=$conn->Execute($sql);
			$data=$rs->GetRows();
			return $data;
			}
	
	function eventToMsg($accion,$param)
		{
			global $comandos;
			$msg=false;
			foreach($comandos as $comando)
				{
					if ($accion==$comando['accion'])
						{
							$implod=true;
							foreach($comando['parametros'] as $par)
								{
									if (!isset($param[$par]))
										{
											$implod=false;
											break;
											}
									else
										{ //Asi garantizamos el orden de los parametros
											$parm[$par]=base64_encode($par."#".$param[$par]);} 
									}
							if ($implod)
								{
									$msg=implode("@",$parm);
									$msg=base64_encode($accion)."@".$msg."@";
									}
							break;
							}
					}
				return $msg;
			}
	
	function msgToEvent($msg)
		{
			global $comandos;
			$event=false;
			$msgarr=explode("@",$msg);	
			foreach($comandos as $comando)
				{
					if (trim($comando)!="")
						{
							if ($comando['accion']==base64_decode($msgarr[0]))
								{
									$event["accion"]=base64_decode($msgarr[0]);
									$aux=1;
									foreach($comando['parametros'] as $par)
										{
											$parz=array();
											$auxz=base64_decode($msgarr[$aux]);
											$parz=explode("#",$auxz);
											$event[$par]=$parz[1];
											$aux++;
											}
									}
							}
					}
			return $event;
			}
			
	/* lo q falta es insertar las instrucciones para q se inserten los eventos
	*/
?>