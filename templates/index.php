<?php
/*
 \* Yanis Framework is Yet ANother Internet Software for web and mobile technologists
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
	<!--  <base href="http://dev.charlesen.fr/socialac/" />-->
        <?php
        $document->getPage()->loadHeader();
        ?>
    </head>
    <?php flush(); ?>
    <body itemscope itemtype="http://schema.org/WebPage">
        <div id="component">
            <p class="system-alert"></p>
        </div><!-- System messages -->
        <?php
        $document->getPage()->loadBody('index', 'brandpage');//TODO : rajouter le requestedPage
        $document->getPage()->loadFooter();
        ?>
    </body> 
</html>