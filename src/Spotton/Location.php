<?php

namespace Spotton;

use stdClass, PDO;

/*
*	This class takes in a lat/lon in its constructor, which serves as the location of the user
*	Main purpose is to validate that the user is within the range required to be eligible to post a spot
*/

class Location
{

	const EARTH_RADIUS=6371; //in km, needed for distance calculation
	private $lat;
	private $lon;
	
	/*
	*	Constructor that sets the lat/lon of the user
	*
	*/
	public function __construct($lat, $lon)
	{
		$this->lat=$lat;
		$this->lon=$lon;
	}
	
	/*
	*	Gets the current location of the user
	*	@returns stdClass $location the location object
	*/
	public function getCurrentLocation()
	{
		$location=new stdClass();
		$location->lat=$this->lat;
		$location->lon=$this->lon;

		return $location;
	}

	/*
	*	Checks if the user is in range of the location and university that we are spotting for
	*	@param int $locationID the ID of the location
	*	@param int $universityID the ID of the university
	*	@returns bool $isInRange Whether the user is in range or not
	*/
	public function inRange($locationID, $universityID)
	{
		$location=$this->getLocation($locationID, $universityID);
		$distance=$this->calcDistFromUser($location);
		$isInRange=$distance <= $location->distance;
		return $isInRange;
	}

	private function calcDistFromUser(stdClass $location)
	{
		//A way of calculating distance between two lat/lon coordinates using equirectangular projection approximation

		$latRad=deg2rad($location->latitude);
		$lonRad=deg2rad($location->longitude);
		$userLatRad=deg2rad($this->lat);
		$userLonRad=deg2rad($this->lon);

		$lonDifference=$userLonRad-$lonRad;
		$cosTerm=cos(($latRad+$userLatRad)/2);
		$x=$lonDifference*$cosTerm;
		$y=$userLatRad-$latRad;

		$distance=sqrt($x*$x + $y*$y)*self::EARTH_RADIUS;

		return $distance;
	}

	private function getLocation($locationID, $universityID)
	{
		$query="SELECT * from locations WHERE id=:id AND UniID=:uniID";
		$connection=$this->connectToDB();
		$statement=$connection->prepare($query);
		
		$statement->execute(array(':id'=>$locationID, ':uniID' => $universityID));

		return $statement->fetch(PDO::FETCH_OBJ);
	}

	private function connectToDB()
	{
		$dsn="mysql:dbname=spotton;host=localhost";
		$username="spotton";
		$password="quackathon";
		
		$connection=null;

		try {

			$connection=new PDO($dsn, $username, $password);

		} catch (PDOException $e) {

			die("Locations database connection failed!".$e->getMessage());
			
		}

		return $connection;
	}

}