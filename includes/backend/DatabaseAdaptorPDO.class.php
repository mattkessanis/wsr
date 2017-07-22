<?php

  /**
  * database class allowing PDO to operate through interface adaptor
  *
  * @author - Ben Futterleib
  */

  class DatabaseAdaptorPDO implements DatabaseAdaptor {

    protected $pdo;
    protected $log;

    //** --------------------------------------- class constructor -------------------------------------- **//

    /**
    * creates the database adaptor for the php PDO type
    * @param $values - the connection values used in
    *
    */
    public function __construct($values, $log) {
      $this->setConnectionInfo($values);
      $this->log = $log;
    }

    //** --------------------------------------- public methods ----------------------------------------- **//

    /**
    * creates a database PDO object and assigns it connection values and user and password, catches exception
    * if error occurs and sends it to the error log class for user notification (server admin user that is)
    *
    * @param values - the array of values containing connection values, username and password
    */
    public function setConnectionInfo($values = array()) {
      $connString = $values[0];
      $user = $values[1];
      $pass = $values[2];

      try {
        $pdo = new pdo($connString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;
      } catch (PDOException $e) {
        $this->log->output($e);
      }
    }

    /**
    * runs a sql query that is passed and binds the values already added to the bind points in the sql
    * requires the use of prepared statements to work correctly, is used for all queries that do not return
    * results hence it is a 'setter'.
    *
    * @param values - the values to be bound to the sql
    * @param sql - the sql to be run
    */
    public function setterQuery($values, $sql) {
      $statement = $this->pdo->prepare($sql);
      if($values != null) {
        foreach($values as $bindPoint => $newValue) {
          $statement->bindValue($bindPoint, $newValue);
        }
      }
      $statement->execute();
    }

    /**
    * used to check if a given value already exists in a table TODO: needs a clean up and check
    *
    * @param values - the values to be bound to the sql
    * @param sql - the sql to be run
    */
    public function checkExists($values, $sql) {
      $statement = $this->pdo->prepare($sql);
      if($values != null) {
        foreach($values as $bindPoint => $newValue) {
          $statement->bindValue($bindPoint, $newValue);
        }
      }
      $statement->execute();
      $data = $statement->fetch();
      return $data;
    }

    /**
    * counts the entries from a given table name in the current database and returns new index to be used
    * useful for primary keys that rely on unique index numbers to be assinged
    *
    * @param table - the name of the table to be counted
    */
    public function countEntries($table) {
      $count = 0;
      $sql = "SELECT * FROM $table";
      $statement = $this->pdo->prepare($sql);
      $statement->execute();
      while($row = $statement->fetch()) {
        $count = $count + 1;
      }
      return $count + 1;
    }

    /**
    * fetches a row from a table, TODO: either use this or delete
    */
    function fetchRow() {
      return $this->statement->fetch();
    }
  }

 ?>
