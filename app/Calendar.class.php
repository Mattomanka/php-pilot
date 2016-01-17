<?php

class Calendar {

  private $weekDaysArray = array("Mon", "Tue", "Wed", "Thur", "Fri", "Sat", "Sun");
  private $monthArray = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" );


  private $currentYear=0;
  private $currentMonth=0;
  private $currentDay=0;
  private $currentDate=null;
  private $daysInMonth=0;
  private $naviHref= null;


  // Constructor
  function __construct() {
    $this->naviHref = htmlentities($_SERVER["PHP_SELF"]);
  }

  private function init() {
    $year  == null;

    if (isset($_GET["year"])) {
      $year = $_GET["year"];
    } else {
      $year = date("Y");
    }

    $this->currentYear=$year;

    //$this->daysInMonth=$this->_daysInMonth($month,$year);
  }

  public function show() {
    $this->init();
    echo "<div class='box'>" . $this->_createNavi() . "</div>";

    foreach ($this->monthArray as $i => $i_val) {
      echo "<div class='hp-month'>\n";
        echo "<table class='month-table'>\n";
          echo "<tr>\n<th class='month-name' colspan='7'>" . $i_val . "</th>\n</tr>\n";
          echo $this->_showWeekDays();

            echo $this->_showDays($i+1);

        echo "</table>";
      echo "</div>";
    }

  }


  private function _showDays($month=null) {
    $day = 1;
    $allDays = "";
    $firstDay = date("w",mktime(0,1,0,$month,1,$this->currentYear));
    $daysInMonth = date("t",mktime(0,1,0,$month,1,$this->currentYear));
    $weeksInMonth = $this->_weeksInMonth($month);

    for($row = 1; $row <= $weeksInMonth; $row++) {

      if($row == 1){

        $allDays .= "<tr>\n";

        for($cell = 1; $cell <= 7; $cell++) {

          if (($cell == 7 && $firstDay == 0) || $cell == $firstDay || $day > 1) {

            $allDays .= "<td";

            if ($cell == 6 || $cell == 7) {
              $allDays .= " class='usual-holiday'";
            }
            $allDays .= ">" . $day . "</td>\n";
            $day++;
          } else {
            $allDays .= "<td";
            if ($cell == 6 || $cell == 7) {
              $allDays .= " class='usual-holiday'";
            }
            $allDays .= ">&nbsp;</td>\n";
          }
        }
        $allDays .= "</tr>\n";
      } else {
        $allDays .= "<tr>\n";
        for($cell = 1; $cell <= 7; $cell++) {
          if($day > $daysInMonth){
            $allDays .= "<td";
            if ($cell == 6 || $cell == 7) {
              $allDays .= " class='usual-holiday'";
            }
            $allDays .= ">&nbsp;</td>\n";
          } else {
            $allDays .= "<td";
            if ($cell == 6 || $cell == 7) {
              $allDays .= " class='usual-holiday'";
            }
            $allDays .= ">" . $day . "</td>\n";
            $day++;
          }
        }
        $allDays .= "</tr>\n";
      }
    }

    return $allDays;
  }

  /**
  * create navigation
  */
  private function _createNavi(){
    $year = date('Y', mktime(0,0,0,2,1,$this->currentYear));
    return
      '<div class="header">' .
        '<a class="prev" href="' . $this->naviHref . '?year=' . ($this->currentYear-1) . '">Prev</a>' .
          '<span class="title">' . $year . '</span>' .
        '<a class="next" href="' . $this->naviHref . '?year='. ($this->currentYear+1) . '">Next</a>' .
      '</div>';
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


  private function _weeksInMonth($month=null) {
    $month = date("n", mktime(0, 0, 0, $month, 1, $this->currentYear));
    $firstDay = mktime(0,1,0,$month,1,$this->currentYear);
    $daysInMonth = date("t",$firstDay);
    $firstDay = date("w",$firstDay);

    $totalCells = $firstDay + $daysInMonth;
    if($totalCells < 37){
      $rowCount = 5;
    } else {
      $rowCount = 6;
    }

    return $rowCount;
  }

}
