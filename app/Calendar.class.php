<?php

require_once "Database.class.php";

class Calendar {

  private $weekDaysArray = array("Mon", "Tue", "Wed", "Thur", "Fri", "Sat", "Sun");
  private $monthArray = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" );


  private $currentYear = 0;
  private $currentMonth = 0;
  private $currentDay = 0;
  private $currentDate = null;
  private $daysInMonth = 0;
  private $holidaysArray = array();
  private $naviHref = null;


  // Constructor - check year selection
  function __construct() {
    $this->naviHref = htmlentities($_SERVER["PHP_SELF"]);
    $this->_init();
  }

  private function _init() {
    $year  == null;

    if (isset($_GET["year"])) {
      $year = $_GET["year"];
    } else {
      $year = date("Y");
    }

    $this->currentYear=$year;
  }


  public function show() {
    $showCal = "";

    foreach ($this->monthArray as $i => $i_val) {
      $showCal .= "<div class='hp-month'>\n";
        $showCal .= "<table class='month-table'>\n";
          $showCal .= "<tr>\n<th class='month-name' colspan='7'>" . $i_val . "</th>\n</tr>\n";
          $showCal .= $this->_showWeekDays();

            $showCal .= $this->_showDays($i+1);

        $showCal .= "</table>\n";
      $showCal .= "</div>\n";
    }

    return $showCal;
  }


  public function createNavi(){
    $year = date('Y', mktime(0,0,0,2,1,$this->currentYear));
    return
      "<a class='prev' href='" . $this->naviHref . "?year=" . ($this->currentYear-1) . "'><</a>\n" .
        "<span class='title'>" . $year . "</span>\n" .
      "<a class='next' href='" . $this->naviHref . "?year=" . ($this->currentYear+1) . "'>></a>\n";
  }


  private function _showDays($month) {    $allDays = "";
    $firstDay = date("w",mktime(0,1,0,$month,1,$this->currentYear));
    $daysInMonth = date("t",mktime(0,1,0,$month,1,$this->currentYear));
    $weeksInMonth = $this->_weeksInMonth($month);

    $db = new Database();
    $this->holidaysArray = $db->getHolidaysInMonth($this->currentYear, $month, $daysInMonth);

    $day = 1;

    for($row = 1; $row <= $weeksInMonth; $row++) {
      if($row == 1){
        $allDays .= "<tr>\n";
        for($cell = 1; $cell <= 7; $cell++) {
          if (($cell == 7 && $firstDay == 0) || $cell == $firstDay || $day > 1) {
            $allDays .= $this->_fillDayCell($day,$cell,$month);
            $day++;
          } else {
            $allDays .= $this->_fillDayCell(0,$cell,$month);
          }
        }
        $allDays .= "</tr>\n";
      } else {
        $allDays .= "<tr>\n";
        for($cell = 1; $cell <= 7; $cell++) {
          if($day > $daysInMonth){
            $allDays .= $this->_fillDayCell(0,$cell,$month);
          } else {
            $allDays .= $this->_fillDayCell($day,$cell,$month);
            $day++;
          }
        }
        $allDays .= "</tr>\n";
      }
    }

    return $allDays;
  }


  private function _fillDayCell($day,$cell,$month) {
    $dayCell = "";
    $holiday = "";
    $id = 0;

    $dayCell .= "<td class='";

    if (!$day) {

      if ($cell == 6 || $cell == 7) {
        $dayCell .= "usual-holiday ";
      }
      $dayCell .= "'>&nbsp;";

    } else {

      if ($cell == 6 || $cell == 7) {
        $dayCell .= "usual-holiday ";
      }
      foreach ($this->holidaysArray as $key => $value) {
        if (date('j', strtotime($value[Date])) == $day) {
          $dayCell .= "special-holiday ";
          $holiday = $value[Name];
          $id = $value[ID];
          break;
        }
      }
      $dayCell .= "'>\n";
      if (!empty($holiday)) {
        $dayCell .= "<a class='day-link' href='single.php?id=" . $id . "'>" . $day . "</a>";
        $dayCell .= "<div class='holiday-detail'>" . $holiday . "</div>\n";
      } else {
        $dayData = $this->currentYear . "-" . $month . "-" . $day;
        $dayCell .= "<a class='day-link' href='create.php?date=" . $dayData . "'>" . $day . "</a>";
      }

    }

    $dayCell .= "</td>\n";

    return $dayCell;
  }


  private function _showWeekDays(){
    $weekDays = "";
    $weekDays .= "<tr>\n";
    foreach ($this->weekDaysArray as $i => $val) {
    $weekDays .= "<th class='hp-day'>" . $val . "</th>\n";
    }
    $weekDays .= "</tr>\n";

    return $weekDays;
  }


  private function _weeksInMonth($month) {
    $month = date("n", mktime(0, 0, 0, $month, 1, $this->currentYear));
    $firstDay = mktime(0,1,0,$month,1,$this->currentYear);
    $daysInMonth = date("t",$firstDay);
    $firstDay = date("w",$firstDay);
    if ($firstDay > 0) {
      $totalCells = $firstDay + $daysInMonth;
    } else {
      $totalCells = $daysInMonth + 6;
    }
    if($totalCells <= 36){
      $rowCount = 5;
    } else {
      $rowCount = 6;
    }

    return $rowCount;
  }

}
