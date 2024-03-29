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
	public function create($spotID, $message) 
	{
		if (strlen($message) > self::CHAR_LIMIT) {
			return false;
		}

		$query = "INSERT INTO {$this->table} (spotID, message) VALUES (:spotID, :message)";

		$bind=array(':spotID' => $spotID, ':message' => $message);

		$result=Database::query($query, $bind);

		return $this->get($result->lastID);
	}
	
	/*
	*	Gets all Spot/Comments posted up to the number of days provided
	*	@param int $numDays number of days to get Spot/Comments for
	*	@returns array $Spot/Comments the array of stdClass objects for Spot/Comments
	*/

	public function getAllRecent($spotID)
	{
		$query = "SELECT * FROM {$this->table} WHERE spotID=:spotID";
		$bind=array(':spotID' => $spotID);

		return Database::query($query, $bind);
	}

	public function getAllTop($spotID)
	{
		$commentsList=$this->getAllRecent($spotID);
		
		if (!is_array($commentsList)) {
			
			if ($commentsList->lastID==0) {
				return false;	
			} else {
				$comments[0]=$commentsList;
			}
		} else {
			$comments=$commentsList;
		}
		
		return Ranker::rank($comments);
	}
	
}