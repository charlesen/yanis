<?php
/*
 \* Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */
?>
<!doctype html>
<html lang="fr">
    <head>
        <title>Erreur 404 - Fichier introuvable</title>
        <meta charset="utf-8">
        <link href="http://dev.charlesen.fr/socialac/resources/css/xtrem.css" rel="stylesheet">
        <style type="text/css">
            body {
                width: 50%;
                margin:0px auto;
                font-family: Georgia, "DejaVu Serif", Norasi, serif;
            }
            p {
                font-size:1.1em;
                line-height: 1.5em;
            }
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
    	<h1 class="brand">Socialac</h1>
        <div>
            <h2>Erreur 500</h2>
            <hr />
            <p>
                Oups! une erreur est survenue au niveau du Serveur web.
                Mais le problème sera surement vite résolu.<br />.
            </p>
            <p>
                Si, cependant, les difficultés venaient à persister, merci de contacter l'administrateur du site.<br />
                <span>#500 <br />Erreur du Serveur web</span>
                <br /><br />
                <a href="<?php echo YANIS_ROOT; ?>" title="Retour à l'accueil">Retour à l'accueil</a>
            </p>
        </div>
    </body>
</html>