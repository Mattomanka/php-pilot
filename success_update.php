<?php

  require_once "app/config.php";

  $responce = $db->updateHoliday($_POST["ID"], $_POST["Name"], $_POST["Date"]);

?>

<h2 class="create-message">
<?php
  if ($responce) {
    echo "Holiday was successfully updated.";
  } else {
    echo "Something goes wrong. Try again later.";
  }
?>
  <br />
  <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST']; ?>">Home page.</a>
</h2>
