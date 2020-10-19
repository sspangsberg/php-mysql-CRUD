<?php
require( __DIR__ . '/../includes/db/connection.php' );


function getReview($reviewID)
{
	try {
		$cxn = connectToDB();

		$handle = $cxn->prepare( "SELECT * FROM Review WHERE ReviewID = $reviewID" );
		$handle->execute();

		// Using the fetchAll() method might be too resource-heavy if you're selecting a truly massive amount of rows.
		// If that's the case, you can use the fetch() method and loop through each result row one by one.
		// You can also return arrays and other things instead of objects.  See the PDO documentation for details.
		$result = $handle->fetch( \PDO::FETCH_OBJ );

		return $result;
	}
	catch(\PDOException $ex){
		print($ex->getMessage());
	}
}

// Create a new Review (using Prepared Statements)
function createReview($fullName, $contents)
{
	try
	{
		$cxn = connectToDB();

		/*
		 * Dynamic SQL - Vulnerable to SQL Injection
		 */
		
		// //SQL Injection examples:     aadf');  TRUNCATE Review; --
		// //INSERT INTO Review (FullName, Contents) VALUES ('not important','aadf');  TRUNCATE Review; --');
		
		// $statement = "INSERT INTO Review (FullName, Contents) VALUES ('" . $fullName . "','" . $contents . "')";
		// $handle = $cxn->prepare($statement);
		// $handle->execute();
		
		
		/*
		 * Prepared Statement Approach
		 */
		
		$statement = "INSERT INTO Review (FullName, Contents) VALUES (:fullName, :contents)";

		//Prepared Statements protects against SQL Injection BUT is vunerable to Cross-Site-Scripting (XSS)...
		//XSS example: <script>alert('Hello there....');</script>
		//XSS example: <script>window.location = 'https://www.google.com';</script>

		$handle = $cxn->prepare($statement);
		$handle->bindParam(':fullName', $fullName);
		$handle->bindParam(':contents', $contents);
		
		// $sanitized_fullName = htmlspecialchars($fullName); //sanitize input using built-in PHP method
		// $sanitized_contents = htmlspecialchars($contents); //sanitize input using built-in PHP method
		// $handle->bindParam(':fullName', $sanitized_fullName);
		// $handle->bindParam(':contents', $sanitized_contents);
		
		
		$handle->execute();
		

		//close the connection
		$cxn = null;
	}
	catch(\PDOException $ex){
		print($ex->getMessage());
	}
}

function readReviews()
{
	try {
		$cxn = connectToDB();

		$handle = $cxn->prepare( 'SELECT * FROM Review ORDER BY ReviewID DESC' );
		$handle->execute();

		// Using the fetchAll() method might be too resource-heavy if you're selecting a truly massive amount of rows.
		// If that's the case, you can use the fetch() method and loop through each result row one by one.
		// You can also return arrays and other things instead of objects.  See the PDO documentation for details.
		$result = $handle->fetchAll( \PDO::FETCH_OBJ );

		foreach ( $result as $row ) {
			print( reviewTemplate($row) );
		}
	}
	catch(\PDOException $ex){
		print($ex->getMessage());
	}
}

function updateReview($fullName, $contents, $reviewID)
{
	try
	{
		$cxn = ConnectToDB();

		$statement = "UPDATE Review SET FullName = :fullName, Contents = :contents WHERE ReviewID = :reviewID";
		$handle = $cxn->prepare( $statement );
	
		$sanitized_fullName = htmlspecialchars($fullName);
		$sanitized_contents = htmlspecialchars($contents);
	
		$handle->bindParam(':fullName', $sanitized_fullName);
		$handle->bindParam(':contents', $sanitized_contents);
		$handle->bindParam(':reviewID', $reviewID);

		$handle->execute();

		//close the connection
		$cxn = null;
	}
	catch(\PDOException $ex){
		print($ex->getMessage());
	}
}

function deleteReview($reviewID)
{
	try
	{
		$cxn = ConnectToDB();

		$statement = "DELETE FROM Review WHERE ReviewID = :reviewID";
		$handle = $cxn->prepare( $statement );
		$handle->bindParam(':reviewID', $reviewID);
		
		$handle->execute();

		//close the connection
		$cxn = null;
	}
	catch(\PDOException $ex){
		print($ex->getMessage());
	}
}

// Utility function to provide some basic styling for a review
function reviewTemplate($row)
{
	return $template = "	
	<div>
	  <input class='reviewID' type=\"hidden\" name='reviewID' id='reviewID' value='" . $row->ReviewID . "' >
      
      <label>Full Name:</label>
      <label class='fullName'><strong>" . $row->FullName. "</strong></label>
    </div>
    <div>
      <label>Message:</label>
      <label class='message'>" . $row->Contents. "</label>
    </div>
    <div>
      <label>Created:</label>
     <label class='createdAt'></label>
    </div>
    <br>
    <a class='waves-effect waves-light btn edit'>Edit</a>
    <a href='business/handleReview.php?action=delete&reviewID=" . $row->ReviewID . "' class='waves-effect waves-light btn edit'>Delete</a>
	<br><br><br><br>";
	
}