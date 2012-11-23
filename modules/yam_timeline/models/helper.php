<?php

/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

/**
 * Timeline Module
 * ----------------
 * helper Class
 * 
 */

//MySQL DB Instance
// @todo : à mettre dans le fichier model.php
yimport ( 'registry.Mysqldb' );

// Yanis Controller
yimport ( 'controller.Controller' );

yimport ( 'translate.Translate' );

//Load some librairies 
require_once MODULE_FOLDER_PATH . '/yam_timeline/models/lib/google-api.php';

class timelineHelper extends YaC {
	
	/**
	 * @var Object Google Api Client 
	 */
	private $_client;
	
	/**
	 * @var type 
	 */
	private $_service;
	
	public function __construct() {
		$trad->_client = new apiClient ();
		$trad->_client->setDeveloperKey ( 'AIzaSyCZvVdAos1DwzHa1HXThZtA_LMFmTZuB_A' );
		$trad->_client->setApplicationName ( 'Socialac Timeline' );
	}
	
	public static function indexAction() {
		// Load the default.php page
		Yam::loadDefault ( 'timeline' );
	}
	
	/**
	 * Implements the module controllers (actions) :
	 * @param String $_SESSION ['APP_CONTROLLER']
	 * @param Array $params Controller params
	 */
	public static function moduleAction($controller, $params) {
		//print_r($_GET);
		switch ($controller) {
			case 'share' :
				self::share ();
				break;
			
			case 'deals' :
				break;
			
			case 'shopping' :
				self::googleShopping ( $params [0] );
				break;
			
			case 'fav' :
				break;
			
			default :
				self::indexAction ();
				break;
		}
	}
	
	/**
	 * Define a new Google Service
	 * @param String $service
	 * @return Object
	 */
	public function setService($service = '') {
		if (isset ( $service ) && $service != '') {
			$trad->_service = new api () . ucfirst ( $service ) . Service ( $trad->_client );
			
			return this;
		}
	}
	
	public function getService() {
		return $trad->_service;
	}
	
	/**
	 * @param String $query Shopping Query String
	 */
	public static function googleShopping($query = 'Jet li') {
		$api_key = 'AIzaSyCZvVdAos1DwzHa1HXThZtA_LMFmTZuB_A';
		$country = 'FR';
		$q = urlencode ( $query ); //$q = urlencode($post['q']);
		$startIndex = (isset ( $post ['start'] )) ? $post ['start'] : '0';
		$maxResults = 10;
		$uri = 'https://www.googleapis.com/shopping/search/v1/public/products?thumbnails=110:*&key=' . $api_key . '&country=' . $country . '&q=' . $q . '&startIndex=' . $startIndex . '&maxResults=' . $maxResults;
		
		// Appel de l'API Google Shopping
		$contents = file_get_contents ( $uri );
		
		// Decodage Json - Transoformation du résulat en Tableau
		$products = json_decode ( $contents );
		
		if (empty ( $products->totalItems )) {
			exit ( "<div class='alert alert-info'><h3>Oups !</h3><p style='text-size:1.1em;'>La recherche n'a rien donnée. Merci d'affiner vos mots clés.</p></div>" );
		}
		
		// Pagination
		$total = $products->totalItems;
		//$numberPages = ceil($total / $startIndex);
		

		$previous = $products->startIndex - $maxResults;
		$next = $products->startIndex + $maxResults;
		
		$start = $products->startIndex;
		$end = $start + $maxResults;
		
		if ($end > $total) { // Fin de liste ?
			$end = $total;
			$for = $total - $start;
		} else {
			$for = $maxResults;
		}
		
		// Parcours des résultats
		for($i = 0; $i < $for; $i ++) {
			$items = $products->items [$i]->product;
			
			// Informations par items
			$title = $items->title;
			$description = $items->description;
			$link = $items->link;
			$image = $items->images [0]->thumbnails [0]->link;
			$brand = $items->brand;
			$condition = $items->condition;
			$author = $items->author->name;
			$price = $items->inventories [0]->price;
			$currency = $items->inventories [0]->currency;
			
			echo '
                <div id="shopping-content" class="bloc">
                    <div class="photo">
                        <img src="' . $image . '" alt="' . str_replace ( '"', '', $title ) . '" />
                    </div>
                    <div class="item">
                        <h3><a href="' . $link . '" target="_blank">' . $title . ' <em>(' . $brand . ')</em></a></h3>
                        <p>' . $description . '</p>
                    </div>
                    <div class="infos">
                        <div><span class="label label-success">' . number_format ( $price, 2, ',', ' ' ) . $currency . '</span></div>
                        <p class="help-block">Vendu par ' . $author . '
                        (' . $condition . ')</p>
                    </div>
                    <div class="clear"></div>
                </div>';
		}
		
		if ($previous > 0) {
			echo '<div class="previous"><a href="?q=' . $_GET ['q'] . '&amp;start=' . $previous . '">Pr&eacute;c&eacute;dent</a></div>';
		}
		
		if ($next < $total) {
			echo '<div class="next"><a href="?q=' . $_GET ['q'] . '&amp;start=' . $next . '">Suivant</a></div>';
		}
	}
	
	public static function share() {
		// DB object 
		$db = Mysqldb::getInstance ();
		
		// Clean and Format content
		$content = preg_replace ( '/((?:http|https|ftp):\/\/(?:[A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?[^\s\"\']+)/i', '<a href="$1" rel="nofollow" target="blank">$1</a>', $_POST ['share-content'] );
		
		// User infos
		$contentToShare = '<a href="#"><img src="resources/images/modules/user.png" class="item-tips-image" alt="User icon"/></a>';
		$contentToShare .= '<div class=="item-tips-userinfo"  itemscope itemtype="http://data-vocabulary.org/Person"><h4><a href="#" itemprop="url"><span itemprop="name">' . $_SESSION['APP_USER'] ['NAME'] . '</span></a></h4></div>';
		
		// -- Favorites
		$contentToShare .= '<div class="item-tips-tools">';
		$favsTab = '<span class="tools-favs" data-favorite="0" title="Add to favorites"><i class="icon-star"></i></span>';
		$contentToShare .= $favsTab . '</div><div class="clear"></div>';
		// --/ Favorites
		

		$contentToShare .= '<div class="item-tips-content">' . $content . '</div>';
		
		// Datetime
		$datetime = date ( 'd-m-Y H:i:s' );
		
		// Final content - Tips
		$tips = '<div class="item-tips"  itemprop="itemListElement">' . stripslashes ( $contentToShare ) . '<p class="help-block" style="padding-left:50px; margin-top:5px;">' . relativeTime ( $datetime ) . '</p><div class="clear"></div></div>';
		$tips .= '<meta itemprop="itemListOrder" content="Descending" />';
		
		// "is_deal"=>"1" ==> Cache à cocher dans la vue
		$db->yInsert ( "socialac_yac_timeline", array ("tips" => $db->encodeString ( $content ), "is_deal" => "1", "user_id" => $_SESSION['APP_USER'] ['ID'] ) );
		
		// Render content
		echo $tips;
	}
	
	/**
	 * Charge le contenu de la timeline en fonction du type (Astuce, Deal, favoris)
	 * @param String $type Content Type  (Tip, Deal or Fav)
	 */
	public static function loadContents($type = null, $limit = 24) {
		$trad = Yanis_Translate::getInstance ();
		$db = Mysqldb::getInstance ();
		
		switch ($type) {
			case 'fav' :
				$query = "SELECT * FROM  `socialac_yac_timeline` WHERE `favorites`>0 ORDER BY id DESC LIMIT 0 , $limit";
				break;
			
			case 'deals' :
				$query = "SELECT * FROM  `socialac_yac_timeline` WHERE `is_deal`=1 ORDER BY id DESC LIMIT 0 , $limit";
				break;
			
			default :
				$query = "SELECT * FROM  `socialac_yac_timeline` ORDER BY  `socialac_yac_timeline`.`id` DESC LIMIT 0 , $limit";
				break;
		}
		
		$db->yQuery ( $query );
		$datas = $db->getAll ();
		
		if ($datas) {
			$firstTokenID = $datas [0] ['id'];
			print '<meta itemprop="itemListOrder" content="Descending" />';
			foreach ( $datas as $data ) {
				// User infos
				$content = $db->decodeString ( $data ['tips'] );
				$contentToShare = '<a href="#"><img src="resources/images/modules/user.png" class="item-tips-image" alt="User icon"/></a>';
				$contentToShare .= '<div class="item-tips-userinfo"  itemscope itemtype="http://data-vocabulary.org/Person"><h4><a href="#" itemprop="url"><span itemprop="name">' . $_SESSION['APP_USER'] ['NAME'] . '</span></a></h4></div>';
				
				// -- Top Toolbar buttons
				$contentToShare .= '<div class="dropdown item-tips-tools tools-top">
									  <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#">
									    <i title="' . $trad->_ ( "APP_MORE_ACTION" ) . '..." class="icon-tasks"></i>
									  </a>
									  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';
				$topTools = '<li><span>%s</span><i title="%s" class="icon-edit"></i></li>
								   <li><span>%s</span><i title="%s" class="icon-map-marker"></i></li>
								   <li><span>%s</span><i title="%s" class="icon-remove"></i></li></ul>';
				$contentTools = sprintf ( $topTools, $trad->_ ( "APP_ACTION_EDIT" ), $trad->_ ( "APP_ACTION_EDIT_TEXT" ), $trad->_ ( "APP_ACTION_LOCATION" ), $trad->_ ( "APP_ACTION_LOCATION_TEXT" ), $trad->_ ( "APP_ACTION_REMOVE" ), $trad->_ ( "APP_ACTION_REMOVE_TEXT" ) );
				$contentToShare .= $contentTools . '</div><div class="clear"></div>';
				
				// -- Main content
				$contentToShare .= '<div class="item-tips-content">' . $content . '</div>';
				
				// -- Bottom Toolbar buttons
				$bottomTools = '<span class="item-tips-tools">';
				$bottomTools .= '<span class="tools-favs" data-favorite="0">
									<i title="%s" class="icon-star-empty"></i>
									<i title="%s" class="icon-thumbs-up"></i>
									<i title="%s" class="icon-share"></i>
								</span>';
				$bottomTools .= '</span><div class="clear"></div>';
				$contentBTools = sprintf ( $bottomTools, $trad->_ ( "APP_ACTION_ADD_FAV" ), $trad->_ ( "APP_ACTION_LIKE" ), $trad->_ ( "APP_ACTION_SHARE" ) );
				
				// -- Datetime
				$datetime = $data ['dt']; // 2012-08-13 18:01:25
				

				// -- Final content - Tips
				$tips = '<div class="item-tips"  itemprop="itemListElement" data-tip-id="%s">
						 	%s<div class="help-block"><span class="label">%s</span>%s</div><div class="clear"></div>
						 </div>';
				
				// -- Output tip
				printf ( $tips, $data ['id'], stripslashes ( $contentToShare ), relativeTime ( $datetime ), $contentBTools );
			}
			
			$moreBtn = '<p class="btn-more">
							<a class="btn btn-large" data-next-id="%s" data-to-id="" href="#">' . $trad->_ ( "APP_MORE" ) . ' ...</a><!-- Load more data ... -->
                    	</p>';
			printf ( $moreBtn, $data ['id'] - 1 );
		} else {
			//Sinon, c'est le vide intersidéral :)
			print '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#">&times;</a><strong>'.$trad->_ ('APP_SYSTEM_SQL_NORESULT').'</strong></div>';
		}
	}
}

/**
 * Render Relative time
 * 
 * @param date $dt
 * @param int $precision
 * @return String 
 */
function relativeTime($dt, $precision = 2) {
	$trad = Yanis_Translate::getInstance ();
	if (is_string ( $dt ))
		$dt = strtotime ( $dt );
	
	$times = array (365 * 24 * 60 * 60 => $trad->_ ( "SYSTEM_DATE_YEAR" ), 30 * 24 * 60 * 60 => $trad->_ ( "SYSTEM_DATE_MONTH" ), 7 * 24 * 60 * 60 => $trad->_ ( "SYSTEM_DATE_WEEK" ), 24 * 60 * 60 => $trad->_ ( "SYSTEM_DATE_DAY" ), 60 * 60 => $trad->_ ( "SYSTEM_DATE_HOUR" ), 60 => $trad->_ ( "SYSTEM_DATE_MINUTE" ), 1 => $trad->_ ( "SYSTEM_DATE_SECOND" ) );
	
	$passed = time () - $dt;
	
	if ($passed < 5) {
		$output = $trad->_ ( "SYSTEM_DATE_LT_5" );
	} else {
		$output = array ();
		$exit = 0;
		
		foreach ( $times as $period => $name ) {
			if ($exit >= $precision || ($exit > 0 && $period < 60))
				break;
			
			$result = floor ( $passed / $period );
			if ($result > 0) {
				$output [] = $result . ' ' . $name . ($result == 1 ? '' : ($name === $trad->_ ( "SYSTEM_DATE_MONTH" ) ? '' : 's'));
				$passed -= $result * $period;
				$exit ++;
			} else if ($exit > 0)
				$exit ++;
		}
		
		$output = implode ( " " . $trad->_ ( "APP_TEXT_AND" ) . " ", $output );
	}
	
	return $output;
}

?>
