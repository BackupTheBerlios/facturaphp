<?php

function InitTables()
{
	$tables=array();

	$tables['archivos']='tblArchivos';
	$tables['autorizaciones']='tblAutorizaciones';
	$tables['documentos']='tblDocumentos';
	$tables['eventos']='tblEventos';
	$tables['recursos']='tblRecursos';
	$tables['secciones']='tblSecciones';
	$tables['usuarios']='tblUsuarios';
	$tables['noticias']='tblNoticias';
	$tables['vars']='tblVars';

	$columns=array();
	$columns['archivos']=array(	'aid' 		=>	"aid",
								'abrev'		=>	"txtAbreviatura",
								'nombre'	=>	"txtNombre");
	$columns['autorizaciones']=array(	'autid'			=>	"autid",
										'uid'			=>	"uid",
										'rid'			=>	"rid",
										'solicitud'		=>	"datSolicitud",
										'resolucion'	=>	"datResolucion",
										'estado'		=>	"txtEstado",
										'razon'			=>	"ltxRazon"
										);
	/*$columns['documentos']=array(	'did'		=>	'did',
									'aid'		=>	'aid',
									'sid'		=>	'sid',
									'folios'	=>	'txtFolios',
									'signatura'	=>	'txtSignatura',
									'siglos'	=>	'txtSiglos',
									'periodo'	=>	'txtPeriodoCronologico',
									'idantiguo'	=>	'txtIdAntiguo',
									'visitas'	=>	'intVisitas',
									'resumen'	=>	'ltxResumen',
									'notas'		=>	'ltxNotas'
									);*/
									
	$columns['documentos']=array(	'did'		=>	'did',
									'aid'		=>	'aid',
									'sid'		=>	'sid',
									'folios'	=>	'txtFolios',
									'signatura'	=>	'txtSignatura',
									'siglos'	=>	'txtSiglos',
									'periodo'	=>	'txtPeriodoCronologico',
									'idantiguo'	=>	'txtIdAntiguo',
									'visitas'	=>	'intVisitas',
									'resumen'	=>	'ltxResumen',
									'notas'		=>	'ltxNotas',
									'titulo'	=>	'ltxTitulo'
									);

	$columns['eventos']=array(	'eid'	=>	'eid',
								'fecha'	=>	'datEvento',
								'suceso'=>	'txtSuceso');

	$columns['recursos']=array(	'rid'			=>	'rid',
								'did'			=>	'did',
								'archivo'		=>	'txtNombreArchivo',
								'ruta'			=>	'txtRuta',
								'url'			=>	'txtUrl',
								'titulo'		=>	'txtTituloRecurso',
								'restringido'	=>	'txtRestringido',
								'accesos'		=>	'intAccesos',
								'solicitudes'	=>	'intSolicitudes'
								);

	$columns['secciones']=array('sid'	=>	'sid',
								'nombre'=>	'txtNombreref'
								);

	$columns['usuarios']=array(	'uid'			=>		'uid',
								'uname'			=>		'txtUName',
								'clave'			=>		'txtClave',
								'email'			=>		'txtEmail',
								'nombre'		=>		'txtNombre',
								'apellidos'		=>		'txtApellidos',
								'calle'			=>		'txtCalle',
								'poblacion'		=>		'txtPoblacion',
								'provincia'		=>		'txtProvincia',
								'pais'			=>		'txtPais',
								'cpostal'		=>		'txtCPostal',
								'actividad'		=>		'txtActividad',
								'nivel'			=>		'intNivel',
								'preferencias'	=>		'ltxPreferencias');

	$columns['noticias']=array(	'nid'			=>	'nid',
								'titulo'		=>	'txtTitulo',
								'contenido'		=>	'ltxTitulo',
								'publicacion'	=>	'datPublicacion',
								'retirada'		=>	'datRetirada',
								'uid'			=>	'uid');

	$columns['vars']=array(	'session_id'	=>	'session_id',
							'name'			=>	'name',
							'value'			=>	'value');

	return array(	't'		=>		$tables,
					'c'		=>		$columns);

	}
?>
