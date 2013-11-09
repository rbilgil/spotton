<?php

require_once __DIR__.'/../vendor/autoload.php';

use Spotton\Spots;
use Spotton\Location;

$app=new Silex\Application();

$app->post("/addspot", function() {

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
	
	return json_encode($newMessage);

});

$app->post("/addcomment/{spotId}", function($spotId) {
	return "Comment Added to spot ID: ".$spotId;
});

$app->post("/validate", function() {
	
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