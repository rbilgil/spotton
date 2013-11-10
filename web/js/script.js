
var uniID;
var locID;

$(function(){
	
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
	getTop();
}

function selectUni(id){
	//Save Uni Selection
	localStorage.uniID = id;
	//Load Uni Locations
	getLocList(id);
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
	
}