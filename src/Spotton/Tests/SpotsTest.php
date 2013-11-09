<?php

namespace Spotton;

use PHPUnit_Framework_TestCase;

class SpotsTest extends PHPUnit_Framework_TestCase
{

	private $spots;

	public function setUp()
	{
		$this->spots=new Spots;
	}
	
	public function testCreate() 
	{
		//testing case of exceeding characters
		$spot=$this->createSpot("Too many characters in this message, haha it's gonna be hard to exceed it because I don't have a whole lot of things to type lol! Anyway I should probably go now");
		$this->assertFalse($spot);

		$spot=$this->createSpot();
		$this->assertObjectHasAttribute('id', $spot, 'Spot not created properly');
	}

	private function createSpot($message="Test spot")
	{
		$highfield=new Location(50.935282,-1.398421);
		
		if ($highfield->inRange(1,1)) {
			$spot=$this->spots->create($message, $highfield);
		} else {
			$spot=new stdClass;
		}

		return $spot;
	}
	
	public function testDelete()
	{
		$spot=$this->createSpot();

		$this->assertTrue($this->spots->delete($spot->id));
	}

	public function testGet()
	{
		$spot=$this->createSpot();
		$newSpot=$this->spots->get($spot->id);

		$this->assertObjectHasAttribute('id', $newSpot, 'No ID found in Spot');
	}

	public function testUpVote()
	{
		$spot=$this->createSpot();
		
		$previousVotes=$spot->rating;

		$this->assertTrue($this->spots->upVote($spot->id));

		$newSpot=$this->spots->get($spot->id);
		$newVotes=$newSpot->rating;

		$this->assertEquals($newVotes-$previousVotes, 1);
	}

	public function testGetAllRecent()
	{
		$this->spots->getAllRecent(1, 3);
	}

	public function testGetAllTop() 
	{
		$this->assertContainsOnlyInstancesOf('stdClass', $this->spots->getAllTop(1, 3));
	}

}