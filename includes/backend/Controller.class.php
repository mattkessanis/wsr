<?php

  /**
  * Controller class for handling all control operations, TODO: either use this or delete
  */

  class Controller {

    public static $formMessage;

    public static function checkCredentials($username, $password) {

      // sql statement and database object creation
      $sql = "SELECT memberID, email, password FROM Member";
      $adaptor = Factory::createConnection();
      $adaptor->runQuery($sql);

      while($row = $adaptor->fetchRow()) {
        //TODO - add hash function for passwords
        if($username == $row["email"] && $password == $row["password"]) {

          $_SESSION["user"] = $row["memberID"];
          $_SESSION["logged_in"] = true;
          $formMessage = "Logging in";
          header("location: site-manager.php");

        } else if ($username == $row["email"] && $hashed != $row["password"]) {
          Controller::$formMessage = "Incorrect Password";
        } else {
          Controller::$formMessage = "Invalid Login";
        }
      }
    }
  }

 ?>
