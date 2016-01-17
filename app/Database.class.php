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

  public function select($table, $where) {
    $resultArray = array();

    $sql = "SELECT * FROM $table WHERE $where";
    print_r($sql);
    $result = $this->db->query($sql);

    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
      array_push($resultArray, $row);
    }
    $result->close();

    return $resultArray;
  }

  public function update($data, $table, $where) {
    $sequence = "";
    foreach ($data as $column => $value) {
      $sequence .= ($sequence == "") ? "" : ", ";
      $sequence .= $column . "=" . $value . "";
    }
    $sql = "UPDATE $table SET $sequence WHERE $where";
    print_r($sql);
    $result = $this->db->query($sql);
  }

  public function insert($data, $table) {
    $columns = "";
    $values = "";
    foreach ($data as $column => $value) {
      $columns .= ($columns == "") ? "" : ", ";
      $columns .= $column;
      $values .= ($values == "") ? "" : ", ";
      $values .= $value;
    }

    $sql = "insert into $table ($columns) values ($values)";
    print_r($sql);
    $result = $this->db->query($sql);
  }
}

?>
