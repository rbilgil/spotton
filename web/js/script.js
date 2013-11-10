
var uniID;
var locID;

$(function(){
	
	if(!localStorage.id){
		newUser();
	}
	
	//Check for Uni Preference
	if (localStorage.uniID){
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
	}
	
	
	setLayout();
	$(window).resize(function(){
		setLayout();
	});
	
});

function loadSpotts(){
	uniID = Number(localStorage.uniID);
	locID = Number(localStorage.locID);
	validateLocation();
	//Populate page with Top Spotts
	$('$page').fadeOut('fast');
	getTop();
	$('$page').fadeIn('fast');
}

function selectUni(id){
	//Save Uni Selection
	localStorage.uniID = id;
	//Load Uni Locations
	$('$page').fadeOut('fast');
	getLocList(id);
	$('$page').fadeIn('fast');
}

function selectLoc(id){
	//Save Location Selection
	localStorage.locID = id;
	//Load Location Spotts
	loadSpotts();
}

function setLayout(){
	$(".msg").outerHeight(function(){
		var minH = 40;
		var maxH = 120;
		var score = Number($(this).attr("data-score"));
		return minH + ((score>maxH)?maxH:score);
	});
	
	$(".spot").outerWidth(function(){
		var minW = 130;
		var maxW = 230;
		var score = Number($(this).attr("data-score"));
		return minW + ((score>maxW)?maxW:score);
	});
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

function newUser(){
	location.id = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
						var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
						return v.toString(16);
					});
}