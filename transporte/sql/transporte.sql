-- phpMyAdmin SQL Dump
-- version 2.6.0-beta2
-- http://www.phpmyadmin.net
-- 
-- Servidor: localhost
-- Tiempo de generación: 25-10-2004 a las 19:04:50
-- Versión del servidor: 4.0.18
-- Versión de PHP: 4.3.8-9
-- 
-- Base de datos: `transporte`
-- 

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

INSERT INTO `per_user_methods` VALUES (1, 1, 1, 1);
