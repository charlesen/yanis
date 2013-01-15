<?php

// no direct access
defined ( 'YANIS_EXEC' ) or die ( 'Restricted access' );

// Start app session
//session_start ();
//
//Zend_Session::start();


include_once YANIS_PATH . '/libraries/define.php';

// Define Environnement
if (DEVELOPMENT_ENVIRONMENT) {
	error_reporting ( (E_ALL | E_STRICT) & ~ (E_NOTICE) );
} else {
	error_reporting ( E_ALL & ~ (E_STRICT | E_NOTICE) );
	ini_set ( 'display_errors', 'Off' );
	ini_set ( 'log_errors', 'On' );
	ini_set ( 'error_log', YANIS_PATH . '/tmp/logs/error.log' );
}

// Load Libraries
set_include_path ( implode ( PATH_SEPARATOR, array (realpath ( dirname ( __FILE__ ) ), get_include_path () ) ) );

// Set Zend Autoloader
require_once 'Zend/Loader/Autoloader.php';
require_once 'Zend/Loader/Autoloader/Resource.php';
require_once 'Zend/Session.php';

// Start app session
Zend_Session::start ();

// Yanis Registry
require_once YANIS_PATH . '/libraries/yanis/registry/Registry.php';
?>