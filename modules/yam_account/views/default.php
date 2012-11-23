<?php
/*
 \* Yanis Framework is Yet ANother Internet Software for web and mobile technologists
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
        <script type="text/javascript">
            var RecaptchaOptions = {
                theme : 'white'
            };
        </script>
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
            <h2 class="alert alert-success">Créez votre compte en moins de 15 secondes !</h2>
            <div class="hero-unit">
                <div>
                    <div class="span4">
                        <h3>Pas encore inscrit ? <small>S'inscrire !</small></h3>
                        <form accept-charset="UTF-8" class="form-horizontal" method="post" action="<?php echo YANIS_ROOT; ?>/account/create">
                            <input type="hidden" name="yam_account_type" value="create"/>
                            <div class="control-group">
                                <input class="span4" type="text" maxlength="45" id="register_username" name="register_username" value="" placeholder="Nom complet" autocomplete="off" required />
                            </div>
                            <div class="control-group">
                                <input class="span4" type="text" id="register_email" name="register_email" value="" placeholder="Adresse e-mail" autocomplete="off" required />
                                <p class="help-block">Un mail de confirmation vous sera envoyé à cette adresse.</p>
                            </div>
                            <div class="control-group">
                                <input class="span4" type="password" minlength="6" id="register_password" name="register_password" value="" placeholder="Mot de passe" autocomplete="off" required />
                                <p class="help-block">Vous devez entrer un mot de passe d'au moins 6 caractères.</p>
                            </div>
                            <div class="control-group">
                            	<div class"span4">
	                                <script type="text/javascript"
	                                        src="http://www.google.com/recaptcha/api/challenge?k=6LcpedESAAAAAK3FAnPaKi-Eohxm4DIzUhdFzXcD">
	                                </script>
	                                <noscript>
		                                <iframe src="http://www.google.com/recaptcha/api/noscript?k=6LcpedESAAAAAK3FAnPaKi-Eohxm4DIzUhdFzXcD"
		                                        height="300" width="500" frameborder="0"></iframe><br>
		                                <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
		                                <input type="hidden" name="recaptcha_response_field" value="manual_challenge" />
	                                </noscript>
                                </div>
                            </div><!--re-Captcha -->
                            <!--<p><a class="btn primary large">Créer un compte &raquo;</a></p>-->
                            <!--<input type="submit" value="S'inscrire">-->
                            <button class="btn btn-large" type="submit">S'inscrire</button>
                        </form>
                    </div><!-- eXtac Subscription -->
                    <div class="span3" id="socialsub">
                        <h3> Ou alors <small> Se connecter avec : </small></h3>
                        <p id="twitterconnect"><a href="<?php echo YANIS_ROOT; ?>/account/login?provider=twitter"><img src="<?php echo YANIS_ROOT; ?>/resources/images/logo_twitter.png" alt="Twitter Connect Logo" width="161" height="30" /></a></p>
                        <p id="facebookconnect"><a href="<?php echo YANIS_ROOT; ?>/account/login?provider=facebook"><img src="<?php echo YANIS_ROOT; ?>/resources/images/logo_facebook.png" alt="Facebook Connect Logo" width="118" height="40" /></a></p>
                        <p id="googleconnect"><a href="<?php echo YANIS_ROOT; ?>#"><img src="<?php echo YANIS_ROOT; ?>/resources/images/logo_google.png" alt="Google Connect Logo" width="117" height="40" /></a></p>
                    </div> <!-- Social Registration -->
                </div><!-- Normal and Social Registration -->
                <div class="clear"></div>
            </div><!-- Formulaire d'inscription -->
            <?php
            $default->loadFooter();
            ?>
        </div>
    </body>
</html>