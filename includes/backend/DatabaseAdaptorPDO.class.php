<?php


  /**
  * database class allowing PDO to operate through interface adaptor
  *
  * @author - Ben Futterleib
  */

  class DatabaseAdaptorPDO implements DatabaseAdaptor {

    protected $pdo;
    protected $statement;
    protected $values = null;

    public function __construct($values) {
      $this->setConnectionInfo($values);
    }

    public function setConnectionInfo($values = array()) {
      $connString = $values[0];
      $user = $values[1];
      $pass = $values[2];

      try {
        $pdo = new pdo($connString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
      } catch (PDOException $e) {
        $err = Plog::getInstance();
        $err->output($e);
      }
    }

    public function runQuery($sql) {
      $this->statement = $this->pdo->prepare($sql);
      if($this->values != null) {
        $counter = 0;
        foreach($this->values as $bindPoint => $newValue) {
          $this->statement->bindValue($bindPoint, $newValue);
        }
      }
      $this->statement->execute();
    }

    public function countEntries($table) {
      $count = 0;
      $sql = "SELECT * FROM $table";
      $statement = $pdo->prepare($sql);
      $statement->execute();
      while($row = $statement->fetch()) {
        $count = $count + 1;
      }
      return $count + 1;
    }

    function addValues($vals) {
      $this->values = $vals;
    }

    function fetchRow() {
      return $this->statement->fetch();
    }
  }

 ?>
