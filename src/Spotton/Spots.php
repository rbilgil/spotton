<?php

namespace Spotton;

class Spots extends Queries
{

	const CHAR_LIMIT=140;
	
	public function __construct()
	{
		parent::__construct("spots");
	}
	
	/*
	*	Creates a new Spot/Comment using given text and location, and saves it to database
	*	@param string $message the Spot/Comment Text
	*	@param string $location lat/lon of Spot/Comment
	*	@returns stdClass Spot/Comment
	*/
	public function create($message, Location $location)
	{
		if (strlen($message) > self::CHAR_LIMIT) {
			return false;
		}

		$universityID=$location->getUniversityID();
		$locationID=$location->getLocationID();

		$query = "INSERT INTO {$this->table} (message, locationID) VALUES (:message, :loc)";

		$bind=array(':message' => $message, ':loc' => $locationID);

		$result=Database::query($query, $bind);

		return $this->get($result->lastID);
	}

	/*
	*	Gets all Spot/Comments posted up to the number of days provided
	*	@param int $numDays number of days to get Spot/Comments for
	*	@returns array $Spot/Comments the array of stdClass objects for Spot/Comments
	*/
	public function getAllRecent($numDays)
	{
		$dateTimeString = "-".$numDays." days";
		$daysAgo=strtotime($dateTimeString);

		$query = "SELECT * FROM {$this->table} WHERE time >= :timePeriod";
		$bind=array(':timePeriod' => $daysAgo);

		return Database::query($query, $bind);
	}

	public function getAllTop($numDays)
	{
		$spots=$this->getAllRecent($numDays);

		return RankedSpots::rankSpots($spots);
	}
	
}