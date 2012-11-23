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
<h2> Socialac <br> <small>Share eXperience, eXchange ideas.</small></h2>
<div class="span4 hero-unit">
    <h3>Pas encore inscrit ? <small>S'inscrire !</small></h3>
     <form class="form-horizontal" method="post" action="account/create">
           <input type="hidden" name="yam_account_type" value="create"/>
           <div class="control-group">
                <input class="span4" type="text" maxlength="45" id="register_username" name="register_username" value="" placeholder="Nom complet" autocomplete="off">
           </div>
           <div class="control-group">
                <input class="span4" type="email" id="register_email" name="register_email" value="" placeholder="Adresse e-mail" autocomplete="off" data-validation-required-message="Entrez une adresse e-mail valide." required>
           </div>
           <div class="control-group">
                <input class="span4" type="password" id="register_password" name="register_password" value="" placeholder="Mot de passe" autocomplete="off" data-validation-required-message="Entrez un mot de passe d'au moins 6 caractères." required>
                <span class="help-block">Entrer un mot de passe d'au moins 6 caractères.</span>
           </div>
           <button class="btn btn-info btn-large" type="submit">S'inscrire</button>
     </form>
</div><!-- eXtac Subscription -->
<div>
      <h3>Déjà inscrit ? <a href="account/login">Se connecter</a></h3>
</div>