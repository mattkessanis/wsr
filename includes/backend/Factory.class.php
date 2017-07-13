<?php

  /**
  * factory class for creating and returning references to helpers class interfaces
  */


  class Factory {

    private static $connectionValues = array(DBCONNSTRING, DBUSER, DBPASS);

    public static function createConnection() {

      $adaptor = "DatabaseAdaptor". DATABASE_TYPE;

      if (class_exists($adaptor)) {
        $log = Factory::createLog();
        $log->output("database created");
        return new $adaptor(Factory::$connectionValues);
      }
    }

    public static function createValidator() {
      $log = new Plog();
      return new Validator($log);
    }

    public static function createLog() {
      return new Plog();
    }

  }

 ?>
