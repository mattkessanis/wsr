<?php
$prefix = "";

include "../protected/config.php";
include "FilterControl.php";

$log = Factory::createLog();
$val = Factory::createValidator();

// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $form = $_POST["form"];

  switch($form) {

    case "team":

      break;

    case "eng":


      break;
  }

  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $message = $_POST["message"];


  $log->output("*************************************************\n\n\n\n\n\n\n\n\n\n");
  $log->output($_POST);
  $log->output($form." form recieved : ".$name." ".$email." ".$phone." ".$message);

  // Retrieve rules from filter control and set them in the validator
  $val->filterRules(FilterControl::memberFilters());
  $val->validationRules(FilterControl::memberValidators());


  // Sanitise data and check resulting data
  $data = $val->filter($_POST);

  $log->output($data);

  if($val->run($data)) {

    http_response_code(200);
    echo "Thanks for your application!";
  } else {

    http_response_code(400);
    echo $val->message();
  }
}
?>
