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
		if ($highfield->inRange(1,1)) {
			$this->spot=$spots->create("Test Spot", $highfield);	
		} else {
			$this->spot=new \stdClass;
		}
		
		$this->comments=new Comments;
	}
	
	public function testCreate() 
	{
		//testing case of exceeding characters
		$comment=$this->createComment("Too many characters in this message, haha it's gonna be hard to exceed it because I don't have a whole lot of things to type lol! Anyway I should probably go now");
		$this->assertFalse($comment);

		//normal case
		$comment=$this->createComment();
		$this->assertObjectHasAttribute('id', $comment, 'Comment not created properly');
	}

	public function testDelete()
	{
		$comment=$this->createComment();

		$this->assertTrue($this->comments->delete($comment->id));
	}

	private function createComment($message="Test Comment")
	{
		return $this->comments->create($this->spot->id, $message);
	}

	public function testGet()
	{
		$comment=$this->createComment();
		$newComment=$this->comments->get($comment->id);

		$this->assertObjectHasAttribute('id', $newComment, 'No ID found in Comment');
	}

	public function testUpVote()
	{
		$comment=$this->createComment();
		
		$previousVotes=$comment->rating;

		$this->assertTrue($this->comments->upVote($comment->id,"SOMERANDOMID"));

		$newComment=$this->comments->get($comment->id);
        
		$newVotes=$newComment->rating;
		$this->assertEquals($newVotes-$previousVotes, 1);
        
        $this->assertFalse($this->comments->upVote($comment->id,"SOMERANDOMID"));
	}

	public function testGetAllRecent()
	{
		for ($i=0; $i<5; $i++) {
			$this->createComment();
		}
		$this->assertContainsOnlyInstancesOf('stdClass', $this->comments->getAllRecent($this->spot->id, 3));
	}

	public function testGetAllTop() 
	{
		for ($i=0; $i<5; $i++) {
			$this->createComment();
		}

		$this->assertContainsOnlyInstancesOf('stdClass', $this->comments->getAllTop($this->spot->id, 3));
	}

}