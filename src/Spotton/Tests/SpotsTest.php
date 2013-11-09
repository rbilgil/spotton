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
		$location=new Location(53.36,-1.3);
		$spot=$this->spots->create("Test spot", $location);	
		
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