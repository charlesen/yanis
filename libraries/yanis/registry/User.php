<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

/**
 * Class Users
 *
 */
class User {
	
	/**
	 * @var Object The Registry object 
	 */
	private $_registry;
	
	/**
	 * @var String Core users table name 
	 */
	private $_user_tablename = 'socialac_yac_users';
	
	/**
	 * @var int The User ID 
	 */
	private $_id = 0;
	
	/**
	 * @var String The Username 
	 */
	private $_username = '';
	
	/**
	 * @var String The Username 
	 */
	private $_password = '';
	
	/**
	 * @var String User email 
	 */
	private $_email;
	
	/**
	 * @var int (0 or 1)
	 */
	private $_welcomeOK = 0;
	
	/**
	 * @var int (0 or 1)
	 */
	private $_active = 0;
	
	/**
	 * @var int (0 or 1) 
	 */
	private $_banned = 0;
	
	/**
	 * @var int 
	 */
	private $_usertype;
	
	/**
	 * @var String 
	 */
	private $_pwd_reset_key;
	
	/**
	 * @var Bool
	 */
	private $_valid = false;
	
	/**
	 * @var static var
	 */
	private static $_instance;
	
	/**
	 * Connect a user. Connection_OK = email_OK && password_OK.
	 * @param type $id
	 * @param type $email
	 * @param type $password 
	 */
	public function __construct() {
		$db = Mysqldb::getInstance ();
		$num = func_num_args ();
		if ($num == 3) {
			$id = func_get_arg ( 0 );
			$email = func_get_arg ( 1 );
			$password = func_get_arg ( 2 );
			/**
			 * If we haven't set a User ID ($id=0) and we have set a username and a password,
			 * we should look up the User to see whether these are valid credentials
			 */
			if ($id == 0 && $email != '' && $password != '') {
				$email = filter_var ( $email, FILTER_SANITIZE_EMAIL ); //hash("whirlpool", PRE_HASH . $password . POST_HASH)
				$hash = md5 ( PRE_HASH . $password . POST_HASH ); //md5($password)
				$sql = "SELECT * FROM " . $this->_user_tablename . " WHERE email ='{$email}' AND 
            password='{$hash}' AND deleted=0";
				$db->yQuery ( $sql );
				
				if ($db->numRows () == 1) {
					$data = $db->getRows ();
					//$_SESSION ['APP_USER'] = $data;
					
					$this->_id = $data ['id'];
					$this->_username = $data ['username'];
					$this->_email = $data ['email'];
					$this->_welcomeOK = $data ['welcomeOK'];
					$this->_active = $data ['active'];
					$this->_banned = $data ['banned'];
					$this->_usertype = $data ['usertype'];
					$this->_pwd_reset_key = $data ['pwd_reset_key'];
					$this->_valid = true;
				}
			} elseif ($id > 0) {
				/**
				 * If we supply a User ID, then we look up the User with that ID and populate
				 * the object with their details. 
				 */
				$id = intval ( $id );
				$sql = "SELECT * FROM " . $this->_user_tablename . " WHERE id='{$id}' AND deleted=0";
				$db->yQuery ( $sql );
				if ($db->numRows () == 1) {
					$data = $db->getRows ();
					//$_SESSION ['APP_USER'] = $data;
					
					$this->_id = $data ['id'];
					$this->_username = $data ['username'];
					$this->_email = $data ['email'];
					$this->_welcomeOK = $data ['welcomeOK'];
					$this->_active = $data ['active'];
					$this->_banned = $data ['banned'];
					$this->_usertype = $data ['usertype'];
					$this->_pwd_reset_key = $data ['pwd_reset_key'];
					$this->_valid = true;
				}
			}
		}
	}
	
	public function getUserID() {
		return $this->_id;
	}
	
	public function setID($userID) {
		$this->_id = $userID;
	}
	
	public function setUsername($username) {
		$this->_username = $username;
	}
	
	public function getUsername() {
		return $this->_username;
	}
	
	public function setEmail($email) {
		$this->_email = $email;
	}
	
	public function getEmail() {
		return $this->_email;
	}
	
	public function setPassword($password) {
		$this->_password = $password;
	}
	
	public function isValid() {
		return $this->_valid;
	}
	
	public function isWelcomeOK() {
		return $this->_welcomeOK == 1 ? true : false;
	}
	
	public function isActive() {
		return $this->_active == 1 ? true : false;
	}
	
	public function isBanned() {
		return $this->_banned == 1 ? true : false;
	}
	
	public function hashPassword($password) {
		return hash ( "whirlpool", PRE . $password . POST );
	}
	
	/**
	 * Return current User's instance
	 *
	 * @return User Object
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
