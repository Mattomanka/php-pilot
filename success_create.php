<?php

  require_once "app/config.php";

  $responce = $db->insertHoliday($_POST["Date"], $_POST["Name"]);

?>

<h2 class="create-message">
<?php
  if ($responce) {
    echo "Holiday was successfully saved.";
  } else {
    echo "Something goes wrong. Try again later.";
  }
?>
  <br />
  <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST']; ?>">Home page.</a>
</h2>
