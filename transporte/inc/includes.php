<?php
require_once('config.inc.php');
require_once('users.class.php');
require_once('groups.class.php');
require_once('group_users.class.php');
require_once('per_group_modules.class.php');
require_once('per_user_modules.class.php');
require_once('per_group_methods.class.php');
require_once('per_user_methods.class.php');
global 	$INSTALL_DIR,$SMARTY_DIR, $ADODB_DIR;
require_once($ADODB_DIR.'adodb.inc.php');
require_once($SMARTY_DIR.'Smarty.class.php');
require_once('templates.class.php');
require_once('fields.class.php');
require_once('sessions.class.php');
require_once('modules.class.php');
?>