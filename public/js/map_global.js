var places = [];
var offset = 0;
while (!$('#place'+offset).length){
	offset++;
}
var refpoint = {
	lat : $('#place'+offset).children('.lat').val(),
	long : $('#place'+offset).children('.long').val(),
	rad : $('#place'+offset).children('.radius').val()
}

// 7 Rue Léon Gambetta
$('.place').each(function(){
	lat = $(this).children('.lat').val();
	long = $(this).children('.long').val();
	rad = $(this).children('.radius').val()*1000;
	child_nb = $(this).children('.child_nb').val();

	places.push({
		lat : lat,
		long : long,
		rad : rad,
		child_nb : child_nb
	})
});

if($('#mapid').length){
	var map = L.map('mapid').setView([refpoint['lat'], refpoint['long']], 11);
}

function mark(lat, long, rad){

	var redMarker = L.AwesomeMarkers.icon({
		prefix: 'fa',
		icon: 'cross',
		markerColor: 'black',
		iconColor: 'white'
	  });
	  

	// var marker = L.marker([lat, long])
	var marker = L.marker([lat, long], {icon: redMarker})
	.addTo(map);
	// marker.bindPopup("<b>Hello world!</b><br>I am a popup.")
}


function initMap(){
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
		maxZoom: 20,
		id: 'mapbox.streets',
		accessToken: 'pk.eyJ1IjoiY3lyaWxkZW5veWVsbGUiLCJhIjoiY2o3dm80bzBoNTI3ODMybnUweGRoOWZmdiJ9.-E8SEOtLZ1qbBjb5SEHtww'
	}).addTo(map);

	// var marker = L.marker([45, 1.33]).addTo(map)
	// marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();
	// mark(refpoint.lat, refpoint.long, refpoint.rad);
	for(i=0; i<places.length; i++){
		console.log('coucouplace');
		mark(places[i].lat, places[i].long, places[i].rad);
	}

}initMap();

// $('#city, #lat, #long').on('keyup', function(){
// 	map.setView(new L.LatLng($('#lat').val(), $('#long').val()), 10);
// });

var autocomplete;
function initAutocomplete() {
	var options = {
		componentRestrictions: { country: "fr" }
	};
	var input = document.getElementById('city');
	var autocomplete = new google.maps.places.Autocomplete(input, options);
}

// find only city string and call api geocode
function ajaxCity(city){
	$.ajax({
		type: "GET",
		url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + city + "&lang=fr&key=AIzaSyCbDnwlE6W0EO0LIIp16f4yqgzye78ENRY",
		dataType: "json",
		success: geolocation,
		error: function() {
			alert("404 Not Found - Oops something went wrong !");
		}
	});
}

var timeout = true;
function verifCity(){
	var city = $('#city').val();
	if (city !== '') {
		ajaxCity(city);
	}
}

typed = ''; // stock the input
$('#city').on('keyup', function(e) {
	$("#lat").val(lat).html();
	$("#long").val(long).html();
	if(e.which === 13){
		typed = $('#city').val();
		verifCity();
	}
});

$('#city').on('focusout', function() {
	$("#long").val(long).html();
	$("#lat").val(lat).html();
	if(typed !== $('#city').val()){ // condition if somethings hase change in the input
		typed = $('#city').val();
		setTimeout(function(){
			verifCity();
		}, 200)
	}
});

// find city lat and long and put marker

// MARKER ON CLICK
var markclick = L.marker([0, 0])
.addTo(map)
;

function geolocation(data) {
	var lat = data.results[0].geometry.location.lat;
	var long = data.results[0].geometry.location.lng;
	var city = '';
	map.setView(new L.LatLng(lat, long), 16);
	var markercol = 'red';
	city = '';
	var colorMarker = L.AwesomeMarkers.icon({
		prefix: 'fa',
		icon: 'child',
		markerColor: markercol
	});

	markclick
	.setLatLng([lat, long])
	.setIcon(colorMarker)
	;
}

// MAP PLACE MARKER ON CLICK
// map.on('click', function(e){
// 	$("#markclicklat").val(e.latlng.lat).html();
// 	$("#markclicklong").val(e.latlng.long).html();
// 	markclick.setLatLng(e.latlng);
// })

// $('#submit').on('click', function() {
// 	geocodeLatLng(geocoder, map, infowindow);
// });

// function geocodeLatLng(geocoder, map, infowindow) {

// 	var lat = $('#lat').val();
// 	var long = $('#long').val();

// 	var latlng = {lat: parseFloat(lat), lng: parseFloat(long)};
// 	geocoder.geocode({'location': latlng}, function(results, status) {
// 		if (status === 'OK') {
// 			if (results[1]) {
// 				map.setZoom(11);
// 				var marker = new google.maps.Marker({
// 					position: latlng,
// 					map: map
// 				});
// 				infowindow.setContent(results[1].formatted_address);
// 				infowindow.open(map, marker);
// 			} else {
// 				window.alert('No results found');
// 			}
// 		} else {
// 			window.alert('Geocoder failed due to: ' + status);
// 		}
// 	});
// }