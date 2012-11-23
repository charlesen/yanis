<?php

/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

// no direct access
defined ( 'YANIS_EXEC' ) or die ( 'Restricted access' );

/**
 * model
 * 
 * @author Charles EDOU NZE
 * @version 1.0
 */

require_once 'Zend/Db/Table/Abstract.php';

class model extends Zend_Db_Table_Abstract {
	/**
	 * Table name 
	 */
	protected $_name = 'socialac_timeline';

}
