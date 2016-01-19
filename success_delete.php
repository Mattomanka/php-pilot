<?php

  require_once "app/config.php";

  print_r($_POST["ID"]);
  $responce = $db->deleteHoliday($_POST["ID"]);

?>

<h2 class="create-message">
<?php
  if ($responce) {
    echo "Holiday was successfully deleted.";
  } else {
    echo "Something goes wrong. Try again later.";
  }
?>
  <br />
  <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST']; ?>">Home page.</a>
</h2>
