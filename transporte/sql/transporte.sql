-- phpMyAdmin SQL Dump
-- version 2.6.0-beta2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 22-10-2004 a las 00:37:41
-- Versión del servidor: 4.0.18
-- Versión de PHP: 4.3.8-9
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
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `cat_emps`
-- 

INSERT INTO `cat_emps` (`id_cat_emp`, `name`, `descrip`) VALUES (1, 'Gestor', 'aadadfada da a dadfad');

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
) TYPE=MyISAM PACK_KEYS=0 AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `corps`
-- 

INSERT INTO `corps` (`id_corp`, `name`, `full_name`, `cif_nif`, `address`, `fiscal_address`, `postal_address`, `url`, `mail`, `city`, `state`, `postal_code`, `country`, `phone`, `fax`, `mobile_phone`, `notes`) VALUES (1, 'Resuival', 'Resuival', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

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
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- 
-- Volcar la base de datos para la tabla `emps`
-- 

INSERT INTO `emps` (`id_emp`, `id_corp`, `id_user`, `name`, `last_name`, `last_name2`, `birthday`, `phone`, `mobile_phone`, `fax`, `mail`, `address`, `city`, `state`, `postal_code`, `country`) VALUES (1, 1, 3, 'Elena', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '');

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
) TYPE=MyISAM AUTO_INCREMENT=57 ;

-- 
-- Volcar la base de datos para la tabla `group_users`
-- 

INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (1, 1, 2, '2004-12-12');
INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (45, 2, 1, '0000-00-00');
INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (46, 3, 1, '0000-00-00');
INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (47, 4, 1, '0000-00-00');
INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (48, 5, 1, '0000-00-00');
INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (49, 6, 1, '0000-00-00');
INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (50, 7, 1, '0000-00-00');
INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (51, 8, 1, '0000-00-00');
INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (52, 9, 1, '0000-00-00');
INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (53, 10, 1, '0000-00-00');
INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (54, 11, 1, '0000-00-00');
INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (55, 12, 1, '0000-00-00');
INSERT INTO `group_users` (`id_group_user`, `id_group`, `id_user`, `up`) VALUES (56, 13, 1, '0000-00-00');

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

INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (1, 'Mi_grupo', 'Mi grupo', 'descripcion adicional sobre mi grupo');
INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (2, 'admin', 'Administrador', '');
INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (3, 'conductor', 'Conductores', '');
INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (4, 'user', 'Usuario', '');
INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (5, 'superadmin', 'Super Administrador', '');
INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (6, 'contable', 'Contables', '');
INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (7, 'limpieza', 'Limpieza', '');
INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (8, 'root', 'Root', '');
INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (9, 'simple_user', 'Usuario Simple', '');
INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (10, 'test', 'Test', '');
INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (11, 'guest', 'Invitado', '');
INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (12, 'group12', 'Grupo 12', '');
INSERT INTO `groups` (`id_group`, `name`, `name_web`, `descrip`) VALUES (13, 'group13', 'Grupo 13', '');

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

INSERT INTO `holydays` (`id_holy`, `id_emp`, `gone`, `come`, `ill`, `descrip`) VALUES (1, 1, '2004-08-06', '2004-08-19', 0, 'sdasdfasdfasdfa');

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

INSERT INTO `log_methods` (`id_log_method`, `id_user`, `id_method`, `datetime`, `id_method_type`, `sql_sentence`, `afected`) VALUES (1, 1, 1, '0000-00-00 00:00:00', 2, '', 0);

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

INSERT INTO `log_sessions` (`id_log_session`, `id_session`, `date_in`, `date_out`, `timeout`, `ip`, `id_user`, `country`) VALUES (1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '00:00:00', '127.0.0.1', 1, 'espa�a');

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
) TYPE=MyISAM PACK_KEYS=0 AUTO_INCREMENT=18 ;

-- 
-- Volcar la base de datos para la tabla `methods`
-- 

INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (1, 'add', 'A&ntilde;adir', 1, 1);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (2, 'modify', 'Modificar', 1, 1);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (3, 'delete', 'Borrar', 1, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (4, 'list', 'Listar', 1, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (5, 'list', 'Listar', 2, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (6, 'add', 'A&ntilde;adir', 2, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (7, 'modify', 'Modificar', 2, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (8, 'select', 'Seleccionar', 2, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (9, 'delete', 'Borrar', 2, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (10, 'add', 'A&ntilde;adir', 3, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (11, 'modify', 'Modificar', 3, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (12, 'delete', 'Borrar', 3, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (13, 'list', 'Listar', 3, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (14, 'modify', 'Modificar', 4, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (15, 'add', 'A&ntilde;adir', 4, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (16, 'delete', 'Borrar', 4, 0);
INSERT INTO `methods` (`id_method`, `name`, `name_web`, `id_module`, `id_type_method`) VALUES (17, 'list', 'Listar', 4, 0);

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
  `public` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id_module`),
  UNIQUE KEY `nombre` (`name`)
) TYPE=MyISAM PACK_KEYS=0 AUTO_INCREMENT=5 ;

-- 
-- Volcar la base de datos para la tabla `modules`
-- 

INSERT INTO `modules` (`id_module`, `name`, `name_web`, `path`, `active`, `public`) VALUES (1, 'users', 'Usuarios', '/inc/', 1, 0);
INSERT INTO `modules` (`id_module`, `name`, `name_web`, `path`, `active`, `public`) VALUES (2, 'corps', 'Empresas', '/inc/', 1, 0);
INSERT INTO `modules` (`id_module`, `name`, `name_web`, `path`, `active`, `public`) VALUES (3, 'groups', 'Grupos', '/inc/', 1, 0);
INSERT INTO `modules` (`id_module`, `name`, `name_web`, `path`, `active`, `public`) VALUES (4, 'emps', 'Empleados', '/inc/', 1, 0);

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
) TYPE=MyISAM AUTO_INCREMENT=69 ;

-- 
-- Volcar la base de datos para la tabla `per_group_methods`
-- 

INSERT INTO `per_group_methods` (`id_per_group_method`, `id_group`, `id_method`, `per`) VALUES (1, 1, 1, 1);

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
) TYPE=MyISAM AUTO_INCREMENT=68 ;

-- 
-- Volcar la base de datos para la tabla `per_group_modules`
-- 

INSERT INTO `per_group_modules` (`id_per_group_module`, `id_group`, `id_module`, `per`) VALUES (1, 1, 1, 2);

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
) TYPE=MyISAM AUTO_INCREMENT=43 ;

-- 
-- Volcar la base de datos para la tabla `per_user_methods`
-- 

INSERT INTO `per_user_methods` (`id_per_user_method`, `id_user`, `id_method`, `per`) VALUES (1, 1, 1, 1);

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
) TYPE=MyISAM AUTO_INCREMENT=67 ;

-- 
-- Volcar la base de datos para la tabla `per_user_modules`
-- 

INSERT INTO `per_user_modules` (`id_per_user_module`, `id_user`, `id_module`, `per`) VALUES (1, 1, 1, 2);

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

INSERT INTO `rel_emps_cats` (`id_rel_emp_cat`, `id_emp`, `id_cat_emp`) VALUES (1, 1, 1);

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

INSERT INTO `sessions` (`id_session`, `id_session_php`, `id_user`, `up`, `down`) VALUES (1, 'adfadfadfadfadfa', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) TYPE=MyISAM AUTO_INCREMENT=85 ;

-- 
-- Volcar la base de datos para la tabla `users`
-- 

INSERT INTO `users` (`id_user`, `login`, `passwd`, `name`, `last_name`, `last_name2`, `full_name`, `internal`, `active`) VALUES (1, 'admin', 'sta3war2', 'David', 'Vaquero', 'Santiago', 'David Vaquero Santiago', 0, 0);
INSERT INTO `users` (`id_user`, `login`, `passwd`, `name`, `last_name`, `last_name2`, `full_name`, `internal`, `active`) VALUES (84, 'admin2', 'sta3war2', 'Daniel', 'González', 'Zaballos', 'Daniel González Zaballos', 1, 1);
