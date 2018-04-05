<?php

define("DB_SERVER", "localhost");
define("DB_USER", "dbuser");
define("DB_PASS", "1234");
define("DB_NAME", "ReviewDB");


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
		//$statement = "INSERT INTO Review (FullName, Contents) VALUES ('" . $fullName . "','" . $contents . "')";

		/*
		 * Prepared Statement Approach
		 */
		$statement = "INSERT INTO Review (FullName, Contents) VALUES (:fullName, :contents)";

		$handle = $cxn->prepare($statement);
		$handle->bindParam(':fullName', $fullName);
		$handle->bindParam(':contents', $contents);
		$handle->execute();


		/*
		 * Stored Procedure Approach
		 *
		//Stored Procedure
		$statement = "CALL proc_create_review('$fullName', '$contents')";

		$handle = $cxn->prepare($statement);
		$handle->execute();
		*/


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

		$statement = "UPDATE Review SET FullName = '" . $fullName  . "', Contents = '" . $contents . "' WHERE ReviewID = " . $reviewID;
		$handle = $cxn->prepare( $statement );
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

		$statement = "DELETE FROM Review WHERE ReviewID = " . $reviewID;
		$handle = $cxn->prepare( $statement );
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
    <a href='all_in_one.php?action=delete&reviewID=" . $row->ReviewID . "' class='waves-effect waves-light btn edit'>Delete</a>
	<br><br><br><br>";
	
}

?>


<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP MySQL Database CRUD example</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  
    <style>
    .headerImg
    {    
            display: block;
            margin-left: auto;
            margin-right: auto 
    }

    h4 
    {
            text-align: center;
            font-weight: bold;
    }

    </style>



    
</head>


<body>
  <div class='container'>
    <div class='header'>
      <img class="headerImg" src="includes/images/phpmysql.png" width="25%" alt="">
      <h4>Database CRUD example</h4>
    </div>
    <br/>
    <form id="reviewForm" method="POST" action="all_in_one.php?action=create">
      <input type="hidden" id='reviewID' name="reviewID" value="">
      <div class="input-field">
        <label for="fullName">Full Name</label>
        <input type="text" id='fullName' name="fullName"/>
      </div>
      <br/>
      <div class="input-field">
        <label for="message">Review Contents</label>
        <textarea class="materialize-textarea" name="message" id='message'></textarea>
      </div>
      <br/>
      <br/>
      <button class="waves-effect waves-light btn" type='submit'>Add / Update Review</button>
    </form>
    <br>
    <br>
    <br>
      <ul id='reviews'>
           <?php readReviews(); ?>
      </ul>
  </div>
  
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

</body>

<script>    
        reviews.addEventListener("click", e =>
        {
            updateReviewHelper(e);
        });

        function updateReviewHelper(e) {
            var reviewForm = document.getElementById("reviewForm");
            var fullName = document.getElementById("fullName");
            var message = document.getElementById("message");
            var reviewID = document.getElementById("reviewID");
            var reviewNode = e.target.parentNode;

            if (e.target.classList.contains("edit")) {
                fullName.value = reviewNode.querySelector(".fullName").innerText;
                message.value = reviewNode.querySelector(".message").innerText;
                reviewID.value = reviewNode.querySelector(".reviewID").value;

                Materialize.updateTextFields();
                reviewForm.action = "all_in_one.php?action=edit";
            }
        }

        // Utility method to clear the form
        function clearForm() {
            fullName.value = "";
            message.value = "";
            hiddenId.value = "";
        }
    
    </script>


</html>

<?php
if (isset($_GET["action"]))
{
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
    header( "Location: " . "all_in_one.php" );
}
?>