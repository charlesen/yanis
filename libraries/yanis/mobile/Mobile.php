<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

require_once 'Zend/Mobile/Push/Apns.php';
require_once 'Zend/Mobile/Push/C2dm.php';
require_once 'Zend/Gdata/ClientLogin.php';
require_once 'Zend/Mobile/Push/Mpns.php';
require_once 'Zend/Mobile/Push/Message/Mpns/Raw.php';
require_once 'Zend/Mobile/Push/Message/Mpns/Toast.php';

/** 
 * Mobile Class
 * @author Charles EDOU NZE
 */
class Mobile {
	
	function __construct() {
	
	}
	
	/**
	 * Send Mobile Push
	 * 
	 * @param String $deviceType (android, ios, win)
	 * @param String $pem
	 * @param String $id
	 * @param String $token
	 * @param String $messageType
	 * @param String $text Push Message
	 * @param String $sound
	 * @param Array $options
	 * @return void
	 */
	function sendPush($token, $text, $deviceType, $pem = null, $id = null, $messageType = null, $sound = null, $options = null) {
		switch ($deviceType) {
			case "android" :
				$this->c2dmPush ( $id, $token, $text );
				break;
			
			case "ios" :
				$this->apnsPush ( $pem, $token, $text );
				break;
			
			case "win" :
				$this->mpnsPush ( $messageType, $token, $text, $options );
				break;
			
			default :
				exit ( "Nothing to see here." );
				break;
		}
	}
	
	/**
	 * Send Android Push
	 * 
	 * @param String $token User token
	 * @param String $id User key
	 */
	private function c2dmPush($id, $token, $text) {
	
	}
	
	/**
	 * Send Apple Push
	 * 
	 * @param String $token
	 * @param String $pem
	 * @param String $text
	 * @param String $sound
	 */
	private function apnsPush($pem, $token, $text, $sound = null) {
		$apns = new Zend_Mobile_Push_Apns ();
		$apns->setCertificate ( $pem );
		$message = new Zend_Mobile_Push_Message_Apns ();
		$message->setToken ( $token );
		$message->setId ( time () );
		$message->setAlert ( $text );
		$message->setBadge ( 1 );
		$message->setSound ( $sound );
		$apns->send ( $message );
	}
	
	/**
	 * Send Microsoft Push
	 * 
	 * @param String $token
	 * @param String $messageType
	 * @param String $text
	 * @param Array $options
	 */
	private function mpnsPush($messageType = "raw", $token, $text, $options = array()) {
	
	}
	
	/** 
	 * Send a feedback after pushing on device(s)
	 * 
	 * @param String $pem
	 * @return Array
	 */
	function pushFeedback($pem) {
		$apns = new Zend_Mobile_Push_Apns ();
		$apns->setCertificate ( $pem );
		
		return $apns->feedback (); // array of items
	}
	
	/**
	 * Mr Destructor :(
	 */
	function __destruct() {
	
	}
}

?>