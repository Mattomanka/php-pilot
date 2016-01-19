<?php

  require_once "app/config.php";

  $errorDate = "";
  $errorName = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["DEL"])) {
    $resultName = $valid->validateName($_POST["Name"]);
    $resultDate = $valid->validateDate(htmlentities($_POST["Date"]), "Y-m-d");
    if (!$resultDate) {
      $errorDate = "Date is not valid.";
    }
    if (!$resultName) {
      $errorName = "Only letters and white space allowed.";
    }

    if ($resultDate && $resultName) {
      $url = "http://" . $_SERVER['HTTP_HOST'] . "/success_update.php";
      $data = array("ID" => $_POST["ID"], "Name" => addslashes($_POST["Name"]), "Date" => $_POST["Date"]);
      $response = $valid->validateSuccess($url, $data);
    }
  } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["DEL"])) {
    $url = "http://" . $_SERVER['HTTP_HOST'] . "/success_delete.php";
    $data = array("ID" => $_POST["ID"]);
    $response = $valid->validateSuccess($url, $data);
  }

  if (isset($_GET["id"])) {
    $id = $_GET["id"];
  } else {
    $id = $_POST["ID"];
  }
  $select = $db->getHolidayByID($id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update holiday</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
<?php
  if (isset($_GET["id"]) || ($_SERVER["REQUEST_METHOD"] == "POST" && (!$resultName || !$resultDate) && !isset($_POST["DEL"]))) {
    ?>
    <h2 class="create-message">Update information</h2>
    <form class="holiday-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
      <p class="error-message"><?php print_r($errorName); ?></p>
      <input type="text" name="Name" placeholder="Name holiday" autocomplete="off" value="<?php echo $select[0][Name]; ?>" />
      <p class="error-message"><?php print_r($errorDate); ?></p>
      <input type="date" name="Date" value="<?php echo $select[0][Date]; ?>" />
      <input type="hidden" name="ID" value="<?php echo $id; ?>" />
      <input class="submit-button" type="submit" value="Save" />
    </form>
    <form class="delete-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
      <input type="hidden" name="ID" value="<?php echo $id; ?>" />
      <input type="hidden" name="DEL" value="1" />
      <input class="delete-button" type="submit" value="Delete" />
      <a class="back-link" href="<?php echo 'http://' . $_SERVER['HTTP_HOST']; ?>">Cancel</a>
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
