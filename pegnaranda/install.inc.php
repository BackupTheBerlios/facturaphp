<?php

	function install_db()
		{
			$FullTables=GetTables();
			$tables=$FullTables['t'];
			$cols=$FullTables['c'];

			$archivos=$cols['archivos'];
			$autorizaciones=$cols['autorizaciones'];
			$documentos=$cols['documentos'];
			$eventos=$cols['eventos'];
			$recursos=$cols['recursos'];
			$secciones=$cols['secciones'];
			$usuarios=$cols['usuarios'];
			$noticias=$cols['noticias'];
			$vars=$cols['vars'];

			$sql=array();

			$sql['sql'][]="CREATE TABLE $tables[archivos]
									(	$archivos[aid] int(11) unsigned NOT NULL auto_increment,
										$archivos[abrev] varchar(200) NOT NULL default 'N/D',
										$archivos[nombre] text,
										PRIMARY KEY($archivos[aid])) type=MyISAM COMMENT='Tabla de archivos';";

			$sql['sql'][]="CREATE TABLE $tables[autorizaciones]
							(	$autorizaciones[autid] int(11) unsigned NOT NULL auto_increment,
								$autorizaciones[uid]	int(11) unsigned NOT NULL default '0',
								$autorizaciones[rid]	int(11) unsigned NOT NULL default '0',
								$autorizaciones[solicitud] timestamp(14),
								$autorizaciones[resolucion] timestamp(14),
								$autorizaciones[estado] char(1) default 'P',
								$autorizaciones[razon] text,
								PRIMARY KEY($autorizaciones[autid])) type=MyISAM COMMENT='Tabla de autorizaciones';";
			$sql['drop'][]="$tables[archivos]";

			$sql['sql'][]="CREATE TABLE $tables[documentos]
							(	$documentos[did] int(11) unsigned NOT NULL auto_increment,
								$documentos[aid] int(11) unsigned NOT NULL,
								$documentos[sid] int(11) unsigned NOT NULL,
								$documentos[folios] varchar(100)  NOT NULL,
								$documentos[signatura] varchar(250)  NOT NULL,
								$documentos[siglos] varchar(100)  NOT NULL,
								$documentos[periodo] varchar(100)  NOT NULL,
								$documentos[idantiguo] int(11) unsigned,
								$documentos[visitas] int(11) unsigned default 0,
								$documentos[resumen] text,
								$documentos[notas] text,
								$documentos[titulo] text,
								PRIMARY KEY($documentos[did]),
								FULLTEXT ($documentos[resumen])) type=MyISAM COMMENT='Tabla de los Documentos';";
			$sql['drop'][]="$tables[autorizaciones]";

			$sql['sql'][]="CREATE TABLE $tables[eventos]
							(	$eventos[eid] int(11) unsigned NOT NULL auto_increment,
								$eventos[fecha] timestamp(14),
								$eventos[suceso] varchar(250) NOT NULL default 'Some event has passed',
								PRIMARY KEY($eventos[eid])) type=MyISAM COMMENT='Tabla con los ejemplos';";
			$sql['drop'][]="$tables[documentos]";

			$sql['sql'][]="CREATE TABLE $tables[noticias]
							(	$noticias[nid] int(11) unsigned NOT NULL auto_increment,
								$noticias[titulo] varchar(200) NOT NULL,
								$noticias[contenido] text,
								$noticias[publicacion] timestamp(14),
								$noticias[retirada]	timestamp(14),
								$noticias[uid] int(11) unsigned,
								PRIMARY KEY($noticias[nid])) type=MyISAM COMMENT='Tabla de noticias';";
			$sql['drop'][]="$tables[eventos]";

			$sql['sql'][]="CREATE TABLE $tables[recursos]
							(	$recursos[rid] int(11) unsigned NOT NULL auto_increment,
								$recursos[did] int(11) unsigned NOT NULL,
								$recursos[archivo] varchar(255),
								$recursos[ruta] varchar(255),
								$recursos[url] varchar(255),
								$recursos[titulo] varchar(255),
								$recursos[restringido] char(1) NOT NULL default 'N',
								$recursos[accesos] int(11) unsigned NOT NULL default 0,
								$recursos[solicitudes] int(11) unsigned NOT NULL default 0,
								PRIMARY KEY($recursos[rid])) type=MyISAM COMMENT='Tabla de recursos';";
			$sql['drop'][]="$tables[noticias]";

			$sql['sql'][]="CREATE TABLE $tables[secciones]
							(	$secciones[sid] int(11) unsigned NOT NULL auto_increment,
								$secciones[nombre] varchar(255),
								PRIMARY KEY($secciones[sid])) type=MyISAM COMMENT='Tabla de secciones';";
			$sql['drop'][]="$tables[recursos]";

			$sql['sql'][]="CREATE TABLE $tables[usuarios]
							(	$usuarios[uid] int(11) unsigned NOT NULL auto_increment,
								$usuarios[uname] varchar(32) NOT NULL,
								$usuarios[clave] varchar(32) NOT NULL,
								$usuarios[email] varchar(160) NOT NULL,
								$usuarios[nombre] varchar(160) NOT NULL,
								$usuarios[apellidos] varchar(160) NOT NULL,
								$usuarios[calle] varchar(160) NOT NULL,
								$usuarios[poblacion] varchar(160) NOT NULL,
								$usuarios[provincia] varchar(60) NOT NULL,
								$usuarios[pais] varchar(60) NOT NULL,
								$usuarios[cpostal] char(5) NOT NULL,
								$usuarios[actividad] varchar(160) NOT NULL,
								$usuarios[nivel] int NOT NULL,
								$usuarios[preferencias] text,
								PRIMARY KEY ($usuarios[uid])) type=MyISAM COMMENT='Tabla con los datos de usuario';";
			$sql['drop'][]="$tables[secciones]";

			$sql['sql'][]="CREATE TABLE $tables[vars]
							(	$vars[session_id] char(32) not null,
								$vars[name] varchar(64) NOT NULL,
								$vars[value] text NOT NULL
								) type=MyISAM COMMENT='Tabla con las variables persistentes';";
			$sql['drop'][]="$tables[usuarios]";

			$sql['drop'][]="$tables[vars]";

			return $sql;
			}

	function install_dbdata()
		{
			$FullTables=GetTables();
			$tables=$FullTables['t'];
			$cuser=$FullTables['c']['usuarios'];

			$datainsert[]="INSERT INTO 	`$tables[usuarios]` (`$cuser[uid]`, `$cuser[nombre]`, `$cuser[apellidos]`, `$cuser[calle]`,
										`$cuser[poblacion]`, `$cuser[provincia]`, `$cuser[pais]`, `$cuser[cpostal]`, `$cuser[actividad]`,
										`$cuser[uname]`, `$cuser[clave]`, `$cuser[nivel]`,`$cuser[email]`)
							VALUES (NULL, 'Vicente Antonio', 'Werner y S&aacute;nchez','Avda Olympus Mons 1',
									'Syria Planitia', 'Syria Planum','Mars','M0909','Administrador',
									'TheWind','".md5("yu98az")."', 1000,'vicente@wapcomunicaciones.com')";
			echo $datainsert;
			return $datainsert;
		}

?>
