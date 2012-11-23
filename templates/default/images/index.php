<?php
/*
 * Yanis Framework, Yet ANother Internet Service for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="fr"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="fr"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <title>Default Yanis Framework page</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <link rel="stylesheet" href="css/style.css">

        <script src="js/libs/modernizr-2.0.min.js"></script>
        <script src="js/libs/respond.min.js"></script>
    </head>
    <body>
        <!-- 
        Corps de la page...C'est ici que vous allez surtout bosser les gars
        Touchez pas à ce qui en dessous (les scripts javascript) :), ni aux fichiers js qui sont dans l'entete...
        vous pouvez voir que j'importe bien jQuery (voir ci-dessous), donc pas besoin d'en mettre
        dans l'entete
        
        ** ch@rlesen **
        -->
        <!-- Ca commence à peu près ici pour vous (Loic & Siwei)-->
        <div id="container">
            <header>

            </header><!-- #Container - Entete : Titre, Menu-->

            <div id="main">

            </div><!-- #Main - Corps du site-->

            <footer>

            </footer> <!-- #Footer - Pied de page -->
        </div> <!--! end of #container -->
        <!-- Et ça fini ici -->
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>

        <script src="js/script.js"></script>
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']]; // Change UA-XXXXX-X to be your site's ID
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
                g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
                s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>

        <!--[if lt IE 7 ]>
                <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
                <script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
        <![endif]-->

    </body>
</html>