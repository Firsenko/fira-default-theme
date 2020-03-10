(function( $ ) {

	/**
	 * initMap
	 *
	 * Renders a Google Map onto the selected jQuery element
	 *
	 * @date    22/10/19
	 * @since   5.8.6
	 *
	 * @param   jQuery $el The jQuery element.
	 * @return  object The map instance.
	 */
	function initMap( $el ) {

		// Find marker elements within map.
		var $markers = $el.find('.marker');
		// Get position from marker.
		// Create gerenic map.
		var mapArgs = {
			zoom        : $el.data('zoom') || 16,
			mapTypeId   : google.maps.MapTypeId.ROADMAP,
			styles: [
				{elementType: 'geometry', stylers: [{color: '#242f3e'}]},
				{elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
				{elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
				{
					featureType: 'administrative.locality',
					elementType: 'labels.text.fill',
					stylers: [{color: '#d59563'}]
				},
				{
					featureType: 'poi',
					elementType: 'labels.text.fill',
					stylers: [{color: '#d59563'}]
				},
				{
					featureType: 'poi.park',
					elementType: 'geometry',
					stylers: [{color: '#263c3f'}]
				},
				{
					featureType: 'poi.park',
					elementType: 'labels.text.fill',
					stylers: [{color: '#6b9a76'}]
				},
				{
					featureType: 'road',
					elementType: 'geometry',
					stylers: [{color: '#38414e'}]
				},
				{
					featureType: 'road',
					elementType: 'geometry.stroke',
					stylers: [{color: '#212a37'}]
				},
				{
					featureType: 'road',
					elementType: 'labels.text.fill',
					stylers: [{color: '#9ca5b3'}]
				},
				{
					featureType: 'road.highway',
					elementType: 'geometry',
					stylers: [{color: '#746855'}]
				},
				{
					featureType: 'road.highway',
					elementType: 'geometry.stroke',
					stylers: [{color: '#1f2835'}]
				},
				{
					featureType: 'road.highway',
					elementType: 'labels.text.fill',
					stylers: [{color: '#f3d19c'}]
				},
				{
					featureType: 'transit',
					elementType: 'geometry',
					stylers: [{color: '#2f3948'}]
				},
				{
					featureType: 'transit.station',
					elementType: 'labels.text.fill',
					stylers: [{color: '#d59563'}]
				},
				{
					featureType: 'water',
					elementType: 'geometry',
					stylers: [{color: '#17263c'}]
				},
				{
					featureType: 'water',
					elementType: 'labels.text.fill',
					stylers: [{color: '#515c6d'}]
				},
				{
					featureType: 'water',
					elementType: 'labels.text.stroke',
					stylers: [{color: '#17263c'}]
				}
			]
		};
		var map = new google.maps.Map( $el[0], mapArgs );

		// Add markers.
		map.markers = [];
		$markers.each(function(){
			initMarker( $(this), map, marker_img );
		});
		// Center map based on markers.
		centerMap( map );

		// Return map instance.
		return map;
	}

	/**
	 * initMarker
	 *
	 * Creates a marker for the given jQuery element and map.
	 *
	 * @date    22/10/19
	 * @since   5.8.6
	 *
	 * @param   jQuery $el The jQuery element.
	 * @param   object The map instance.
	 * @return  object The marker instance.
	 */
	function initMarker( $marker, map ) {

		// Get position from marker.
		var lat = $marker.data('lat');
		var lng = $marker.data('lng');
		var latLng = {
			lat: parseFloat( lat ),
			lng: parseFloat( lng )
		};

		// Create marker instance.
		var marker = new google.maps.Marker({
			position : latLng,
			map: map,
			icon: marker_img
		});

		// Append to reference for later use.
		map.markers.push( marker );

		// If marker contains HTML, add it to an infoWindow.
		if( $marker.html() ){

			// Create info window.
			var infowindow = new google.maps.InfoWindow({
				content: $marker.html()
			});

			// Show info window when marker is clicked.
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open( map, marker );
			});
		}
	}

	/**
	 * centerMap
	 *
	 * Centers the map showing all markers in view.
	 *
	 * @date    22/10/19
	 * @since   5.8.6
	 *
	 * @param   object The map instance.
	 * @return  void
	 */
	function centerMap( map ) {

		// Create map boundaries from all map markers.
		var bounds = new google.maps.LatLngBounds();
		map.markers.forEach(function( marker ){
			bounds.extend({
				lat: marker.position.lat(),
				lng: marker.position.lng()-.02
			});
		});

		// Case: Single marker.
		if( map.markers.length == 1 ){
			map.setCenter( bounds.getCenter() );

			// Case: Multiple markers.
		} else{
			map.fitBounds( bounds );
		}
	}

// Render maps on page load.
	$(document).ready(function(){
		$('.acf-map').each(function(){
			var map = initMap( $(this) );
		});
	});

})(jQuery);