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

	public function testGetUniversityList()
	{
		$location=new Location($this->lat, $this->lon);
		$list=$location->getUniversityList();
		
		if (!is_array($list)) {
			$l[0]=$list;
		} else {
			$l=$list;
		}

		$this->assertObjectHasAttribute('id', $l[0], 'University list not obtained correctly');
		return $l[0];
	}

	public function testGetLocationList()
	{
		$unis=$this->testGetUniversityList();
		$location=new Location($this->lat, $this->lon);
		$list=$location->getLocationList($unis->id);

		if (!is_array($list)) {
			$l[0]=$list;
		} else {
			$l=$list;
		}

		$this->assertObjectHasAttribute('id', $l[0], 'Location list not obtained correctly');
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

		$avenueCampus=new Location(50.928344,-1.402133);
		$isInRange=$avenueCampus->inRange(1, 1);
		$this->assertFalse($isInRange);

		$highfieldCampus=new Location(50.935282,-1.398421);
		$isInRange=$highfieldCampus->inRange(1,1);
		$this->assertTrue($isInRange);

	}

}