-- phpMyAdmin SQL Dump
-- version 2.6.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 19-01-2005 a las 14:19:04
-- Versión del servidor: 4.1.7
-- Versión de PHP: 5.0.2
-- 
-- Base de datos: `transporte`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cat_emps`
-- 

CREATE TABLE `cat_emps` (
  `id_cat_emp` int(11) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `descrip` text NOT NULL,
  PRIMARY KEY  (`id_cat_emp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `cat_emps`
-- 

INSERT INTO `cat_emps` VALUES (1, 'Gestor', 'Gestor de empleados');
INSERT INTO `cat_emps` VALUES (2, 'Director jefe', 'Director Jefe en funciones');
INSERT INTO `cat_emps` VALUES (3, 'Transportista', 'Persona que conduce los veh?culos de la empresa');
INSERT INTO `cat_emps` VALUES (4, 'Limpiador', 'Personal de limpieza');
INSERT INTO `cat_emps` VALUES (5, 'Contable', 'Contable de la empresa');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cat_prods`
-- 

CREATE TABLE `cat_prods` (
  `id_cat_prod` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `descrip` varchar(255) NOT NULL default '',
  `id_parent_cat` int(11) NOT NULL default '0',
  `path_photo` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id_cat_prod`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `cat_prods`
-- 

INSERT INTO `cat_prods` VALUES (24, 'categoriafdsfdg', 'afdafafdfff', 0, 'images/cat_prods/24.JPG');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cat_vehicles`
-- 

CREATE TABLE `cat_vehicles` (
  `id_cat_vehicle` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `name_web` varchar(50) NOT NULL default '',
  `descrip` text NOT NULL,
  PRIMARY KEY  (`id_cat_vehicle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `cat_vehicles`
-- 

INSERT INTO `cat_vehicles` VALUES (1, 'mi veh?culo', 'mi veh?culo', ' s?lo m?o qui?n lo toque se las ver? con la poli');
INSERT INTO `cat_vehicles` VALUES (10, 'Otra', 'ota', 'sdfafafasdf');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `corps`
-- 

CREATE TABLE `corps` (
  `id_corp` int(11) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `full_name` varchar(50) NOT NULL default '',
  `cif_nif` varchar(10) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `fiscal_address` varchar(255) NOT NULL default '',
  `postal_address` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `mail` varchar(100) NOT NULL default '',
  `city` varchar(50) NOT NULL default '',
  `state` varchar(50) NOT NULL default '',
  `postal_code` varchar(10) NOT NULL default '',
  `country` varchar(50) NOT NULL default '',
  `phone` varchar(15) NOT NULL default '',
  `fax` varchar(15) NOT NULL default '',
  `mobile_phone` varchar(15) NOT NULL default '',
  `notes` text NOT NULL,
  PRIMARY KEY  (`id_corp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `corps`
-- 

INSERT INTO `corps` VALUES (1, 'Resuival', 'Resuival', '76915846-L', 'Avd Portugal', 'Avd Portugal', 'Avd Portugal', 'www.resuival.es', 'elena@resuival.es', 'Salamanca', 'Salamanca', '37009', 'Espa?a', '923487512', '923487512', '659326789', 'Empresa de limpieza y transporte');
INSERT INTO `corps` VALUES (2, 'Copiar-pegar', 'Copiar-Pegar Salamanca', '70952648', 'Alfonso IX', 'Alfonso IX', 'Alfonso IX', 'www.copiar-pegar.com', 'david@copiar-pegar.com', 'Salamanca', 'CyL', '37008', 'Espa?a', '923180512', '923180512', '656661478', 'Empresa de desarrollo basado en el software libre. Impulsadora de conocimientos mediante la ense?anza.');
INSERT INTO `corps` VALUES (3, 'Drag and Drop', 'Drag and Drop Salamanca', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `drivers`
-- 

CREATE TABLE `drivers` (
  `id_driver` int(11) unsigned NOT NULL auto_increment,
  `id_emp` int(11) unsigned NOT NULL default '0',
  `id_vehicle` int(11) unsigned NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id_driver`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `drivers`
-- 

INSERT INTO `drivers` VALUES (1, 3, 1, 0x323030352d31322d3330);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `emps`
-- 

CREATE TABLE `emps` (
  `id_emp` int(11) NOT NULL auto_increment,
  `id_corp` int(11) NOT NULL default '0',
  `id_user` int(11) NOT NULL default '0',
  `name` varchar(20) NOT NULL default '',
  `last_name` varchar(20) NOT NULL default '',
  `last_name2` varchar(20) NOT NULL default '',
  `birthday` date NOT NULL default '0000-00-00',
  `phone` varchar(15) NOT NULL default '',
  `mobile_phone` varchar(15) NOT NULL default '',
  `fax` varchar(15) NOT NULL default '',
  `mail` varchar(50) NOT NULL default '',
  `address` varchar(255) NOT NULL default '',
  `city` varchar(50) NOT NULL default '',
  `state` varchar(50) NOT NULL default '',
  `postal_code` varchar(10) NOT NULL default '',
  `country` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id_emp`),
  KEY `id_corp` (`id_corp`,`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `emps`
-- 

INSERT INTO `emps` VALUES (1, 1, 3, 'Elena', 'Resuival', 'Resuival', 0x303030302d30302d3030, '923564871', '665123489', '923564871', 'elena@hotmail.com', 'Calle ancha 63', 'Salamanca', 'Salamanca', '37006', 'Espa?a');
INSERT INTO `emps` VALUES (2, 1, 1, 'David', 'Vaquero', 'Santiago', 0x323030342d31302d3235, '923247845', '646754340', '923247845', 'david@copiar-pegar.com', 'M?sico Antonio Jos', 'Salamanca', 'Salamanca', '37004', 'Espa?a');
INSERT INTO `emps` VALUES (3, 2, 1, 'David', 'Vaquero', 'Santiago', 0x323030342d31302d3235, '923247845', '646754340', '923247845', 'david@copiar-pegar.com', 'M?sico Antonio Jos', 'Salamanca', 'Salamanca', '37004', 'Espa?a');
INSERT INTO `emps` VALUES (4, 2, 2, 'Daniel', 'Gonz?lez', 'Zaballos', 0x303030302d30302d3030, '923654875', '646754340', '923654875', 'daniel@copiar-pegar.com', 'Calle larga 26', 'Do?inos', 'Salamanca', '37009', 'Espa?a');
INSERT INTO `emps` VALUES (5, 2, 4, 'Roc', 'Guti?rrez', 'Gonz?lez', 0x303030302d30302d3030, '923268475', '665053440', '', 'rocio_gg15@hotmail.com', 'Camino de Miranda 38', 'Salamanca', 'CyL', '37008', 'Espa?a');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `group_users`
-- 

CREATE TABLE `group_users` (
  `id_group_user` int(11) unsigned NOT NULL auto_increment,
  `id_group` int(11) unsigned NOT NULL default '0',
  `id_user` int(11) unsigned NOT NULL default '0',
  `up` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id_group_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `group_users`
-- 

INSERT INTO `group_users` VALUES (1, 1, 1, 0x323030342d31322d3132);
INSERT INTO `group_users` VALUES (45, 2, 1, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (46, 3, 1, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (47, 4, 1, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (48, 5, 1, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (49, 6, 1, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (50, 7, 1, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (51, 8, 1, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (52, 9, 1, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (53, 10, 1, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (54, 11, 1, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (55, 12, 1, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (56, 13, 1, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (57, 1, 2, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (58, 2, 3, 0x303030302d30302d3030);
INSERT INTO `group_users` VALUES (59, 9, 4, 0x303030302d30302d3030);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `groups`
-- 

CREATE TABLE `groups` (
  `id_group` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `name_web` varchar(100) NOT NULL default '',
  `descrip` text NOT NULL,
  PRIMARY KEY  (`id_group`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `groups`
-- 

INSERT INTO `groups` VALUES (1, 'superadmin', 'Super Administrador', 'Persona con capacidad de acceso a todas las herremientas de la aplicacion');
INSERT INTO `groups` VALUES (2, 'admin', 'Administrador', 'Personal con permiso de acceso en todos los m?dulos internos de la aplicaci?n con peque?as restricciones');
INSERT INTO `groups` VALUES (3, 'conductor', 'Conductores', '');
INSERT INTO `groups` VALUES (4, 'user', 'Usuario', '');
INSERT INTO `groups` VALUES (5, 'Grupo de Pr?cticas', 'Grupo de Pr&aacute;cticas', 'Personal de pr?cticas en empresa que tendr?n acceso a la aplicaci?n');
INSERT INTO `groups` VALUES (6, 'contable', 'Contables', '');
INSERT INTO `groups` VALUES (7, 'limpieza', 'Limpieza', '');
INSERT INTO `groups` VALUES (8, 'root', 'Root', '');
INSERT INTO `groups` VALUES (9, 'simple_user', 'Usuario Simple', '');
INSERT INTO `groups` VALUES (10, 'test', 'Test', '');
INSERT INTO `groups` VALUES (11, 'guest', 'Invitado', '');
INSERT INTO `groups` VALUES (12, 'gerente', 'Gerente', '');
INSERT INTO `groups` VALUES (13, 'administrativo', 'Administrativo', '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `holydays`
-- 

CREATE TABLE `holydays` (
  `id_holy` int(11) NOT NULL auto_increment,
  `id_emp` int(11) NOT NULL default '0',
  `gone` date NOT NULL default '0000-00-00',
  `come` date NOT NULL default '0000-00-00',
  `ill` tinyint(3) NOT NULL default '0',
  `descrip` text NOT NULL,
  PRIMARY KEY  (`id_holy`),
  KEY `id_emp` (`id_emp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `holydays`
-- 

INSERT INTO `holydays` VALUES (1, 1, 0x323030342d30382d3036, 0x323030342d30382d3139, 0, 'sdasdfasdfasdfa');
INSERT INTO `holydays` VALUES (3, 0, 0x303030302d30302d3030, 0x323030342d31322d3037, 2, '');
INSERT INTO `holydays` VALUES (8, 0, 0x303030302d30302d3030, 0x303030302d30302d3030, 2, '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `laborers`
-- 

CREATE TABLE `laborers` (
  `id_laborer` int(11) unsigned NOT NULL auto_increment,
  `id_emp` int(11) unsigned NOT NULL default '0',
  `id_vehicle` int(11) unsigned NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id_laborer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `laborers`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `log_methods`
-- 

CREATE TABLE `log_methods` (
  `id_log_method` int(11) unsigned NOT NULL auto_increment,
  `id_user` int(11) unsigned NOT NULL default '0',
  `id_method` int(11) unsigned NOT NULL default '0',
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `id_method_type` tinyint(3) unsigned NOT NULL default '0',
  `sql_sentence` text NOT NULL,
  `afected` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_log_method`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `log_methods`
-- 

INSERT INTO `log_methods` VALUES (1, 1, 1, '0000-00-00 00:00:00', 2, '', 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `log_sessions`
-- 

CREATE TABLE `log_sessions` (
  `id_log_session` int(11) unsigned NOT NULL auto_increment,
  `id_session` int(11) unsigned NOT NULL default '0',
  `date_in` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_out` datetime NOT NULL default '0000-00-00 00:00:00',
  `timeout` time NOT NULL default '00:00:00',
  `ip` varchar(20) NOT NULL default '',
  `id_user` int(11) unsigned NOT NULL default '0',
  `country` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`id_log_session`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `log_sessions`
-- 

INSERT INTO `log_sessions` VALUES (1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0x30303a30303a3030, '127.0.0.1', 1, 'espa?a');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `methods`
-- 

CREATE TABLE `methods` (
  `id_method` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `name_web` varchar(50) NOT NULL default '',
  `id_module` int(11) unsigned NOT NULL default '0',
  `id_type_method` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id_method`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `methods`
-- 

INSERT INTO `methods` VALUES (1, 'add', 'A&ntilde;adir', 1, 1);
INSERT INTO `methods` VALUES (2, 'modify', 'Modificar', 1, 1);
INSERT INTO `methods` VALUES (3, 'delete', 'Borrar', 1, 0);
INSERT INTO `methods` VALUES (4, 'list', 'Listar', 1, 0);
INSERT INTO `methods` VALUES (5, 'view', 'Ver', 1, 0);
INSERT INTO `methods` VALUES (7, 'add', 'A&ntilde;adir', 4, 1);
INSERT INTO `methods` VALUES (8, 'modify', 'Modificar', 4, 1);
INSERT INTO `methods` VALUES (9, 'delete', 'Borrar', 4, 0);
INSERT INTO `methods` VALUES (10, 'list', 'Listar', 4, 0);
INSERT INTO `methods` VALUES (11, 'view', 'Ver', 4, 0);
INSERT INTO `methods` VALUES (13, 'add', 'A&ntilde;adir', 5, 1);
INSERT INTO `methods` VALUES (14, 'modify', 'Modificar', 5, 1);
INSERT INTO `methods` VALUES (15, 'delete', 'Borrar', 5, 0);
INSERT INTO `methods` VALUES (16, 'list', 'Listar', 5, 0);
INSERT INTO `methods` VALUES (17, 'view', 'Ver', 5, 0);
INSERT INTO `methods` VALUES (19, 'add', 'A&ntilde;adir', 6, 1);
INSERT INTO `methods` VALUES (20, 'modify', 'Modificar', 6, 1);
INSERT INTO `methods` VALUES (21, 'delete', 'Borrar', 6, 0);
INSERT INTO `methods` VALUES (22, 'list', 'Listar', 6, 0);
INSERT INTO `methods` VALUES (23, 'view', 'Ver', 6, 0);
INSERT INTO `methods` VALUES (24, 'add', 'A&ntilde;adir', 8, 1);
INSERT INTO `methods` VALUES (25, 'modify', 'Modificar', 8, 1);
INSERT INTO `methods` VALUES (26, 'delete', 'Borrar', 8, 0);
INSERT INTO `methods` VALUES (27, 'list', 'Listar', 8, 0);
INSERT INTO `methods` VALUES (28, 'view', 'Ver', 8, 0);
INSERT INTO `methods` VALUES (29, 'add', 'A&ntilde;adir', 9, 1);
INSERT INTO `methods` VALUES (30, 'modify', 'Modificar', 9, 1);
INSERT INTO `methods` VALUES (31, 'delete', 'Borrar', 9, 0);
INSERT INTO `methods` VALUES (32, 'list', 'Listar', 9, 0);
INSERT INTO `methods` VALUES (33, 'view', 'Ver', 9, 0);
INSERT INTO `methods` VALUES (34, 'select', 'Seleccionar', 7, 1);
INSERT INTO `methods` VALUES (35, 'list', 'Listar', 20, 0);
INSERT INTO `methods` VALUES (36, 'add', 'A?adir', 20, 0);
INSERT INTO `methods` VALUES (37, 'modify', 'Modificar', 20, 0);
INSERT INTO `methods` VALUES (38, 'delete', 'Borrar', 20, 0);
INSERT INTO `methods` VALUES (40, 'list', 'Listar', 22, 0);
INSERT INTO `methods` VALUES (53, 'list', 'Listar', 30, 0);
INSERT INTO `methods` VALUES (54, 'view', 'Ver', 30, 0);
INSERT INTO `methods` VALUES (55, 'add', 'Añadir', 30, 0);
INSERT INTO `methods` VALUES (56, 'modify', 'Modificar', 30, 0);
INSERT INTO `methods` VALUES (57, 'delete', 'Borrar', 30, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `modules`
-- 

CREATE TABLE `modules` (
  `id_module` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `name_web` varchar(50) NOT NULL default '',
  `path` varchar(255) NOT NULL default '',
  `active` tinyint(3) unsigned NOT NULL default '0',
  `public` tinyint(3) unsigned NOT NULL default '0',
  `parent` int(11) unsigned NOT NULL default '0',
  `order` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_module`),
  UNIQUE KEY `nombre` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `modules`
-- 

INSERT INTO `modules` VALUES (1, 'users', 'Usuarios', 'index.php?module=users', 1, 0, 18, 11);
INSERT INTO `modules` VALUES (2, 'news', 'Noticias', 'index.php?module=news', 1, 1, 0, 1);
INSERT INTO `modules` VALUES (3, 'user_corps', 'Elegir empresa', 'index.php?module=user_corps', 1, 0, 4, 31);
INSERT INTO `modules` VALUES (4, 'corps', 'Empresas', 'index.php?module=corps', 1, 0, 0, 30);
INSERT INTO `modules` VALUES (5, 'groups', 'Grupos', 'index.php?module=groups', 1, 0, 18, 12);
INSERT INTO `modules` VALUES (6, 'emps', 'Empleados', 'index.php?module=emps', 1, 0, 4, 32);
INSERT INTO `modules` VALUES (7, 'error', 'Errores', 'index.php?module=error', 0, 0, 0, 0);
INSERT INTO `modules` VALUES (8, 'modules', 'M?dulos', 'index.php?module=modules', 1, 0, 29, 21);
INSERT INTO `modules` VALUES (9, 'cat_emps', 'Categor?as de Empleados', 'index.php?module=cat_emps', 1, 0, 4, 33);
INSERT INTO `modules` VALUES (10, 'holydays', 'Altas/Bajas', 'index.php?module=holydays', 1, 0, 4, 34);
INSERT INTO `modules` VALUES (11, 'products', 'Productos', 'index.php?module=products', 1, 1, 4, 2);
INSERT INTO `modules` VALUES (12, 'services', 'Servicios', 'index.php?module=services', 1, 1, 4, 3);
INSERT INTO `modules` VALUES (13, 'vehicles', 'Veh?culos', 'index.php?module=vehicles', 1, 0, 0, 40);
INSERT INTO `modules` VALUES (14, 'cat_vehicles', 'Categor?as de veh?culos', 'index.php?module=cat_vehicles', 1, 0, 13, 42);
INSERT INTO `modules` VALUES (15, 'drivers', 'Conductores', 'index.php?module=drivers', 1, 0, 13, 43);
INSERT INTO `modules` VALUES (16, 'contact', 'Contacto', 'index.php?module=contact', 1, 1, 0, 4);
INSERT INTO `modules` VALUES (17, 'sessions', 'Sesiones', 'index.php?module=sessions', 1, 0, 18, 13);
INSERT INTO `modules` VALUES (18, 'access_gestion', 'Gesti?n de acceso', 'index.php?module=access_gestion', 1, 0, 0, 10);
INSERT INTO `modules` VALUES (19, 'vehicles_list', 'Listado de veh?culos', 'index.php?', 1, 0, 13, 41);
INSERT INTO `modules` VALUES (29, 'modules_gestion', 'Gesti?n de m?dulos', 'index.php?module=modules_gestion', 1, 0, 0, 20);
INSERT INTO `modules` VALUES (30, 'cat_prods', 'Categorías de Productos', 'index.php?module=cat_prods', 1, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `per_group_methods`
-- 

CREATE TABLE `per_group_methods` (
  `id_per_group_method` int(11) unsigned NOT NULL auto_increment,
  `id_group` int(11) unsigned NOT NULL default '0',
  `id_method` int(11) unsigned NOT NULL default '0',
  `per` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_per_group_method`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `per_group_methods`
-- 

INSERT INTO `per_group_methods` VALUES (1, 9, 2, 1);
INSERT INTO `per_group_methods` VALUES (2, 9, 5, 1);
INSERT INTO `per_group_methods` VALUES (3, 9, 20, 1);
INSERT INTO `per_group_methods` VALUES (4, 9, 23, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `per_group_modules`
-- 

CREATE TABLE `per_group_modules` (
  `id_per_group_module` int(10) unsigned NOT NULL auto_increment,
  `id_group` int(10) unsigned NOT NULL default '0',
  `id_module` int(10) unsigned NOT NULL default '0',
  `per` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_per_group_module`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `per_group_modules`
-- 

INSERT INTO `per_group_modules` VALUES (1, 9, 1, 1);
INSERT INTO `per_group_modules` VALUES (68, 9, 6, 1);
INSERT INTO `per_group_modules` VALUES (69, 1, 1, 1);
INSERT INTO `per_group_modules` VALUES (70, 1, 2, 1);
INSERT INTO `per_group_modules` VALUES (71, 1, 3, 1);
INSERT INTO `per_group_modules` VALUES (72, 1, 4, 1);
INSERT INTO `per_group_modules` VALUES (73, 1, 5, 1);
INSERT INTO `per_group_modules` VALUES (74, 1, 6, 1);
INSERT INTO `per_group_modules` VALUES (75, 1, 7, 1);
INSERT INTO `per_group_modules` VALUES (76, 1, 8, 1);
INSERT INTO `per_group_modules` VALUES (77, 1, 9, 1);
INSERT INTO `per_group_modules` VALUES (78, 1, 20, 1);
INSERT INTO `per_group_modules` VALUES (79, 2, 1, 1);
INSERT INTO `per_group_modules` VALUES (80, 2, 2, 1);
INSERT INTO `per_group_modules` VALUES (81, 2, 3, 1);
INSERT INTO `per_group_modules` VALUES (82, 2, 4, 1);
INSERT INTO `per_group_modules` VALUES (83, 2, 5, 1);
INSERT INTO `per_group_modules` VALUES (84, 2, 6, 1);
INSERT INTO `per_group_modules` VALUES (85, 2, 7, 1);
INSERT INTO `per_group_modules` VALUES (86, 2, 9, 1);
INSERT INTO `per_group_modules` VALUES (87, 2, 20, 1);
INSERT INTO `per_group_modules` VALUES (88, 2, 21, 1);
INSERT INTO `per_group_modules` VALUES (89, 2, 22, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `per_user_methods`
-- 

CREATE TABLE `per_user_methods` (
  `id_per_user_method` int(11) unsigned NOT NULL auto_increment,
  `id_user` int(11) unsigned NOT NULL default '0',
  `id_method` int(11) unsigned NOT NULL default '0',
  `per` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_per_user_method`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `per_user_methods`
-- 

INSERT INTO `per_user_methods` VALUES (1, 4, 17, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `per_user_modules`
-- 

CREATE TABLE `per_user_modules` (
  `id_per_user_module` int(10) unsigned NOT NULL auto_increment,
  `id_user` int(10) unsigned NOT NULL default '0',
  `id_module` int(10) unsigned NOT NULL default '0',
  `per` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_per_user_module`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `per_user_modules`
-- 

INSERT INTO `per_user_modules` VALUES (67, 1, 7, 1);
INSERT INTO `per_user_modules` VALUES (68, 2, 7, 1);
INSERT INTO `per_user_modules` VALUES (72, 4, 5, 1);
INSERT INTO `per_user_modules` VALUES (74, 3, 7, 1);
INSERT INTO `per_user_modules` VALUES (87, 4, 7, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `products`
-- 

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL auto_increment,
  `id_corp` int(11) NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  `name_web` varchar(50) NOT NULL default '',
  `path_photo` varchar(255) NOT NULL default '',
  `pvp` decimal(10,0) NOT NULL default '0',
  `tax` decimal(10,0) NOT NULL default '0',
  `pvp_tax` decimal(10,0) NOT NULL default '0',
  `minimun_stock` decimal(10,0) NOT NULL default '0',
  PRIMARY KEY  (`id_product`),
  KEY `id_corp` (`id_corp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `products`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_emps_cats`
-- 

CREATE TABLE `rel_emps_cats` (
  `id_rel_emp_cat` int(11) NOT NULL auto_increment,
  `id_emp` int(11) NOT NULL default '0',
  `id_cat_emp` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_rel_emp_cat`),
  KEY `id_emp` (`id_emp`,`id_cat_emp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `rel_emps_cats`
-- 

INSERT INTO `rel_emps_cats` VALUES (6, 7, 1);
INSERT INTO `rel_emps_cats` VALUES (9, 9, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_prods_cats`
-- 

CREATE TABLE `rel_prods_cats` (
  `id_rel_prod_cat` int(11) NOT NULL auto_increment,
  `id_prod` int(11) NOT NULL default '0',
  `id_cat_prod` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_rel_prod_cat`),
  KEY `id_prod` (`id_prod`,`id_cat_prod`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `rel_prods_cats`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_vehicles_cats`
-- 

CREATE TABLE `rel_vehicles_cats` (
  `id_rel_vehicle_cat` int(11) unsigned NOT NULL auto_increment,
  `id_vehicle` int(11) unsigned NOT NULL default '0',
  `id_cat_vehicle` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_rel_vehicle_cat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `rel_vehicles_cats`
-- 

INSERT INTO `rel_vehicles_cats` VALUES (46, 205, 1);
INSERT INTO `rel_vehicles_cats` VALUES (7, 2, 10);
INSERT INTO `rel_vehicles_cats` VALUES (8, 3, 1);
INSERT INTO `rel_vehicles_cats` VALUES (9, 4, 1);
INSERT INTO `rel_vehicles_cats` VALUES (45, 204, 1);
INSERT INTO `rel_vehicles_cats` VALUES (26, 185, 0);
INSERT INTO `rel_vehicles_cats` VALUES (27, 186, 1);
INSERT INTO `rel_vehicles_cats` VALUES (25, 184, 0);
INSERT INTO `rel_vehicles_cats` VALUES (36, 195, 1);
INSERT INTO `rel_vehicles_cats` VALUES (44, 203, 1);
INSERT INTO `rel_vehicles_cats` VALUES (47, 206, 1);
INSERT INTO `rel_vehicles_cats` VALUES (48, 207, 1);
INSERT INTO `rel_vehicles_cats` VALUES (49, 208, 1);
INSERT INTO `rel_vehicles_cats` VALUES (50, 209, 1);
INSERT INTO `rel_vehicles_cats` VALUES (51, 210, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sessions`
-- 

CREATE TABLE `sessions` (
  `id_session` int(10) unsigned NOT NULL auto_increment,
  `id_session_php` varchar(255) NOT NULL default '',
  `id_user` int(11) NOT NULL default '0',
  `up` datetime NOT NULL default '0000-00-00 00:00:00',
  `down` datetime default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_session`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `sessions`
-- 

INSERT INTO `sessions` VALUES (1, 'adfadfadfadfadfa', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `users`
-- 

CREATE TABLE `users` (
  `id_user` int(10) unsigned NOT NULL auto_increment,
  `login` varchar(20) NOT NULL default '',
  `passwd` varchar(20) NOT NULL default '',
  `name` varchar(20) NOT NULL default '',
  `last_name` varchar(20) NOT NULL default '',
  `last_name2` varchar(20) NOT NULL default '',
  `full_name` varchar(100) NOT NULL default '',
  `internal` tinyint(3) NOT NULL default '0',
  `active` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `users`
-- 

INSERT INTO `users` VALUES (1, 'admin', 'sta3war2', 'David', 'Vaquero', 'Santiago', 'David Vaquero Santiago', 0, 0);
INSERT INTO `users` VALUES (2, 'admin2', 'sta3war2', 'Daniel', 'González', 'Zaballos', 'Daniel González Zaballos', 1, 1);
INSERT INTO `users` VALUES (3, 'Elena', 'elena', 'Elena', 'Resuival', '', '', 0, 0);
INSERT INTO `users` VALUES (4, 'rocio', 'rocio', 'Roc', 'Guti?rrez', 'Gonz?lez', 'Roc?o Guti?rrez Gonz?lez', 0, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `vehicles`
-- 

CREATE TABLE `vehicles` (
  `id_vehicle` int(11) unsigned NOT NULL auto_increment,
  `id_corp` int(11) unsigned NOT NULL default '0',
  `number_plate` varchar(10) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `path_photo` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id_vehicle`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Volcar la base de datos para la tabla `vehicles`
-- 

INSERT INTO `vehicles` VALUES (205, 2, 'asdfas', 'sadfasf', 'images/vehicles/205.JPG');
INSERT INTO `vehicles` VALUES (203, 2, 'afd', 'dsafas', 'images/vehicles/203.JPG');
INSERT INTO `vehicles` VALUES (204, 2, 'sdfas', 'asfdsda', 'images/vehicles/204.JPG');
INSERT INTO `vehicles` VALUES (206, 1, 'adasdfa', 'asfdasdfasdfad', 'images/vehicles/206.JPG');
INSERT INTO `vehicles` VALUES (207, 1, 'adfadfafd', 'adfadfafdadf', 'images/vehicles/207.JPG');
INSERT INTO `vehicles` VALUES (208, 1, 'dfsafdsafs', 'fadsafdsafds', 'images/vehicles/208.PNG');
INSERT INTO `vehicles` VALUES (209, 1, 'fadfadfad', 'faafdfd', 'images/vehicles/209.GIF');
INSERT INTO `vehicles` VALUES (210, 1, 'fads', 'fadsfda', 'images/vehicles/210.GIF');
