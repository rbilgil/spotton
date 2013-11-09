
function showSpots(spots){
	$("#page").html("");
	spots = spots.spots;
	if(spots.length !== undefined){
		for(i=0;i<spots.length;i++){
			addSpotDiv(spots[i]);
		}
	} else {
		addSpotDiv(spots);
	}
	setLayout();
}

var commentN = 0;
function addSpotDiv(s){
	countComments(s.id);
	var spot = "";
	spot += '<div class="spot curve" id="'+s.id+'" data-time="'+s.time+'" data-score="'+s.score+'">';
	spot += '<div class="msg" data-score="'+s.score+'">'+s.message+'</div>';
	spot += '<div class="time">'+timeDiff(s.time)+'</div>';
	spot += '<div class="info">';
		spot += '<div class="upVote" onclick="upVote('+s.id+');">Spott</div>';
		spot += '<div class="rating">'+s.rating+'</div>';
		spot += '<div class="commentNum" onclick="toComment('+s.id+');">'+commentN+'</div>';
	spot += '</div>';
	spot += '<div class="arrow"></div>';
	spot += '</div>';
	$("#page").append(spot);
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
	setLayout();
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
	setLayout();
}

function timeDiff(timestamp){
	var spotDate = new Date(timestamp);
	var ms = (new Date())-spotDate;
	var mins = (ms/1000)/60;
	if(mins < 1){
		return "Just now";
	} else if(mins < 60){
		return Math.round(mins) + (mins==1?" min":" mins") + " ago";
	} else {
		hours = mins/60;
		if(hours < 24){
			return Math.round(hours) + (hours==1?" hour":" hours") + " ago"
		} else {
			days = hours/24;
			return Math.round(days) + (days==1?" day":" days") + " ago"
		}
	}
}