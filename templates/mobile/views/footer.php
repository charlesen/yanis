<?php
/*
 * Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

// no direct access
defined ( 'YANIS_EXEC' ) or die ( 'Restricted access' );

yimport ( 'translate.Translate' );
$trad = new Yanis_Translate ();
?>
<script src="<?php echo YANIS_ROOT?>/resources/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo YANIS_ROOT?>/resources/js/application.js"></script>

<div xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
	xmlns="http://www.w3.org/1999/xhtml"
	xmlns:foaf="http://xmlns.com/foaf/0.1/"
	xmlns:gr="http://purl.org/goodrelations/v1#"
	xmlns:vcard="http://www.w3.org/2006/vcard/ns#">
	<div about="#company" typeof="gr:BusinessEntity">
	<div property="gr:legalName" content="Socialac"></div>
	<div rel="vcard:adr">
	<div typeof="vcard:Address">
	<div property="vcard:country-name" content="France"></div>
	<div property="vcard:locality" content="Troyes"></div>
	<div property="vcard:postal-code" content="10000"></div>
	<div property="vcard:street-address" content="Rue du Berry"></div>
	</div>
	</div>
	<!--<div property="vcard:tel" content=""></div>-->
	<div rel="foaf:depiction"
		resource="http://socialac.com/resources/images/logo.png"></div>
	<div rel="foaf:page" resource=""></div>
	</div>
</div><!-- Rdfa for Socialac Company -->
<div xmlns="http://www.w3.org/1999/xhtml"
	xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
	xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
	xmlns:xsd="http://www.w3.org/2001/XMLSchema#"
	xmlns:gr="http://purl.org/goodrelations/v1#"
	xmlns:foaf="http://xmlns.com/foaf/0.1/"
	xmlns:pto="http://www.productontology.org/id/">
	<div typeof="gr:Offering" about="#offering">
	<div rev="gr:offers" resource="#company"></div>
	<div property="gr:name" content="Socialac" xml:lang="fr"></div>
	<div property="gr:description"
		content="Social network for sharing useful things and tips"
		xml:lang="fr"></div>
	<div rel="foaf:depiction"
		resource="http://socialac.com/resources/images/logo.png"></div>
	<div rel="gr:hasBusinessFunction"
		resource="http://purl.org/goodrelations/v1#ProvideService"></div>
	<div rel="foaf:page" resource="http://socialac.com/about"></div>
	<div rel="gr:includes">
	<div typeof="gr:SomeItems pto:Website" about="#product">
	<div property="gr:name" content="Socialac" xml:lang="fr"></div>
	<div property="gr:description"
		content="Social network for sharing useful things and tips"
		xml:lang="fr"></div>
	<div rel="foaf:depiction"
		resource="http://socialac.com/resources/images/logo.png"></div>
	<div rel="foaf:page" resource="http://socialac.com/about"></div>
	</div>
	</div>
	</div>
</div><!-- Rdfa for Socialac Services -->

<div id="system-message"
	style="z-index: 16777271; position: fixed; left: 50%; bottom: 0px; width: 1263px; margin-left: -632px; height: 30px; line-height: 30px; border: none; background-color: #C9DBE9; color: rgb(0, 0, 0); overflow: hidden; text-align: center; font-size: 12px; font-family: arial;">
<strong>Welcome ! </strong>Nous sommes heureux de vous accueillir sur <span
	class="label label-info" title="Social and Accountable"> Socialac </span>
&nbsp;, le réseau du partage utile. Pour bien démarrer, <a
	class="btn btn-mini" href="start"> suivez le guide»</a>. <a id="close"
	href="#"
	style="display: block; width: 30px; height: 30px; background-color: #bbb; border: none; color: rgb(255, 255, 255); font-size: 20px; line-height: 30px; text-decoration: none; position: absolute; right: 0px; top: 0px;">×</a>
</div>
<script>
	$("#close").click(function () {
		  $("#system-message").fadeOut();
	});
</script>