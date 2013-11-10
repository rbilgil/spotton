
var url = "http://www.spotton.co/web/api.php";

function validateLocation(){
	if(located){
		$.post(url+"/validateLocation",
		{
			lat:lat,
			lon:lon,
			universityID:uniID,
			locationID:locID
		},
		function(data,status){
			//IF TRUE: 
			//	FADE IN SPOTT FORM
			if(JSON.parse(data).StatusCode=='0'){
				$("#form").fadeIn();
			}
		});
	}
}

function addSpot(message){
	$.post(url+"/addSpot",
	{
		latitude:lat,
		longitude:lon,
		universityID:uniID,
		locationID:locID,
		message:message
	},
	function(data,status){
		alert("Data: " + data + "\nStatus: " + status);
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
	$.get(url+"/rateSpot"+id,
	function(data,status){
		alert("Data: " + data + "\nStatus: " + status);
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
		alert("Data: " + data + "\nStatus: " + status);
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
