
function showSpots(spots){
	$("#page").html("");
	spotN = 1;
	spots = spots.spots;
	if(spots.length !== undefined){
		for(i=0;i<spots.length;i++){
			addSpotDiv(spots[i]);
		}
	} else {
		addSpotDiv(spots);
	}
	$('#page').fadeIn('fast');
	validateLocation();
}

var commentN = 0;
var spotN = 1;
function addSpotDiv(s){
	countComments(s.id);
	var spot = "";
	var align = "";
	if(spotN%2 == 1){
		align = "single-box-left";
	} else {
		align = "single-box-right";
	}
	spot += '<div class="'+align+' single-box grid-50 mobile-grid-100">';
	spot +=   '<div class="date">'+timeDiff(s.time)+'</div>';
	spot +=   '<p>'+s.message+'</p>';
	spot +=   '<div class="box-footer">';
	spot += 	'<a href="#" class="btn-spot_on">Spott on!</a>';
	spot += 	'<a href="#" class="upvote-count">'+s.rating+'</a>';
	spot +=   '</div>';
	spot += '</div>';
	
	/*
	spot += '<div class="spot curve" id="'+s.id+'" data-time="'+s.time+'" data-ups="'+s.rating+'">';
	spot += '<div class="msg curve" data-ups="'+s.rating+'">'+s.message+'</div>';
	spot += '<div class="info">';
		spot += '<div class="upVote" onclick="upVote('+s.id+');">Spott';
		spot += '<span class="ratingVal"> ('+s.rating+')</span></div>';
		spot += '<div class="time">'+timeDiff(s.time)+'</div>';
		//spot += '<div class="commentNum" onclick="toComment('+s.id+');">'+commentN+'</div>';
	spot += '</div>';
	spot += '<div class="arrow"></div>';
	spot += '</div>';
	*/
	$("#page").append(spot);
	spotN++;
}

function showUniList(list){
	$("#page").html("");
	list = list.universities;
	if(list.length !== undefined){
		for(i=0;i<list.length;i++){
			addUni(list[i]);
		}
	} else {
		addUni(list);
	}
}

function addUni(u){
	var option = "";
	option += '<a href="#" onclick="selectUni('+u.id+'); return false;">'+u.name+'</a>';
	$("#page").append(option);
	$('#page').fadeIn('fast');
}

function showLocList(list){
	$("#page").html("");
	list = list.locations;
	if(list.length !== undefined){
		for(i=0;i<list.length;i++){
			addLoc(list[i]);
		}
	} else {
		addLoc(list);
	}
}

function addLoc(l){
	var option = "";
	option += '<a href="#" onclick="selectLoc('+l.id+'); return false;">'+l.name+'</a>';
	$("#page").append(option);
	$('#page').fadeIn('fast');
}

function timeDiff(timestamp){
	var spotDate = new Date(timestamp);
	var ms = (new Date())-spotDate;
	var mins = (ms/1000)/60;
	if(mins < 1){
		return "Just now";
	} else if(mins < 60){
		return Math.round(mins) + (Math.round(mins)==1?" min":" mins") + " ago";
	} else {
		hours = mins/60;
		if(hours < 24){
			return Math.round(hours) + (Math.round(hours)==1?" hour":" hours") + " ago"
		} else {
			days = hours/24;
			return Math.round(days) + (Math.round(days)==1?" day":" days") + " ago"
		}
	}
}