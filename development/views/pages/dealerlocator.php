<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard.php"/> 

<!--<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.5.3/bootstrap-slider.js" ></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.5.3/css/bootstrap-slider.css" rel="stylesheet">
-->
<div class="rn_Hero">
    <div class="rn_Container">
        <h1>Dealer Locator</h1>
    </div>
</div>
<div class="container">
<p>&nbsp;</p>
<link rel="stylesheet" type="text/css" href="/euf/assets/themes/standard/css/store.css">
<div id="storeLocator" class="storeLocator">

	<!--
		This is the autocomplete address search field.
		It must have the "input" class.
	-->
	<input type="text" class="input controls" placeholder="Enter an address, city...">

	<!--
		This is the map div which will contain the map generated
		by Google Maps. It must have the "map" class.
	-->
	<div id="map-canvas" class="map"></div>

	<!--
		This is the store list. It must contain the "data-list-stores"
		attribute.
	-->
	<ul id="stores" data-list-stores>

		<!--
			This element will be displayed while the stores are
			loading. It must have the "loading" class.
		-->
		<p class="loading">Loading...</p>

		<!--
			This element will be displayed if no store is found
			at this place. It must have the "no-store" class.
		-->
		<p class="no-store" style="display: none">No store found.</p>

		<!--
			This element is actually the template which will be
			cloned for each store to show. It is hidden (display: none)
			and must have the "data-store-template" attribute.
		-->
		<li class="store" data-store-template style="display: none">

			<!--
				The "data-store-link-to-map" on this div specifies
				that when the user clicks on the div, the store should
				be focused on the map. Note that you can add this attribute
				on a big div or only on a tiny link if you want.
			-->
			<div data-store-link-to-map>

				<!--
					The next elements define how this store will be showed
					in the list. The attribute "data-store-attr" defines which
					store data must be shown here. For example, if you want to
					show the name of the store, just use:
						<span data-store-attr="name"></span>
					Then the name will be inserted in the span element.
				-->

				<span class="distance" data-store-attr="distance-miles"></span>

				<!--
					Here is a new notation for the attibute "data-store-attr"
					to specify that it is not only the content that should be
					replaced by a store data, but also the content of an attribute
					(in this case "href"). The syntax is :
						data-store-attr='{"content":"the store property which will
						be used to replace the element's content","attr1":"property
						used for attribute attr1","attr2":"etc"}'
					The attribute content must be valid JSON.
					Note that the following notations are equivalent:
						<span data-store-attr="name"></span>
						<span data-store-attr='{"content":"name"}''></span>
				-->
				<strong><a target="_blank" href="javascript:void(0);" data-store-attr='{"content":"name","href":"url"}'></a></strong><br>

				<span data-store-attr="email"></span><br>
				<span data-store-attr="address"></span><br>
				<span data-store-attr="zip"></span> <span data-store-attr="city"></span>
			</div>
		</li>
	</ul>

	<!--
		This div defines what will be shown in the balloon window which will
		appear when the user clicks on a store on the map. It works exactly as
		the previous template div.
	-->
	<div style="display: none" data-store-infowindow-template>
		<strong><span data-store-link-to-map data-store-attr="name"></span></strong><br>
		<span data-store-attr="address"></span><br>
		<span data-store-attr="zip"></span> <span data-store-attr="city"></span>
	</div>

</div>

<!--
	Remember that the plugins requires jQuery library, and the
	Google Maps API.
-->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//maps.google.com/maps/api/js?sensor=false&amp;libraries=places"></script>

<!--
	Include the jQuery plugin.
-->
<script src="/euf/assets/themes/standard/js/jquery.storelctr.js"></script>

<script>

	// When the document is fully loaded...
	$(document).ready(function() {

		// Here we say that we want to use the plugin
		// on the "storeLocator" div. The storeLocator
		// methods accepts as parameter the options that
		// you want to pass to the plugin.
		$('#storeLocator').storeLocator({

			// The fetchStoresFunction is a quite required
			// option. It is a function which take three parameters:
			// the latitude and the longitude of the address that
			// the user wants to find the store nearby, and the
			// function that will be called when the stores are fetched.
			// See below for an example of such a function.
			fetchStoresFunction: fetchStores,

			// This options defines wether the user should be located
			// to center the map on his position (it uses HTML5 API).
			enableGeolocation: true,

			// This is the coordinates of the default location the map
			// will be centered to.
			defaultLocation: { latitude: 48.858877, longitude: 2.3470598 }

		});

	});

	// This example function simply makes an AJAX call to the stores.php
	// script, which returns the stores in JSON format. The script takes
	// two parameters: the latitude and the longitude. When the AJAX call
	// is finished, we call the callback function. The stores will be passed
	// as parameter to this function.
	function fetchStores(lat, lng, callback) {
		$.post('/cc/AjaxCustom/getDealerStores', { lat: lat, lng: lng }, 'json').success(callback);
	}
</script>