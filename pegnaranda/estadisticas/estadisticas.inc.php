<?php
require_once ("usuarios/usuarios.aux.inc.php");

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
					array ( "dbname"	=>	$col['titulo'],
							"label"		=>	"Titulo",
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
		$resultado= SmartyInit();
		$plantilla="estadisticas/listarestadisticas.tpl";
		$resultado->assign("listadoRecur",$listadoRecur);		
		$resultado->assign("listadoDocu",$listadoDocu);
		$salida=$resultado->fetch($plantilla);

		vwSessionSetVar('urlantigua',CurrentUrl());
		return $salida;

	}
	
?>
