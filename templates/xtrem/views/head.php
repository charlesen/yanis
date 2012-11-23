<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

// no direct access
defined('YANIS_EXEC') or die('Restricted access');
yimport('translate.Translate');
$trad = new Yanis_Translate();
?>
	<title>Socialac | <?= $trad->_("APP_SLOGAN2") ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="<?= $trad->_("APP_SLOGAN2") ?>">
        <meta name="application-name" content="Socialac">
        <meta name="keywords" content="réseau, social, partage, utile, sharing, share, social, network, useful">
        <meta name="author" content="Socialac, Mobile-tuts, Charles EDOU NZE">
        <meta name="generator" content="Yanis Framework">
        <meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        
        <!-- Microsoft Pin tags -->
        <meta name="application-name" content="Socialac | <?= $trad->_("APP_SLOGAN") ?>" />
        <meta name="msapplication-tooltip" content="<?= $trad->_("APP_SLOGAN2") ?>" />
        <meta name="msapplication-starturl" content="/" />
        <meta name="msapplication-task" content="name=Socialac on Twitter;action-uri=http://twitter.com/social_ac;icon-uri=http://twitter.com/favicon.ico" />
        <meta name="msapplication-task" content="name=Socialac on Facebook;action-uri=http://www.facebook.com/pages/Socialac/;icon-uri=https://s-static.ak.facebook.com/rsrc.php/yi/r/q9U99v3_saj.ico" />
        
        <meta property="og:title" content="Socialac | <?= $trad->_("APP_SLOGAN2") ?>"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="http://socialac.com/"/>
        <meta property="og:image" content="http://socialac.com/resources/images/logo.png"/>
        <meta property="og:site_name" content="Socialac"/>
        <meta property="og:description" content="Meet a social and accountable network. Find or Share tips with the commmunity."/>
	    <!-- <meta property="fb:admins" content="624919723" /> -->
        
        <!-- HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href="<?php echo YANIS_ROOT ?>/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo YANIS_ROOT ?>/resources/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="<?php echo YANIS_ROOT ?>/resources/css/xtrem.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 60px; 
            }
        </style> 
        <!-- fav and touch icons -->
        <link rel="shortcut icon" href="<?php echo YANIS_ROOT ?>/resources/favicon.ico">
        <link rel="apple-touch-icon" href="<?php echo YANIS_ROOT ?>/resources/images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo YANIS_ROOT ?>/resources/images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo YANIS_ROOT ?>/resources/images/apple-touch-icon-114x114.png">
        
        <link rel="search" type="application/opensearchdescription+xml" href="<?php echo YANIS_ROOT ?>/opensearch.xml" title="Socialac Content Search" />
        <link rel="canonical" href="<?php echo $_SERVER['SCRIPT_URI']?>" />
        
        <script src="<?php echo YANIS_ROOT ?>/resources/js/libs/jquery.min.js"></script>
		<script src="<?php echo YANIS_ROOT ?>/resources/js/libs/jquery.placeholder.min.js"></script>
		<script>
		   $(function() {
			$('input, textarea').placeholder();
		   });
		</script>