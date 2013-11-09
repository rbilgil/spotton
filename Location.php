<?php

namespace Spotton;

class Location
{

	private $locationString

	public function __construct($locationString)
	{
		$this->locationString=$locationString;
	}

	public function getCurrentLocation()
	{
		return $this->locationString;
	}

	public function inRange($locationID, $universityID)
	{

	}

}