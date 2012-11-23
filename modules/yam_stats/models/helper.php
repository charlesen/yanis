<?php

/*
 \* Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

/**
 * Stats Module
 * ----------------
 * helper Class
 * 
 */
//$_SESSION ['APP_CONTROLLER'], $_SESSION ['APP_PARAMS']
class statsHelper {

    public function __construct() {
        
    }

    public static function indexAction() {
        // Load the default.php page
        Yam::loadDefault('stats');
    }

    /**
     * Implements the module controllers (actions) :
     * @param String $controller
     * @param Array $params Controller params
     */
    public function moduleAction($post, $controller, $params) {
        
    }

}

?>
