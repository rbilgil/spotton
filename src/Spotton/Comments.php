<?php

namespace Spotton;

class Comments extends Queries {

	const CHAR_LIMIT=140;
	
	public function __construct() 
	{
		parent::__construct("comments");
	}
	
	/*
	*	Creates a new Spot/Comment using given text and location, and saves it to database
	*	@param string $text the Spot/Comment Text
	*	@param string $location lat/lon of Spot/Comment
	*	@returns stdClass $Spot/Comment
	*/
	public function create($spotID, $text, Location $location) 
	{
		if (strlen($message) > self::CHAR_LIMIT) {
			return false;
		}

		$locationID=$location->getLocationID();

		$query = "INSERT INTO {$this->table} (spotID, message, locationID) VALUES (:spotID, :message, :loc)";

		$bind=array(':spotID' => $spotID, ':message' => $message, ':loc' => $locationID);

		$result=Database::query($query, $bind);

		return $this->get($result->lastID);
	}
	
	/*
	*	Gets all Spot/Comments posted up to the number of days provided
	*	@param int $numDays number of days to get Spot/Comments for
	*	@returns array $Spot/Comments the array of stdClass objects for Spot/Comments
	*/

	public function getAllRecent($spotID, $numDays)
	{
		$dateTimeString = "-".$numDays." days";
		$daysAgo=strtotime($dateTimeString);

		$query = "SELECT * FROM {$this->table} WHERE spotID=':spotID' AND time >= :timePeriod";
		$bind=array(':spotID' => $spotID, ':timePeriod' => $daysAgo);

		return Database::query($query, $bind);
	}

	public function getAllTop($spotID, $numDays)
	{
		$comments=$this->getAllRecent($numDays);

		return RankedSpots::rankSpots($comments);
	}
	
}