<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/
 	
	define('INSTALL_DIRECTORY', '/Users/david/Sites/transporte/');
	define('INSTALL_IS_WINDOWS',TRUE);
	define('SMARTY_DIRECTORY', INSTALL_DIRECTORY . 'inc/smarty');
	define('ADODB_DIRECTORY',INSTALL_DIRECTORY . 'inc/adodb');
	define('DDBB_USER','root');
	define('DDBB_PASS','sta3war2');
	define('DDBB_NAME','transporte');
	define('IP_DDBB','127.0.0.1');
	define('DDBB_PREFIX','');
	define('DDBB_TYPE','mysql');
	define('DDBB_PORT','3306');
	

	//**************************************************************
	//Configuración De Dani (Windows)
	
	/*$DDBB_NAME="transporte";
	$DDBB_USER="root";
	$DDBB_PASS="aquelarre";
	$IP_DDBB="127.0.0.1";
	$TABLE_PREFIX="";
	$DDBB_TYPE="mysql";
	$DDBB_PORT="3306";
	$INSTALL_DIR="D:\\Archivos de programa\\EasyPHP1-7\\www\\transporte\\";*/
	//**************************************************************
	//Configuración De Dani (Linux)
	
	$DDBB_NAME="transporte";
	$DDBB_USER="root";
	$DDBB_PASS="";
	$IP_DDBB="localhost";
	$TABLE_PREFIX="";
	$DDBB_TYPE="mysql";
	$DDBB_PORT="3306";
	$INSTALL_DIR="/var/www/transporte/";
	
	// *************************************************
	//Configuracion de David
/*
	$DDBB_NAME="transporte";
	$DDBB_USER="root";
	$DDBB_PASS="sta3war2";
	$IP_DDBB="127.0.0.1";
	$TABLE_PREFIX="";
	$DDBB_TYPE="mysql";
	$DDBB_PORT="3306";
	$INSTALL_DIR="/Users/david/Sites/transporte/";	
	*/
	
	// *************************************************
	//Configuracion de LUpus
/*
	$DDBB_NAME="transporte";
	$DDBB_USER="root";
	$DDBB_PASS="";
	$IP_DDBB="127.0.0.1";
	$TABLE_PREFIX="";
	$DDBB_TYPE="mysql";
	$DDBB_PORT="3306";
	$INSTALL_DIR="C:\\Archivos de programa\\EasyPHP1-7\\www\\transporte\\";
	*/
	
	$WIN32=false;
	$SLASH="/";
	$ADODB_DIR=$INSTALL_DIR."inc/adodb/";
	$SMARTY_DIR=$INSTALL_DIR."inc/smarty/";
	$SMARTY_TEMPLATES_DIR=$INSTALL_DIR."templates/";
	$SMARTY_TEMPLATES_C_DIR=$INSTALL_DIR."templates_c/";
	$SMARTY_CONFIGS_DIR=$INSTALL_DIR."configs/";
	$SMARTY_CACHE_DIR=$INSTALL_DIR."cache/";
	$WEB_SERVER="";
	$WEB_DIR="";
	$BASE_URL="";
?>
