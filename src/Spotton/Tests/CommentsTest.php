<?php

namespace Spotton;

use PHPUnit_Framework_TestCase;

class CommentsTest extends PHPUnit_Framework_TestCase
{

	private $comments;
	private $spot;

	public function setUp()
	{
		$spots=new Spots();
		$highfield=new Location(50.935282,-1.398421);
		$this->spot=$spots->create("Test Spot", $highfield);
		$this->comments=new Comments;
	}
	
	public function testCreate() 
	{
		//testing case of exceeding characters
		$comment=$this->comment->createComment($this->spot->id, "Too many characters in this message, haha it's gonna be hard to exceed it because I don't have a whole lot of things to type lol! Anyway I should probably go now");
		$this->assertFalse($comment);

		//normal case
		$comment=$this->comment->createCommment($this->spot->id, "Test comment");
		$this->assertObjectHasAttribute('id', $comment, 'Comment not created properly');
	}

	public function testDelete()
	{
		$comment=$this->createComment();

		$this->assertTrue($this->comment->delete($comment->id));
	}

	public function testGet()
	{
		$spot=$this->spots->create();
		$comment=$this->createComment();
		$newComment=$this->comments->get($comment->id);

		$this->assertObjectHasAttribute('id', $newComment, 'No ID found in Comment');
	}

	public function testUpVote()
	{
		$comment=$this->createComment();
		
		$previousVotes=$comment->rating;

		$this->assertTrue($this->spots->upVote($comment->id));

		$newComment=$this->spots->get($comment->id);
		$newVotes=$newComment->rating;

		$this->assertEquals($newVotes-$previousVotes, 1);
	}

	public function testGetAllRecent()
	{
		$this->spots->getAllRecent(3);
	}

	public function testGetAllTop() 
	{
		$this->assertContainsOnlyInstancesOf('stdClass', $this->spots->getAllTop(3));
	}

}