var places = [];
var refpoint = {
	lat : $('#place0').children('.lat').val(),
	long : $('#place0').children('.long').val(),
	rad : $('#place0').children('.radius').val()
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

$('.place').on('click', function(){
	lat = $(this).children('.lat').val();
	long = $(this).children('.long').val();
	map.setView([lat, long], 18);
});

// var map = L.map('mapid').setView([$('#lat').val(), $('#long').val()], 6);
if($('#mapid')){	
	var map = L.map('mapid').setView([refpoint['lat'], refpoint['long']], 11);
}

function mark(lat, long, rad){
	var marker = L.marker([lat, long])
	.addTo(map);
	// marker.bindPopup("<b>Hello world!</b><br>I am a popup.")
	;
	if(rad !== NaN && Number.isInteger(rad)){
		var circle = L.circle([lat, long],{
			color: 'green',
			fillColor: 'green',
			fillOpacity: 0.1,
			radius: rad
		}).addTo(map);

		circle
		// .bindPopup("<b>Hello circle!</b><br>I am a popup.")
		;
	}
}

function measure(lat1, lon1, lat2, lon2, rad){
    var R = 6378.137; // Radius of earth in KM
    var dLat = lat2 * Math.PI / 180 - lat1 * Math.PI / 180;
    var dLon = lon2 * Math.PI / 180 - lon1 * Math.PI / 180;
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
    Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c;
    return (d * 1000)<rad; // meters
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
		// if(measure(places[i].lat, places[i].long, refpoint.lat, refpoint.long, refpoint.rad)){	
			mark(places[i].lat, places[i].long, places[i].rad);
		// }
	}

}initMap();

$('#city, #lat, #long').on('keyup', function(){
	map.setView(new L.LatLng($('#lat').val(), $('#long').val()), 10);
});

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
$('#city').on('keyup', function() {
	var city = $('#city').val();
	if (city !== '' && timeout) {
		ajaxCity(city);
		timeout = false;
		setTimeout(function(){
			timeout = true;
			ajaxCity(city);
		}, 1000);
	}
});

// find city lat and long and put marker

var markclick = L.marker([0, 0])
.addTo(map)
;

function geolocation(data) {
	var lat = data.results[0].geometry.location.lat;
	var long = data.results[0].geometry.location.lng;
	$("#lat").val(lat).html();
	$("#long").val(long).html();
	map.setView(new L.LatLng(lat, long), 12);
	markclick.setLatLng([lat, long]);
}

map.on('click', function(e){
	$("#lat").val(e.latlng.lat).html();
	$("#long").val(e.latlng.long).html();
	markclick.setLatLng(e.latlng);
})

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