<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

require_once 'Zend/View/Interface.php';
//require_once 'libraries/yanis/registry/Template.php';
yimport ( 'registry.Template' );

/** 
 * Class View
 * @author Charles EDOU NZE
 */
class Yanis_View implements Zend_View_Interface {
	
	/**
	 * @var Template
	 */
	private $_template;
	
	function __construct() {
		$this->_template = new Template ();
	}
	
	/**
	 * Return the template engine object
	 *
	 * @return Template
	 */
	public function getEngine() {
		return $this->_template;
	}
	
	/**
	 * Set the path to the templates
	 *
	 * @param string $path The directory to set as the path.
	 * @return void
	 */
	public function setScriptPath($path) {
		if (is_readable ( $path )) {
			$this->_template->_path = $path;
			return;
		}
		
		throw new Exception ( 'Invalid path provided' );
	}
	
	/**
	 * Retrieve the current template directory
	 *
	 * @return string
	 */
	public function getScriptPaths() {
		return array ($this->_template->_path () );
	}
	
	/**
	 * Alias for setScriptPath
	 *
	 * @param string $path
	 * @param string $prefix Unused
	 * @return void
	 */
	public function setBasePath($path, $prefix = '') {
		return $this->setScriptPath ( $path );
	}
	
	/**
	 * Alias for setScriptPath
	 *
	 * @param string $path
	 * @param string $prefix Unused
	 * @return void
	 */
	public function addBasePath($path, $prefix = '') {
		return $this->setScriptPath ( $path );
	}
	
	/**
	 * Assign a variable to the template
	 *
	 * @param string $key The variable name.
	 * @param mixed $val The variable value.
	 * @return void
	 */
	public function __set($key, $val) {
		$this->_template->assign ( $key, $val );
	}
	
	/**
	 * Retrieve an assigned variable
	 *
	 * @param string $key The variable name.
	 * @return mixed The variable value.
	 */
	public function __get($key) {
		return $this->_template->get_template_vars ( $key );
	}
	
	/**
	 * Allows testing with empty() and isset() to work
	 *
	 * @param string $key
	 * @return boolean
	 */
	public function __isset($key) {
		return (null !== $this->_template->get_template_vars ( $key ));
	}
	
	/**
	 * Allows unset() on object properties to work
	 *
	 * @param string $key
	 * @return void
	 */
	public function __unset($key) {
		$this->_template->clear_assign ( $key );
	}
	
	/**
	 * Assign variables to the template
	 *
	 * Allows setting a specific key to the specified value, OR passing an array
	 * of key => value pairs to set en masse.
	 *
	 * @see __set()
	 * @param string|array $spec The assignment strategy to use (key or array of key
	 * => value pairs)
	 * @param mixed $value (Optional) If assigning a named variable, use this
	 * as the value.
	 * @return void
	 */
	public function assign($spec, $value = null) {
		if (is_array ( $spec )) {
			$this->_template->assign ( $spec );
			return;
		}
		
		$this->_template->assign ( $spec, $value );
	}
	
	/**
	 * Clear all assigned variables
	 *
	 * Clears all variables assigned to Zend_View either via {@link assign()} or
	 * property overloading ({@link __get()}/{@link __set()}).
	 *
	 * @return void
	 */
	public function clearVars() {
		$this->_template->clear_all_assign ();
	}
	
	/**
	 * Processes a template and returns the output.
	 *
	 * @param string $file The template to process.
	 * @return string The output.
	 */
	public function render($file) {
		return $this->_template->fetch ( $file );
	}
	
	function __destruct() {
	
	}
}

?>