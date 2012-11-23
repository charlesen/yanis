<?php
/*
 \* Yanis Framework is Yet ANother Internet Software for web and mobile technologists
 * @copyright Copyright (C) 2012, Charles EDOU NZE & Mobile-tuts!
 * @license Released under the MIT License.
 * @author Charles EDOU NZE <charles at charlesen.fr>
 */

// no direct access
defined ( 'YANIS_EXEC' ) or die ( 'Restricted access' );
?>
<style>
	body {
		padding-top: 0px;
		margin-top:0px;
	}
</style>
<script>
		   // DOM Ready    
		   $(function() {
		   	$.getJSON('http://twitter.com/status/user_timeline/charlesen7.json?count=10&callback=?', function(data){
		   		$.each(data, function(index, item){
		   			$('#twitter').append('<div class="tweet"><p>' + item.text.linkify() + '</p><p><strong>' + relative_time(item.created_at) + '</strong></p></div>');
		   		});
		   	
		   	});
		   		    	
		   	function relative_time(time_value) {
		   	  var values = time_value.split(" ");
		   	  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
		   	  var parsed_date = Date.parse(time_value);
		   	  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
		   	  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
		   	  delta = delta + (relative_to.getTimezoneOffset() * 60);
		   	  
		   	  var r = '';
		   	  if (delta < 60) {
		   		r = 'a minute ago';
		   	  } else if(delta < 120) {
		   		r = 'couple of minutes ago';
		   	  } else if(delta < (45*60)) {
		   		r = (parseInt(delta / 60)).toString() + ' minutes ago';
		   	  } else if(delta < (90*60)) {
		   		r = 'an hour ago';
		   	  } else if(delta < (24*60*60)) {
		   		r = '' + (parseInt(delta / 3600)).toString() + ' hours ago';
		   	  } else if(delta < (48*60*60)) {
		   		r = '1 day ago';
		   	  } else {
		   		r = (parseInt(delta / 86400)).toString() + ' days ago';
		   	  }
		   	  
		   	  return r;
		   	}
		   	
		   	String.prototype.linkify = function() {
		   		return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(m) {
		   			return m.link(m);
		   		});
		   	};
		   	
		   });
  	</script>
<h2> Socialac <br> <small>Share eXperience, eXchange ideas.</small></h2>
<h3><a href="account/logout">Se déconnecter</a></h3>
<div id="page-wrap" class="hero-unit">
		<div id="twitter">
			<h2>Timeline</h2>
		</div>
		<div id="tips">
			<h2>All tips</h2>
		</div>
</div><!-- Timeline -->