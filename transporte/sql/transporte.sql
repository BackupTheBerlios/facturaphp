-- phpMyAdmin SQL Dump
-- version 2.6.0-rc1
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 11-01-2005 a las 12:53:19
-- Versión del servidor: 4.0.20
-- Versión de PHP: 4.3.8-5
-- 
-- Base de datos: `transporte`
-- 

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cat_emps`
-- 

DROP TABLE IF EXISTS `cat_emps`;
CREATE TABLE IF NOT EXISTS `cat_emps` (
  `id_cat_emp` int(11) NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `descrip` text NOT NULL,
  PRIMARY KEY  (`id_cat_emp`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- 
-- Volcar la base de datos para la tabla `cat_emps`
-- 

INSERT INTO `cat_emps` VALUES (1, 'Gestor', 'Gestor de empleados');
INSERT INTO `cat_emps` VALUES (2, 'Director jefe', 'Director Jefe en funciones');
INSERT INTO `cat_emps` VALUES (3, 'Transportista', 'Persona que conduce los vehículos de la empresa');
INSERT INTO `cat_emps` VALUES (4, 'Limpiador', 'Personal de limpieza');
INSERT INTO `cat_emps` VALUES (5, 'Contable', 'Contable de la empresa');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `cat_vehicles`
-- 

DROP TABLE IF EXISTS `cat_vehicles`;
CREATE TABLE IF NOT EXISTS `cat_vehicles` (
  `id_cat_vehicle` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `name_web` varchar(50) NOT NULL default '',
  `descrip` text NOT NULL,
  PRIMARY KEY  (`id_cat_vehicle`)
) TYPE=MyISAM AUTO_INCREMENT=11 ;

-- 
-- Volcar la base de datos para la tabla `cat_vehicles`
-- 

INSERT INTO `cat_vehicles` VALUES (1, 'mi vehículo', 'mi vehículo', ' sólo mío quién lo toque se las verá con la poli');
INSERT INTO `cat_vehicles` VALUES (10, 'Otra', 'ota', 'sdfafafasdf');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `corps`
-- 

DROP TABLE IF EXISTS `corps`;
CREATE TABLE IF NOT EXISTS `corps` (
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
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `corps`
-- 

INSERT INTO `corps` VALUES (1, 'Resuival', 'Resuival', '76915846-L', 'Avd Portugal', 'Avd Portugal', 'Avd Portugal', 'www.resuival.es', 'elena@resuival.es', 'Salamanca', 'Salamanca', '37009', 'España', '923487512', '923487512', '659326789', 'Empresa de limpieza y transporte');
INSERT INTO `corps` VALUES (2, 'Copiar-pegar', 'Copiar-Pegar Salamanca', '70952648', 'Alfonso IX', 'Alfonso IX', 'Alfonso IX', 'www.copiar-pegar.com', 'david@copiar-pegar.com', 'Salamanca', 'CyL', '37008', 'España', '923180512', '923180512', '656661478', 'Empresa de desarrollo basado en el software libre. Impulsadora de conocimientos mediante la enseñanza.');
INSERT INTO `corps` VALUES (3, 'Drag and Drop', 'Drag and Drop Salamanca', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `drivers`
-- 

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE IF NOT EXISTS `drivers` (
  `id_driver` int(11) unsigned NOT NULL auto_increment,
  `id_emp` int(11) unsigned NOT NULL default '0',
  `id_vehicle` int(11) unsigned NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id_driver`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `drivers`
-- 

INSERT INTO `drivers` VALUES (1, 3, 1, '2005-12-30');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `emps`
-- 

DROP TABLE IF EXISTS `emps`;
CREATE TABLE IF NOT EXISTS `emps` (
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
) TYPE=MyISAM AUTO_INCREMENT=10 ;

-- 
-- Volcar la base de datos para la tabla `emps`
-- 

INSERT INTO `emps` VALUES (1, 1, 3, 'Elena', 'Resuival', 'Resuival', '0000-00-00', '923564871', '665123489', '923564871', 'elena@hotmail.com', 'Calle ancha 63', 'Salamanca', 'Salamanca', '37006', 'España');
INSERT INTO `emps` VALUES (2, 1, 1, 'David', 'Vaquero', 'Santiago', '2004-10-25', '923247845', '646754340', '923247845', 'david@copiar-pegar.com', 'Músico Antonio José', 'Salamanca', 'Salamanca', '37004', 'España');
INSERT INTO `emps` VALUES (3, 2, 1, 'David', 'Vaquero', 'Santiago', '2004-10-25', '923247845', '646754340', '923247845', 'david@copiar-pegar.com', 'Músico Antonio José', 'Salamanca', 'Salamanca', '37004', 'España');
INSERT INTO `emps` VALUES (4, 2, 2, 'Daniel', 'González', 'Zaballos', '0000-00-00', '923654875', '646754340', '923654875', 'daniel@copiar-pegar.com', 'Calle larga 26', 'Doñinos', 'Salamanca', '37009', 'España');
INSERT INTO `emps` VALUES (5, 2, 4, 'Rocío', 'Gutiérrez', 'González', '0000-00-00', '923268475', '665053440', '', 'rocio_gg15@hotmail.com', 'Camino de Miranda 38', 'Salamanca', 'CyL', '37008', 'España');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `group_users`
-- 

DROP TABLE IF EXISTS `group_users`;
CREATE TABLE IF NOT EXISTS `group_users` (
  `id_group_user` int(11) unsigned NOT NULL auto_increment,
  `id_group` int(11) unsigned NOT NULL default '0',
  `id_user` int(11) unsigned NOT NULL default '0',
  `up` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id_group_user`)
) TYPE=MyISAM AUTO_INCREMENT=110 ;

-- 
-- Volcar la base de datos para la tabla `group_users`
-- 

INSERT INTO `group_users` VALUES (1, 1, 1, '2004-12-12');
INSERT INTO `group_users` VALUES (45, 2, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (46, 3, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (47, 4, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (48, 5, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (49, 6, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (50, 7, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (51, 8, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (52, 9, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (53, 10, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (54, 11, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (55, 12, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (56, 13, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (57, 1, 2, '0000-00-00');
INSERT INTO `group_users` VALUES (58, 2, 3, '0000-00-00');
INSERT INTO `group_users` VALUES (59, 9, 4, '0000-00-00');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `groups`
-- 

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id_group` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `name_web` varchar(100) NOT NULL default '',
  `descrip` text NOT NULL,
  PRIMARY KEY  (`id_group`)
) TYPE=MyISAM AUTO_INCREMENT=42 ;

-- 
-- Volcar la base de datos para la tabla `groups`
-- 

INSERT INTO `groups` VALUES (1, 'superadmin', 'Super Administrador', 'Persona con capacidad de acceso a todas las herremientas de la aplicacion');
INSERT INTO `groups` VALUES (2, 'admin', 'Administrador', 'Personal con permiso de acceso en todos los módulos internos de la aplicación con pequeñas restricciones');
INSERT INTO `groups` VALUES (3, 'conductor', 'Conductores', '');
INSERT INTO `groups` VALUES (4, 'user', 'Usuario', '');
INSERT INTO `groups` VALUES (5, 'Grupo de Prácticas', 'Grupo de Pr&aacute;cticas', 'Personal de prácticas en empresa que tendrán acceso a la aplicación');
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

DROP TABLE IF EXISTS `holydays`;
CREATE TABLE IF NOT EXISTS `holydays` (
  `id_holy` int(11) NOT NULL auto_increment,
  `id_emp` int(11) NOT NULL default '0',
  `gone` date NOT NULL default '0000-00-00',
  `come` date NOT NULL default '0000-00-00',
  `ill` tinyint(3) NOT NULL default '0',
  `descrip` text NOT NULL,
  PRIMARY KEY  (`id_holy`),
  KEY `id_emp` (`id_emp`)
) TYPE=MyISAM AUTO_INCREMENT=9 ;

-- 
-- Volcar la base de datos para la tabla `holydays`
-- 

INSERT INTO `holydays` VALUES (1, 1, '2004-08-06', '2004-08-19', 0, 'sdasdfasdfasdfa');
INSERT INTO `holydays` VALUES (3, 0, '0000-00-00', '2004-12-07', 2, '');
INSERT INTO `holydays` VALUES (8, 0, '0000-00-00', '0000-00-00', 2, '');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `laborers`
-- 

DROP TABLE IF EXISTS `laborers`;
CREATE TABLE IF NOT EXISTS `laborers` (
  `id_laborer` int(11) unsigned NOT NULL auto_increment,
  `id_emp` int(11) unsigned NOT NULL default '0',
  `id_vehicle` int(11) unsigned NOT NULL default '0',
  `date` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id_laborer`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `laborers`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `log_methods`
-- 

DROP TABLE IF EXISTS `log_methods`;
CREATE TABLE IF NOT EXISTS `log_methods` (
  `id_log_method` int(11) unsigned NOT NULL auto_increment,
  `id_user` int(11) unsigned NOT NULL default '0',
  `id_method` int(11) unsigned NOT NULL default '0',
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `id_method_type` tinyint(3) unsigned NOT NULL default '0',
  `sql_sentence` text NOT NULL,
  `afected` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_log_method`)
) TYPE=MyISAM AUTO_INCREMENT=15 ;

-- 
-- Volcar la base de datos para la tabla `log_methods`
-- 

INSERT INTO `log_methods` VALUES (1, 1, 1, '0000-00-00 00:00:00', 2, '', 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `log_sessions`
-- 

DROP TABLE IF EXISTS `log_sessions`;
CREATE TABLE IF NOT EXISTS `log_sessions` (
  `id_log_session` int(11) unsigned NOT NULL auto_increment,
  `id_session` int(11) unsigned NOT NULL default '0',
  `date_in` datetime NOT NULL default '0000-00-00 00:00:00',
  `date_out` datetime NOT NULL default '0000-00-00 00:00:00',
  `timeout` time NOT NULL default '00:00:00',
  `ip` varchar(20) NOT NULL default '',
  `id_user` int(11) unsigned NOT NULL default '0',
  `country` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`id_log_session`)
) TYPE=MyISAM AUTO_INCREMENT=33 ;

-- 
-- Volcar la base de datos para la tabla `log_sessions`
-- 

INSERT INTO `log_sessions` VALUES (1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '00:00:00', '127.0.0.1', 1, 'españa');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `methods`
-- 

DROP TABLE IF EXISTS `methods`;
CREATE TABLE IF NOT EXISTS `methods` (
  `id_method` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `name_web` varchar(50) NOT NULL default '',
  `id_module` int(11) unsigned NOT NULL default '0',
  `id_type_method` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id_method`)
) TYPE=MyISAM AUTO_INCREMENT=53 ;

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
INSERT INTO `methods` VALUES (36, 'add', 'Añadir', 20, 0);
INSERT INTO `methods` VALUES (37, 'modify', 'Modificar', 20, 0);
INSERT INTO `methods` VALUES (38, 'delete', 'Borrar', 20, 0);
INSERT INTO `methods` VALUES (40, 'list', 'Listar', 22, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `modules`
-- 

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
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
) TYPE=MyISAM AUTO_INCREMENT=30 ;

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
INSERT INTO `modules` VALUES (8, 'modules', 'Módulos', 'index.php?module=modules', 1, 0, 29, 21);
INSERT INTO `modules` VALUES (9, 'cat_emps', 'Categorías de Empleados', 'index.php?module=cat_emps', 1, 0, 4, 33);
INSERT INTO `modules` VALUES (10, 'holydays', 'Altas/Bajas', 'index.php?module=holydays', 1, 0, 4, 34);
INSERT INTO `modules` VALUES (11, 'products', 'Productos', 'index.php?module=products', 1, 1, 4, 2);
INSERT INTO `modules` VALUES (12, 'services', 'Servicios', 'index.php?module=services', 1, 1, 4, 3);
INSERT INTO `modules` VALUES (13, 'vehicles', 'Vehículos', 'index.php?module=vehicles', 1, 0, 0, 40);
INSERT INTO `modules` VALUES (14, 'cat_vehicles', 'Categorías de vehículos', 'index.php?module=cat_vehicles', 1, 0, 13, 42);
INSERT INTO `modules` VALUES (15, 'drivers', 'Conductores', 'index.php?module=drivers', 1, 0, 13, 43);
INSERT INTO `modules` VALUES (16, 'contact', 'Contacto', 'index.php?module=contact', 1, 1, 0, 4);
INSERT INTO `modules` VALUES (17, 'sessions', 'Sesiones', 'index.php?module=sessions', 1, 0, 18, 13);
INSERT INTO `modules` VALUES (18, 'access_gestion', 'Gestión de acceso', 'index.php?module=access_gestion', 1, 0, 0, 10);
INSERT INTO `modules` VALUES (19, 'vehicles_list', 'Listado de vehículos', 'index.php?', 1, 0, 13, 41);
INSERT INTO `modules` VALUES (29, 'modules_gestion', 'Gestión de módulos', 'index.php?module=modules_gestion', 1, 0, 0, 20);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `per_group_methods`
-- 

DROP TABLE IF EXISTS `per_group_methods`;
CREATE TABLE IF NOT EXISTS `per_group_methods` (
  `id_per_group_method` int(11) unsigned NOT NULL auto_increment,
  `id_group` int(11) unsigned NOT NULL default '0',
  `id_method` int(11) unsigned NOT NULL default '0',
  `per` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_per_group_method`)
) TYPE=MyISAM AUTO_INCREMENT=143 ;

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

DROP TABLE IF EXISTS `per_group_modules`;
CREATE TABLE IF NOT EXISTS `per_group_modules` (
  `id_per_group_module` int(10) unsigned NOT NULL auto_increment,
  `id_group` int(10) unsigned NOT NULL default '0',
  `id_module` int(10) unsigned NOT NULL default '0',
  `per` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_per_group_module`)
) TYPE=MyISAM AUTO_INCREMENT=90 ;

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

DROP TABLE IF EXISTS `per_user_methods`;
CREATE TABLE IF NOT EXISTS `per_user_methods` (
  `id_per_user_method` int(11) unsigned NOT NULL auto_increment,
  `id_user` int(11) unsigned NOT NULL default '0',
  `id_method` int(11) unsigned NOT NULL default '0',
  `per` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_per_user_method`)
) TYPE=MyISAM AUTO_INCREMENT=122 ;

-- 
-- Volcar la base de datos para la tabla `per_user_methods`
-- 

INSERT INTO `per_user_methods` VALUES (1, 4, 17, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `per_user_modules`
-- 

DROP TABLE IF EXISTS `per_user_modules`;
CREATE TABLE IF NOT EXISTS `per_user_modules` (
  `id_per_user_module` int(10) unsigned NOT NULL auto_increment,
  `id_user` int(10) unsigned NOT NULL default '0',
  `id_module` int(10) unsigned NOT NULL default '0',
  `per` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_per_user_module`)
) TYPE=MyISAM AUTO_INCREMENT=106 ;

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

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id_product` int(10) unsigned NOT NULL auto_increment,
  `id_family` int(10) unsigned NOT NULL default '0',
  `name` varchar(20) NOT NULL default '',
  `category` varchar(160) NOT NULL default '',
  `description` varchar(160) NOT NULL default '',
  PRIMARY KEY  (`id_product`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Volcar la base de datos para la tabla `products`
-- 


-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_emps_cats`
-- 

DROP TABLE IF EXISTS `rel_emps_cats`;
CREATE TABLE IF NOT EXISTS `rel_emps_cats` (
  `id_rel_emp_cat` int(11) NOT NULL auto_increment,
  `id_emp` int(11) NOT NULL default '0',
  `id_cat_emp` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_rel_emp_cat`),
  KEY `id_emp` (`id_emp`,`id_cat_emp`)
) TYPE=MyISAM AUTO_INCREMENT=10 ;

-- 
-- Volcar la base de datos para la tabla `rel_emps_cats`
-- 

INSERT INTO `rel_emps_cats` VALUES (6, 7, 1);
INSERT INTO `rel_emps_cats` VALUES (9, 9, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `rel_vehicles_cats`
-- 

DROP TABLE IF EXISTS `rel_vehicles_cats`;
CREATE TABLE IF NOT EXISTS `rel_vehicles_cats` (
  `id_rel_vehicle_cat` int(11) unsigned NOT NULL auto_increment,
  `id_vehicle` int(11) unsigned NOT NULL default '0',
  `id_cat_vehicle` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_rel_vehicle_cat`)
) TYPE=MyISAM AUTO_INCREMENT=47 ;

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

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `sessions`
-- 

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id_session` int(10) unsigned NOT NULL auto_increment,
  `id_session_php` varchar(255) NOT NULL default '',
  `id_user` int(11) NOT NULL default '0',
  `up` datetime NOT NULL default '0000-00-00 00:00:00',
  `down` datetime default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id_session`)
) TYPE=MyISAM AUTO_INCREMENT=51 ;

-- 
-- Volcar la base de datos para la tabla `sessions`
-- 

INSERT INTO `sessions` VALUES (1, 'adfadfadfadfadfa', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
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
) TYPE=MyISAM AUTO_INCREMENT=90 ;

-- 
-- Volcar la base de datos para la tabla `users`
-- 

INSERT INTO `users` VALUES (1, 'admin', 'sta3war2', 'David', 'Vaquero', 'Santiago', 'David Vaquero Santiago', 0, 0);
INSERT INTO `users` VALUES (2, 'admin2', 'sta3war2', 'Daniel', 'GonzÃ¡lez', 'Zaballos', 'Daniel GonzÃ¡lez Zaballos', 1, 1);
INSERT INTO `users` VALUES (3, 'Elena', 'elena', 'Elena', 'Resuival', '', '', 0, 0);
INSERT INTO `users` VALUES (4, 'rocio', 'rocio', 'Rocío', 'Gutiérrez', 'González', 'Rocío Gutiérrez González', 0, 0);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `vehicles`
-- 

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id_vehicle` int(11) unsigned NOT NULL auto_increment,
  `id_corp` int(11) unsigned NOT NULL default '0',
  `number_plate` varchar(10) NOT NULL default '',
  `alias` varchar(255) NOT NULL default '',
  `path_photo` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id_vehicle`)
) TYPE=MyISAM AUTO_INCREMENT=206 ;

-- 
-- Volcar la base de datos para la tabla `vehicles`
-- 

INSERT INTO `vehicles` VALUES (205, 2, 'asdfas', 'sadfasf', 'images/vehicles/205.JPG');
INSERT INTO `vehicles` VALUES (203, 2, 'afd', 'dsafas', 'images/vehicles/203.JPG');
INSERT INTO `vehicles` VALUES (204, 2, 'sdfas', 'asfdsda', 'images/vehicles/204.JPG');
