<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

// no direct access
defined ( 'YANIS_EXEC' ) or die ( 'Restricted access' );

require_once 'Zend/Translate.php';

/** 
 * Class Translate
 * @author Charles EDOU NZE
 */
class Yanis_Translate {
	
	/**
	 * @var static var
	 */
	private static $_instance;
	
	/**
	 * Adapter type
	 * @var String
	 */
	private $_adapter = 'array';
	
	/**
	 * Local
	 * @var String
	 */
	private $_locale;
	
	/**
	 * Translation Folder
	 * @var String
	 */
	private $_folder;
	
	/**
	 * Content file
	 * @var String
	 */
	private $_content;
	
	/**
	 * Content file
	 * @var String
	 */
	private $_type = 'app';
	
	/**
	 * Translate
	 * @var Object
	 */
	private $_translate;
	
	/**
	 * 
	 * @param String $lang
	 */
	function __construct() {
		//@todo : constructeur avec arguments (type
		$locale = new Zend_Locale ();
		$lang = $locale->getLanguage ();
		
		$this->_locale = $lang;
		$this->_folder = LANG_FOLDER . "/$lang/";
		$this->_content = $this->_folder . $this->_type . ".php";
		
		$this->_translate = new Zend_Translate ( array ('adapter' => $this->_adapter, 'content' => $this->_content, 'locale' => $this->_locale ) );
	}
	
	/**
	 * @return the $_lang
	 */
	public function getLang() {
		return $this->_locale;
	}
	
	/**
	 * @param String $_lang
	 */
	public function setLang($_lang) {
		$this->_locale = $_lang;
	}
	
	/**
	 * @return the $_type
	 */
	public function getType() {
		return $this->_type;
	}
	
	/**
	 * @param String $_type
	 */
	public function setType($_type) {
		$this->_type = $_type;
	}
	
	/**
	 * Add
	 * @param String $lang New language
	 */
	function add($lang) {
		$folder = LANG_FOLDER . "/" . $lang . "/";
		$this->_translate->addTranslation ( $folder, $lang );
	}
	
	/**
	 * Translate content text
	 * @param String $text
	 */
	function _($text) {
		return $this->_translate->translate ( $text );
	}
	
	public static function &getInstance() {
		$className = __CLASS__;
		if (isset ( self::$_instance ) === false) {
			self::$_instance = new $className ();
		}
		return self::$_instance;
	}
	
	function __destruct() {
	
	}
}

?>