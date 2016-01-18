<?php

  require_once "app/config.php";

  $name = "";
  $date = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = $valid->validateName($_POST["Name"]);

    if ($result === true) {
      $url = "http://" . $_SERVER['HTTP_HOST'] . "/success_create.php";
      $data = array("Name" => $_POST["Name"], "Date" => $_POST["Date"]);
      $response = $valid->validateSuccess($url, $data);
    }
  }

  if (isset($_POST["Date"])) {
    $date = htmlentities($_POST["Date"]);
  } else {
    $date = htmlentities($_GET["date"]);
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create holiday</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>

<?php
  if ($valid->validateDate(htmlentities($_GET["date"]), "Y-n-j") || ($_SERVER["REQUEST_METHOD"] == "POST" && $result !== true)) {
    ?>
    <h2 class="create-message">This day will be a holiday - <?php echo $date; ?></h2>
    <form class="holiday-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
      <p class="error-message"><?php print_r($result); ?></p>
      <input type="text" name="Name" placeholder="Name holiday" autocomplete="off" />
      <input type="hidden" name="Date" value="<?php echo $date; ?>" />
      <input type="submit" value="Save" />
    </form>
    <?php
  } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($response);
  } else {
    ?>
    <h2>Something goes wrong.<br /><a href="<?php echo 'http://' . $_SERVER['HTTP_HOST']; ?>">Home page.</a></h2>
    <?php
  }
?>

</body>
</html>
