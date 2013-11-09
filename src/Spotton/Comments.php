<?php

namespace Spotton;

class Comments extends Queries {
	
	private $this->connection;
	
	public function __construct() 
	{
		parent::__construct("comments");
		$this->spotID = $spotID;
	}
	
	/*
	*	Creates a new Spot/Comment using given text and location, and saves it to database
	*	@param string $text the Spot/Comment Text
	*	@param string $location lat/lon of Spot/Comment
	*	@returns stdClass $Spot/Comment
	*/
	public function create($spotID, $text, Location $location) 
	{
		$lat  = $location->latitude;
		$lon  = $location->longitude;
		$dist = $location->distance;
	
		$query="INSERT INTO :table (spot, comment, latitude, longitude, distance)"
						 ."VALUES (:spotID, :text, :lat, :lon, :dist)";

		$bind=array(':table' => $this->table, ':spotID' => $spotID, ':text' => $text, ':lat' => $lat, ':lon' => $lon, ':dist' => $dist);

		return Database::query($query, $bind);
	}
	
	/*
	*	Gets all Spot/Comments posted up to the number of days provided
	*	@param int $numDays number of days to get Spot/Comments for
	*	@returns array $Spot/Comments the array of stdClass objects for Spot/Comments
	*/
	public function getAll($spotID, $numDays)
	{
		$timePeriod = strtotime($timeAgo);
		
		$query="SELECT * FROM :table WHERE time > :timePeriod AND spot = :spotID";
		$bind=array(':table' => $this->table, ':timePeriod' => $timePeriod, ':spotID' => $spotID);

		return Database::query($query, $bind);
	}
	
}