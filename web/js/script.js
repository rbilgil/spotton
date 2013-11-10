
var uniID;
var locID;

var filterTop = true;

$(function(){
	
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
	uniID = Number(localStorage.uniID);
	locID = Number(localStorage.locID);
	//Populate page with Top Spotts
	$('#page').fadeOut('fast');
	getTop();
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
	if(filterTop){
		$('#page').fadeOut('fast');
		getLatest();
		filterTop = false;
	} else {
		$('#page').fadeOut('fast');
		getTop();
		filterTop = true;
	}
}

function newUser(){
	localStorage.id = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
						var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
						return v.toString(16);
					});
}