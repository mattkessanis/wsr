<?php
  $charTest = "/^[a-z' ]{3,20}$/i"; // name test
  $descriptionTest = "/^[0-9a-z,' :*!.]*$/i"; // tests description
  $numTest = "/^[0-9]*$/"; // Tests for age and jumps fields
  $emailTest = "/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i"; // email test

  /**
  * checks a given variable is not empty and that any values are within specified RangeException
  * @param $val - the value to be checked
  * @param $pattern - the regular expression to check the value against
  * @return - a numeric value used to activate error messages specific to type
  */
  function textCheck($val, $pattern) {
    if(empty($val)) {
      return 2;
    } else if(!preg_match($pattern, $val)) {
      return 1;
    } else {
      return 0;
    }
  }


  /**
  * used to count number of records in a table and return a number that will be used
  * as the id number of a new record being input
  * @param $pdo - the database connection object
  * @param $sql - the sql used to query the database
  * @return - the number of entries + 1, used as the id number for a new entry
  */
  function countEntries($pdo, $sql) {
    $count = 0;
    $statement = $pdo->prepare($sql);
    $statement->execute();
    while($row = $statement->fetch()) {
      $count = $count + 1;
    }
    return $count + 1;
  }

  /**
  * checks a select box has had a non default value assigned
  * @param $val - the checkbox value currently selected
  * @return - a numeric value used to activate error messages specific to type
  */
  function selectCheck($val) {
    if($val == "default") {
      return 1;
    } else {
      return 0;
    }
  }

  /**
  * used in select boxes to echo the selected attribute so the box does not CallbackFilterIterator
  * when the page reloads
  * @param $val - the currently selected value of the checkbox
  * @param $toCheck - the check box value to compare it to
  * @return - if a match is found then the selected attribute is returned, else returns empty
  */
  function echoSelect($bool, $val, $toCheck) {
    if($bool) {
      if ($val == $toCheck) {
        return " selected";
      } else {
        return "";
      }
    }
  }
  /**
  * allows a html error message to be activated during server side validation
  * @param $counter - error value used to control error messages and activation
  */
  function showError($counter) {
    if($counter > 0) {
      echo 'style=" display: block"';
    }
  }
  function errorMessage($error, $message) {
    if($error == 2) {
      echo "* Required Field *";
    } else if($error == 1) {
      echo $message;
    }
  }
  /**
  * activates a message stating whether or not the form is valid or not
  * @param $bool - the boolean value of whether or not the form is valid
  * @param $message - error message when form is not valid
  * @param $submit - the submission variable needed for the correct button value
  */
  function formValidMessage($bool, $message, $submit) {
    if($bool && isset($_POST[$submit])) {
      echo '<span name="save" style="display: block; width: 90%; margin: auto; float: none;">';
      echo $message.'</span>';
    } else if(!$bool && isset($_POST[$submit])){
      echo '<span style=" display: block; width: 90%; margin: auto; float: none;">';
      echo $message.'</span>';
    }
  }


  /**
  * checks the files array for file upload errors
  */
  function checkFileUploadError() {
    foreach($_FILES["error'"] as $fileKey => $fileArray) {
      if($fileArray["size"] > MAX_FILE_SIZE) {
        $message = "File upload error";
        return $message;
      }
    }
  }
  /**
  * moves the uploaded file to the correct directory
  */
  function moveFile() {
    $fileToMove = $_FILES["member-photo"]["tmp_name"];
    $file = $_FILES['member-photo']['name'];
    $destination = MEMBER_PHOTO_LOCATION."/$file";
    $errorCode = $_FILES["member-photo"]["error"];
    $size = $_FILES["member-photo"]["size"];
    $name = $_FILES["member-photo"]["name"];

    if(!move_uploaded_file($fileToMove, $destination)) {
      die("<br>Cannot move file<br>upload code = ".$errorCode."<br>name = ".$name."<br>size = ".$size
      ."<br>destination = ".$destination."<br>file = ".$fileToMove);
    } else {
      unset($_FILES["member-photo"]);
    }

  }

  /**
  * makes the current page highlighted on nav bar if a main or sub menu option is active
  */

  function isActive() {
    $parts = explode("/", $_SERVER["PHP_SELF"]);
    $page = $parts[2];
    $subHeader = func_get_args();

    foreach($subHeader as $url) {
      if($url === $page) {
        echo 'active';
      }
    }
  }

?>
