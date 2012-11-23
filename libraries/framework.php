<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

require_once 'loader.php';

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
	
	function callHook() {
		//global $url;
		

		$url = $_GET ['page'];
		
		$urlArray = array ();
		$urlArray = explode ( "/", $url );
		
		$_SESSION ['APP_CONTROLLER'] = $urlArray [0];
		array_shift ( $urlArray );
		$action = $urlArray [0];
		array_shift ( $urlArray );
		$queryString = $urlArray;
		
		//$controllerName = $controller;
		$controller = ucwords ( $controller );
		$model = rtrim ( $controller, 's' );
		$controller .= 'Controller';
		$dispatch = new $controller ( $model, $controllerName, $action );
		
		if (( int ) method_exists ( $controller, $action )) {
			call_user_func_array ( array ($dispatch, $action ), $queryString );
		} else {
			/* Error Generation Code Here */
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
		include_once YANIS_PATH . '/librairies/yanis/registry/' . $classname . '.php';
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