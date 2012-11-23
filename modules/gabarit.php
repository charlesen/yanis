<?php

/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

/**
 * Name Module
 * ----------------
 * helper Class
 * 
 */

class Helper extends Yam {

    public function __construct() {
        
    }

    public static function indexAction() {
        // Load the default.php page
        Yam::loadDefault('module_name');
    }

    /**
     * Implements the module controllers (actions) :
     * @param String $controller
     * @param Array $params parameters
     */
    public function moduleAction($post, $controller, $params) {
        
    }
	
	public function __destruct () {
	
	}

}

?>
