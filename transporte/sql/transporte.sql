-- phpMyAdmin SQL Dump
-- version 2.6.0-rc1
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 09-11-2004 a las 13:40:50
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
) TYPE=MyISAM AUTO_INCREMENT=4 ;

-- 
-- Volcar la base de datos para la tabla `cat_emps`
-- 

INSERT INTO `cat_emps` VALUES (1, 'Gestor', 'aadadfada da a dadfad');

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

INSERT INTO `corps` VALUES (1, 'Resuival', 'Resuival', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `corps` VALUES (2, 'Copiar-pegar', 'Copiar-Pegar Salamanca', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `corps` VALUES (3, 'Drug and Drop', 'Drug and Drop', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

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
) TYPE=MyISAM AUTO_INCREMENT=5 ;

-- 
-- Volcar la base de datos para la tabla `emps`
-- 

INSERT INTO `emps` VALUES (1, 1, 3, 'Elena', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '');
INSERT INTO `emps` VALUES (2, 1, 1, 'David', 'Vaquero', 'Santiago', '2004-10-25', '', '', '', '', '', '', '', '', '');
INSERT INTO `emps` VALUES (3, 2, 1, 'David', 'Vaquero', 'Santiago', '0000-00-00', '', '', '', '', '', '', '', '', '');
INSERT INTO `emps` VALUES (4, 3, 1, 'David', 'Vaquero', 'Santiago', '0000-00-00', '', '', '', '', '', '', '', '', '');

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
) TYPE=MyISAM AUTO_INCREMENT=57 ;

-- 
-- Volcar la base de datos para la tabla `group_users`
-- 

INSERT INTO `group_users` VALUES (1, 1, 2, '2004-12-12');
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

INSERT INTO `groups` VALUES (1, 'Mi_grupo', 'Mi grupo', 'descripcion adicional sobre mi grupo');
INSERT INTO `groups` VALUES (2, 'admin', 'Administrador', '');
INSERT INTO `groups` VALUES (3, 'conductor', 'Conductores', '');
INSERT INTO `groups` VALUES (4, 'user', 'Usuario', '');
INSERT INTO `groups` VALUES (5, 'superadmin', 'Super Administrador', '');
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
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Volcar la base de datos para la tabla `holydays`
-- 

INSERT INTO `holydays` VALUES (1, 1, '2004-08-06', '2004-08-19', 0, 'sdasdfasdfasdfa');

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
) TYPE=MyISAM AUTO_INCREMENT=21 ;

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
INSERT INTO `methods` VALUES (19, 'view', 'Ver', 11, 0);
INSERT INTO `methods` VALUES (20, 'select', 'Seleccionar', 7, 0);

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
  PRIMARY KEY  (`id_module`),
  UNIQUE KEY `nombre` (`name`)
) TYPE=MyISAM AUTO_INCREMENT=13 ;

-- 
-- Volcar la base de datos para la tabla `modules`
-- 

INSERT INTO `modules` VALUES (1, 'users', 'Usuarios', '/inc/', 1, 0);
INSERT INTO `modules` VALUES (2, 'clients', 'Clientes del programa', '/inc/', 0, 0);
INSERT INTO `modules` VALUES (3, 'news', 'Noticias', '/inc/', 0, 1);
INSERT INTO `modules` VALUES (4, 'products', 'Productos', '/inc/', 0, 1);
INSERT INTO `modules` VALUES (5, 'services', 'Servicios', '/inc/', 0, 1);
INSERT INTO `modules` VALUES (6, 'contact', 'Contactos', '/inc/', 0, 1);
INSERT INTO `modules` VALUES (7, 'user_corps', 'Empresas usuario', '/inc/', 0, 0);
INSERT INTO `modules` VALUES (9, 'corps', 'Empresas', '/inc/', 1, 0);
INSERT INTO `modules` VALUES (10, 'groups', 'Grupos', '/inc/', 1, 0);
INSERT INTO `modules` VALUES (11, 'emps', 'Empleados', '/inc/', 1, 0);
INSERT INTO `modules` VALUES (12, 'error', 'Errores', '/inc/', 0, 0);

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

DROP TABLE IF EXISTS `per_group_modules`;
CREATE TABLE IF NOT EXISTS `per_group_modules` (
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

DROP TABLE IF EXISTS `per_user_methods`;
CREATE TABLE IF NOT EXISTS `per_user_methods` (
  `id_per_user_method` int(11) unsigned NOT NULL auto_increment,
  `id_user` int(11) unsigned NOT NULL default '0',
  `id_method` int(11) unsigned NOT NULL default '0',
  `per` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id_per_user_method`)
) TYPE=MyISAM AUTO_INCREMENT=50 ;

-- 
-- Volcar la base de datos para la tabla `per_user_methods`
-- 

INSERT INTO `per_user_methods` VALUES (1, 1, 1, 1);
INSERT INTO `per_user_methods` VALUES (44, 1, 24, 1);
INSERT INTO `per_user_methods` VALUES (45, 1, 23, 1);
INSERT INTO `per_user_methods` VALUES (46, 1, 18, 1);
INSERT INTO `per_user_methods` VALUES (47, 1, 5, 1);
INSERT INTO `per_user_methods` VALUES (48, 1, 19, 1);
INSERT INTO `per_user_methods` VALUES (49, 1, 20, 1);

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
) TYPE=MyISAM AUTO_INCREMENT=74 ;

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
) TYPE=MyISAM AUTO_INCREMENT=6 ;

-- 
-- Volcar la base de datos para la tabla `rel_emps_cats`
-- 

INSERT INTO `rel_emps_cats` VALUES (1, 1, 1);

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
) TYPE=MyISAM AUTO_INCREMENT=85 ;

-- 
-- Volcar la base de datos para la tabla `users`
-- 

INSERT INTO `users` VALUES (1, 'admin', 'sta3war2', 'David', 'Vaquero', 'Santiago', 'David Vaquero Santiago', 0, 0);
INSERT INTO `users` VALUES (2, 'admin2', 'sta3war2', 'Daniel', 'GonzÃ¡lez', 'Zaballos', 'Daniel GonzÃ¡lez Zaballos', 1, 1);
INSERT INTO `users` VALUES (3, 'Elena', 'elena', 'Elena', 'Resuival', '', '', 0, 0);
