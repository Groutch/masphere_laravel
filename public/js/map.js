(function(){
	
	var autocomplete;
	function initAutocomplete() {
		var options = {
			componentRestrictions: { country: "fr" }
		};
		var input = $('#city');
		var autocomplete = new google.maps.places.Autocomplete(input, options);
	}
	
	var mymap = L.map('mapid').setView([$('#lat').val(), $('#long').val()], $('#zoom').val());

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
		maxZoom: 18,
		id: 'mapbox.streets',
		accessToken: 'pk.eyJ1IjoiY3lyaWxkZW5veWVsbGUiLCJhIjoiY2o3dm80bzBoNTI3ODMybnUweGRoOWZmdiJ9.-E8SEOtLZ1qbBjb5SEHtww'

	}).addTo(mymap);
	

	$('#lat, #long, #zoom').on('click', function(){
		mymap.setView(new L.LatLng($('#lat').val(), $('#long').val()), $('#zoom').val());
	})

})()