<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

require_once 'loader.php';

// @fixme : set it more magical
require_once YANIS_PATH . '/libraries/yanis/controller/Controller.php';

/**
 * Yanis Class
 * @author Charles EDOU NZE
 *
 */
class Yanis {
	
	/**
	 * Run the framework
	 */
	public static function run() {
		$registry = & Registry::getInstance ();
		// Store core objects
		$registry->yStoreObject ( 'Mysqldb', 'db' );
		$registry->yStoreObject ( 'Template', 'tpl' );
		$registry->yStoreObject ( 'User', 'user' );
		
		// Routing
		self::callHook ();
		
		//Store settings
		/**
		 from yanis_settings"; // Session data : notifications,...
		 $registry->getObject('db')->yQuery($settingsSQL);
		 while ($setting = $this->getObject('db')->getRows()) {
		 $registry->yStoreSetting($setting['value'], $setting['key']);
		}
		 **/
		
		// Database connection
		$registry->getObject ( 'db' )->yConnect ();
		
		// Template Rendering
		$registry->getObject ( 'tpl' )->render ();
	
		// App bootstraper
	//$this->bootstrap ();
	

	}
	
	/**
	 * Init everything about framework (routing, plugins, module, sessions, ...) 
	 */
	public function bootstrap() {
	/**
	 * @todo:importer le test sur la variable $_REQUEST['page'] ici...
	 * Et stocker les variables en session : 
	 * $_SESSION['APP_MODULE'], $_SESSION['APP_CONTROLLER'], $_SESSION['APP_PARAMS']
	 */
	}
	
	public function dispatch() {
	
	}
	
	/**
	 * Prepare Data
	 * E.g : 
	 * /account/profil/index/id/24aq1xs5s/
	 * /MODULE/CONTROLLER/ACTION/PARAM1/VALUE1...
	 */
	public static function callHook() {
		$url = $_GET ['page'];
		$params = array ();
		$urlArray = array ();
		$urlArray = explode ( "/", $url );
		
		if (isset ( $urlArray [0] ) && ! empty ( $urlArray [0] )) {
			// At least one controller
			$_SESSION ['APP_CONTROLLER'] = $controller = $urlArray [0];
			array_shift ( $urlArray );
			$_SESSION ['APP_ACTION'] = $action = isset ( $urlArray [0] ) ? $urlArray [0] : "index";
			array_shift ( $urlArray );
			
			// Prepare params
			if (is_array ( $urlArray ) && sizeof ( $urlArray ) >= 2) {
				while ( count ( $urlArray ) > 1 ) {
					$params [$urlArray [0]] = $urlArray [1];
					array_shift ( $urlArray );
					array_shift ( $urlArray );
				}
				$_SESSION ['APP_PARAMS'] = $params;
			}
			
			$controllerFile = YANIS_PATH . DS . 'modules' . DS . 'yam_' . $controller . DS . 'yam_' . $controller . '.php';
			
			try {
				if (file_exists ( $controllerFile )) {
					include_once $controllerFile;
				} else {
					throw new Exception ( "An Error has occured ! Controller '<b>" . $controller . "</b>' doesn't exist in the app." );
				}
				$className = 'Yam_' . ucfirst ( $controller );
				$dispatch = new $className ( $controller, $action );
				$action .= 'Action'; // Zend Like notation
				if (( int ) method_exists ( $dispatch, $action )) {
					call_user_func_array ( array ($dispatch, $action ), $params );
				} else {
					/**
					 * @todo : $exceptionObject->add("type", "content");
					 * e.g   : $exception->add("warning", "Attention...");
					 * $exception->add("error", "Le fichier n'existe pas");
					 */
					throw new Exception ( "<b>An Error has occured !</b><br> Method '<b>" . $action . "</b>' doesn't exist for <b>$controller</b> Module. Please, check your <b>yam_$controller.php</b> file" );
					call_user_func_array ( array ($dispatch, 'index' ), $params );
				}
			} catch ( Exception $e ) {
				// 404 Error
				header ( $_SERVER ["SERVER_PROTOCOL"] . " 404 Not Found " . $e->getMessage () );
				$_SESSION ['APP_Routing_Error'] = $e->getMessage ();
				include_once YANIS_PATH . '/system/404.php';
			}
		
		} else {
			// Include template index page
			include_once TEMPLATE_BASE . DS . 'index.php'; // @todo: do it more magical
		}
	
	}
	
	/**
	 * @param String $filePath the file path
	 */
	public static function import($filePath) {
		$base = YANIS_PATH . '/libraries' . DS . 'yanis';
		$path = str_replace ( '.', DS, $filePath );
		
		/**
		foreach ( glob ( $path ) as $file ) {
			if (is_dir ( $file ))
		 *" );
			require_once ($file);
		}
		 **/
		
		require_once ($base . DS . $path . '.php');
	}
	
	function __autoload($classname) {
		if (file_exists ( YANIS_PATH . '/librairies/yanis/registry/' . $classname . '.php' )) {
			include_once YANIS_PATH . '/librairies/yanis/registry/' . $classname . '.php';
		} elseif (file_exists ( YANIS_PATH . '/librairies/yanis/' . ucfirst ( $classname ) . '/$classname.php' )) {
			include_once YANIS_PATH . '/librairies/yanis/' . ucfirst ( $classname ) . '/$classname.php';
		}
	}

}

/**
 * ========================================
 * Core Class definitions - Framework Layer
 * ======================================= */

/**
 * Yanis Extension Class
 */
class Yax {
	
	public static function loadExtension($extensionName) {
		$extensionPath = YANIS_PATH . '/extensions/yax_' . $extensionName;
		if (file_exists ( $extensionPath )) {
			include_once $extensionPath . '/yax_' . $extensionName . '.php';
		}
	}

}

/**
 * Yanis Plugin Class
 */
class Yap {
	
	public static function loadHelper($pluginName) {
		$pluginPath = YANIS_PATH . '/plugins/yap_' . $pluginName;
		if (file_exists ( $pluginPath )) {
			include_once $pluginPath . '/yap_' . $pluginName . '.php';
		}
	}

}

/**
 * Yanis Module Class
 */
class Yam {
	
	public static function loadModule($moduleName = '') {
		$modulePath = MODULE_FOLDER_PATH . '/yam_' . $moduleName;
		if (file_exists ( $modulePath )) {
			include_once $modulePath . '/yam_' . $moduleName . '.php';
		}
	}
	
	// Changer par loadUri($moduleName, $view = null)
	public static function loadDefault($moduleName) {
		$viewPath = YANIS_PATH . '/modules/yam_' . $moduleName . '/views/default.php';
		if (file_exists ( $viewPath )) {
			include_once $viewPath;
		}
	}

}

/**
 * Intelligent file importer
 *
 * @access public
 * @param String $path dot syntax path
 */
function yimport($path) {
	Yanis::import ( $path );
}

?>