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

	
/*	function eventos($accion){
		//Eventos
		switch ($accion){
			case "solicitud":
			
								"parametros" => array( "rid","uid","razon")),
								
		}
						array ( "accion" => "verdoc",
								"parametros" => array( "did")),
						array ( "accion" => "verrsc",
								"parametros" => array( "rid","uid","restringido")),
						array ( "accion" => "conceder",
								"parametros" => array( "rid","uid")),
						array ( "accion" => "registro",
								"parametros" => array ( 'uid','txtUName','txtClave','txtEmail','txtNombre',
														'txtApellidos','txtCalle','txtPoblacion','txtProvincia',
														'txtPais','txtCPostal','txtActividad','intNivel')),
						array ( "accion" => "editar",
								"parametros" => array ( 'uid','txtClave','txtEmail','txtNombre',
														'txtApellidos','txtCalle','txtPoblacion','txtProvincia',
														'txtPais','txtCPostal','txtActividad'))
		
		$Cols=array(
					array ( "dbname"	=>	$col['did'],
							"label"		=>	"id",
							"width"		=>	"45px",
							"sortable"	=>	false),
					array ( "dbname"	=>	$col['visitas'],
							"label"		=>	"Visitas",
							"width"		=>	"45px",
							"sortable"	=>	false,
							"sort"		=>	"D"),				
					array ( "dbname"	=>	$col['signatura'],
							"label"		=> 	"Signatura",
							"width"		=>	"200px",
							"sortable"	=>	false));

		$opciones=array();

		$acciones=array();

		$docuList=new Lister("admEventos",25,$Cols,$col['did'],$opciones,"dg-admdocumentos.css");
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
			return 0;
	}*/
	

	

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
		$listadoEventos=eventos('registro');
		
		///********		
		$resultado= SmartyInit();
		$plantilla="estadisticas/listarestadisticas.tpl";
		$resultado->assign("listadoRecur",$listadoRecur);		
		$resultado->assign("listadoDocu",$listadoDocu);
		$resultado->assign("listadoEventos",$listadoEventos);
		$salida=$resultado->fetch($plantilla);

		vwSessionSetVar('urlantigua',CurrentUrl());
		return $salida;

	}
	function devuelveRows($array){
		$i=0;
		foreach ($array as $fila){
			$miArray[$i]=msgToEvent($array[$i]['txtSuceso']);
		}
	}
	function eventos($accion){
		$miArray=lastNEntriesAction('registro',25);
		$Rows=devuelveRows($miArray);
		switch ($accion){
			case "solicitud": $Cols=array(
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
							 $Cols=array(
							array ( "dbname"	=>	$col['did'],
									"label"		=>	"id del documento",
									"width"		=>	"290px",
									"sortable"	=>	false));
							break;
				
			case "verrsc": $Cols=array(
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
			case "registro": $Cols=array(
							array ( "dbname"	=>	$col['uid'],
									"label"		=>	"id del usuario",
									"width"		=>	"45px",
									"sortable"	=>	false),
							array ( "dbname"	=>	$col['uname'],
									"label"		=>	"Nombre",
									"width"		=>	"45px",
									"sortable"	=>	false,),				
							array ( "dbname"	=>	$col['apellidos'],
									"label"		=> 	"Restringido",
									"width"		=>	"200px",
									"sortable"	=>	false));
							break;
			case "editar": $Cols=array(
							array ( "dbname"	=>	$col['uid'],
									"label"		=>	"id del usuario",
									"width"		=>	"45px",
									"sortable"	=>	false),
							array ( "dbname"	=>	$col['uname'],
									"label"		=>	"Nombre",
									"width"		=>	"45px",
									"sortable"	=>	false,),				
							array ( "dbname"	=>	$col['apellidos'],
									"label"		=> 	"Restringido",
									"width"		=>	"200px",
									"sortable"	=>	false));
							break;
		}

		$opciones=array();

		$acciones=array();
		$sql="";
		$evento=new Lister("admEventos",25,$Cols,$col['did'],$opciones,"dg-admdocumentos.css");
		$evento->table="";
		$evento->where="";
		$evento->GeneralActions=$acciones;

		if ($sf!="")
			{
				$docuList->SetSort($sf,$up);}

		if ($start!="")
			{
				$docuList->SetStart($start);}
		
		return $evento->render();

	}
?>
