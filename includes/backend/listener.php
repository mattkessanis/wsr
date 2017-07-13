<?php
$prefix = "";

include "../protected/config.php";
include "FilterControl.php";

$log = Factory::createLog();
$val = Factory::createValidator();

// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $database = Factory::createConnection();

  $form = $_POST["form"];
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $message = $_POST["message"];
  $table = "";

  // Log output for testing form inputs
  $log->output("*************************************************\n\n\n\n\n\n\n\n\n\n");
  $log->output($_POST);
  $log->output($form." form recieved : ".$name." ".$email." ".$phone." ".$message);

  // Retrieve rules from filter control and set them in the validator
  $val->filterRules(FilterControl::memberFilters());
  $val->validationRules(FilterControl::memberValidators());

  // Sanitise data and check resulting data
  $data = $val->filter($_POST);
  $log->output($data);

  //Create sql
  switch($form) {

    case "team":
      $id = $database->countEntries("Member");
      $sql = "INSERT INTO Member (ID,name,email,phone,description)VALUES ($id,:name,:email,:phone,:message)";
      break;

    case "eng":
      $id = $database->countEntries("Member");
      $sql = "INSERT INTO Member (ID,name,email,phone,description)VALUES ($id,:name,:email,:phone,:message)";
      break;

    case "general":
      $id = $database->countEntries("Contact");
      $sql = "INSERT INTO Contact (ID,name,email,phone,message)VALUES ($id,:name,:email,:phone,:message)";
      break;

    case "sponser":
      $sql = "INSERT INTO Contact (ID,name,email,phone,message)VALUES ($id,:name,:email,:phone,:message)";
      break;
  }
  $bindValues = array(':name' => $name,
                      ':email' => $email,
                      ':phone' => $phone,
                      ':message' => $message);

  $database->addValues($bindValues);
  $database->runQuery($sql);


  if($val->run($data)) {

    http_response_code(200);
    echo "Thanks for your application!";
  } else {

    http_response_code(400);
    echo $val->message();
  }
}
?>
