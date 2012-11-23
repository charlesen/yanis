<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

// no direct access
defined('YANIS_EXEC') or die('Restricted access');

yimport('registry.Template');
$document = & Template::getInstance();
?>
<!DOCTYPE html>
<html version="HTML+RDFa 1.1" lang="fr">
    <head>
        <?php
        $document->getPage()->loadHeader();
        ?>
        <link rel="apple-touch-startup-image" href="<?php echo YANIS_ROOT ?>/resources/images/startup.png">
    </head>
    <?php flush(); ?>
    <body itemscope itemtype="http://schema.org/WebPage">
        <div id="component">
            <p class="system-alert"></p>
        </div><!-- System messages -->
        <?php
        $document->getPage()->loadBody('home', 'brandpage');//TODO : rajouter le requestedPage
        ?>
        <footer>
			<p>&copy; <strong>Socialac</strong> 2012 .Tous droits réservés.<span class="no-see"><a href="http://mobile-tuts.com" title="We Mobilize things !">Mobile-tuts!</a>.</span>	</p>
		</footer>
    </body> 
</html>