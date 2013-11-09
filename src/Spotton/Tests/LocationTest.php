<?php

namespace Spotton;

use PHPUnit_Framework_TestCase;

class LocationTest extends PHPUnit_Framework_TestCase
{

	private $lat;
	private $lon;

	private $location;

	public function setUp()
	{
		$this->lat=50.93612;
		$this->lon=-1.3964298;
	}

	public function testGetCurrentLocation()
	{
		$location=new Location($this->lat, $this->lon);
		$this->assertLatAndLonGiven($location);	
	}

	private function assertLatAndLonGiven(Location $location)
	{
		$latlon=$location->getCurrentLocation();

		$this->assertObjectHasAttribute("lat", $latlon, "No latitude found");
		$this->assertObjectHasAttribute("lon", $latlon, "No longitude found");
	}

	public function testInRange()
	{
		$campus=new Location($this->lat, $this->lon);
		$isInRange=$campus->inRange(1, 1);
		$this->assertTrue($isInRange);

		$equator=new Location(0,0);
		
		$isInRange=$equator->inRange(1, 1);
		$this->assertFalse($isInRange);
	}

}