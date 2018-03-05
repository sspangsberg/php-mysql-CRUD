<?php require( "reviewDAO.php" ); ?>

<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP MySQL Database CRUD example</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link rel="stylesheet" href="includes/css/main.css">
</head>

<body>
  <div class='container'>
    <div class='header'>
      <img class="headerImg" src="includes/images/phpmysql.png" width="50%" alt="">
      <h4>Database CRUD example</h4>
    </div>
    <br/>
    <form id="reviewForm" method="POST" action="handleReview.php?action=create">
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
    <ul id='reviews'><?php readReviews(); ?></ul>
  </div>

  <script type="text/javascript" src="includes/js/app.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

</body>

</html>