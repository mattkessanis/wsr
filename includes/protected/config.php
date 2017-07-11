<?php

  // ------------------------------------ database connection information -----------------------------


  define('DBCONNSTRING', 'mysql:host=localhost;dbname=WSR');
  define('DBUSER', 'Ben');
  define('DBPASS', '.Hudeg9m5');
  define('TYPE', 'PDO');


  // -------------------------------------- Define max file size --------------------------------------

  define('MAX_FILE_SIZE', '10000000');


  // ------------------------------------------  constants --------------------------------------------

  define('LOGGING_DIR', '/var/www/errors.log');
  define('DATABASE_TYPE', 'PDO');


  // link constants



  // ---------------------------------------- cache control -------------------------------------------

  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Cache-Control: no-cache");
  header("Pragma: no-cache");


  // ------------------------------------- Mandatory requires -----------------------------------------

  require_once $prefix."Plog.class.php";
  require_once $prefix."Controller.class.php";
  require_once $prefix."functions.script.php";
  require_once $prefix."Validator.class.php";
  require_once $prefix."Factory.class.php";
  require_once $prefix."DatabaseAdaptor.inter.php";
  require_once $prefix."DatabaseAdaptorPDO.class.php";

 ?>
