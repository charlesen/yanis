<?php

/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

// no direct access
defined ( 'YANIS_EXEC' ) or die ( 'Restricted access' );

// Account Model
include_once 'models/helper.php';

$module = Helper::getInstance ();
$module->moduleAction ( $post = $_POST, $_SESSION ['APP_CONTROLLER'], $_SESSION ['APP_PARAMS'] );
//Helper::moduleAction($_POST['yam_account_type'], $params);

///**
// * 
// * Account Controller Class - Module Entry Point
// * @author Charles
// *
// */
//class Yam_Account {
//	public function __construct() {
//	
//	}
//	public function __get() {
//	
//	}
//	
//	public function __set() {
//	
//	}
//	public function indexAction() {
//	
//	}
//}
?>
