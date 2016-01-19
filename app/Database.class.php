<?php

class Database {

  private $db;
  protected $db_name = "u960544755_main";
  protected $db_user = "u960544755_admin";
  protected $db_pass = "010110a";
  protected $db_host = "mysql.hostinger.com.ua";


  // Constructor - open DB connection
  function __construct() {
    $this->db = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
    $this->db->autocommit(FALSE);
  }

  // Destructor - close DB connection
  function __destruct() {
    $this->db->close();
  }


  public function getHolidayByID($id) {
    return $this->_select("holidays", "ID = " . $id);
  }


  public function getHolidaysInMonth($year, $month, $lastDay) {
    return $this->_select("holidays", "Date BETWEEN '$year-$month-01' AND '$year-$month-$lastDay'");
  }


  public function insertHoliday($date, $name) {
    return $this->_insert("holidays", array("Name" => "'" . $name . "'", "Date" => "'" . $date . "'"));
  }


  public function updateHoliday($id, $name, $date) {
    return $this->_update("holidays", array("Name" => "'" . $name . "'", "Date" => "'" . $date . "'"), "ID=" . $id);
  }


  public function deleteHoliday($id) {
    return $this->_delete("holidays", "ID=" . $id);
  }


  private function _select($table, $where) {
    $resultArray = array();

    $sql = "SELECT * FROM $table WHERE $where";
    $result = $this->db->query($sql);

    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      array_push($resultArray, $row);
    }
    $result->close();

    return $resultArray;
  }


  private function _update($table, $data, $where) {
    $sequence = "";
    foreach ($data as $column => $value) {
      $sequence .= ($sequence == "") ? "" : ", ";
      $sequence .= $column . "=" . $value . "";
    }
    $sql = "UPDATE $table SET $sequence WHERE $where";
    $result = $this->db->query($sql);
    return $result;
  }


  private function _insert($table, $data) {
    $columns = "";
    $values = "";
    foreach ($data as $column => $value) {
      $columns .= ($columns == "") ? "" : ", ";
      $columns .= $column;
      $values .= ($values == "") ? "" : ", ";
      $values .= $value;
    }

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    $result = $this->db->query($sql);
    return $result;
  }


  private function _delete($table, $where) {

    $sql = "DELETE FROM $table WHERE $where";
    print_r($sql);
    $result = $this->db->query($sql);
    return $result;
  }
}

?>
