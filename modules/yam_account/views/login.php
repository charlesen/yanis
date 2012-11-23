<?php

/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */
// no direct access
defined ( 'YANIS_EXEC' ) or die ( 'Restricted access' );

yimport('registry.Page');
$default = & Page::getInstance();
?>
<!doctype html>
<html lang="fr">
    <head>
        <?php $default->loadHeader() ?>
    </head>
    <body>
        <div class="navbar navbar-fixed-top" id="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="<?php echo YANIS_ROOT; ?>">Socialac</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li><a href="<?php echo YANIS_ROOT; ?>">Accueil</a></li>
                            <li><a href="#about">A propos de Socialac</a></li>
                        </ul>
                    </div>
                    <div id="version"><span class="label label-info">Alpha 2.0</span></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="hero-unit well">
                    <div class="span4">
                        <h3>Se connecter</h3>
                         <form accept-charset="UTF-8" method="post" id="signin" action="login">
                                <input type="hidden" name="yam_account_type" value="login"/>
                                <input class="span3" type="email" id="login_email" name="register_email" placeholder="Adresse e-mail" data-validation-required-message="Entrez un e-mail valide." required>
                                <input class="span3" type="password" id="login_password" name="register_password" placeholder="Mot de passe" data-validation-required-message="Le mot de passe doit faire au moins 6 caractères" required>
                                <!--  <p class="remember"> -->
                                <label class="checkbox">
						        	<input type="checkbox" id="remember_me" name="remember_me" value="1" tabindex="7">Se souvenir de moi
						        </label>
						        <button class="btn small" type="submit">Se connecter</button>
                                <!-- </p> -->
                                <p class="forgot"> <a href="#">Mot de passe oublié?</a> </p>
                            </form>
                    </div><!-- Authentication -->                    
                <div class="clear"></div>
            </div><!-- Formulaire de connexion -->
            <?php
            	$default->loadFooter();
            ?>
        </div>
    </body>
</html>