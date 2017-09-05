var autocomplete;

function initAutocomplete() {
    console.log('initAutocomplete ok');
    var options = {
        types: ['(regions)'],
        componentRestrictions: { country: "fr" }
    };
    var input = document.getElementById('city');
    var autocomplete = new google.maps.places.Autocomplete(input, options);
    initMap(); //map.js
}