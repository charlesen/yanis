<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

// no direct access
defined('YANIS_EXEC') or die('Restricted access');

yimport('translate.Translate');
$trad = new Yanis_Translate();
$login = $_SESSION['APP_USER_EMAIL'];
?>

<!-- Dashboard - Tableau de bord -->
<div class="navbar navbar-fixed-top" id="navbar">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?php echo YANIS_ROOT;?>">Socialac</a>
            <ul class="nav">
                <li class="active"><a href="<?php echo YANIS_ROOT;?>"><?= $trad->_("APP_MENU_HOME") ?></a></li>
                <li><a href="account/profil"><?= $trad->_("APP_MENU_PROFIL") ?></a></li>
                <li><a href="budget/"><?= $trad->_("APP_MENU_BUDGET") ?></a></li>
                <li><a href="suggest/"><?= $trad->_("APP_MENU_SUGGEST") ?></a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <strong><?= $trad->_("APP_MENU_MORE") ?></strong>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu" id="yam-plus">
                        <li><a href="jobs/"><?= $trad->_("APP_MENU_JOBS") ?></a></li>
                        <li><a href="blog/"><?= $trad->_("APP_MENU_BLOG") ?></a></li>
                        <li><a href="services/"><?= $trad->_("APP_MENU_SERVICES") ?></a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav pull-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown"  data-target="#" href="#">
                        <strong id="username_tpl"><?= $login ?></strong>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu" id="yam-connexion">
                        <li><a href="#params"><?= $trad->_("APP_MENU_PARAMS") ?></a></li>
                        <li><a href="#help"><?= $trad->_("APP_MENU_HELP") ?></a></li>
                        <li><a href="account/logout"><?= $trad->_("APP_ACCOUNT_LOGOUT") ?></a></li>
                    </ul>
                </li>
            </ul>
            <div id="version"><span class="label label-info">Alpha 2.0</span></div>
        </div>
    </div>
</div><!--/navbar -->

<div class="container">
    <div class="content">
        <div class="page-header">
            <h1><?= $trad->_("APP_SLOGAN") ?><small id="status_tpl"> &laquo;...Private alpha...&raquo;</small></h1>
        </div>
        <div class="row-fluid">
            <div id="timeline" class="span8">
                <div id="share-status">
                    <form id="form-share" class="form-horizontal" action="timeline/share/">
                        <fieldset>
                            <!--<label class="control-label" for="share-input">Text input</label>-->
                            <div id="share-tips">
                                <input type="text" maxlength="700" class="input-xlarge" name="share-content" id="share-input" placeholder="<?= $trad->_("APP_TIMELINE_WHATSNEW") ?> ?">
                                <input type="hidden" name="share-type" value="deals" />
                                <button class="btn btn-large" type="submit"><?= $trad->_("APP_SHARE") ?></button>
                                <p class="help-block"><?= $trad->_("APP_SHARE_TIPS") ?>, <?= $trad->_("APP_SUGGEST_IDEAS") ?> ...<?= $trad->_("APP_TEXT_CHANGE_WORLD") ?> !</p>
                            </div>
                        </fieldset>
                    </form><!-- Form Share -->
                </div><!-- Share status -->
                <?php Yam::loadModule('timeline'); ?>
            </div><!-- Timeline - Journal d'activités -->
            <div class="span4">
                <?php Yam::loadModule('stats'); ?>
                <?php Yam::loadModule('suggest'); ?>
				<footer>
					<p>
						&copy; <strong>Socialac</strong> 2012 .<?=$trad->_ ( "APP_COPYRIGHT" )?>.
						<span class="no-see"><a href="http://mobile-tuts.com" title="We Mobilize things !">Mobile-tuts!</a>.</span>
					</p>
				</footer>
				<div class="clear"></div>
            </div> <!-- Modules : stats + Suggestions -->
        </div>
    </div> <!--/content -->
    <?php include_once TEMPLATE_BASE . '/views/footer.php'; ?><!-- Footer + JS -->
</div> <!-- /container -->