<?php

/**
 * 
 *
 * @version $Id$
 * @copyright 2003 
 **/
 	/*
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
	*/
	$DDBB_NAME="transporte";
	$DDBB_USER="root";
	$DDBB_PASS="sta3war2";
	$IP_DDBB="127.0.0.1";
	$DDBB_PREFIX="";
	$DDBB_TYPE="mysql";
	$DDBB_PORT="3306";
	$INSTALL_DIR="/Users/david/Sites/transporte/";
	$WIN32=false;
	$SLASH="/";
	$ADODB_DIR=$INSTALL_DIR."inc/adodb/";
	$SMARTY_DIR=$INSTALL_DIR."inc/smarty/";
	$SMARTY_TEMPLATES_DIR=$INSTALL_DIR."templates/";
	$SMARTY_TEMPLATES_C_DIR=$INSTALL_DIR."templates_c/";
	$SMARTY_CONFIGS_DIR=$INSTALL_DIR."configs/";
	$WEB_SERVER="";
	$WEB_DIR="";
	$BASE_URL="";
?>