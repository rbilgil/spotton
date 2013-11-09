<?php

namespace Spotton;

use stdClass;

class Location
{

	private $lat;
	private $lon;

	public function __construct($lat, $lon)
	{
		$this->lat=$lat;
		$this->lon=$lat;
	}

	public function getCurrentLocation()
	{
		$location=new stdClass();
		$location->lat=$this->lat;
		$location->lon=$this->lon;

		return $location;
	}

	public function inRange($locationID, $universityID)
	{

	}

}