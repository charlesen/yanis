/**
 * @copyright Copyright (C) 2012 Socialac, Mobile-tuts! & Charles EDOU NZE
 * @author Charles EDOU NZE <charles at charlesen.fr>
 * 
 * Core apps
 */

// HTML 5 Compatibility
if (!window.localStorage) {
	Object
			.defineProperty(
					window,
					"localStorage",
					new (function() {
						var aKeys = [], oStorage = {};
						Object.defineProperty(oStorage, "getItem", {
							value : function(sKey) {
								return sKey ? this[sKey] : null;
							},
							writable : false,
							configurable : false,
							enumerable : false
						});
						Object.defineProperty(oStorage, "key", {
							value : function(nKeyId) {
								return aKeys[nKeyId];
							},
							writable : false,
							configurable : false,
							enumerable : false
						});
						Object.defineProperty(oStorage, "setItem", {
							value : function(sKey, sValue) {
								if (!sKey) {
									return;
								}
								document.cookie = escape(sKey) + "="
										+ escape(sValue) + "; path=/";
							},
							writable : false,
							configurable : false,
							enumerable : false
						});
						Object.defineProperty(oStorage, "length", {
							get : function() {
								return aKeys.length;
							},
							configurable : false,
							enumerable : false
						});
						Object.defineProperty(oStorage, "removeItem", {
							value : function(sKey) {
								if (!sKey) {
									return;
								}
								var sExpDate = new Date();
								sExpDate.setDate(sExpDate.getDate() - 1);
								document.cookie = escape(sKey) + "=; expires="
										+ sExpDate.toGMTString() + "; path=/";
							},
							writable : false,
							configurable : false,
							enumerable : false
						});
						this.get = function() {
							var iThisIndx;
							for ( var sKey in oStorage) {
								iThisIndx = aKeys.indexOf(sKey);
								if (iThisIndx === -1) {
									oStorage.setItem(sKey, oStorage[sKey]);
								} else {
									aKeys.splice(iThisIndx, 1);
								}
								delete oStorage[sKey];
							}
							for (aKeys; aKeys.length > 0; aKeys.splice(0, 1)) {
								oStorage.removeItem(aKeys[0]);
							}
							for ( var iCouple, iKey, iCouplId = 0, aCouples = document.cookie
									.split(/\s*;\s*/); iCouplId < aCouples.length; iCouplId++) {
								iCouple = aCouples[iCouplId].split(/\s*=\s*/);
								if (iCouple.length > 1) {
									oStorage[iKey = unescape(iCouple[0])] = unescape(iCouple[1]);
									aKeys.push(iKey);
								}
							}
							return oStorage;
						};
						this.configurable = false;
						this.enumerable = true;
					})());
}

/**
 *  Page Style & Effects
 */
// Alerts
$(".alert").alert();

// Dropdown Menu
$(document).ready(function() {
	$('.dropdown-toggle').dropdown();
});

// Tabs
$(document).ready(function() {
	$('a[data-toggle="tab"]').on('click', function(e) {
		e.tab('show');
	});
});

// The "Not yet done" Effect
$(".not-yet-done").live('click', function(event) {
	event.preventDefault();
	title = $(this).attr('title');
	message = (title == undefined) ? "Component's not yet available :(" : title + "'s " + message;

	$("#component .system-alert").show();
	$("#component .system-alert").fadeOut(1000, function() {
				$(this).html('<span class="alert alert-info">' + message + '</span>');
	});
});


//Socialac shortcuts
var isG = false;
$(document).keydown(function(e) {
	if (e.which == 71 || e.keyCode == 71) {
		isG = true; // si la touche G a été pressée
	}
}).keyup(function(e) {
			/**
			 * Si on se trouve dans un input, une textarea ou si on n'a pas
			 * pressé la touche G, on desactive les raccourcis clavier
			 */
			if ($('input:focus').length > 0 || $('textarea:focus').length > 0
					|| isG != true) {
				isG = false;

				return false;
			}

			if (e.keyCode == true) {
				var key = e.keyCode;
			} else {
				var key = e.which;
			}

			/**
			 * Look for second key pressed
			 */
			switch (key) {
			// G + Q (Ask Question)
			case 81:
				// window.location.href = "/profil/ask";
				return false;
				break;
			// G + A (Answers)
			case 65:
				// window.location.href = "/profil/answers";
				return false;
				break;
			// G + E (Edit profil)
			case 69:
				// window.location.href = "/profil/edit";
				return false;
				break;
			// G + H (Home)
			case 72:
				// window.location.href = "/";
				return false;
				break;
			// G + R (Refresh data list)
			case 82:
				// Refresh page
				return false;
				break;
			// G + P
			case 80:
				// window.location.href = "/profil";
				return false;
				break;
			// G + M (Members)
			case 77:
				// window.location.href = "profil/friends";
				return false;
				break;
			// G + L (Logout)
			case 76:
				// window.location.href = "/account/logout";
				return false;
				break;
			// G + T (Tips)
			case 84:
				// Show tips (load tips tab);
				return false;
				break;
			// G + D (Deals)
			case 68:
				// Show deals (load deals tab);
				return false;
				break;
			// G + K
			case 75:
				// Do some stuffs
				return false;
				break;
			}

			isG = false; // Reinit. flag
});