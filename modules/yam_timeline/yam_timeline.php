<?php

/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

// no direct access
defined ( 'YANIS_EXEC' ) or die ( 'Restricted access' );

//Timeline Model
include_once 'models/helper.php';

/**
 * @todo :
 * timelineHelper::moduleAction ( $_SESSION ['APP_CONTROLLER'], $_SESSION ['APP_PARAMS'] );
 * $tp->set(array());
 * $tp->render();
 **/
timelineHelper::moduleAction ( $_SESSION ['APP_CONTROLLER'], $_SESSION ['APP_PARAMS'] );

class Timeline {

}
?>
