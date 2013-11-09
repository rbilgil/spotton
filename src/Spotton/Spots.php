<?php

namespace Spotton;

class Spots extends Queries {
	
	public function __construct($id,$spotID){
		parent::__construct($id,"spots");
	}
	
		/*
	*	Creates a new Spot/Comment using given text and location, and saves it to database
	*	@param string $text the Spot/Comment Text
	*	@param string $location lat/lon of Spot/Comment
	*	@returns stdClass $Spot/Comment
	*/
	public function new($text, Location $location)
	{
		$con = connectToDB();
	
		$text = mysqli_real_escape_string ( $con , $text );
		$lat  = $location->latitude;
		$lon  = $location->longitude;
		$dist = $location->distance;
	
		mysqli_query($con,"INSERT INTO $table (comment, latitude, longitude, distance)"
						 ."VALUES ('$text', '$lat', '$lon', '$dist')");	
	
		mysqli_close($con);
	}
	
	/*
	*	Gets all Spot/Comments posted up to the number of days provided
	*	@param int $numDays number of days to get Spot/Comments for
	*	@returns array $Spot/Comments the array of stdClass objects for Spot/Comments
	*/
	public function getAll($numDays)
	{
		$con = connectToDB();

		$timePeriod = strtotime($timeAgo);

		$result = mysqli_query($con,"SELECT * FROM $table"
									."WHERE $time>$timePeriod");
														 
		$array = array();
		while($row = mysqli_fetch_array($result)){
			$array[] = $row;
		}
		
		mysqli_close($con);
		
		return $array;
	}
	
}