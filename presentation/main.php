<?php require( __DIR__ . "/../persistence/reviewDAO.php" ); ?>

<!doctype html>
<html>
<?php require( __DIR__ . "/header.php"); ?>

<body>
  <div class='container'>
    <div class='header'>
      <img class="headerImg" src="includes/images/phpmysql.png" width="25%" alt="">
      <h4>Database CRUD example</h4>
    </div>
    <br/>
    <form id="reviewForm" method="POST" action="business/handleReview.php?action=create">
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

  <script type="text/javascript" src="includes/js/app.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

</body>

</html>