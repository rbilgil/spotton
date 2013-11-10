<?php

namespace Spotton;

class Queries
{
	protected $table;
	
	public function __construct($tableName) 
	{
		$this->table = $tableName;
	}
	
	/*
	*	Deletes a given Spot/Comment from database using its ID
	*	@param int $id The ID number of the Spot/Comment
	*	@returns true or false depending on success/failure
	*/
	public function delete($id)
	{
		$spot=$this->get($id);
		
		if ($this->hasAMinutePassed($spot)) {
			return false;
		}

		$query="DELETE FROM {$this->table} WHERE id=:id";
		$bind=array(':id' => $id);

		if (Database::query($query, $bind) !== false) {
			return true;
		} else {
			return false;
		}
	}

	private function hasAMinutePassed($spot)
	{
		$date=new \DateTime();
		$now=$date->getTimeStamp();
		
		if (strtotime($now) - strtotime($spot->time) > strtotime("1 minute")) {
			return true;
		}
	}

	/*
	*	Increases the rank of a given Spot/Comment using its ID
	*	@param int $id The ID number of the Spot/Comment
	*	@returns true or false depending on success/failure
	*/
	public function upVote($id, $uniqueID)
	{
        $queryCheckPrevious = "SELECT * FROM upvoted{$this->table} WHERE id=:id AND userID=:uniqueID";
        $bindUnique=array(':id' => $id, ':uniqueID' => $uniqueID);
        
        $previousUpvotesOnSamePost=Database::query($queryCheckPrevious, $bindUnique);
        if (!isset($previousUpvotesOnSamePost->lastID) or $previousUpvotesOnSamePost->lastID!=0) {
            return false;
        }
        
		$query = "UPDATE {$this->table} SET rating = rating + 1 WHERE id=:id";
        $bind=array(':id' => $id);
        
        $queryUnique= "INSERT INTO upvoted{$this->table} (id, userID) VALUES (:id, :uniqueID)";
		if (Database::query($query, $bind) !== false && Database::query($queryUnique, $bindUnique) !== false) {
			return true;
		} else {
			return false;
		}
	}
	
	/*
	*	Gets a specific Spot/Comment using its ID
	*	@param int $id The ID number of the Spot/Comment
	*	@returns stdClass Spot/Comment
	*
	*/
	public function get($id)
	{
		$query="SELECT * FROM {$this->table} WHERE id={$id}";
		$bind=array();

		$spot = Database::query($query, $bind);
		$spot->score=Ranker::getScore($spot);
		return $spot;

	}
}