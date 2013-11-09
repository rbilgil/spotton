
var located = false;
var lat;
var lon;

function GEOprocess(position) {
	lat = position.coords.latitude;
	lon = position.coords.longitude;
	located = true;
}

function GEOdeclined(error) {
	alert('Error: ' + error.message);
}

if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(GEOprocess, GEOdeclined);
} else {
	alert('Your browser sucks. Upgrade it.');
}