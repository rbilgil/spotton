<?php

namespace Spotton;

class Queries extends ConnectToDB
{
	private $table;
	private $id;
	
	public function __construct($id,$tableName){
		$this->$id = $id;
		$table = $tableName;
	}
	
	/*
	*	Deletes a given Spot/Comment from database using its ID
	*	@param int $id The ID number of the Spot/Comment
	*	@returns true if Spot/Comment deleted successfully
	*/
	public function delete($id)
	{
		$con = connectToDB();

		$id = mysqli_real_escape_string ( $con , $id );

		$result = mysqli_query($con,"DELETE FROM $table"
						 ."WHERE id='$id'");

		mysqli_close($con);
		
		return $result;
	}

	/*
	*	Increases the rank of a given Spot/Comment using its ID
	*	@param int $id The ID number of the Spot/Comment
	*	@returns true if upvoted successfully
	*/
	public function upVote($id)
	{
		$con = connectToDB();

		$id = mysqli_real_escape_string ( $con , $id );

		$result = mysqli_query($con,"UPDATE $table SET spottons = spottons + 1"
						 ."WHERE id='$id'");

		mysqli_close($con);
		
		return $result;
	}
	
	/*
	*	Gets a specific Spot/Comment using its ID
	*	@param int $id The ID number of the Spot/Comment
	*	@returns stdClass $Spot/Comment
	*
	*/
	public function get($id)
	{
		$con = connectToDB();

		$id = mysqli_real_escape_string ( $con , $id );

		$result = mysqli_query($con,"SELECT * FROM $table"
									."WHERE id='$id'");
														 
		$array = mysqli_fetch_array($result);

		mysqli_close($con);

		return $array;
	}

}