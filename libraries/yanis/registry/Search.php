<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

// no direct access
defined ( 'YANIS_EXEC' ) or die ( 'Restricted access' );

require_once 'Zend/Search/Lucene.php';

/** Class Search 
 * @author Charles E. NZE
 */
class Search extends Zend_Search_Lucene_Document {
	/**
	 * Where to save index
	 * @var String
	 */
	private $_indexPath;
	
	function __construct($document) {
		$this->addField ( Zend_Search_Lucene_Field::Keyword ( 'document_id', $document->id ) );
		$this->addField ( Zend_Search_Lucene_Field::UnIndexed ( 'url', $document->url ) );
		$this->addField ( Zend_Search_Lucene_Field::UnIndexed ( 'created', $document->created ) );
		$this->addField ( Zend_Search_Lucene_Field::UnIndexed ( 'teaser', $document->teaser ) );
		$this->addField ( Zend_Search_Lucene_Field::Text ( 'title', $document->title ) );
		$this->addField ( Zend_Search_Lucene_Field::Text ( 'author', $document->author ) );
		$this->addField ( Zend_Search_Lucene_Field::UnStored ( 'content', $document->body ) );
	}
	
	/**
	 * 
	 */
	function __destruct() {
	
		//TODO - Insert your code here
	}
}
/**
 * Building full index
 * 
require_once ('Zend/Search/Lucene.php');
require_once ('Search.php');

// where to save our index
$indexPath = '/var/www/mypath/data/docindex';

// fictional function used to retrieve data from the database
$documents = GetAllDocuments ();

// create our index
$index = Zend_Search_Lucene::create ( $indexPath );

foreach ( $documents as $document ) {
	$index->addDocument ( new PhpRiotIndexedDocument ( $document ) );
}

// write the index to disk
$index->commit ();

 **/
?>