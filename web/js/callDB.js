
var url = "http://www.spotton.co/web/api.php";

function validateLocation(){
	if(located){
		$.post(url+"/validateLocation",
		{
			latitude:lat,
			longitude:lon,
			universityID:uniID,
			locationID:locID
		},
		function(data,status){
			//IF TRUE: 
			//	FADE IN SPOTT FORM
			console.log(data);
			if(JSON.parse(data).StatusCode=='0'){
				$("#form").fadeIn();
			} else {
				$("#form").fadeOut();
			}
		});
	}
}

function addSpot(message){
	console.log(lat+" "+lon+" "+uniID+" "+locID+" "+message);
	$.post(url+"/addSpot",
	{
		latitude:lat,
		longitude:lon,
		universityID:uniID,
		locationID:locID,
		message:message
	},
	function(data,status){
		loadSpotts();
	});
}

function addComment(id,message){
	$.post(url+"/addComment",
	{
		spotID:id,
		message:message
	},
	function(data,status){
		alert("Data: " + data + "\nStatus: " + status);
	});
}

function deleteSpot(id){
	$.get(url+"/deleteSpot"+id,
	function(data,status){
		alert("Data: " + data + "\nStatus: " + status);
	});
}

function deleteComment(id){
	$.get(url+"/deleteComment"+id,
	function(data,status){
		alert("Data: " + data + "\nStatus: " + status);
	});
}

function rateSpot(id){
	$.post(url+"/upVoteSpot",
	{
		spotID:id,
		uniqueID:localStorage.id
	},
	function(data,status){
		loadSpotts();
	});
}

function rateComment(id){
	$.get(url+"/rateComment"+id,
	function(data,status){
		alert("Data: " + data + "\nStatus: " + status);
	});
}

function getTop(){
	var days = 3;
	
	$.post(url+"/getTop/"+days,
	{
		universityID:uniID,
		locationID:locID
	},
	function(data,status){
		showSpots(JSON.parse(data));
	});
}

function getLatest(){
	var days = 3;
	
	$.post(url+"/getLatest/"+days,
	{
		universityID:uniID,
		locationID:locID
	},
	function(data,status){
		showSpots(JSON.parse(data));
	});
}

function countComments(spotID){
	$.get(url+"/getComment/"+spotID,
	function(data,status){
		commentN = JSON.parse(data).length;
	});
}

function getComments(spotID){
	$.get(url+"/getComment/"+spotID,
	function(data,status){
		alert("Data: " + data + "\nStatus: " + status);
	});
}

function getUniList(){
	$.get(url+"/getUniList",
	function(data,status){
		showUniList(JSON.parse(data));
	});
}

function getLocList(){
	uniID = Number(localStorage.uniID);
	$.get(url+"/getLocationList/"+uniID,
	function(data,status){
		showLocList(JSON.parse(data));
	});
}
