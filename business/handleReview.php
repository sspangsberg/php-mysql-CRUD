<?php
require( __DIR__ . "/../persistence/reviewDAO.php" );

$action = $_GET["action"];

if ($action == "create")
{
	$fullName = $_POST["fullName"];
	$contents = $_POST["message"];
	createReview( $fullName, $contents );
}
else if ($action == "edit")
{
	$fullName = $_POST["fullName"];
	$contents = $_POST["message"];
	$reviewID = $_POST["reviewID"];
	updateReview($fullName, $contents, $reviewID);
}

else if ($action == "delete")
{
	$reviewID = $_GET["reviewID"];
	deleteReview($reviewID);
}
//header( "Location: " . "../index.php" );