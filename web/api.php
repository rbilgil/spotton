<?php

require_once __DIR__.'/../vendor/autoload.php';

use Spotton\Spots;
use Spotton\Comments;
use Spotton\Location;

$app=new Silex\Application();

$location=new Location(0,0);
$spots=new Spots();
$comments=new Comments();

$app->match("/getUniList", function() use ($location) {
	
	$resultMessage["universities"]=$location->getUniversityList();
	
	return json_encode($resultMessage);
});

$app->match("/getLocationList/{uniId}", function($uniId) use ($location) {

	$resultMessage["locations"]=$location->getLocationList($uniId);
	
	return json_encode($resultMessage);
});


$app->post("/addSpot", function() use ($spots) {

	$message=filter_input($_POST["message"],FILTER_SANITIZE_STRING);
	$lat=filter_input($_POST["latitude"], FILTER_VALIDATE_FLOAT); 
	$lon=filter_input($_POST["longitude"], FILTER_VALIDATE_FLOAT);
	$locationID=filter_input($_POST["locationID"], FILTER_VALIDATE_INT);
	$universityID=filter_input($_POST["universityID"], FILTER_VALIDATE_INT);

	$location = new Location($lat, $lon);

	if ($location->inRange($locationID, $universityID)) {

		$newMessage = $spots->create($message, $location);

		if ($newMessage !== false) {
			$newMessage->StatusCode=0;
		} else {
			$newMessage->StatusCode=403;
			$newMessage->StatusMsg="Message exceeds character length";
		}

	} else {
		$newMessage=new stdClass;
		$newMessage->StatusMsg="Location too far from target";
		$newMessage->StatusCode=999;
	}
        $resultMessage=[];
	$resultMessage["spots"][0]=$newMessage;
	
	return json_encode($resultMessage);

});

$app->post("/addComment", function() use ($comments) {

	$message=filter_input($_POST["message"],FILTER_SANITIZE_STRING);
	$spotID=filter_input($_POST["spotID"],FILTER_VALIDATE_INT);

	$newMessage = $comments->create($spotID, $message);

	if ($newMessage !== false) {
		$newMessage->StatusCode=0;
	} else {
		$newMessage->StatusCode=403;
		$newMessage->StatusMsg="Message exceeds character length";
	}
        $resultMessage=[];
	$resultMessage["comments"][0]=$newMessage;
	
	return json_encode($resultMessage);
});

$app->match("/getSpot/{spotId}", function($spotId) {
	$spot=new Spots();
        $resultMessage=[];
	$resultMessage["spots"][0]=$spot->get($spotId);
	return json_encode($resultMessage);
});

$app->match("/getComment/{commentId}", function($commentId) use ($comments) {

        $resultMessage=[];
	$resultMessage["comments"][0]=$comments->get($commentId);
	return json_encode($resultMessage);
});

$app->match("/deleteSpot/{spotId}", function($spotId) use ($spots) {
	$result=new stdClass;

	if ($spots->delete($spotId)) {
		$result->StatusCode=0;
	} else {
		$result->StatusCode=999;
		$result->StatusMsg="Could not delete spot";
	}

	return json_encode($result);
});

$app->match("/deleteComment/{commentId}", function($commentId) use ($comments) {
	$result=new stdClass;

	if ($comments->delete($commentId)) {
		$result->StatusCode=0;
	} else {
		$result->StatusCode=999;
		$result->StatusMsg="Could not delete comment";
	}

	return json_encode($result);
});


$app->post("/getLatest/{numDays}", function($numDays) use ($spots) {
	$resultMessage["spots"]=$spots->getAllRecent($numDays);
	return json_encode($resultMessage);
});

$app->post("/getTop/{numDays}", function($numDays) use ($spots) {
	$resultMessage["spots"]=$spots->getAllTop($numDays);
	return json_encode($resultMessage);
});

$app->match("/getLatestComments/{spotId}", function($spotId) use ($comments) {
	$resultMessage["comments"]=$comments->getAllRecent($spotId);
	return json_encode($resultMessage);
});

$app->match("/getTopComments/{spotId}", function($spotId) use ($comments) {
	$resultMessage["comments"]=$comments->getAllTop($spotId);
	return json_encode($resultMessage);
});



$app->post("/validateLocation", function() {
	
	$lat=filter_input($_POST["latitude"], FILTER_VALIDATE_FLOAT); 
	$lon=filter_input($_POST["longitude"], FILTER_VALIDATE_FLOAT);
	$locationID=filter_input($_POST["locationID"], FILTER_VALIDATE_INT);
	$universityID=filter_input($_POST["universityID"], FILTER_VALIDATE_INT);

	$location=new Location($lat, $lon);
	$status=new stdClass();

	if ($location->inRange($locationID, $universityID)) {
		
		$status->StatusCode=0;
		
	} else {
		$status->StatusCode=999;
	}

	return json_encode($status);
});

$app->run();