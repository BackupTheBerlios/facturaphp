-- phpMyAdmin SQL Dump
-- version 2.6.0-beta2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generaciÃ³n: 19-11-2004 a las 02:05:49
-- VersiÃ³n del servidor: 4.0.18
-- VersiÃ³n de PHP: 4.3.8-9
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
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- 
-- Volcar la base de datos para la tabla `cat_emps`
-- 

INSERT INTO `cat_emps` VALUES (1, 'Gestor', 'aadadfada da a dadfad');
INSERT INTO `cat_emps` VALUES (4, 'Administrador', 'Categoria de los administradores');

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
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `corps`
-- 

INSERT INTO `corps` VALUES (1, 'Resuival', 'Resuival', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `corps` VALUES (2, 'Copiar-pegar', 'Copiar-Pegar Salamanca', '70881082', 'Alfonso IX', 'Alfonso IX', 'Alfonso IX', 'www.copiar-pegar.com', 'david@copiar-pegar.com', 'Salamanca', 'CyL', '37008', 'España', '923268475', '923268477', '665053440', 'Empresa de desarrollo basado en el software libre. Impulsadora de conocimientos mediante la enseñanza.');
INSERT INTO `corps` VALUES (3, 'Drag and Drop', 'Drag and Drop Salamanca', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

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
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- 
-- Volcar la base de datos para la tabla `emps`
-- 

INSERT INTO `emps` VALUES (1, 1, 3, 'Elena', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '');
INSERT INTO `emps` VALUES (2, 1, 1, 'David', 'Vaquero', 'Santiago', '2004-10-25', '', '', '', '', '', '', '', '', '');
INSERT INTO `emps` VALUES (3, 2, 1, 'David', 'Vaquero', 'Santiago', '0000-00-00', '', '', '', '', '', '', '', '', '');
INSERT INTO `emps` VALUES (4, 3, 1, 'David', 'Vaquero', 'Santiago', '0000-00-00', '', '', '', '', '', '', '', '', '');
INSERT INTO `emps` VALUES (5, 3, 2, 'Daniel', 'González', 'Zaballos', '0000-00-00', '', '', '', '', '', '', '', '', '');
INSERT INTO `emps` VALUES (6, 2, 4, 'Rocío', 'Gutiérrez', 'González', '0000-00-00', '923268475', '665053440', '', 'rocio_gg15@hotmail.com', 'Camino de Miranda 38', 'Salamanca', 'CyL', '37008', 'España');

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
) TYPE=MyISAM AUTO_INCREMENT=103 ;

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
INSERT INTO `group_users` VALUES (59, 3, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (60, 4, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (61, 5, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (62, 6, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (63, 7, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (64, 8, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (65, 9, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (66, 10, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (67, 11, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (68, 12, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (69, 13, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (70, 3, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (71, 4, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (72, 5, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (73, 6, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (74, 7, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (75, 8, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (76, 9, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (77, 10, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (78, 11, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (79, 12, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (80, 13, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (81, 3, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (82, 4, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (83, 5, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (84, 6, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (85, 7, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (86, 8, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (87, 9, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (88, 10, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (89, 11, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (90, 12, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (91, 13, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (92, 3, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (93, 4, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (94, 5, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (95, 6, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (96, 7, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (97, 8, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (98, 9, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (99, 10, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (100, 11, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (101, 12, 1, '0000-00-00');
INSERT INTO `group_users` VALUES (102, 13, 1, '0000-00-00');

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
) TYPE=MyISAM AUTO_INCREMENT=42 ;

-- 
-- Volcar la base de datos para la tabla `groups`
-- 

INSERT INTO `groups` VALUES (1, 'superadmin', 'Super Administrador', '');
INSERT INTO `groups` VALUES (2, 'admin', 'Administrador', '');
INSERT INTO `groups` VALUES (3, 'conductor', 'Conductores', '');
INSERT INTO `groups` VALUES (4, 'user', 'Usuario', '');
INSERT INTO `groups` VALUES (5, 'Migrupo', 'Mi Grupo', '');
INSERT INTO `groups` VALUES (6, 'contable', 'Contables', '');
INSERT INTO `groups` VALUES (7, 'limpieza', 'Limpieza', '');
INSERT INTO `groups` VALUES (8, 'root', 'Root', '');
INSERT INTO `groups` VALUES (9, 'simple_user', 'Usuario Simple', '');
INSERT INTO `groups` VALUES (10, 'test', 'Test', '');
INSERT INTO `groups` VALUES (11, 'guest', 'Invitado', '');
INSERT INTO `groups` VALUES (12, 'group12', 'Grupo 12', '');
INSERT INTO `groups` VALUES (13, 'group13', 'Grupo 13', '');

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
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `holydays`
-- 

INSERT INTO `holydays` VALUES (1, 1, '2004-08-06', '2004-08-19', 0, 'sdasdfasdfasdfa');

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
) TYPE=MyISAM AUTO_INCREMENT=15 ;

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
) TYPE=MyISAM AUTO_INCREMENT=33 ;

-- 
-- Volcar la base de datos para la tabla `log_sessions`
-- 

INSERT INTO `log_sessions` VALUES (1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '00:00:00', '127.0.0.1', 1, 'españa');

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
) TYPE=MyISAM AUTO_INCREMENT=72 ;

-- 
-- Volcar la base de datos para la tabla `methods`
-- 

INSERT INTO `methods` VALUES (1, 'add', 'A&ntilde;adir', 1, 1);
INSERT INTO `methods` VALUES (2, 'modify', 'Modificar', 1, 1);
INSERT INTO `methods` VALUES (3, 'delete', 'Borrar', 1, 0);
INSERT INTO `methods` VALUES (4, 'list', 'Listar', 1, 0);
INSERT INTO `methods` VALUES (5, 'view', 'Ver', 1, 0);
INSERT INTO `methods` VALUES (6, 'list', 'Listar', 2, 0);
INSERT INTO `methods` VALUES (7, 'add', 'A&ntilde;adir', 2, 0);
INSERT INTO `methods` VALUES (8, 'modify', 'Modificar', 2, 0);
INSERT INTO `methods` VALUES (9, 'select', 'Seleccionar', 2, 0);
INSERT INTO `methods` VALUES (10, 'delete', 'Borrar', 2, 0);
INSERT INTO `methods` VALUES (11, 'add', 'A&ntilde;adir', 3, 0);
INSERT INTO `methods` VALUES (12, 'modify', 'Modificar', 3, 0);
INSERT INTO `methods` VALUES (13, 'delete', 'Borrar', 3, 0);
INSERT INTO `methods` VALUES (14, 'list', 'Listar', 3, 0);
INSERT INTO `methods` VALUES (15, 'modify', 'Modificar', 4, 0);
INSERT INTO `methods` VALUES (16, 'add', 'A&ntilde;adir', 4, 0);
INSERT INTO `methods` VALUES (17, 'delete', 'Borrar', 4, 0);
INSERT INTO `methods` VALUES (18, 'list', 'Listar', 4, 0);
INSERT INTO `methods` VALUES (66, 'delete', 'Borrar', 11, 0);
INSERT INTO `methods` VALUES (20, 'select', 'Seleccionar', 7, 0);
INSERT INTO `methods` VALUES (21, 'view', 'Ver', 9, 0);
INSERT INTO `methods` VALUES (22, 'list', 'Listar', 16, 0);
INSERT INTO `methods` VALUES (23, 'view', 'Ver', 16, 0);
INSERT INTO `methods` VALUES (24, 'add', 'A&ntilde;adir', 16, 0);
INSERT INTO `methods` VALUES (25, 'modify', 'Modificar', 16, 0);
INSERT INTO `methods` VALUES (26, 'delete', 'Borrar', 16, 0);
INSERT INTO `methods` VALUES (55, 'modify', 'Modificar', 25, 0);
INSERT INTO `methods` VALUES (54, 'add', 'Añadir', 25, 0);
INSERT INTO `methods` VALUES (31, 'delete', 'Borrar', 0, 0);
INSERT INTO `methods` VALUES (56, 'delete', 'Borrar', 25, 0);
INSERT INTO `methods` VALUES (53, 'view', 'Ver', 25, 0);
INSERT INTO `methods` VALUES (52, 'list', 'Listar', 25, 0);
INSERT INTO `methods` VALUES (67, 'list', 'Listar', 10, 0);
INSERT INTO `methods` VALUES (65, 'modify', 'Modificar', 11, 0);
INSERT INTO `methods` VALUES (64, 'add', 'Añadir', 11, 0);
INSERT INTO `methods` VALUES (63, 'view', 'Ver', 11, 0);
INSERT INTO `methods` VALUES (62, 'list', 'Listar', 11, 0);
INSERT INTO `methods` VALUES (68, 'view', 'Ver', 10, 0);
INSERT INTO `methods` VALUES (69, 'add', 'Añadir', 10, 0);
INSERT INTO `methods` VALUES (70, 'modify', 'Modificar', 10, 0);
INSERT INTO `methods` VALUES (71, 'delete', 'Borrar', 10, 0);

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
  PRIMARY KEY  (`id_module`),
  UNIQUE KEY `nombre` (`name`)
) TYPE=MyISAM AUTO_INCREMENT=33 ;

-- 
-- Volcar la base de datos para la tabla `modules`
-- 

INSERT INTO `modules` VALUES (1, 'users', 'Usuarios', '/inc/', 1, 0, 0);
INSERT INTO `modules` VALUES (3, 'news', 'Noticias', '/inc/', 0, 1, 0);
INSERT INTO `modules` VALUES (7, 'user_corps', 'Empresas usuario', '/inc/', 0, 0, 0);
INSERT INTO `modules` VALUES (9, 'corps', 'Empresas', '/inc/', 1, 0, 0);
INSERT INTO `modules` VALUES (10, 'groups', 'Grupos', '/inc/', 1, 0, 0);
INSERT INTO `modules` VALUES (11, 'emps', 'Empleados', '/inc/', 1, 0, 9);
INSERT INTO `modules` VALUES (12, 'error', 'Errores', '/inc/', 0, 0, 0);
INSERT INTO `modules` VALUES (16, 'modules', 'Módulos', '/inc/', 0, 0, 0);
INSERT INTO `modules` VALUES (25, 'cat_emps', 'Categorias de empleados', '/inc/', 0, 0, 0);

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
) TYPE=MyISAM AUTO_INCREMENT=72 ;

-- 
-- Volcar la base de datos para la tabla `per_group_methods`
-- 

INSERT INTO `per_group_methods` VALUES (1, 1, 1, 1);
INSERT INTO `per_group_methods` VALUES (69, 2, 6, 1);
INSERT INTO `per_group_methods` VALUES (70, 2, 22, 1);
INSERT INTO `per_group_methods` VALUES (71, 10, 25, 1);

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
) TYPE=MyISAM AUTO_INCREMENT=69 ;

-- 
-- Volcar la base de datos para la tabla `per_group_modules`
-- 

INSERT INTO `per_group_modules` VALUES (1, 1, 1, 1);
INSERT INTO `per_group_modules` VALUES (68, 12, 2, 1);

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
) TYPE=MyISAM AUTO_INCREMENT=94 ;

-- 
-- Volcar la base de datos para la tabla `per_user_methods`
-- 

INSERT INTO `per_user_methods` VALUES (1, 1, 1, 1);
INSERT INTO `per_user_methods` VALUES (60, 1, 8, 1);
INSERT INTO `per_user_methods` VALUES (59, 1, 7, 1);
INSERT INTO `per_user_methods` VALUES (46, 1, 18, 1);
INSERT INTO `per_user_methods` VALUES (47, 1, 5, 1);
INSERT INTO `per_user_methods` VALUES (48, 1, 19, 1);
INSERT INTO `per_user_methods` VALUES (49, 1, 20, 1);
INSERT INTO `per_user_methods` VALUES (50, 1, 2, 1);
INSERT INTO `per_user_methods` VALUES (51, 1, 3, 1);
INSERT INTO `per_user_methods` VALUES (52, 1, 4, 1);
INSERT INTO `per_user_methods` VALUES (58, 1, 6, 1);
INSERT INTO `per_user_methods` VALUES (56, 2, 5, 1);
INSERT INTO `per_user_methods` VALUES (55, 2, 21, 1);
INSERT INTO `per_user_methods` VALUES (61, 1, 9, 1);
INSERT INTO `per_user_methods` VALUES (62, 1, 10, 1);
INSERT INTO `per_user_methods` VALUES (63, 1, 11, 1);
INSERT INTO `per_user_methods` VALUES (64, 1, 12, 1);
INSERT INTO `per_user_methods` VALUES (65, 1, 13, 1);
INSERT INTO `per_user_methods` VALUES (66, 1, 14, 1);
INSERT INTO `per_user_methods` VALUES (67, 1, 15, 1);
INSERT INTO `per_user_methods` VALUES (68, 1, 16, 1);
INSERT INTO `per_user_methods` VALUES (69, 1, 17, 1);
INSERT INTO `per_user_methods` VALUES (70, 1, 21, 1);
INSERT INTO `per_user_methods` VALUES (71, 4, 24, 1);
INSERT INTO `per_user_methods` VALUES (72, 0, 0, 0);
INSERT INTO `per_user_methods` VALUES (73, 4, 20, 1);
INSERT INTO `per_user_methods` VALUES (74, 1, 22, 1);
INSERT INTO `per_user_methods` VALUES (75, 1, 23, 1);
INSERT INTO `per_user_methods` VALUES (76, 1, 24, 1);
INSERT INTO `per_user_methods` VALUES (77, 1, 25, 1);
INSERT INTO `per_user_methods` VALUES (78, 1, 26, 1);
INSERT INTO `per_user_methods` VALUES (79, 1, 55, 1);
INSERT INTO `per_user_methods` VALUES (80, 1, 54, 1);
INSERT INTO `per_user_methods` VALUES (81, 1, 56, 1);
INSERT INTO `per_user_methods` VALUES (82, 1, 53, 1);
INSERT INTO `per_user_methods` VALUES (83, 1, 52, 1);
INSERT INTO `per_user_methods` VALUES (84, 1, 66, 1);
INSERT INTO `per_user_methods` VALUES (85, 1, 65, 1);
INSERT INTO `per_user_methods` VALUES (86, 1, 64, 1);
INSERT INTO `per_user_methods` VALUES (87, 1, 63, 1);
INSERT INTO `per_user_methods` VALUES (88, 1, 62, 1);
INSERT INTO `per_user_methods` VALUES (89, 1, 67, 1);
INSERT INTO `per_user_methods` VALUES (90, 1, 68, 1);
INSERT INTO `per_user_methods` VALUES (91, 1, 69, 1);
INSERT INTO `per_user_methods` VALUES (92, 1, 70, 1);
INSERT INTO `per_user_methods` VALUES (93, 1, 71, 1);

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
) TYPE=MyISAM AUTO_INCREMENT=90 ;

-- 
-- Volcar la base de datos para la tabla `per_user_modules`
-- 

INSERT INTO `per_user_modules` VALUES (1, 1, 1, 1);
INSERT INTO `per_user_modules` VALUES (67, 1, 7, 1);
INSERT INTO `per_user_modules` VALUES (68, 2, 7, 1);
INSERT INTO `per_user_modules` VALUES (69, 1, 11, 1);
INSERT INTO `per_user_modules` VALUES (70, 1, 3, 1);
INSERT INTO `per_user_modules` VALUES (71, 1, 4, 1);
INSERT INTO `per_user_modules` VALUES (72, 1, 5, 1);
INSERT INTO `per_user_modules` VALUES (73, 1, 6, 1);
INSERT INTO `per_user_modules` VALUES (74, 3, 7, 1);
INSERT INTO `per_user_modules` VALUES (75, 1, 9, 1);
INSERT INTO `per_user_modules` VALUES (76, 1, 10, 1);
INSERT INTO `per_user_modules` VALUES (77, 2, 9, 1);
INSERT INTO `per_user_modules` VALUES (78, 1, 2, 1);
INSERT INTO `per_user_modules` VALUES (79, 1, 8, 1);
INSERT INTO `per_user_modules` VALUES (80, 1, 12, 1);
INSERT INTO `per_user_modules` VALUES (81, 1, 13, 1);
INSERT INTO `per_user_modules` VALUES (82, 1, 14, 1);
INSERT INTO `per_user_modules` VALUES (83, 1, 15, 1);
INSERT INTO `per_user_modules` VALUES (84, 1, 16, 1);
INSERT INTO `per_user_modules` VALUES (85, 1, 17, 1);
INSERT INTO `per_user_modules` VALUES (87, 4, 7, 1);
INSERT INTO `per_user_modules` VALUES (88, 4, 9, 1);
INSERT INTO `per_user_modules` VALUES (89, 1, 25, 1);

-- --------------------------------------------------------

-- 
-- Estructura de tabla para la tabla `products`
-- 

CREATE TABLE `products` (
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

CREATE TABLE `rel_emps_cats` (
  `id_rel_emp_cat` int(11) NOT NULL auto_increment,
  `id_emp` int(11) NOT NULL default '0',
  `id_cat_emp` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_rel_emp_cat`),
  KEY `id_emp` (`id_emp`,`id_cat_emp`)
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `rel_emps_cats`
-- 

INSERT INTO `rel_emps_cats` VALUES (1, 1, 1);

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
) TYPE=MyISAM AUTO_INCREMENT=51 ;

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
) TYPE=MyISAM AUTO_INCREMENT=86 ;

-- 
-- Volcar la base de datos para la tabla `users`
-- 

INSERT INTO `users` VALUES (1, 'admin', 'sta3war2', 'David', 'Vaquero', 'Santiago', 'David Vaquero Santiago', 0, 0);
INSERT INTO `users` VALUES (2, 'admin2', 'sta3war2', 'Daniel', 'GonzÃ¡lez', 'Zaballos', 'Daniel GonzÃ¡lez Zaballos', 1, 1);
INSERT INTO `users` VALUES (3, 'Elena', 'elena', 'Elena', 'Resuival', '', '', 0, 0);
INSERT INTO `users` VALUES (4, 'rocio', 'rocio', 'Rocío', 'Gutiérrez', 'González', 'Rocío Gutiérrez González', 0, 0);
