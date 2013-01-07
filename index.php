<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE
 * 
 * Front Controller
 */

// Set this flag so that we make sure starting from here.
define ( 'YANIS_EXEC', 1 );

// Core constants
define ( 'DS', DIRECTORY_SEPARATOR );
define ( 'YANIS_PATH', dirname ( __FILE__ ) );
define ( 'YANIS_ROOT', substr ( $_SERVER ['PHP_SELF'], 0, - (strlen ( $_SERVER ['SCRIPT_FILENAME'] ) - strlen ( YANIS_PATH )) ) );

// Load Yanis Framework and run.
include_once YANIS_PATH . DS . 'libraries/framework.php';
Yanis::run ();
?>