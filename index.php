<?php
  require_once "app/Calendar.class.php";
  $calendar = new Calendar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Holidays</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body class="home">

<header class="nav">
  <?php echo $calendar->createNavi(); ?>
</header>

<?php
  echo $calendar->show();
?>

</body>
</html>
