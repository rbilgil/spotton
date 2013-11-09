<?php

namespace Spotton;

use stdClass, PDO;

/*
*	This class connects to the Spotton DB and can execute queries
*/

class Database
{
	/*
	*	Connect to spotton db - we persist the connection using ATTR_PERSISTENT to speed up connection via caching
	*	@param return PDO $connection The PDO connection object
	*/
	public static function connect()
	{
		$dsn="mysql:dbname=spotton;host=localhost";
		$username="spotton";
		$password="quackathon";
		
		$connection=null;

		try {

			$connection=new PDO($dsn, $username, $password, array(PDO::ATTR_PERSISTENT => true));

		} catch (PDOException $e) {

			die("Database connection failed! ".$e->getMessage());
			
		}

		return $connection;
	}

	/*
	*	Query the database and return result
	*	@param string $query the query string
	*	@param array $bind the array of variables to bind to query
	*	@return stdClass object or array $results Array of the results if more than one result, single object if one result
	*/
	public static function query($query, array $bind)
	{
		$connection=self::connect();
		$statement=$connection->prepare($query);
		try {
			$statement->execute($bind);
		} catch (PDOException $e) {
			return false;
		}
		
		$result = $statement->fetchAll(PDO::FETCH_OBJ);

		//If there is only a single result, it's stored in a single-element array. If so, we return the element instead of the array
		if (count($result) === 1) {
			return $result[0];
		} else {
			return $result;
		}
	}

}