<!doctype html>
<html>
<?php require("header.php"); ?>

<body>
  <div class='container'>
    <div class='header'>
      <img class="headerImg" src="<?php echo BASE_URL ?>/assets/img/phpmysql.png" width="25%" alt="">
      <h4>Database CRUD example</h4>
    </div>

    <br />
    <form id="reviewForm" method="POST" action="<?php echo BASE_URL ?>/controllers/ReviewController.php?action=create">
      <input type="hidden" id='reviewID' name="reviewID" value="">
      <div class="input-field">
        <label for="fullName">Full Name</label>
        <input type="text" id='fullName' name="fullName" />
      </div>
      <br />
      <div class="input-field">
        <label for="message">Review Contents</label>
        <textarea class="materialize-textarea" name="message" id='message'></textarea>
      </div>
      <br />
      <br />
      <button class="waves-effect waves-light btn" type='submit'>Add / Update Review</button>
    </form>
    <br>
    <br>
    <br>
    <ul id='reviews'>
      <?php (new models\ReviewModel)->readReviews(); ?>
    </ul>
  </div>

  <?php require("footer.php"); ?>

</body>

</html>