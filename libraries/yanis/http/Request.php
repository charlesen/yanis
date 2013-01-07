<?php

/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

/**
 * Class Request
 * @author Charles EDOU NZE
 */

/** @see Zend_Controller_Request_Abstract */
require_once 'Zend/Controller/Request/Http.php';

class Yanis_Request extends Zend_Controller_Request_Http {
	
	public function __construct() {
	
	}
	
	/**
	 * @return string
	 */
	public function getControllerName() {
	
	}
	
	/**
	 * @param string $value
	 * @return self
	 */
	public function setControllerName($value) {
	}
	
	/**
	 * @return string
	 */
	public function getActionName() {
	}
	
	/**
	 * @param string $value
	 * @return self
	 */
	public function setActionName($value) {
	}
	
	/**
	 * @return string
	 */
	public function getControllerKey() {
	}
	
	/**
	 * @param string $key
	 * @return self
	 */
	public function setControllerKey($key) {
	}
	
	/**
	 * @return string
	 */
	public function getActionKey() {
	}
	
	/**
	 * @param string $key
	 * @return self
	 */
	public function setActionKey($key) {
	}

}

?>