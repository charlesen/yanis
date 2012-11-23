<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */
yimport('registry.Page');
yimport('registry.Email');
yimport('translate.Translate');
$trad = new Yanis_Translate();
//yimport('registry.Authentication');
//Page Object
$default = & Page::getInstance();
// message
$message = '
            <html lang="fr">
            <head>
	<base href="http://dev.charlesen.fr/socialac/" />
                <title>Socialac - Subscription</title>
            </head>
            <body style="margin-bottom:7px;padding-top:10px;border:0px;border-radius:3px;">
                <h1 style="">Socialac <span style="position:relative;top:-0.3em;left:1em;;font-size:13px;background:#468847; color:#fff; border-radius:3px;padding:5px;">Alpha 1.0</span></h1>
                <h3 style="color:#bbb;">Partager des expériences, échanger des idées.</h3>
                <div style="border-radius:3px;background:#eee; padding:10px;color:#333;font-family:Helvetica,Arial,sans-serif;font-size:14px">
                    <h3> Bienvenue ' . $_SESSION['APP_USER_NAME'] . ' ! </h3>
                    <p>Vous venez de vous inscrire avec succès et nous sommes heureux de vous compter parmi nos utilisateurs !</p>
                    <p>Voici un rappel des informations que vous as renseignées. Vous en aurez besoin pour vous connecter.</p>
                    <ul>
                        <li><b>Email :</b> ' . $_SESSION['APP_USER_EMAIL'] . '</li>
                        <li><b>Mot de passe :</b> (vous êtes le seul à le connaitre)</li>
                    </ul>
                    <br />
                    <p>Connectez-vous sans plus tarder et découvrez des astuces et bons plans sur <a href="http://socialac.com">Socialac.com</a></p>
                <div>
                <hr />
                <footer style="background:#ddd;padding-top:5px;">
                    <p>&copy; <strong>Socialac</strong> 2012 - Share experiences, exchange ideas.</p>
                </footer>
            </body>
            </html>
            ';
// Entete HTML
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "From: Socialac <postmaster@socialac.com>  \n";
// Prepare email
$email = new Email();
$email->setTo($_SESSION['APP_USER_EMAIL']);
$email->setHeader($headers);
$email->setMessage($message);
// Send Email Confirmation
$email->sendMail();
?>

<!doctype html>
<html lang="fr">
    <head>
	<base href="http://dev.charlesen.fr/socialac/" />
        <?php $default->loadHeader() ?>
        <link href="/socialac/resources/css/welcome.css" rel="stylesheet">
        <script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
        <style>
            #wizard {
                border:none;
                height:40em;
                width:77%;
                margin:auto;
            }
            #wizard .page {width:71.2em;}
            #wizard #status {background-color: #333}
            #status li.active {
                background-color: #468847
            }
            .items .page #fourmi {float:right;}
            .items .page #cigale, .items .page #fourmi {margin-top:2em;}
            #fleche {position: absolute; top:13em;left:32.75em;}
            [class*="span"]	{margin-left:0px;}
            #welcome-form {margin-top: 3em;}
            footer {text-align: center; margin-top:1em;}
        </style>

    </head>

    <body>
        <div class="navbar navbar-fixed-top" id="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="#">Socialac</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li><a href="<?php echo YANIS_ROOT; ?>"><?= $trad->_("APP_MENU_HOME") ?></a></li>
                            <li><a href="#about"><?= $trad->_("APP_MENU_START") ?></a></li>
                        </ul>
                    </div>
                    <div id="version"><span class="label label-success">Alpha 2.0</span></div>
                </div>
            </div>
        </div>
        <!-- twitter style notification bar for validation errors -->
        <div id="drawer"><strong>Erreur de saisie !</strong> Vous avez certainement omis des détails.</div>
        <!-- the form -->
        <form id="welcome-form" class="form-horizontal" action="<?php echo YANIS_ROOT; ?>/account/welcome" method="post">

            <div id="wizard">

                <ul id="status">
                    <li class="active"><strong>1.</strong> <?= $trad->_("APP_WELCOME_PERSONALITY") ?></li>
                    <li><strong>2.</strong> <?= $trad->_("APP_WELCOME_INTEREST") ?> </li>
                    <li><strong>3.</strong> <?= $trad->_("APP_WELCOME_FINISH") ?> </li>
                </ul>

                <div class="items">

                    <div class="page hero-unit">
                        <ul>
                            <h2>
                                <strong>&Eacute;tape 1: </strong> Vous êtes plutôt <strong>Cigale</strong> ou <strong>Fourmi</strong> ?
                            </h2>
                            <li id="about" class="row-fluid">
                                <div class="span4 persontype" id="cigale">
                                    <button class="btn"><img src="resources/images/cigale.png" />Cigale</button>
                                </div>
                                <div id="fleche">
                                    <img src="resources/images/fleche.png" />
                                </div>
                                <div class="span4 persontype" id="fourmi">
                                    <button class="btn"><img src="resources/images/fourmi.png" />Fourmi</button>
                                </div>
                                <input type="hidden" name="personality" id="personality" value="" /><!-- Insérer la personalité à l'intérieur-->
                                <div class="clear"></div>
                            </li>
                            <li>
                                <button type="button" class="btn btn-large next right"><?= $trad->_("APP_WELCOME_NEXT") ?> &raquo;</button>
                            </li>
                        </ul>

                    </div><!-- page1 -->

                    <div class="page hero-unit">

                        <h2>
                            <strong>&Eacute;tape 2: </strong> Cliquez sur les catégories qui vous intéressent le plus :
                        </h2>
                        <ul>
                            <li id="category" class="row-fluid">
                                <?php
                                $category = array('family_home' => 'Famille et foyer', 'market_food' => 'Courses et Alim.', 'food_restaurant' => 'Art culinaire',
                                    'people_services' => 'Services à la pers.', 'society' => 'Culture et Société', 'discovery' => 'Voyages et Déc.', 'school_education' => 'Education', 'sciences_tech' => 'Sciences et Tech.',
                                    'social_science' => 'Sciences sociales', 'history' => 'Histoire et Person.', 'art_design' => 'Art et Design', 'other' => 'Autre');
                                $i = 1;
                                foreach ($category as $key => $value) {
                                    echo "<div class='span2 category'>";
                                    echo "<button class='btn'><img src=\"resources/images/categories/$key.png\" />$value";
                                    echo "<input class='chosen_category' type=\"hidden\" name='$key' id='$key' value='nok' /></button>";
                                    echo "</div><!-- Category $i-->";
                                    $i++;
                                }
                                ?>
                                <div class="clear"></div>
                            </li>
                        </ul>
                        <ul>
                            <li class="clearfix">
                                <button type="button" class="btn btn-large prev" style="float:left">&laquo; Retour</button>
                                <button type="button" class="btn btn-success btn-large next right"><?= $trad->_("APP_WELCOME_NEXT") ?> &raquo;</button>
                            </li>

                            <br clear="all" />
                        </ul>
                    </div><!-- page2 -->

                    <div class="page hero-unit">
                        <ul>
                            <li>
                                <h2>
                                    <strong>&Eacute;tape 3: </strong> Renseignez votre ville et votre pays
                                    <em>Puis cliquez sur <strong>Terminer</strong> pour valider la saisie.</em>
                                </h2>
                            </li>
                            <li class="required">
                                <div class="control-group">
                                    <label>
                                        <!-- Votre pays <span>*</span><br /><strong>1.</strong> -->
                                        <input class="span4" type="text" maxlength="20" name="pays" id="pays" placeholder="Nom du Pays *" autocomplete="off" />
                                    </label>
                                </div>
                                <div class="control-group">
                                    <label>
                                        <!-- Votre ville <span>*</span><br />-->
                                        <input class="span4" type="text" maxlength="20" name="ville" id="ville" placeholder="Nom de la ville *" autocomplete="off" />
                                        <!--<select name="city">
                                                <option value="">-- please select --</option>
                                                <option>Helsinki</option>
                                                <option>Berlin</option>
                                                <option>New York</option>
                                        </select> Prévoir un chargement des ville en Ajax-->
                                    </label>
                                </div>
                                <div class="control-group">
                                    <label class="span4">
                                        Vous êtes un (e) <span>*</span><br /><br />
                                        <select id="genre" name="genre">
                                            <option value="">-- Choisir un genre --</option>
                                            <option>Homme</option>
                                            <option>femme</option>
                                        </select>
                                    </label>
                                </div>
                            </li><!-- country / city -->
                            <li>
                                <button type="button" class="btn btn-large prev">&laquo; Retour</button>
                                <button type="submit" class="btn btn-success btn-large right"><?= $trad->_("APP_WELCOME_FINISH") ?> &raquo;</button>
                            </li>
                            <p class="help-block">* Merci de renseigner ces informations.</p>
                        </ul>
                    </div><!-- page3 -->


                </div><!--items-->
            </div><!--wizard-->
            <footer>
                <p>&copy; <strong>Socialac</strong> 2012 <em class="no-see"> - Un réseau enfin Social</em> <span class="no-see"> Share experiences, exchange ideas.</span>.Tous droits réservés. <span class="no-see"><a href="http://mobile-tuts.com" title="We Mobilize things !">Mobile-tuts!</a>.</span></p>
            </footer>
        </form>
        <script>
            $(function() {


                var root = $("#wizard").scrollable();



                // some variables that we need
                var api = root.scrollable(), drawer = $("#drawer");

                // validation logic is done inside the onBeforeSeek callback
                api.onBeforeSeek(function(event, i) {

                    // we are going 1 step backwards so no need for validation
                    if (api.getIndex() < i) {

                        // 1. get current page
                        var page = root.find(".page").eq(api.getIndex()),

                        // 2. .. and all required fields inside the page
                        inputs = page.find(".required :input").removeClass("alert"),

                        // 3. .. which are empty
                        empty = inputs.filter(function() {
                            return $(this).val().replace(/\s*/g, '') == '';
                        });

                        // if there are empty fields, then
                        if (empty.length) {

                            // slide down the drawer
                            drawer.slideDown(function()  {

                                // colored flash effect
                                //drawer.css("backgroundColor", "#B94A48");
                                drawer.addClass("alert alert-error");
                                setTimeout(function() { drawer.css("backgroundColor", "#fff"); }, 1000);
                            });

                            // add a CSS class name "error" for empty & required fields
                            empty.addClass("alert alert-error");

                            // cancel seeking of the scrollable by returning false
                            return false;

                            // everything is good
                        } else {

                            // hide the drawer
                            drawer.slideUp();
                        }

                    }

                    // update status bar
                    $("#status li").removeClass("active").eq(i).addClass("active");

                });

                // if tab is pressed on the next button seek to next page
                root.find("button.next").keydown(function(e) {
                    if (e.keyCode == 9) {

                        // seeks to next tab by executing our validation routine
                        api.next();
                        e.preventDefault();
                    }
                });

            });

            $("#about .btn, #category .btn").click(function(event) {
                event.preventDefault();
                $(this).toggleClass('active');
            });
            $('#about .persontype').click(function(event){
                if (this.id == 'cigale') {
                    $('#personality').val('cigale');
                    $("#fourmi .btn").removeClass('active');
                } else {
                    $('#personality').val('fourmi');
                    $("#cigale .btn").removeClass('active');
                }
            });
            
            $('#category .btn').toggle(function() {
                $(this).find('input').val("ok");
            }, function() {
                $(this).find('input').val("nok");
            });
            //$("#welcome-form").submit(function () { return false; });
        </script>
    </body>
</html>