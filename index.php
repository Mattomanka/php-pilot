<?
  require_once "app/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <base href="/">
  <meta charset="UTF-8">
  <title>Holidays</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>

<?php
/*
print_r($db->select("holidays", "1"));
echo "<br />";
$db->insert(array("Name" => "'New Year Party'", "Date" => "'2015-12-29'"), "holidays");
echo "<br />";
$result = $db->update(array("Name" => "'Bithday Party'", "Date" => "'2015-09-01'"), "holidays", "Name='First'");
*/
?>

<?php
/*
$year = date("Y");

print_r($year);
echo "<br />";

$monthArray = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" );
$weekDaysArray = array("Mon", "Tue", "Wed", "Thur", "Fri", "Sat", "Sun");

foreach ($monthArray as $i => $value) {
  echo "<div class='hp-month'>\n";
    echo "<table class='month-table'>\n";
      echo "<tr>\n<th class='month-name' colspan='7'>" . $monthArray[$i] . "</th>\n</tr>\n";
      echo "<tr>\n";
      foreach ($weekDaysArray as $j => $value) {
        echo "<th class='hp-day'>" . $weekDaysArray[$j] . "</th>\n";
      }
      echo "</tr>\n";

        $month = date("n", mktime(0, 0, 0, $i+1, 1, $year));
        $firstDay = mktime(0,1,0,$month,1,$year);
        $daysInMonth = date("t",$firstDay);
        $firstDay = date("w",$firstDay);
        $firstDayName = date("l",mktime(0,1,0,$month,1,$year));

        $totalCells = $firstDay + $daysInMonth;
        if($totalCells < 36){
          $rowCount = 5;
        } else {
          $rowCount = 6;
        }

        $day = 1;

        for($row = 1; $row <= $rowCount; $row++){
          if($row == 1){
            echo "<tr>\n";
            for($cell = 1; $cell <= 7; $cell++){
              if($cell == $firstDay || $day > 1){
                echo "<td>" . $day . "</td>\n";
                $day++;
              } else {
                echo "<td>&nbsp;</td>\n";
              }
            }
            echo "</tr>\n";
          } else {
            echo "<tr>\n";
            for($cell = 0; $cell < 7; $cell++){
              if($day > $daysInMonth){
                echo "<td>&nbsp;</td>\n";
              } else {
                echo "<td>" . $day . "</td>\n";
                $day++;
              }
            }
            echo "</tr>\n";
          }
        }


    echo "</table>";
  echo "</div>";
}
*/
?>

<?php
  $calendar->show();
?>

</body>
</html>
