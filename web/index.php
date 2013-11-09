<?php

require_once __DIR__.'/../vendor/autoload.php';

use Spotton\Spots;
use Spotton\Location;

$app=new Silex\Application();

$app->post("/addSpot", function() {

	$message=$_POST["message"];
	$lat=$_POST["latitude"];
	$lon=$_POST["longitude"];
	$locationID=$_POST["locationID"];
	$universityID=$_POST["universityID"];

	$spot = new Spots();
	$location = new Location($lat, $lon);

	if ($location->inRange($locationID, $universityID)) {

		$newMessage = $spot->create($message, $location);

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

	$resultMessage["spots"][0]=$newMessage;
	
	return json_encode($resultMessage);

});

$app->get("/getSpot/{spotId}", function($spotId) {
	$spot=new Spots();
	$resultMessage["spots"][0]=$spot->get($spotId);
	return json_encode($resultMessage);
});

$app->get("/deleteSpot/{spotId}", function($spotId) {
	$spot=new Spots();
	$result=new stdClass;

	if ($spot->delete($spotId)) {
		$result->StatusCode=0;
	} else {
		$result->StatusCode=999;
		$result->StatusMsg="Could not delete spot";
	}

	return json_encode($result);
});

$app->get("/getLatest/{numDays}", function($numDays) {
	$spot=new Spots();
	$resultMessage["spots"]=$spot->getAllRecent($numDays);
	return json_encode($resultMessage);
});

$app->get("/getTop/{numDays}", function($numDays) {
	$spot=new Spots();
	$resultMessage["spots"]=$spot->getAllTop($numDays);
	return json_encode($resultMessage);
});

$app->post("/validateLocation", function() {
	
	$lat=$_POST["latitude"];
	$lon=$_POST["longitude"];
	$locationID=$_POST["locationID"];
	$universityID=$_POST["universityID"];

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