<?php
	yimport('translate.Translate');
	$trad = new Yanis_Translate(); 
?>
<script type="text/javascript">
    var RecaptchaOptions = {
        theme : 'white'
    };
</script>
<div id="brandpage">
    <div class="navbar navbar-fixed-top" id="navbar">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="#">Socialac</a>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li class="active"><a href="<?php echo YANIS_ROOT; ?>"><?= $trad->_("APP_MENU_HOME") ?></a></li>
                        <li><a href="start"><?= $trad->_("APP_MENU_START") ?></a></li>
                    </ul>
                </div>
                <ul class="nav pull-right" id="module-connexion">
                    <li class="dropdown" id="dd2">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <em><?= $trad->_("APP_ACCOUNT_REGISTERED") ?> ?</em>
                            <strong><?= $trad->_("APP_ACCOUNT_LOGIN") ?></strong>
                            <b class="caret"></b>
                        </a>
                        <div id="yam-connexion" class="dropdown-menu">
                            <form method="post" id="signin" action="account/login">
                                <input type="hidden" name="yam_account_type" value="login"/>
                                <input class="input-large" type="email" id="login_email" name="register_email" placeholder="<?= $trad->_("APP_ACCOUNT_EMAIL") ?>" required>
                                <input class="input-large" type="password" id="login_password" name="register_password" placeholder="<?= $trad->_("APP_ACCOUNT_PWD") ?>" data-validation-required-message="Le mot de passe doit faire au moins 6 caractères" required>
                                <p class="remember">
                                    <button class="btn small" type="submit"><?= $trad->_("APP_ACCOUNT_LOGIN") ?></button>
                                    <input id="remember_me" name="remember_me" value="1" tabindex="7" type="checkbox">
                                    <span><?= $trad->_("APP_ACCOUNT_REMEMBER_ME") ?></span>
                                </p>
                                <p class="forgot"> <a href="#"><?= $trad->_("APP_ACCOUNT_FORGET_PWD") ?> ?</a> </p>
                                <!--<p class="forgot-username"> <a title="Oubli..." href="#">Forgot your username?</a> </p>-->
                            </form>
                        </div>
                    </li>
                </ul>
                <div id="version"><span class="label label-info">Alpha 2.0</span></div>
            </div>
        </div>
    </div> <!-- navbar -->

    <div class="container">
        <!-- Such a marketing message :) -->
        <div class="hero-unit">
            <div id="brandtext">
                <h1><?= $trad->_("APP_SLOGAN") ?>.</h1>
                <!--<h1>La compta sociale ! Apprendre au travers des difficultés.</h1>-->
                <br />
                <img src="<?php echo YANIS_ROOT ?>/resources/images/socialac-brandpage.png" alt="SocialAc - Un réseau vraiment social"/>
                <!--<p class="alert alert-info well muted">...parce qu'en ces temps de <strong>crise</strong>, le soutien <strong>affectif</strong> des <strong>autres</strong> est plus que nécessaire...</p>-->

                <p class="no-see">
                    Vos <span>Dépenses</span> à répétition font depuis des années le bonheur des <span>Banques</span> et le malheur de votre compte bancaire. Apprenez à mieux gérer votre argent
                    ou celui de votre foyer à l'aide d'un outil d'<span>Analyse Prédictive</span>, qui vous prodiguera de précieux conseils en ces temps de crise.
                    Devenez votre propre <span>eXpert Comptable</span>.
                </p>
            </div><!-- eXtac Description -->
            <div>
                <div class="span4">
                    <h3><?= $trad->_("APP_ACCOUNT_NOT_REGISTERED") ?> ? <small><?= $trad->_("APP_ACCOUNT_REGISTER") ?> !</small></h3>
                    <form class="form-horizontal" method="post" action="account/create">
                        <input type="hidden" name="yam_account_type" value="create"/>
                        <div class="control-group">
                            <input class="span4" type="text" maxlength="45" id="register_username" name="register_username" value="" placeholder="<?= $trad->_("APP_ACCOUNT_NAME") ?>" autocomplete="off"  autofocus>
                        </div>
                        <div class="control-group">
                            <input class="span4" type="email" id="register_email" name="register_email" value="" placeholder="<?= $trad->_("APP_ACCOUNT_EMAIL") ?>" autocomplete="off" required>
                        </div>
                        <div class="control-group">
                            <input class="span4" type="password" id="register_password" name="register_password" value="" placeholder="<?= $trad->_("APP_ACCOUNT_PWD") ?>" autocomplete="off" required>
                            <span class="help-block"><?= $trad->_("APP_ACCOUNT_PWD_NOTE") ?>.</span>
                        </div>
                        <div class="control-group">
                            <script type="text/javascript"
                                    src="http://www.google.com/recaptcha/api/challenge?k=6LcpedESAAAAAK3FAnPaKi-Eohxm4DIzUhdFzXcD">
                            </script>
                            <noscript>
                            <iframe src="http://www.google.com/recaptcha/api/noscript?k=6LcpedESAAAAAK3FAnPaKi-Eohxm4DIzUhdFzXcD"
                                    height="300" width="500" frameborder="0"></iframe><br>
                            <textarea name="recaptcha_challenge_field" rows="3" cols="40">
                            </textarea>
                            <input type="hidden" name="recaptcha_response_field"
                                   value="manual_challenge">
                            </noscript>
                        </div><!--re-Captcha -->
                        <button class="btn btn-info btn-large" type="submit"><?= $trad->_("APP_ACCOUNT_REGISTER") ?></button>
                    </form>
                </div><!-- eXtac Subscription -->
                <div class="span3" id="socialsub">
                    <h3> <?= $trad->_("APP_TEXT_OR") ?> <small> <?= $trad->_("APP_ACCOUNT_CONNECTWITH") ?> : </small></h3>
                    <p><a class="not-yet-done" href="account/login?provider=twitter"><img src="resources/images/logo_twitter.png" alt="Twitter Connect Logo" width="161" height="30" /></a></p>
                    <p><a class="not-yet-done" href="account/login?provider=facebook"><img src="resources/images/logo_facebook.png" alt="Facebook Connect Logo" width="118" height="40" /></a></p>
                    <p><a class="not-yet-done" href="#"><img src="resources/images/logo_google.png" alt="Google Connect Logo" width="117" height="40" /></a></p>
                </div> <!-- Social Registration -->
                <div class="clear"></div>
            </div><!-- Registration -->
        </div> <!-- Hero Banner -->
        
        <div class="row-fluid well" id="about">
            <div class="wrapper">
	        	<div class="span4">
	                <h2><?= $trad->_("APP_FIND") ?> </h2>
	                <p><img class="img-rounded" alt="<?= $trad->_("APP_FIND_TITLE") ?>" src="<?php echo YANIS_ROOT?>/resources/images/icons/search.png" /></p>
	                <p><a class="btn" href="#"><?= $trad->_("APP_MORE_DETAILS") ?> &raquo;</a></p>
	            </div>
	            <div class="span4">
	                <h2><?= $trad->_("APP_SHARE") ?></h2>
	                <p><img class="img-rounded" alt="<?= $trad->_("APP_SHARE_TITLE") ?>" src="<?php echo YANIS_ROOT?>/resources/images/icons/share.png" /></p>
	                <p><a class="btn" href="#"><?= $trad->_("APP_MORE_DETAILS") ?> &raquo;</a></p>
	            </div>
	            <div class="span4">
	                <h2><?= $trad->_("APP_USE") ?></h2>
	                <p><img class="img-rounded" alt="<?= $trad->_("APP_USE_TITLE") ?>" src="<?php echo YANIS_ROOT?>/resources/images/icons/deals.png" /></p>
		                <p><a class="btn" href="#"><?= $trad->_("APP_MORE_DETAILS") ?> &raquo;</a></p>
		        </div>
            </div><!-- wrapper-->
        </div> <!-- About -->
        <?php include_once TEMPLATE_BASE . '/views/footer.php'; ?><!-- Footer + JS -->
    </div> <!-- /container -->
</div><!--/Brandpage -->