<?php

namespace Spotton;

class Spots extends Queries
{
	
	public function __construct()
	{
		parent::__construct("spots");
	}
	
		/*
	*	Creates a new Spot/Comment using given text and location, and saves it to database
	*	@param string $text the Spot/Comment Text
	*	@param string $location lat/lon of Spot/Comment
	*	@returns stdClass $Spot/Comment
	*/
	public function create($text, Location $location)
	{
		$universityID=$location->getUniversityID();
		$locationID=$location->getLocationID();
		$startRating=0;
	
		$query = "INSERT INTO :table (text, universityID, locationID, rating) VALUES (:text,  :uni, :loc, :rating)";
	
		$bind = array(':table' => $this->table, ':text' => $text, ':uni' => $universityID, ':loc' => $locationID, ':rating' => $startRating);

		return Database::query($query, $bind);
	}
	
	/*
	*	Gets all Spot/Comments posted up to the number of days provided
	*	@param int $numDays number of days to get Spot/Comments for
	*	@returns array $Spot/Comments the array of stdClass objects for Spot/Comments
	*/
	public function getAll($numDays)
	{
		$timePeriod = strtotime($timeAgo);

		$query = "SELECT * FROM $table WHERE time > :timePeriod";
		$bind=array(':timePeriod' => $timePeriod);

		return Database::query($query, $bind);
	}
	
}