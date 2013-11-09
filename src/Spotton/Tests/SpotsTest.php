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
	
	public function testNew() 
	{
		$highfield=new Location(50.935282,-1.398421);
		
		if ($highfield->inRange(1,1)) {
			$spot=$this->spots->create("Test spot", $highfield);
		}
		
		$this->assertObjectHasAttribute('ID', $spot, 'Spot not created properly');
	}
	
	public function testDelete()
	{
		$this->markTestIncomplete("Not implemented yet");
	}

	public function testGet()
	{
		$this->markTestIncomplete("Not implemented yet");
	}

	public function testUpVote()
	{
		$this->markTestIncomplete("Not implemented yet");
	}

	public function testGetAll()
	{
		$this->markTestIncomplete("Not implemented yet");
	}

}