<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

require_once 'Zend/Controller/Action.php';

yimport ( 'registry.Template' );
yimport ( 'translate.Translate' );

/** 
 * @author Charles EDOU NZE
 * 
 * Class Controller
 */
class YaC {
	/**
	 * @var String
	 */
	protected $_model;
	
	/**
	 * @var String
	 */
	protected $_controller;
	
	/**
	 * @var String
	 */
	protected $_action;
	
	/**
	 * @var String
	 */
	protected $_module;
	
	/**
	 * @var Object Template
	 */
	protected $_template;
	
	/**
	 * @var Object Translate
	 */
	protected $_translate;
	
	/**
	 * @var Object Zend_Action
	 */
	protected $_zend_action;
	
	/**
	 * session
	 *
	 * @var Zend_Session_Namespace
	 */
	protected $_session = null;
	
	/**
	 * authentification
	 *
	 * @var Yanis_Authentication
	 */
	protected $_auth = null;
	
	/**
	 * Controller
	 * @param String $model
	 * @param String $controller
	 * @param String $action
	 */
	function __construct($model, $controller, $action) {
		$this->_controller = isset ( $controller ) ? $controller : (isset ( $_SESSION ['APP_CONTROLLER'] ) ? $_SESSION ['APP_CONTROLLER'] : "");
		$this->_action = isset ( $action ) ? $action : (isset ( $_SESSION ['APP_CONTROLLER'] ) ? $_SESSION ['APP_CONTROLLER'] : "");
		$this->_module = isset ( $_SESSION ['APP_MODULE'] ) ? $_SESSION ['APP_MODULE'] : "";
		
		$this->_model = new $model ();
		$this->_translate = new Yanis_Translate ();
		$this->_template = new Template ();
		$this->_template->setController ( $controller )->setAction ( $action );
		$this->_zend_action = new Zend_Controller_Action ( null, null ); //$request, $response
	

	/**
		if (Zend_Registry::isRegistered ( "session" )) {
			$session = Zend_Registry::get ( "session" );
			$this->_session = $session;
		}
		if (Zend_Registry::isRegistered ( "config" )) {
			$config = Zend_Registry::get ( "config" );
			$this->_config = $config;
		}
		if (Zend_Registry::isRegistered ( "db" )) {
			$db = Zend_Registry::get ( "db" );
			$this->_db = $db;
		}
		if (Zend_Registry::isRegistered ( "EntityManager" )) {
			$EntityManager = Zend_Registry::get ( "EntityManager" );
			$this->_entity_manager = $EntityManager;
		}
		if (Zend_Registry::isRegistered ( "auth" )) {
			$auth = Zend_Registry::get ( "auth" );
			$this->_auth = $auth;
		}
		if (Zend_Registry::isRegistered ( "logger" )) {
			$logger = Zend_Registry::get ( "logger" );
			$this->_logger = $logger;
		}
		if (Zend_Registry::isRegistered ( "tracer" )) {
			$tracer = Zend_Registry::get ( "tracer" );
			$this->_tracer = $tracer;
		}
		if (Zend_Registry::isRegistered ( "translate" )) {
			$translate = Zend_Registry::get ( "translate" );
			$this->_translate = $translate;
		}
	 **/
	
	}
	
	/**
	 * @return the $_model
	 */
	public function getModel() {
		return $this->_model;
	}
	
	/**
	 * @return the $_controller
	 */
	public function getController() {
		return $this->_controller;
	}
	
	/**
	 * @return the $_action
	 */
	public function getAction() {
		return $this->_action;
	}
	
	/**
	 * @return the $_module
	 */
	public function getModule() {
		return $this->_module;
	}
	
	/**
	 * @return the $_template
	 */
	public function getTemplate() {
		return $this->_template;
	}
	
	/**
	 * @return the $_translate
	 */
	public function getTranslate() {
		return $this->_translate;
	}
	
	/**
	 * @param String $_model
	 */
	public function setModel($_model) {
		$this->_model = $_model;
	}
	
	/**
	 * @param String $_controller
	 */
	public function setController($_controller) {
		$this->_controller = $_controller;
	}
	
	/**
	 * @param String $_action
	 */
	public function setAction($_action) {
		$this->_action = $_action;
	}
	
	/**
	 * @param String $_module
	 */
	public function setModule($_module) {
		$this->_module = $_module;
	}
	
	/**
	 * @param Object $_template
	 */
	public function setTemplate($_template) {
		$this->_template = $_template;
	}
	
	/**
	 * Translate content Text
	 * @param String $text
	 */
	function _($text) {
		$this->_translate->_ ( $text );
	}
	
	/**
	 * Template tag setter
	 * @param String $name
	 * @param String $value
	 */
	function set($name, $value) {
		$this->_template->assign ( $name, $value );
	}
	
	/**
	 * Dispatch the requested action
	 *
	 * @param string $action Method name of action
	 * @return void
	 */
	public function dispatch($action) {
	
	}
	
	function __destruct() {
		//@todo : $this->_template->render ();
	}
}

?>