<?php

namespace Spotton;

use stdClass, PDO;

/*
*	This class takes in a lat/lon in its constructor, which serves as the location of the user
*	Main purpose is to validate that the user is within the range required to be eligible to post a spot
*/

class ConnectToDB
{

	private function connectToDB()
	{
		$dsn="mysql:dbname=spotton;host=localhost";
		$username="spotton";
		$password="quackathon";
		
		$connection=null;

		try {

			$connection=new PDO($dsn, $username, $password);

		} catch (PDOException $e) {

			die("Locations database connection failed!".$e->getMessage());
			
		}

		return $connection;
	}

}