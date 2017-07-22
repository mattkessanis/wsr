<?php

/**
* Script for accepting POST data sent by the 4 different forms from the wsr site on the join and contacts page
* this script handles sql creation, form validation, database access and return http codes and messages
*
* @author - Ben Futterleib
*/

$prefix = "";

include "../protected/config.php";
include "FilterControl.php";

$log = Factory::createLog();
$val = Factory::createValidator();

//**  ----------------------------------  Only process POST reqeusts ------------------------------------ **//

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $database = Factory::createConnection();


  //** ------------------ assign form data to variables and create time stamp --------------------------- **//

  $form = $_POST["form"];
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $message = $_POST["message"];
  $date = date('Y-m-d H:i:s');
  $table = "";

  $values = array(':name' => $name,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':message' => $message,
                    ':dateCreated' => $date);


  //** -------------------------   Log output for testing form inputs  ---------------------------------- **//

  // TODO: get rid of this once complete

  $log->output("*************************************************\n\n\n\n\n\n\n\n\n\n");
  $log->output($_POST);
  $log->output($form." form recieved : ".$name." ".$email." ".$phone." ".$message);


  //** ---------------  Retrieve rules from filter control and set them in the validator ---------------- **//

  $val->filterRules(FilterControl::memberFilters());
  $val->validationRules(FilterControl::memberValidators());

  // Sanitise data and check resulting data TODO: delete this once sanitise checks are complete

  $data = $val->filter($_POST);
  $log->output($data);

  //** ------------------------------ Create sql for given form type ------------------------------------ **//
  switch($form) {

    case "team":
      $id = $database->countEntries("Member");
      $sql = "INSERT INTO Member (ID,name,email,phone,description,dateCreated)VALUES ($id,:name,:email,:phone,:message,:dateCreated)";
      $table = "Member";
      break;

    case "eng":
      $id = $database->countEntries("Member");
      $sql = "INSERT INTO Member (ID,name,email,phone,description,dateCreated)VALUES ($id,:name,:email,:phone,:message,:dateCreated)";
      $table = "Member";
      break;

    case "general":
      $id = $database->countEntries("Contact");
      $sql = "INSERT INTO Contact (ID,name,email,phone,description,dateCreated)VALUES ($id,:name,:email,:phone,:message,:dateCreated)";
      $table = "Contact";
      break;

    case "sponser":
      $sql = "INSERT INTO Contact (ID,name,email,phone,description,dateCreated)VALUES ($id,:name,:email,:phone,:message,:dateCreated)";
      $table = "Contact";
      break;
  }


  //** ------------------------------ validation and sql run script ------------------------------------ **//

  // check for existing email
  $emailCheck = array('email' => $email); // need to assign email to array for it to work with function
  $emailExists = $database->checkExists($emailCheck, "SELECT email FROM $table WHERE email = :email");
  $log->output("email returned was = ".$emailExists);

  /* now run validation checks if email is unique, set http response codes depending on outcome and echo
   messages back to user, messages and response codes are caught by the ajax controller */
  if($emailExists != null) {

    http_response_code(403);
    echo "A contact with that email already exists";

  } else if($val->run($data)) {
    $database->setterQuery($values, $sql);
    http_response_code(200);
    echo "Thanks for your application!";

  } else {

    http_response_code(400);
    echo $val->message();
  }
}
?>
