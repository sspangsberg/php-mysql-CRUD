<?php

namespace DataAccess;

require( "constants.php" );

class DBConnector
{
	function connectToDB()
	{
		$link = new \PDO(
			'mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ';charset=utf8mb4',
			DB_USER,
			DB_PASS,
			array(
				\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
				\PDO::ATTR_PERSISTENT => false
			)
		);

		return $link;
	}
}