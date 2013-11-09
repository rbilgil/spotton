<?php

namespace Spotton;

class Spots implements DataInterface
{
	/*
	*	Creates a new Spot using given text and location, and saves it to database
	*	@param string $text the Spot Text
	*	@param string $location lat/lon of Spot
	*	@returns stdClass $spot
	*/
	public function new($text, Location $location) 
	{

	}
	/*
	*	Deletes a given spot from database using its ID
	*	@param int $spotID The ID number of the spot
	*	@returns true if spot deleted successfully
	*/
	public function delete($spotID)
	{

	}

	/*
	*	Gets a specific spot using its ID
	*	@param int $spotID The ID number of the spot
	*	@returns stdClass $spot
	*
	*/
	public function get($spotID)
	{

	}

	/*
	*	Increases the rank of a given spot using its ID
	*	@param int $spotID The ID number of the spot
	*	@returns true if upvoted successfully
	*/
	public function upVote($spotID)
	{

	}

	/*
	*	Gets all spots posted up to the number of days provided
	*	@param int $numDays number of days to get spots for
	*	@returns array $spots the array of stdClass objects for spots
	*/
	public function getAll($numDays)
	{

	}

}