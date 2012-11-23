<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="fr"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="fr"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <base href="<?php echo YANIS_BASENAME; ?>" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>WeMobz, we mobilize things</title>
        <meta name="description" content="Société experte en développement d'applications mobiles">
        <meta name="author" content="WeMobz">
        <meta name="viewport" content="width=device-width,initial-scale=1">

        <link rel="stylesheet" href="css/boilerplate.css">
        <link rel="stylesheet" href="css/base.css">

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/script_img.js"></script>

        <script src="js/libs/modernizr-2.0.min.js"></script>
        <script src="js/libs/respond.min.js"></script>
        <script src="http://widgets.twimg.com/j/2/widget.js"></script>
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
                <div id="banniere">                 
                    <image id="lien_logo" src="images/logo.png"/>
                    <image id="separator" src="images/logo_separator.gif"/>
                    <image id="bullet_point" src="images/bullet_point.png"/>
                    <h1>BUILD YOUR APP</h1> 
                </div>


                <nav>
                    <a id="home_button" href=""><image src="images/btn_home.jpg"/></a>

                    <a class="link" href="#" title="agence">L'Agence</a><image class="menu_separator" src="images/menu_separator.gif"/>  
                    <a class="link" href="#" title="services">Nos services</a><image class="menu_separator" src="images/menu_separator.gif"/>  
                    <a class="link" href="#" title="innovation">Notre innovation</a>  <image class="menu_separator" src="images/menu_separator.gif"/>
                    <a class="link" href="#" title="clients">Nos clients</a><image class="menu_separator" src="images/menu_separator.gif"/>  
                    <a class="link" href="#" title="contacts">Contactez-nous</a>  

                </nav>

            </header><!-- #Container - Entete : Titre, Menu-->


            <div id="main">

                <div id="applications">

                    <div id="carrousel">
                        <div id="slide1" class="slides" style="display:block;">
                            <div class="visu">
                                <img src="images/img_cai_home.jpg"/>  
                            </div>
                            <div class="titre">
                                titre1
                            </div>
                        </div>
                        <div id="slide2" class="slides" style="display:block;">
                            <div class="visu">
                                <img src="images/img_cai_marque.jpg"/>  
                            </div>
                            <div class="titre">
                                titre2
                            </div>
                        </div>
                    </div>

                    <!--<div id="left">
                        <a href=""><image src="images/arrow_left.png"/></a>
                    </div>
                    <div id="appli">
                        <image class="image_appli" src="images/img_mobile.png"/>
                        <image class="separator_appli" src="images/shade_separator_screen_central.png"/>  
                    </div>
                    <div id="right">
                        <a href=""><image src="images/arrow_right.png"/></a>
                    </div>-->
                </div>


                <div id="news">

                    <h1>News</h1>
                    <script>
                        new TWTR.Widget({
                            version: 2,
                            type: 'profile',
                            rpp: 4,
                            interval: 30000,
                            width: 250,
                            height: 195,
                            theme: {
                                shell: {
                                    background: '#f0f0f0',
                                    color: '#f0f0f0'
                                },
                                tweets: {
                                    background: '#f0f0f0',
                                    color: '#000000',
                                    links: '#4e9410'
                                }
                            },
                            features: {
                                scrollbar: false,
                                loop: false,
                                live: true,
                                behavior: 'default'
                            }
                        }).render().setUser('charlesen7').start();
                    </script>
                </div>

                <div id="contacts">
                    <h1>Suivez nous</h1><br/>
                    <img src="images/separator_content_news.gif"/>
                    <p>
                        Recevez votre newsletter
                    </p>
                    <input type="text" name="newsletter" /><br/><br/>
                    <h1>Clients</h1><br/>
                    <img src="images/separator_content_news.gif"/>
                </div>


            </div>

            <!-- #Main - Corps du site-->

            <footer>
                <a class="credit" href="">Crédit</a>
                <a class="mention_legal" href="">Mentions légales</a>
                <p>Wemobz SIRET : 37847849589</p>
            </footer> <!-- #Footer - Pied de page -->
        </div> <!--! end of #container -->
        <!-- Et ça fini ici -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>
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