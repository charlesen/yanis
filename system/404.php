<?php
/*
 \* Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

//TODO: Changer le template de la page d'erreur--> utilise la page boostrap Hero

?>
<!doctype html>
<html lang="fr">
    <head>
        <title>Socialac | 404 Fichier introuvable</title>
        <meta charset="utf-8">
        <link rel="shortcut icon" href="<?php echo YANIS_ROOT ?>/resources/favicon.ico">
        <link href="<?php echo YANIS_ROOT ?>/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo YANIS_ROOT ?>/resources/css/xtrem.css" rel="stylesheet">
        <style type="text/css">
            body {
                width: 50%;
                margin:0px auto;
                font-family: Georgia, "DejaVu Serif", Norasi, serif;
            }
            p {
            	text-align:justify;
                font-size:1.1em;
                line-height: 1.5em;
            }
			small{font-size:85%;}
            span {
                color:#f16529;
                font-style: italic;
                font-weight: bolder;
                font-size: 1.3em;
            }
            a {
                text-decoration: none;
            }
            a:hover {border-bottom: 2px solid #aaa;}
        </style>
    </head>
    <body>
    	<h1 class="brand">Socialac <small> | Le réseau du partage utile</small></h1>
        <div class="hero-unit">
            <h2>Erreur 404</h2>
            <hr />
            <p>
                La page <strong><?php echo $_SERVER['REQUEST_URI']; ?></strong> ne peut être affichée.
            </p>
            <p>
                Si les difficultés persistent, merci de contacter l'administrateur de ce site.<br />
                <span>#404 <br />Page non trouvée :( </span>
                <br /><br />
                <a href="<?php echo YANIS_ROOT; ?>" title="Retour à l'accueil">Retour à l'accueil</a>
            </p>
        </div>
        <footer>
				<p>&copy; <strong>Socialac</strong> 2012 .Tous droits réservés.<span class="no-see"><a href="http://mobile-tuts.com" title="We Mobilize things !">Mobile-tuts!</a>.</span>	</p>
		</footer>
    </body>
</html>