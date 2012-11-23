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
 * Yanis Module (yam)- Account Model Class
 * 
 * @desc Process registration, authentication and manage users profiles.
 * @author Charles EDOU NZE NZE
 * 
 */
yimport ( 'registry.User' );
yimport ( 'registry.Mysqldb' );
yimport ( 'registry.Authentication' );

// Recaptcha PHP Library
include_once 'lib/recaptcha/recaptchalib.php';

// AccountModel
class Helper {
	
	/**
	 * @var String Facebook App ID 
	 */
	public static $FACEBOOK_APP_ID = '139727856139006';
	
	/**
	 * @var String Facebook App Secret 
	 */
	public static $FACEBOOK_APP_SECRET = '208306cf348bcb7999862580f87d0e42';
	
	/**
	 * @var String Twitter Consumer Key 
	 */
	public static $TWITTER_CONSUMER_KEY = 'A3kQjMWaRdU4P4Aed8woCw';
	
	/**
	 * @var String Twitter Consumer Secret 
	 */
	public static $TWITTER_CONSUMER_SECRET = 'hLflA6XLqgFcbmk703NU6g0Gsi7xFS5Rb1LufySc';
	
	/**
	 * Registration fields
	 * @var Array
	 */
	private $_fields = array ('username' => 'username', 'password' => 'password', 'email' => 'email' );
	
	/**
	 * Any Errors in the registration
	 * @var Array
	 */
	private $_registrationErrors = array ();
	
	/**
	 * The values the user has submitted when registering
	 * @var Array
	 */
	private $_submittedValues = array ();
	
	/**
	 * The sanitized versions of the values the user has submitted, so these are database ready
	 */
	private $_sanitizedValues = array ();
	
	/**
	 * User status (active or not) at registration 
	 */
	private $_activeValue = 1;
	
	/**
	 * @var String 
	 */
	private $_captcha_html = '';
	
	/**
	 * @var String
	 */
	public $captcha_private_key = '6LcpedESAAAAANdAmArSydI7y_tiS1CbzUVJT_On';
	
	/**
	 * @var static var
	 */
	private static $_instance;
	
	public function __construct() {
		;
	}
	
	public static function indexAction($pageName = '') {
		$host = $_SERVER ['HTTP_HOST'];
		$uri = rtrim ( dirname ( $_SERVER ['PHP_SELF'] ), '/\\' );
		header ( "Location: http://$host$uri/$pageName" );
	}
	
	public static function loginAction($pageName = '') {
		include_once YANIS_PATH . "/modules/yam_account/views/login.php";
	}
	
	/**
	 * Implements the module controllers (actions) : create, login, logout
	 * @param String $controller
	 * @param Array $params Controller params
	 */
	public function moduleAction($post, $controller, $params) {
		$user = & User::getInstance ();
		$auth = & Authentication::getInstance ();
		$auth->checkAuth ();
		
		if (! isset ( $controller ) || $controller == '') {
			include_once YANIS_PATH . "/modules/yam_account/views/default.php";
		}
		if (count ( $params ) == 0 || $params [0] == '') {
			/**
			 * Normal Authentication
			 */
			if ($controller == 'create') {
				//Registration Process : $user->create();
				if ($this->checkRegistration ( $post ) == true) {
					$userID = $this->processRegistration ();
					$user->setID ( $userID );
					$auth->sessionAuth ( $userID ); //
					$_SESSION['APP_USER'] ['ID'] = $userID;
					$_SESSION['APP_USER'] ['LOGGED'] = true;
					if ($this->_activeValue == 1) {
						self::indexAction ( 'welcome' ); //Show The "Welcome" Page
					}
				} else {
					include_once YANIS_PATH . "/modules/yam_account/views/default.php";
				}
			} elseif ($controller == 'login') {
				//Login process : $user->connect();
				$auth->postAuth ( $post ['register_email'], $post ['register_password'] );
				if (! $auth->isLoggedIn ()) {
					self::loginAction ();
				} else {
					// @remember me
					$remember = isset ( $post ['remember_me'] ) && $post ['remember_me'];
					if ($remember) {
						$seconds = 60 * 60 * 24 * 7; // 7 days
						$auth->rememberMe ( $seconds );
					}
					self::indexAction ();
				}
			} elseif ($controller == 'logout') {
				/**
				 * Logout from App and do a redirection to the homepage 
				 */
				$auth->logout ();
				self::indexAction ();
			} elseif ($controller == 'welcome') {
				/**
				 * Welcome Page : Usertype (cicada or Ant)+ Categories + Location 
				 */
				$submittedValues = array ();
				$category = array ('family_home' => 'Famille et foyer', 'market_food' => 'Courses et Alim.', 'food_restaurant' => 'Art culinaire', 'people_services' => 'Services à la pers.', 'society' => 'Culture et Société', 'discovery' => 'Voyages et Déc.', 'school_education' => 'Education', 'sciences_tech' => 'Sciences et Tech.', 'social_science' => 'Sciences sociales', 'history' => 'Histoire et Person.', 'art_design' => 'Art et Design', 'other' => 'Autre' );
				foreach ( $category as $cle => $valeur ) {
					if ($_POST [$cle] === 'ok') {
						$selectedCategory [] = $cle;
					}
				}
				$submittedValues ['params'] = 'categories:' . implode ( ',', $selectedCategory );
				$submittedValues ['country'] = filter_var ( $_POST ['pays'], FILTER_SANITIZE_STRING );
				$submittedValues ['city'] = filter_var ( $_POST ['ville'], FILTER_SANITIZE_STRING );
				$submittedValues ['gender'] = $_POST ['genre'];
				$submittedValues ['usertype'] = $_POST ['personality'] ? $_POST ['personality'] : 'cicada';
				$submittedValues ['welcomeOK'] = 1;
				
				$db = Mysqldb::getInstance ();
				$uid = $_SESSION['APP_USER'] ['ID'];
				//$sql = "INSERT * FROM " . $this->_user_tablename . " WHERE id='{$id}' AND deleted=0";
				//insert data
				$status = $db->yUpdate ( 'socialac_yac_users', $submittedValues, 'id=' . $uid );
				if ($status) {
					self::indexAction ();
				}
			} elseif ($controller == 'edit') {
			/**
			 * Editing of params 
			 */
			} else {
				self::indexAction ();
			}
		} else {
			/*
             * Social Authentication : twitter, facebook.
             * TODO: Google Authentication
             */
		}
	}
	
	/**
	 * Check the registration process
	 * @return boolean 
	 */
	public function checkRegistration($post) {
		$allClear = true;
		$captcha_resp = recaptcha_check_answer ( $this->captcha_private_key, $_SERVER ["REMOTE_ADDR"], $_POST ["recaptcha_challenge_field"], $_POST ["recaptcha_response_field"] );
		
		// Captcha Checking
		if (! $captcha_resp->is_valid) {
			$allClear = false;
			$this->_registrationErrors [] = '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>Erreur ! </strong>Vous avez indiqué le mauvais Captcha. Merci de recommencer</div>';
		}
		
		// We look for blank fields.
		$postTmp = $post;
		foreach ( $this->_fields as $field => $name ) {
			if ((! isset ( $post ['register_' . $field] )) || ($post ['register_' . $field] = '')) {
				$allClear = false;
				$this->_registrationErrors [] = '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>Erreur ! </strong>Vous devez entrer un ' . $name . '</div>';
				$post ['register_' . $field] = '';
			}
		}
		$post = $postTmp;
		// Test if passwords match
		/**
          if ($_POST['register_password'] != $_POST['register_password_confirm']) {
          $allClear = false;
          $this->_registrationErrors[] = '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>Erreur ! </strong>Vous devez confirmer votre Mot de passe</div>';
          }
		 * 
		 */
		// Test the password length
		if (strlen ( $post ['register_password'] ) < 5) {
			$allClear = false;
			$this->_registrationErrors [] = '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>Erreur ! </strong>Votre mot de passe est trop court, il doit comporter au moins 6 charactères.</div>';
		}
		// Check for email header injection - Security...
		//TODO : revoir le test de sécu avant la beta.
		if (strpos ( (urldecode ( $post ['register_email'] )), "\r" ) === true || strpos ( (urldecode ( $post ['register_email'] )), "\n" ) === true) {
			$allClear = false;
			$this->_registrationErrors [] = '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>Attention ! </strong>Votre adresse email n\'est pas valide. Caractères non autorisés.</div>';
		}
		// Check if email is valid : email norm + domain
		if (filter_var ( $post ['register_email'], FILTER_VALIDATE_EMAIL )) {
			$domain = explode ( '@', $post ['register_email'] );
			if (! checkdnsrr ( $domain [1] )) {
				$allClear = false;
				$this->_registrationErrors [] = '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>Erreur ! </strong>Votre adresse email n\'est pas valide.</div>';
			}
		}
		// Check if terms are accepted or not
		//TODO : A implémenter plus tard : Durant la Beta ?
		/**
          if (!isset($_POST['register_terms']) || $_POST['register_terms'] != 1) {
          $allClear = false;
          $this->_registrationErrors[] = '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>Erreur ! </strong>Vous devez accepter nos conditions d\'utilisations.</div>';
          }
		 * 
		 */
		//Look for duplicated email
		$database = & Mysqldb::getInstance ();
		$username = filter_var ( $post ['register_username'], FILTER_SANITIZE_STRING ); //$database->sanitizedData($post['register_username']);
		$email = filter_var ( $post ['register_email'], FILTER_SANITIZE_EMAIL ); //$database->sanitizedData($post['register_email']);
		$password = $post ['register_password'];
		$sql = "SELECT * FROM socialac_yac_users WHERE email = '{$email}'";
		$database->yQuery ( $sql );
		
		if ($database->numRows () == 1) {
			$allClear = false;
			$this->_registrationErrors [] = '<div class="alert alert-error"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>Erreur ! </strong>Cette adresse email est déjà utilisée dans le site (Mot de passe oublié ?).</div>';
		}
		
		if ($allClear == true) {
			$this->_sanitizedValues ['username'] = $username;
			$this->_sanitizedValues ['email'] = $email;
			$this->_sanitizedValues ['password'] = md5 ( PRE_HASH . $password . POST_HASH ); //hash("whirlpool", PRE_HASH . $password . POST_HASH)
			$this->_sanitizedValues ['active'] = $this->_activeValue;
			$this->_sanitizedValues ['banned'] = 0;
			
			//$this->_submittedValues['register_email'] = $post['register_email'];
			//$this->_submittedValues['register_password'] = $post['register_password'];
			

			return true;
		} else {
			$this->_submittedValues ['register_username'] = $post ['register_username'];
			$this->_submittedValues ['register_email'] = $post ['register_email'];
			$this->_submittedValues ['register_password'] = $post ['register_password'];
			
			//$auth = Authentication::getInstance();
			//$currentPage = $auth->getPage();
			//$currentPage->setTagsArray($this->_registrationErrors); //It sends errors to the template engine.
			

			foreach ( $this->_registrationErrors as $errors ) {
				echo $errors; // Affiche l'ensemble des erreurs.
			}
			
			return false;
		}
	}
	
	/**
	 * Process the users registration, and create the users profiles.
	 * @return int UID 
	 */
	public function processRegistration() {
		$db = & Mysqldb::getInstance ();
		//insert data
		$db->yInsert ( 'socialac_yac_users', $this->_sanitizedValues );
		// Save ID in Session
		$uid = $db->getLastInsertID ();
		
		return $uid; //TODO : utilisation en Session
	}
	
	/**
	 * Check if the user exists or not
	 * 
	 * @param type $uid
	 * @param type $oauth_provider
	 * @param type $username
	 * @param type $email
	 * @param type $twitter_otoken
	 * @param type $twitter_otoken_secret
	 * @return Array 
	 */
	public function checkUser($uid, $oauth_provider, $username, $email, $twitter_otoken, $twitter_otoken_secret) {
		$view = '';
		
		$database = & Mysqldb::getInstance ();
		$sql = "SELECT * FROM `socialac_yam_account` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'";
		//$query = mysql_query($sql) or die(mysql_Ereur());
		$database->yQuery ( $sql );
		$result = $database->getRows ();
		if (! empty ( $result )) {
			$view = 'index.php'; //Index du dashboard
		} else {
			$view = 'welcome.php'; //Page à afficher lors de la première inscription (Choix de catégories + tuto).
			/**
			 * user not present. Insert a new Record
			 */
			// Créer un nouvel utilisateur et l'ajouter dans socialac_yac_users (juste l'id)
			$database->yQuery ( "INSERT INTO `socialac_yac_users` (username, email, password) VALUES ('$username', $email, '')" );
			$user_id = $database->getLastInsertID ();
			$database->yQuery ( "INSERT INTO `socialac_yam_accounts` (user_id, oauth_uid, oauth_provider, twitter_oauth_token, twitter_oauth_token_secret) VALUES ($user_id,'$uid','$oauth_provider', '$twitter_otoken','$twitter_otoken_secret')" );
			
			//$query = mysql_query("SELECT * FROM `yam_account` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'");
			$database->yQuery ( "SELECT * FROM `socialac_yam_accounts` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'" );
			$result = $database->getRows ();
			return $result;
		}
		return $result;
	}
	
	public function profilAction() {
		//$this->render(); Render Module_PATH/views/profil.php Page.
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