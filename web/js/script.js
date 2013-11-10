
var uniID;
var locID;

var filterTop = true;

$(function(){
	
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(GEOprocess, GEOdeclined);
		validateLocation();
	} else {
		alert('Your browser sucks. Upgrade it.');
	}
	
	if(!localStorage.id){
		newUser();
	}
	
	//Check for Uni Preference
	/*if (localStorage.uniID){
		//Check For Location Preference
		if (localStorage.locID){
  			loadSpotts();
  		} else {
			//Show Location List
			getLocList();
		}
  	} else {
  		//Show Uni List
		getUniList();
		//getTop();
	}*/
	
	loadSpotts();
	
});

function loadSpotts(){
	//uniID = Number(localStorage.uniID);
	//locID = Number(localStorage.locID);
	uniID = 1;
	locID = 1;
	//Populate page with Top Spotts
	$('#page').fadeOut('fast');
	if(filterTop){
		getTop();
	} else {
		getLatest();
	}
}

function selectUni(id){
	//Save Uni Selection
	localStorage.uniID = id;
	//Load Uni Locations
	$('#page').fadeOut('fast');
	getLocList(id);
}

function selectLoc(id){
	//Save Location Selection
	localStorage.locID = id;
	//Load Location Spotts
	loadSpotts();
}

function submitSpot(){
	var m = $("#newSpot").val();
	if(m != ""){
		addSpot(m);
	}
}

function upVote(id){
	rateSpot(id);
}

function toggleFilter(){
	filterTop = !filterTop;
	loadSpotts();
}

function newUser(){
	localStorage.id = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
						var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
						return v.toString(16);
					});
}