<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

/**
 * Class Url
 */
class Url {
	
	/**
	 * @var Object The Registry object 
	 */
	private $_registry;
	
	/**
	 * @var String The URL Path
	 */
	private $_urlpath;
	
	/**
	 * @var Array Url bits 
	 */
	private $_urlBits;
	
	/*
     * The getURLData method processes the incoming URL, and breaks it down into
     * parts, building up an array of "URL bits"
     * 
     * Gets data from the current URL
     */
	
	/**
	 * @var static var
	 */
	private static $_instance;
	
	public function __construct() {
		$this->_registry = new Registry ();
	}
	
	public function getURLData() {
		$param = 'page';
		$urldata = (isset ( $_GET [$param] )) ? $_GET [$param] : '';
		$this->_urlpath = $urldata;
		if ($urldata == '') {
			$this->_urlBits [] = '';
			$this->_urlpath = '';
		} else {
			$data = explode ( '/', $urldata );
			while ( ! empty ( $data ) && strlen ( reset ( $data ) ) === 0 ) {
				array_shift ( $data );
			}
			while ( ! empty ( $data ) && strlen ( end ( $data ) ) === 0 ) {
				array_pop ( $data );
			}
			$this->_urlBits = trim ( $data );
		}
	}
	
	/**
	 * @return Array array of bits 
	 */
	public function getURLBits() {
		return $this->_urlBits;
	}
	
	/**
	 * Access to a specific bit 
	 */
	public function getURLBit($thisBit) {
		return (isset ( $this->_urlBits [$thisBit] )) ? $this->_urlBits [$thisBit] : 0;
	}
	
	/**
	 * Set the URL Path
	 * @param String $path the Url path
	 */
	public function setURLPath($path) {
		$this->_urlpath = $path;
	}
	
	/**
	 * Get the path URL
	 * @return type 
	 */
	public function getURLPath() {
		return $this->_urlpath;
	}
	
	public function renderURL($bits, $qs, $admin) {
		$admin = ($admin == 1) ? $this->_registry->getSetting ( 'admin_folder' ) . '/' : '';
		$the_rest = '';
		foreach ( $bits as $bit ) {
			$the_rest .= $bit . '/';
		}
		$the_rest = ($qs != '') ? $the_rest . '?&' . $qs : $the_rest;
		return $this->_registry->getSetting ( 'siteurl' ) . $admin . $the_rest;
	}
	
	public static function &getInstance() {
		$className = __CLASS__;
		if (isset ( self::$_instance ) === false) {
			self::$_instance = new $className ();
		}
		return self::$_instance;
	}

}

?>