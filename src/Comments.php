<?php

namespace Spotton;

class Comments
{
	/*
	*	Creates a new Comment using given text and location, and saves it to database
	*	@param string $text the Comment Text
	*	@param string $location lat/lon of Comment
	*	@returns stdClass $comment
	*/
	public function newComment($text, $location) 
	{

	}
	
	/*
	*	Deletes a given comment from database using its ID
	*	@param int $commentID The ID number of the comment
	*	@returns true if comment deleted successfully
	*/
	public function deleteComment($commentID)
	{

	}

	/*
	*	Gets a specific comment using its ID
	*	@param int $commentID The ID number of the comment
	*	@returns stdClass $comment
	*
	*/
	public function getComment($commentID)
	{

	}

	/*
	*	Increases the rank of a given comment using its ID
	*	@param int $commentID The ID number of the comment
	*	@returns true if upvoted successfully
	*/
	public function upVote($commentID)
	{

	}

	/*
	*	Gets all comments posted up to the number of days provided
	*	@param int $numDays number of days to get comments for
	*	@returns array $comments the array of stdClass objects for comments
	*/
	public function getComments($numDays)
	{

	}

}