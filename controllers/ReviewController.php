<?php

include "../bootstrap.php";

use models\ReviewModel;

$reviewModel = new ReviewModel();

$action = $_GET["action"];

if ($action == "create")
{
	$fullName = $_POST["fullName"];
	$contents = $_POST["message"];
	$reviewModel->createReview( $fullName, $contents );
}
else if ($action == "edit")
{
	$fullName = $_POST["fullName"];
	$contents = $_POST["message"];
	$reviewID = $_POST["reviewID"];
	$reviewModel->updateReview($fullName, $contents, $reviewID);
}

else if ($action == "delete")
{
	$reviewID = $_GET["reviewID"];
	$reviewModel->deleteReview($reviewID);
}
header( "Location: " . "../index.php" );