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
?>
<div>
    <!--<h2>Journal d'activités</h2>-->
    <div class="tabbable">
        <ul class="nav nav-tabs" id="timeline-tabs">
            <li class="active">
                <a href="#tips" data-toggle="tab"><?= $trad->_("APP_TIPS") ?></a>
            </li>
            <li>
                <a href="#deals" data-toggle="tab"><?= $trad->_("APP_DEALS") ?></a>
            </li>
            <li>
                <!-- <a href="#shopping" data-toggle="tab">Shopping</a> -->
            </li>
            <li>
                <a href="#fav" data-toggle="tab"><?= $trad->_("APP_FAVORITES") ?></a>
            </li>
            <li>
                <a href="#search" data-toggle="tab"><?= $trad->_("APP_SEARCH") ?></a>
            </li>
        </ul>
        <div id="timeline-content" class="tab-content">
            <div class="tab-pane active" id="tips" itemscope itemtype="http://schema.org/ItemList">
                <meta itemprop="mainContentOfPage" content="true"/>
                <div class="tab-title">
                    <h3 itemprop="name"><?= $trad->_("APP_ALL_TIPS") ?></h3>
                </div>
                <div id="tips-loader"></div>
                <div id="all-tips">
                    <?php timelineHelper::loadContents(null) ?>
                </div><!-- All tips -->
            </div><!-- Tips Tab -->

            <div class="tab-pane" id="search">
                <div class="tab-title">
                    <h3><?= $trad->_("APP_MORE_IDEAS") ?> <?= $trad->_("APP_TEXT_AND") ?> <span><?= $trad->_("APP_TIPS") ?></span></h3>
                </div>
                <form id="form-tips" class="form-search" method="post" action="timeline/shopping/">
                    <fieldset>
                        <!--<label class="control-label" for="share-input">Text input</label>-->
                        <div id="search-tips">
                            <input type="search" class="input-xlarge search-query" name="q" id="tips-input" autocomplete="on" placeholder="Entrer un terme ou une expression ...">
                            <button class="btn btn-large" type="submit">Trouver</button>
                            <p class="help-block">Exemples: payer moins d'impôts, acheter une voiture neuve, ...</p>
                        </div>
                    </fieldset>
                </form><!-- Tips Form Search -->
                <div id="tips-results"></div><!-- Tips search results -->
            </div><!-- Search Tab -->

            <div class="tab-pane" id="deals">
                <div class="tab-title">
                    <h3>Derniers deals</h3>
                </div>
                <?php timelineHelper::loadContents('deals') ?>
            </div><!-- Deals Tab -->

            <div class="tab-pane" id="shopping">
                <div class="tab-title">
                    <h3>Trouver des produits Moins chers</h3> <br />
                </div>
                <form id="form-shopping" class="form-search" action="timeline/shopping/">
                    <fieldset>
                        <!--<label class="control-label" for="share-input">Text input</label>-->
                        <div id="search-shopping">
                            <input type="search" class="input-xlarge search-query" name="q" id="shopping-input" autocomplete="on" placeholder="Rechercher un produit...">
                            <button class="btn btn-large" type="submit">Trouver</button>
                            <p class="help-block">Exemples: galaxy nexus, iphone, friteuse, mp3,...</p>
                        </div>
                    </fieldset>
                </form><!-- Shopping Form Search -->
                <div>
                    Tendances utilisateurs :
                    <ul class="nav nav-pills">
                        <li class="active">
                            <a href="#">Jet li</a>
                        </li>
                        <li><a href="#">Galaxy Nexus</a></li>
                        <li><a href="#">iPhone 5</a></li>
                    </ul>
                </div><!-- Users trends -->
                <div id="shopping-results">
                    <?php //timelineHelper::googleShopping(); ?>
                </div><!-- Shopping search results -->
            </div><!-- Shopping Tab -->
            <div class="tab-pane" id="fav">
                <div class="tab-title">
                    <h3>Favoris</h3>
                </div>
                <?php timelineHelper::loadContents('fav') ?>
            </div><!-- favorites Tab -->

            <script>
                $(document).ready(function(){
                    $("#form-shopping").submit(function(event) {

                        /* Supprime la soumission classique du formulaire */
                        event.preventDefault(); 
        
                        /* Récupère les elements du form: */
                        var $form = $( this ),
                        term = $form.find( 'input[name="q"]' ).val(),
                        url = $form.attr( 'action' );
                        var postdata = url+term;

                        /* Envoi des données par Post et l'insère dans le div */
                        $.post( postdata,{ q: term },
                        function( data ) {
                            $('#shopping-results').html('<div style="text-align:center;"><img src="resources/images/modules/loading.gif" alt="Chargement..." /></div>');
                            $( "#shopping-results" ).empty().html(data);
                        }
                    );
                    });
                });
            </script><!-- Shopping stuff -->
            
            <script>
			    $(document).ready(function(){
			        $("#form-share").submit(function(event) {
			            
			            event.preventDefault(); 
			            
			            /* Get form vars */
			            var $form = $( this ),
			            url = $form.attr( 'action' ),
			            tips = $form.find( 'input[name="share-content"]' ).val();
			            
			            /** Loading message **/
			            $('#tips-loader').html('<p style="text-align:center;"><img src="resources/images/modules/loading.gif" alt="<?= $trad->_("APP_EVENT_LOADING") ?>..." /></p>').fadeIn();
			            
			            /* Envoi des données par Post et l'insère dans la div */
			            $.post( url,{"share-content":tips},
				            function( data ) {
				                $( "#all-tips" ).prepend( data );
				                $('#share-input').val('');
				                $('#timeline-tabs a:first').tab('show');
				                $('#tips-loader').fadeOut('fast');
				            }
			        	); 
			        });
			    });
		</script><!-- Share tips and ideas -->
        </div><!-- Tabs content -->
    </div>
</div><!-- Journal d'activités  -->