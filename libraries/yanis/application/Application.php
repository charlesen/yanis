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
 * @author Charles EDOU NZE
 * 
 * Class Application
 */
class Yanis_Application {
	function __construct() {
	
	}
	
	/**
	 * Route the application.
	 *
	 * Routing is the process of examining the request environment to determine which
	 * component should receive the request. The component optional parameters
	 * are then set in the request object to be processed when the application is being
	 * dispatched.
	 *
	 * @abstract
	 * @access	public
	 */
	function route() {
		// get the full request URI
	}
	
	/**
	 * Dispatch the applicaiton.
	 *
	 * Dispatching is the process of pulling the option from the request object and
	 * mapping them to a component. If the component does not exist, it handles
	 * determining a default component to dispatch.
	 *
	 * @abstract
	 * @access	public
	 */
	function dispatch($component) {
	
	}
	
	/**
	 * Render the application.
	 *
	 * Rendering is the process of pushing the document buffers into the template
	 * placeholders, retrieving data from the document and pushing it into
	 * the Yanis_Response buffer.
	 *
	 * @abstract
	 * @access	public
	 */
	function render() {
	
	}
	
	/**
	 * Registers a handler to a particular event group.
	 *
	 * @static
	 * @param	string	The event name.
	 * @param	mixed	The handler, a function or an instance of a event object.
	 * @return	void
	 */
	function registerEvent($event, $handler) {
		$args = array ();
		if (method_exists ( $handler, $event )) {
			call_user_func_array ( array ($handler, $event ), $args );
		}
	}
	
	/**
	 * Calls all handlers associated with an event group.
	 *
	 * @static
	 * @param	string	The event name.
	 * @param	array	An array of arguments.
	 * @return	array	An array of results from each function call.
	 */
	function triggerEvent($event, $args = null) {
	
	}
	
	/**
	 * Exit the application.
	 *
	 * @access	public
	 * @param	int	Exit code
	 */
	function close($code = 0) {
		exit ( $code );
	}
	
	function __destruct() {
	
	}
}

?>