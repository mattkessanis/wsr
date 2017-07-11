<?php

$prefix = "";
include "../protected/config.php";

$log = Factory::createLog();

if(isset($_GET["name"])) {
  $log->output("listener reached");
  $log->output($_GET["name"]);
}



?>
