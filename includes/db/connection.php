<?php
require( "constants.php" );


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

/*
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS);

if (!$connection) {
    die("Database connection error!");
}

$db_select = mysqli_select_db($connection, DB_NAME);

if (!$db_select){
    die("Database error: " . mysqli_error($connection));
}
*/