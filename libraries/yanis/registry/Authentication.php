<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

require_once 'Zend/Session.php';

/**
 * Class Authentication
 */
class Authentication {
	
	/**
	 * @var static var
	 */
	private static $_instance;
	
	/**
	 * @var Bool User status
	 */
	private $_loggedIn = false;
	
	/**
	 * @var Bool User status
	 */
	private $_welcomeOK = false;
	
	/**
	 * @var String Login Failure Reason
	 */
	private $_loginFailureReason = '';
	
	/**
	 * @var Bool
	 */
	private $_justProcessed = false;
	
	/**
	 * @var Object Template 
	 */
	private $_template;
	
	/**
	 * @var Object Zend_Session 
	 */
	private $_session;
	
	public function __construct() {
		yimport ( 'registry.Template' );
		$this->_template = new Template ();
	}
	
	/**
	 * Set a new Session in specific namespace
	 * @param String $namespace
	 */
	public function setSession($namespace = 'Default') {
		$this->_session = new Zend_Session_Namespace ( $namespace );
	}
	
	public function isLoggedIn() {
		return $this->_loggedIn;
	}
	
	/**
	 * Check for new users
	 */
	public function isWelcomeOK() {
		return $this->_welcomeOK;
	}
	
	/**
	 * Logout
	 */
	public function logout() {
		Zend_Session::destroy ();
		$_SESSION = array ();
		//session_destroy ();
		$this->_loggedIn = false;
	}
	
	/*
     * Check Both for an active session and user credentials
     */
	public function checkAuth() {
		$this->_template->assign ( 'alert', '' );
		
		if (isset ( $_SESSION ['APP_USER'] ['ID'] )) {
			$uid = $_SESSION ['APP_USER'] ['ID'];
		}
		if (isset ( $_POST ['register_email'] )) {
			$email = $_SESSION ['APP_USER'] ['EMAIL'];
		}
		if (isset ( $_POST ['register_password'] )) {
			$password = $_SESSION ['APP_USER'] ['PASSWORD']; //yanis_auth_pwd
		}
		
		if (isset ( $uid ) && intval ( $uid ) > 0) {
			// We test if a session data is already set
			$this->sessionAuth ( intval ( $uid ) );
			if ($this->_loggedIn === false) {
				$this->_template->assign ( 'alert', '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>Error !</strong> Vos identifiants ne sont pas correctes. Merci de reéssayer.</div>' );
			}
		} elseif ((isset ( $email ) && $email != '') && (isset ( $password ) && $password != '')) {
			//If not, let's us launch a brand new session !
			$this->postAuth ( $email, $password );
			if ($this->_loggedIn === false) {
				$this->_template->assign ( 'alert', '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>Error !</strong> Vos identifiants ne sont pas correctes. Merci de reéssayer.</div>' );
			}
		} elseif (isset ( $_POST ['yam_account_type'] ) && $_POST ['yam_account_type'] == 'login') { //login
			$this->_template->assign ( 'alert', '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>Erreur !</strong> Vous devez entrer un Nom et un Mot de passe.</div>' );
		}
	}
	
	/**
	 * If a user exists and is logged in, then the method sets the appropriate session data
	 * @param type $username
	 * @param type $password 
	 */
	public function postAuth($email, $password) {
		$this->_justProcessed = true;
		require_once YANIS_PATH . '/libraries/yanis/registry/User.php';
		$user = new User ( 0, $email, $password );
		
		if ($user->isValid ()) {
			if ($user->isActive () === false) {
				$this->_loggedIn = false;
				$this->_loginFailureReason = 'User is inactive';
			} elseif ($user->isBanned () == true) {
				$this->_loggedIn = false;
				$this->_loginFailureReason = 'User is Banned';
			} else {
				$this->_loggedIn = true;
				$this->_welcomeOK = $user->isWelcomeOK ();
				$_SESSION ['APP_USER'] ['ID'] = $user->getUserID ();
				$_SESSION ['APP_USER'] ['NAME'] = $user->getUsername ();
				$_SESSION ['APP_USER'] ['EMAIL'] = $user->getEmail ();
			}
		} else {
			$this->_loggedIn = false;
			$this->_loginFailureReason = 'Invalid credentials';
		}
	}
	
	public function sessionAuth($uid) {
		yimport ( 'registry.User' );
		yimport ( 'registry.Email' );
		
		$email = new Email ();
		$user = new User ( $uid, '', '' );
		
		if ($user->isValid ()) {
			if ($user->isActive () === false) {
				$this->_loggedIn = false;
				$this->_loginFailureReason = 'User is inactive';
			} elseif ($user->isBanned () == true) {
				$this->_loggedIn = false;
				$this->_loginFailureReason = 'User is inactive';
			} else {
				$this->_loggedIn = true;
				$this->_welcomeOK = $user->isWelcomeOK ();
				$_SESSION ['APP_USER'] ['NAME'] = $user->getUsername ();
				$_SESSION ['APP_USER'] ['EMAIL'] = $user->getEmail ();
			}
		} else {
			$this->_loggedIn = false;
			$this->_loginFailureReason = 'No user';
		}
		
		if ($this->_loggedIn == false) {
			$this->logout ();
		}
		$this->_template->assign ( 'username', $user->getUsername () );
		$this->_template->assign ( 'email', $user->getEmail () );
	}
	
	/**
	 * Remember Me
	 * @param String $seconds
	 * @return void
	 */
	public function rememberMe($seconds) {
		Zend_Session::rememberMe ( $seconds );
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
