<?
    require_once 'app/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <title>Holidays</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>

<?php

print_r($db->select("holidays", "1"));
echo "<br />";
$db->insert(array("Name" => "'New Year Party'", "Date" => "'2015-12-29'"), "holidays");
echo "<br />";
$result = $db->update(array("Name" => "'Bithday Party'", "Date" => "'2015-09-01'"), "holidays", "Name='First'");

?>
</body>
</html>
