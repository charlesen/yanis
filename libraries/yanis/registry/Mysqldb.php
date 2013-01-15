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
 * Database Management
 * 
 * Classe Mysqldb
 *
 */
class Mysqldb extends PDO {
	
	/**
	 * Multiple database connections are possible
	 * Each session is stored in a special variable, active one is maintained
	 */
	private $_mysqli;
	
	/**
	 * Tells de Database object which connection to use
	 * setActiveConnection($id) allows us to change this
	 */
	private $_activeConnection = 0;
	
	/**
	 * Queries which have been executed and the results cached for later
	 * Template Engin ? Maybe
	 */
	private $_queryCache = array ();
	
	/**
	 * Data which has been prepared and then cached for later usage
	 * Template Engine ? Maybe
	 */
	private $_dataCache = array ();
	
	/**
	 * Number of queries during execution process
	 */
	private $_queryCounter = 0;
	
	/**
	 * Record of the last query
	 */
	private $_lastQuery;
	
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	private $_DBuser;
	
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	private $_DBhost;
	
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	private $_DBpassword;
	
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	private $_DBname;
	
	/**
	 * @var Object The Registry object 
	 */
	private $_registry;
	
	/**
	 * @var static var
	 */
	private static $_instance;
	
	/**
	 * Construct the Database object
	 * @param Registry $_registry 
	 */
	public function __construct() {
		require_once YANIS_PATH . '/config.php';
		$yconfig = new YConfig ();
		$this->_DBhost = $yconfig->host;
		$this->_DBuser = $yconfig->user;
		$this->_DBpassword = $yconfig->password;
		$this->_DBname = $yconfig->db;
		$this->_registry = new Registry ();
		
		$this->yConnect ();
	}
	
	/**
	 * Create a new database connection
	 * @param String database hostname
	 * @param String database username
	 * @param String password
	 * @param String database the current database
	 * @return int the id of the new connection
	 */
	public function yConnect() {
		$this->_mysqli = new mysqli ( $this->_DBhost, $this->_DBuser, $this->_DBpassword, $this->_DBname );
		//$connection_id = count($this->_mysqli) - 1;
		if (mysqli_connect_errno ()) {
			trigger_error ( 'Oups! Error connecting to host. ' . $this->_mysqli->error, E_USER_ERROR );
		}
	}
	
	/**
	 * Setup Redbean ORM
	 */
	public function redBean() {
		//require_once YANIS_PATH . '/libraries/redbean/rb.php';
	//R::setup ( 'mysql:host=' . $this->_DBhost . '; dbname=' . $this->_DBname, $this->_DBuser, $this->_DBpassword );
	}
	
	/**
	 *
	 * @param int the new connection id
	 */
	public function setActiveConnection(int $new) {
		$this->_activeConnection = $new;
	}
	
	/**
	 * Execute a query string
	 * @param String the query
	 * @return void
	 */
	public function yQuery($query) {
		if (! $result = $this->_mysqli->query ( $query )) {
			trigger_error ( "Erreur dans l'execution de la requete suivante : " . $query . ' - ' . $this->_mysqli->error, E_USER_ERROR );
		} else {
			$this->_lastQuery = $result;
		}
	}
	
	/**
	 * Get row from single query
	 * @return array
	 */
	public function getRows() {
		return $this->_lastQuery->fetch_array ( MYSQLI_ASSOC );
	}
	
	/**
	 * Get all rows from query
	 * @return Array of arrays
	 */
	public function getAll() {
		while ( $result [] = $this->_lastQuery->fetch_array ( MYSQLI_ASSOC ) ) {
			$result [] = $this->_lastQuery->fetch_array ( MYSQLI_ASSOC );
		}
		array_pop ( $result ); // Last element is empty, so unusable.
		return $result;
	}
	
	/**
	 * Get the last insert ID
	 * @return Int the last ID generated in DB. 
	 */
	public function getLastInsertID() {
		return $this->_mysqli->insert_id;
	}
	
	/**
	 * Number of rows
	 */
	public function numRows() {
		return $this->_lastQuery->num_rows;
	}
	
	/**
	 * Gets the number of affected rows from the previous query
	 * @return int the number of affected rows
	 */
	public function affectedRows() {
		return $this->_lastQuery->affected_rows;
	}
	
	/**
	 * Delete records from the database
	 * @param String the table to remove rows from
	 * @param String the condition for which rows are to be removed
	 * @param int the number of rows to be removed
	 * @return void
	 */
	public function yDelete($table, $condition, $limit) {
		$limit = ($limit == '') ? '' : 'LIMIT ' . $limit;
		$delete = "DELETE FROM {$table} WHERE {$condition} {$limit}";
		$this->yQuery ( $delete );
	}
	
	/**
	 * Update records in the database
	 * @param String the table
	 * @param array of changes
	 * @param String the condition
	 * @return bool
	 */
	public function yUpdate($table, $changes, $condition) {
		$update = "UPDATE " . $table . " SET ";
		foreach ( $changes as $field => $value ) {
			$update .= "`" . $field . "`='{$value}',";
		}
		//Remove the last char
		$update = substr ( $update, 0, - 1 );
		if ($condition != '') {
			$update .= " WHERE " . $condition;
		}
		$this->yQuery ( $update );
		
		return true;
	}
	
	/**
	 * Insert records into the database
	 * @param String the table name
	 * @param array Array of data to insert. Keys represent fields, and values represent the values
	 * @return bool
	 */
	public function yInsert($table, $data, $conditions = '') {
		$fields = "";
		$values = "";
		
		foreach ( $data as $key => $value ) {
			$fields .= "`$key`,";
			$values .= (is_numeric ( $value ) && (intval ( $value ) == $value)) ? $value . "," : "'$value',";
		}
		//Remove the last char
		$fields = substr ( $fields, 0, - 1 );
		$values = substr ( $values, 0, - 1 );
		
		$insert = "INSERT INTO $table ({$fields}) VALUES ({$values})";
		
		if ($conditions != '') {
			$insert .= " WHERE " . $conditions;
		}
		$this->yQuery ( $insert );
		
		return true;
	}
	
	/**
	 * Sanitize data
	 * @param String the data to be sanitized
	 * @return String the sanitized data
	 */
	public function sanitizedData($value) {
		//Stripslashes
		if (get_magic_quotes_gpc ()) {
			$value = stripslashes ( $value );
		}
		//Quote value
		if (version_compare ( phpversion (), "4.3.0" ) == "-1") {
			$value = $this->_mysqli->escape_string ( $value );
		} else {
			$value = $this->_mysqli->real_escape_string ( $value );
		}
		
		return $value;
	}
	
	/**
	 * Convert all applicable characters to HTML entities and convert both double and single quotes
	 * @param String $stringData
	 * @return String encoded data
	 */
	public function encodeString($stringData) {
		return htmlentities ( $this->sanitizedData ( $stringData ), ENT_QUOTES, 'UTF-8' );
	}
	
	/**
	 * Decode html entities
	 * @param String $stringData
	 * @return String decoded data
	 */
	public function decodeString($stringData) {
		return html_entity_decode ( $stringData, ENT_QUOTES, 'UTF-8' );
	}
	
	/**
	 * Retourne l'instance de la base courante
	 * Return the current database's instance
	 *
	 * @return Mysqldb
	 */
	public static function &getInstance() {
		$className = __CLASS__;
		if (isset ( self::$_instance ) === false) {
			self::$_instance = new $className ();
		}
		return self::$_instance;
	}
	
	/**
	 * Distroy the object
	 * Close database connection
	 */
	public function __destruct() {
		$this->_mysqli->close ();
	}

}

?>