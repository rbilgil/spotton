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

$app->get("/getspot/{spotId}", function($spotId) {
	$spot=new Spots();
	return json_encode($spot->get($spotId));
});

$app->get("/getrecentspots/{numDays}", function($numDays) {
	$spot=new Spots();
	return json_encode($spot->getAllRecent($numDays));
});

$app->get("/gettopspots/{numDays}", function($numDays) {
	$spot=new Spots();
	return json_encode($spot->getAllTop($numDays));
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