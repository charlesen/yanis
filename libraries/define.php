<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

require_once YANIS_PATH . '/config.php';
$config = new YConfig ();

// Template defines
define ( 'TEMPLATE_BASE', YANIS_PATH . '/templates/' . $config->templateName );
define ( 'TEMPLATE_ROOT', YANIS_ROOT . '/templates/' . $config->templateName );
define ( 'TEMPLATE_PATH', YANIS_PATH . '/templates/' . $config->templateName );
define ( 'TEMPLATE_MOBILE_PATH', YANIS_PATH . '/templates/mobile' );

// Module defines
define ( 'RESOURCES_FOLDER', YANIS_PATH . '/resources' );
define ( 'MODULE_FOLDER', YANIS_ROOT . '/modules' );
define ( 'MODULE_FOLDER_PATH', YANIS_PATH . '/modules' );
if (isset ( $_SESSION ['APP_MODULE'] ) && $_SESSION ['APP_MODULE'] !== '') {
	define ( 'TEMPLATE_MODULE_PATH', MODULE_FOLDER_PATH . '/yam_' . $_SESSION ['APP_MODULE'] . '/views/' );
}

// System - Languages
define ( 'LANG_FOLDER', YANIS_PATH . '/system/languages' );

// Environnement Variables
define ( 'DEVELOPMENT_ENVIRONMENT', true );

// Password hash processing.
define ( "PRE_HASH", "d2d87ff87fbc137b0c0b7e81d97b4f9e" );
define ( "POST_HASH", "e6555b063e211df82afd7c0a8fbc512d" );
?>