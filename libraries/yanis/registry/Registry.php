<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE
 */

/**
 * Classe Registry
 */
class Registry {
	
	/**
	 * @var static var
	 */
	private static $_instance;
	
	/**
	 * @var Array Objects 
	 */
	private $objects;
	
	/**
	 * @var Array Settings
	 */
	private $settings;
	
	/**
	 * @var Object YConfig 
	 */
	private $config;
	
	public function __construct() {
		require_once YANIS_PATH . '/config.php';
		$this->config = new YConfig ();
	}
	
	/**
	 * Create a new object and store it in the Registry
	 * @param String $object the object file prefix
	 * @param String $key pair for the object
	 * @return void
	 */
	public function yStoreObject($object, $key) {
		require_once $object . '.php';
		$this->objects [$key] = new $object ( $this );
	}
	
	/**
	 * Store settings
	 * @param String $setting the setting data
	 * @param String $key the key pair for the settings array
	 * @return void
	 */
	public function yStoreSetting($setting, $key) {
		$this->settings [$key] = $setting;
	}
	
	/**
	 * Get an object from the registries store
	 * @param String $key the objects array key
	 * @return Object
	 */
	public function getObject($key) {
		return $this->objects [$key];
	}
	
	/**
	 * Get a setting from the registries store
	 * @param String $key the settings array key
	 * @return String the setting data
	 */
	public function getSetting($key) {
		return $this->settings [$key];
	}
	
	/**
	 * @return Object YConfig 
	 */
	public function getConfig() {
		return $this->config;
	}
	
	/**
	 * @param YConfig $config 
	 */
	public function setConfig(YConfig $config) {
		$this->config = $config;
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