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
 * Email Class
 *
 * @author Charles EDOU NZE
 */
class Email {
	
	/**
	 * @var Bool 
	 */
	private $_lock;
	
	/**
	 * @var String the Recepient Email Adress 
	 */
	private $_to;
	
	/**
	 * @var String The message Subject
	 */
	private $_subject = "[Socialac] Share experiences / eXchange ideas";
	
	/**
	 * @var String Email Header
	 */
	private $_header;
	
	/**
	 * @var String The content message 
	 */
	private $_message;
	
	/**
	 * @var String Error message 
	 */
	private $_error;
	
	public function __construct() {
		;
	}
	
	/**
	 * @return the $_to
	 */
	public function getTo() {
		return $this->_to;
	}
	
	/**
	 * @return the $_subject
	 */
	public function getSubject() {
		return $this->_subject;
	}
	
	/**
	 * @return the $_header
	 */
	public function getHeader() {
		return $this->_header;
	}
	
	/**
	 * @return the $_message
	 */
	public function getMessage() {
		return $this->_message;
	}
	
	public function setTO($to) {
		if (mb_eregi ( "\r", (urldecode ( $to )) ) || mb_eregi ( "\n", (urldecode ( $to )) )) {
			//bad header - header injections
			$this->lock ();
			$this->_error .= " Bad email Header - Spam or injection securtiy alert";
			
			return false;
		} elseif (filter_var ( $to, FILTER_VALIDATE_EMAIL )) {
			// bad - invalid Email
			$this->lock ();
			$this->_error .= " Bad email adress.";
			
			return false;
		} else {
			// Everything is doing right, so let send that e-mail
			$this->_to = $to;
		}
	}
	
	/**
	 * @param String $_subject
	 */
	public function setSubject($subject) {
		$this->_subject = $subject;
	}
	
	/**
	 * @param String $_header
	 */
	public function setHeader($header) {
		$this->_header = $header;
	}
	
	/**
	 * @param String $_message
	 */
	public function setMessage($message) {
		$this->_message = $message;
	}
	
	private function lock() {
		$this->_lock = true;
	}
	
	/**
	 * This method is called before each new e-mail is sent, wiping the e-mail content 
	 */
	public function startFresh() {
		$this->_lock = false;
		$this->_error = "Failure -  Email not sent";
		$this->_message = "";
	}
	
	/**
	 * Send an Email after the subscription 
	 * @param String $Email
	 * @param Object The user Object
	 */
	public function sendMail() {
		// Envoi
		@mail ( $this->_to, $this->_subject, $this->_message, $this->_header );
	}
	
	/**
	 * Retourne l'instance de l'Email courant
	 * Return the current Email's instance
	 *
	 * @return Object Email
	 */
	public static function &getInstance() {
		$className = __CLASS__;
		if (isset ( self::$_instance ) === false) {
			self::$_instance = new $className ();
		}
		return self::$_instance;
	}

}

?>
