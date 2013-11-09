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
		$query="DELETE FROM :table WHERE id=:id";
		$bind=array($this->table, $id);

		if (Database::query($query, $bind) !== false) {
			return true;
		} else {
			return false;
		}
	}

	/*
	*	Increases the rank of a given Spot/Comment using its ID
	*	@param int $id The ID number of the Spot/Comment
	*	@returns true or false depending on success/failure
	*/
	public function upVote($id)
	{
		$query = "UPDATE :table SET spottons = spottons + 1 WHERE id=:id";
		$bind=array(':table' => $this->table, ':id' => $id);

		if (Database::query($query, $bind) !== false) {
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

		$query="SELECT * FROM :table WHERE id=:id";
		$bind=array(':table' => $this->table, ':id' => $id);

		return Database::query($query, $bind);
	}

}