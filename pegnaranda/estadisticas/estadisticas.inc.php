<?php
require_once ("usuarios/usuarios.aux.inc.php");
require_once("event.inc.php");

	function render_estadistica($accion,$sujeto,$param)
	{
		$UserLevel=vwSessionGetVar("UserLevel");

		if ($UserLevel<500)
			{
					header('Location: index.php');
					die();
					break;
				}
		else
			{
				switch ($accion)
					{
						// Aqui empieza la parte correspondiente al administrador
						case "listar":
												$salida=render_admin_listarestadisticas($param);
												break;						

						default:
							header('Location: index.php');
							die();
							break;
						}
				};
		return $salida;
		}

	


	// Aqui empieza la definicion de las funciones referentes al administrador

	function render_admin_listarestadisticas($param)
	{
		require_once("lister.php");
		$sf=vwVarFromInput('sf');
		$start=vwVarFromInput('start');
		$up=vwVarFromInput('up');
		
		list($db)=Getdb();
		
		// Recursos
		$tbl=GetTable('recursos');
		$col=GetCols('recursos');

		$sql="Select * from $tbl";
		$Cols=array(
					array ( "dbname"	=>	$col['rid'],
							"label"		=>	"id",
							"width"		=>	"45px",
							"sortable"	=>	false),
					array ( "dbname"	=>	$col['nombre'],
							"label"		=>	"Nombre",
							"width"		=>	"200px",
							"sortable"	=>	false),
					array ( "dbname"	=>	$col['acceso'],
							"label"		=>	"Nº Accesos",
							"width"		=>	"45px",
							"sortable"	=>	true),
					array ( "dbname"	=>	$col['solicitud'],
							"label"		=>	"Nº Solicitudes",
							"width"		=>	"45px",
							"sortable"	=>	true,
							"sort"		=> "D"));

		$opciones=array();

		$acciones=array();

		$recurList=new Lister("admRecursos",$sql,25,$Cols,$col['rid'],$opciones,"dg-admrecursos.css");
		$recurList->table="$tbl";
		$recurList->where="";
		$recurList->GeneralActions=$acciones;

		if ($sf!="")
			{
				$recurList->SetSort($sf,$up);}

		if ($start!="")
			{
				$recurList->SetStart($start);}

		$listadoRecur=$recurList->render();
				if (($listadoRecur===null)||(trim($listadoRecur)==""))
			{
				$listadoRecur="<br><center>No hay estadisticas a mostrar</a></center>";}
		
				
		//Documentos
		$tbl=GetTable('documentos');
		$col=GetCols('documentos');

		$sql="Select * from $tbl";
		$Cols=array(
					array ( "dbname"	=>	$col['did'],
							"label"		=>	"id",
							"width"		=>	"45px",
							"sortable"	=>	false),
					array ( "dbname"	=>	$col['visitas'],
							"label"		=>	"Visitas",
							"width"		=>	"45px",
							"sortable"	=>	true,
							"sort"		=>	"D"),				
					array ( "dbname"	=>	$col['signatura'],
							"label"		=> 	"Signatura",
							"width"		=>	"200px",
							"sortable"	=>	false));

		$opciones=array();

		$acciones=array();

		$docuList=new Lister("admDocumentos",$sql,25,$Cols,$col['did'],$opciones,"dg-admdocumentos.css");
		$docuList->table="$tbl";
		$docuList->where="";
		$docuList->GeneralActions=$acciones;

		if ($sf!="")
			{
				$docuList->SetSort($sf,$up);}

		if ($start!="")
			{
				$docuList->SetStart($start);}
		
		$listadoDocu=$docuList->render();
		//****************	
		
		
		
		if (($listadoDocu===null)||(trim($listadoDocu)==""))
			{
				$listadoDocu="<br><center>No hay estadisticas a mostrar</a></center>";}
		///********
		$listadoRegistros=eventos('registro');
		$listadoVerdoc=eventos('verdoc');
		$listadoVerrsc=eventos('verrsc');
		$listadoSolicitudes=eventos('solicitud');
		$listadoEdicion=eventos('editar');
		$listadoConceder=eventos('conceder');
		
		///********		
		$resultado= SmartyInit();
		$plantilla="estadisticas/listarestadisticas.tpl";
		$resultado->assign("listadoRecur",$listadoRecur);		
		$resultado->assign("listadoDocu",$listadoDocu);
		$resultado->assign("listadoRegistros",$listadoRegistros);
		$resultado->assign("listadoVerdoc",$listadoVerdoc);
		$resultado->assign("listadoVerrsc",$listadoVerrsc);	
		$resultado->assign("listadoSolicitudes",$listadoSolicitudes);		
		$resultado->assign("listadoConceder",$listadoConceder);
		$resultado->assign("listadoEdicion",$listadoEdicion);
		$salida=$resultado->fetch($plantilla);

		vwSessionSetVar('urlantigua',CurrentUrl());
		return $salida;

	}
	function devuelveRows($array){
		$i=0;
		foreach ($array as $fila){
			$miArray[$i]=msgToEvent($array[$i]['txtSuceso']);
			
		}
		return $miArray;
	}
	function eventos($accion){
		$miArray=lastNEntriesAction('registro',25);
		$Rows=devuelveRows($miArray);
		$col_id = 'did';
		switch ($accion){
			case "solicitud": 
			
						$col=GetCols('recursos');
									$col_id = $col['rid'];
						$Cols=array(
							array ( "dbname"	=>	$col['rid'],
									"label"		=>	"id del recurso",
									"width"		=>	"45px",
									"sortable"	=>	false),
							array ( "dbname"	=>	$col['uid'],
									"label"		=>	"Id del usuario",
									"width"		=>	"45px",
									"sortable"	=>	false,),				
							array ( "dbname"	=>	$col['razon'],
									"label"		=> 	"razon",
									"width"		=>	"200px",
									"sortable"	=>	false));
							break;
			case "verdoc":						
								$col=GetCols('documentos');
									$col_id = $col['did'];
							 $Cols=array(
							array ( "dbname"	=>	$col['did'],
									"label"		=>	"id del documento",
									"width"		=>	"290px",
									"sortable"	=>	false));
							break;
				
			case "verrsc": 						$col=GetCols('recursos');
									$col_id = $col['rid'];
						$Cols=array(
							array ( "dbname"	=>	$col['rid'],
									"label"		=>	"id del recurso",
									"width"		=>	"45px",
									"sortable"	=>	false),
							array ( "dbname"	=>	$col['uid'],
									"label"		=>	"Id del usuario",
									"width"		=>	"45px",
									"sortable"	=>	false,),				
							array ( "dbname"	=>	$col['restringido'],
									"label"		=> 	"Restringido",
									"width"		=>	"200px",
									"sortable"	=>	false));
							break;
			case "conceder": 	
									$col=GetCols('recursos');
									$col_id = $col['rid'];
							$Cols=array(
							array ( "dbname"	=>	$col['rid'],
									"label"		=>	"id del recurso",
									"width"		=>	"45px",
									"sortable"	=>	false),
							array ( "dbname"	=>	$col['uid'],
									"label"		=>	"Id del usuario",
									"width"		=>	"45px",
									"sortable"	=>	false,));
							break;
			case "registro": 
					$col=GetCols('usuarios');
									$col_id = $col['uid'];
					$Cols=array(
							array ( "dbname"	=>	$col['uid'],
									"label"		=>	"id del usuario",
									"width"		=>	"45px",
									"sortable"	=>	false),
							array ( "dbname"	=>	$col['uname'],
									"label"		=>	"Nombre",
									"width"		=>	"45px",
									"sortable"	=>	false,),				
							array ( "dbname"	=>	$col['apellidos'],
									"label"		=> 	"Apellidos",
									"width"		=>	"200px",
									"sortable"	=>	false));
							break;
			case "editar":
									$col=GetCols('usuarios');
									$col_id = $col['uid'];
			 $Cols=array(
							array ( "dbname"	=>	$col['uid'],
									"label"		=>	"id del usuario",
									"width"		=>	"45px",
									"sortable"	=>	false),
							array ( "dbname"	=>	$col['uname'],
									"label"		=>	"Nombre",
									"width"		=>	"45px",
									"sortable"	=>	false,),				
							array ( "dbname"	=>	$col['apellidos'],
									"label"		=> 	"Apellidos",
									"width"		=>	"200px",
									"sortable"	=>	false));
							break;
		}

		$opciones=array();

		$acciones=array();
		$evento=new Lister("admEventos",$Rows, 25,$Cols,$col_id,$opciones,"dg-admeventos.css");
		$evento->table="";
		$evento->where="";
		$evento->GeneralActions=$acciones;

		if ($sf!="")
			{
				$docuList->SetSort($sf,$up);}

		if ($start!="")
			{
				$docuList->SetStart($start);}
		
		return $evento->render2();

	}
?>
