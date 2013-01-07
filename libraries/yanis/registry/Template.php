<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

/**
 * Class Template
 * @author Charles EDOU NZE
 */
class Template {
	/**
	 * Store all the template variables
	 * @var Array
	 */
	private $_vars = array ();
	
	/**
	 * Path to the templates
	 * @var String
	 */
	private $_path;
	
	/**
	 * @var Object Template
	 */
	private $_page;
	
	/**
	 * Module
	 * @var String
	 */
	private $_module;
	
	/**
	 * Controller
	 * @var String
	 */
	private $_controller;
	
	/**
	 * Action
	 * @var String
	 */
	private $_action;
	
	/**
	 * @var Object The Registry object
	 */
	private $_registry;
	
	/**
	 * @var static var
	 */
	private static $_instance;
	
	/**
	 * Include the page class, and build a page object to manage the content
	 * and structure of the page
	 */
	public function __construct() {
		yimport ( 'registry.Page' );
		$this->_page = & Page::getInstance ();
		
		// Default views path.
		$this->_path = TEMPLATE_BASE;
		
		// Module views path
		if (defined ( TEMPLATE_MODULE_PATH )) {
			$this->_path = TEMPLATE_MODULE_PATH;
		}
		
		// Mobile views path
		if ($this->_page->isMobilePage ()) {
			$this->_path = TEMPLATE_MOBILE_PATH;
		}
		
		$this->_registry = new Registry ();
		
		/** 
		 * @fixme : Problèmes en cas d'exception -> injection du contenu d'un controlleur stocké en session. Refresh est nécessaire sinon.
		 * @todo : make it more magical
		 */
		$this->_module = $_SESSION ['APP_MODULE'];
		$this->_controller = $_SESSION ['APP_CONTROLLER'];
		$this->_action = $_SESSION ['APP_ACTION'];
	}
	
	/**
	 * Set a template variable.
	 *
	 * @param string $name name of the variable to set
	 * @param mixed $value the value of the variable
	 *
	 * @return void
	 */
	function assign($name, $value) {
		$this->_vars [$name] = $value;
	}
	
	/**
	 * Set a bunch of variables at once using an associative array.
	 *
	 * @param array $vars array of vars to set
	 * @param bool $clear whether to completely overwrite the existing vars
	 *
	 * @return void
	 */
	function assign_vars($vars, $clear = false) {
		if ($clear) {
			$this->_vars = $vars;
		} else {
			if (is_array ( $vars ))
				$this->_vars = array_merge ( $this->_vars, $vars );
		}
	}
	
	/**
	 * Clear template element
	 * @param String $key
	 */
	function clear_assign($key) {
		unset ( $this->_vars [$key] );
	}
	
	function clear_all_assign() {
		if (is_array ( $this->_vars )) {
			unset ( $this->_vars );
		}
	}
	
	/**
	 * @return String $_vars
	 */
	public function get_template_vars($key) {
		return $this->_vars [$key];
	}
	
	/**
	 * Set View path
	 * @param String $path
	 */
	function setPath($path) {
		$this->_path = $path;
	}
	
	/**
	 * @param Object $newpage
	 */
	public function setPage($newpage) {
		$this->_page = $newpage;
	}
	
	/**
	 * @return Object Page
	 */
	public function getPage() {
		return $this->_page;
	}
	
	/**
	 * @return the $_module
	 */
	public function getModule() {
		return $this->_module;
	}
	
	/**
	 * @param String $_module
	 */
	public function setModule($_module) {
		$this->_module = $_module;
		//$_SESSION ['APP_MODULE'] = $_module;
		return $this;
	}
	
	/**
	 * @return the $_controller
	 */
	public function getController() {
		return $this->_controller;
	}
	
	/**
	 * @param String $_controller
	 */
	public function setController($_controller) {
		$this->_controller = $_controller;
		return $this;
	}
	
	/**
	 * @return the $_action
	 */
	public function getAction() {
		return $this->_action;
	}
	
	/**
	 * @param String $_action
	 */
	public function setAction($_action) {
		$this->_action = $_action;
		return $this;
	}
	
	/**
	 * @return the $_path
	 */
	public function getPath() {
		return $this->_path;
	}
	
	/**
	 * Open, parse, and return the template file. 
	 *
	 * <code>
	 * require_once('template.php');
	 * $tpl = & new Template('./templates/');
	 * $tpl->set('title', 'User Profile');
	 * $profile = array(
	 * 'name' => 'Charles',
	 * 'email' => 'charles@yanis-framework.com',
	 * 'password' => 'myPassword'
	 * );
	 * $tpl->set_vars($profile);
	 * echo $tpl->fetch('profile.tpl.php');
	 * </code>
	 *
	 * @param String $file the template file name
	 * @return String
	 */
	function fetch($file) {
		extract ( $this->_vars ); // Extract the vars to local namespace
		// Start output buffering
		ob_start ();
		try {
			include ($this->_path . $file); // Include the file
		} catch ( Exception $e ) {
			echo "File $file doesn't exist : " . $e->getMessage ();
		}
		$contents = ob_get_contents (); // Get the contents of the buffer
		ob_end_clean ();
		// End buffering and discard
		

		return $contents; // Return the contents
	}
	
	/**
	 * Render views
	 */
	function render() {
		extract ( $this->_vars );
		
		// Set Header
		if (file_exists ( MODULE_FOLDER_PATH . DS . 'yam_' . $this->_controller . DS . 'yam' . $this->_controller . DS . 'views' . DS . 'header.php' )) {
			include_once MODULE_FOLDER_PATH . DS . 'yam_' . $this->_controller . DS . 'yam' . $this->_controller . DS . 'views' . DS . 'header.php';
		} elseif (empty ( $_SESSION ['APP_Routing_Error'] )) {
			include_once TEMPLATE_BASE . DS . 'views' . DS . 'header.php';
		}
		
		// Set Module layout
		if (file_exists ( MODULE_FOLDER_PATH . DS . 'yam_' . $this->_controller . DS . 'views' . DS . $this->_action . '.php' )) {
			include_once MODULE_FOLDER_PATH . DS . 'yam_' . $this->_controller . DS . 'views' . DS . $this->_action . '.php';
		}
		
		// Set Footer
		if (file_exists ( MODULE_FOLDER_PATH . DS . 'yam_' . $this->_controller . DS . 'yam_' . $this->_controller . DS . 'views' . DS . 'footer.php' )) {
			include_once MODULE_FOLDER_PATH . DS . 'yam_' . $this->_controller . DS . 'yam_' . $this->_controller . DS . 'views' . DS . 'footer.php';
		} elseif (empty ( $_SESSION ['APP_Routing_Error'] )) {
			include_once TEMPLATE_BASE . DS . 'views' . DS . 'footer.php';
		}
	}
	
	/**
	 * Build the Main view
	 * @return void
	 * @deprecated
	 */
	public function renderViews() {
		define ( 'YANIS_BASENAME', $this->_page->getBaseName () );
		$content = "";
		
		extract ( $this->_vars );
		
		if ($this->_page->isModule ( $pageType ) == true) {
			
			// Module ?
			$this->setModule ( $pageType )->setController ( array_shift ( $urlBits ) )->setAction ( $urlBits );
			
			include_once $this->_page->getModuleIndex ();
		
		/**
			// Set Header
			if (file_exists ( MODULE_FOLDER_PATH . DS . "yam_" . $this->_module . DS . 'views/head.php' )) {
				include_once (MODULE_FOLDER_PATH . DS . "yam_" . $this->_module . DS . 'views/head.php');
			} else {
				include_once (TEMPLATE_PATH . '/views/head.php');
			}
			
			// Set Module layout
			if (file_exists ( MODULE_FOLDER_PATH . DS . "yam_" . $this->_module . DS . 'views/' . $_SESSION ['APP_CONTROLLER'] )) {
				include_once (MODULE_FOLDER_PATH . DS . "yam_" . $this->_module . DS . 'views/' . $_SESSION ['APP_CONTROLLER']);
			}
			
			// Set Footer
			if (file_exists ( MODULE_FOLDER_PATH . DS . $this->_module . DS . 'views/footer.php' )) {
				include_once (MODULE_FOLDER_PATH . DS . $this->_module . DS . 'views/footer.php');
			} else {
				include_once (TEMPLATE_PATH . DS . 'views' . DS . 'footer.php');
			}
		 **/
		
		} elseif ($this->_page->isPage ( $pageType ) == true) {
			// or simple Page ?
			$pageURL = $this->_page->getUrlPath ( $pageType );
			$content .= file_get_contents ( $pageURL );
			$this->_page->setContent ( $content );
			
			// Write the base tag in the script
			if (strpos ( $content, '<base href' ) === false) {
				$this->_page->setContent ( str_replace ( '<head>', '<head>' . "\n\t" . '<base href="' . YANIS_BASENAME . '" />', $this->_page->getContent () ) );
			}
			file_put_contents ( $pageURL, $this->_page->getContent () );
			include_once $pageURL;
			print $this->_page->getGenerator (); // Print the Framework generator
		} else {
			// 404 Error
			header ( $_SERVER ["SERVER_PROTOCOL"] . " 404 Not Found" );
			include_once YANIS_PATH . '/system/404.php';
		}
	}
	
	/**
	 * Assign a variable to the template
	 *
	 * @param string $key The variable name.
	 * @param mixed $val The variable value.
	 * @return void
	 */
	public function __set($key, $val) {
		$this->assign ( $key, $val );
	}
	
	/**
	 * Retrieve an assigned variable
	 *
	 * @param string $key The variable name.
	 * @return mixed The variable value.
	 */
	public function __get($key) {
		return $this->get_template_vars ( $key );
	}
	
	public static function &getInstance() {
		$className = __CLASS__;
		if (isset ( self::$_instance ) === false) {
			self::$_instance = new $className ();
		}
		return self::$_instance;
	}
	
	public function __destruct() {
		;
	}

}

?>
