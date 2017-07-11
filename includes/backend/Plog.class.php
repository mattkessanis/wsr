<?php
  /*
  * a class that handles all my error logging and output messages for php
  * ATTENTION! - this class requires
  *     - LOGGING_DIR constant for log destination (string)
  * to be configured elsewhere or for these values to be manually
  * passed on construction

  * this class can be used to send messages to log files or even email, noice!
  * now has a function to time execution of methods and scripts
  * i highly recommend https://www.baremetalsoft.com/baretail/ for a great
  * log monitoring program
  *
  * @author - Ben Futterleib
  * Version: 1.0
  */

  class Plog {

    // location for the log messages to be sent
    private $destination;

    // stores the variable that controls error log message type parameter
    private $messageType;

    // boolean that controls whether or not to send error messages
    private $devMode;

    // stores the user defined prefix's for error log messages
    private $prefixes = array();

    // stores the various options for exception messages
    private $exOptions = array();

    // stores the start time for a clock run
    private $timeStart;

    // stores the end time for a clock run
    private $timeEnd;

    // enables date prefixes to be set, matches standard php error message format
    private $dateOn;
    // ** ---------------------------------- Constructor ------------------------------------------ ** //

    public function __construct() {

      $this->destination = LOGGING_DIR;
      $this->devMode = true;
      $this->messageType = 3;
      $this->dateOn = true;
      $this->exOptions = array(
        "MESSAGE",
        "FILE",
        "TRACE",
      );
      $this->prefixes = array(
        "EXCEPTION" => "EXC: ",
        "STRING" => "STR: ",
        "ARRAY" => "ARR: ",
        "INTEGER" => "INT: ",
        "FLOAT" => "FLT: ",
        "BOOLEAN" => "BOO: ",
        "EMPTY" => "NUL: ",
      );
    }


    // ** ---------------------------------- Getter & Setters ------------------------------------- ** //

    /*
    * set and get the exception output filtering
    */
    public function exceptionOptions($value = null) {

      if($value === null) {

        return $this->exOptions;
      } else {

        $pieces = explode("|",$value);
        $this->exOptions = $pieces;
      }
    }


    /*
    * set and get the message destination, more info http://php.net/manual/en/function.error-log.php
    */
    public function destination($value = null) {

      if($value === null) {

        return $this->destination;
      } else {

        $this->destination = $value;
      }
    }

    /*
    * set and get the message type, more info http://php.net/manual/en/function.error-log.php
    */
    public function messageType($number = null) {

      if($number === null) {

        return $this->messageType;
      } else {

        $this->messageType = $number;
      }
    }

    /*
    * get and set dev mode, if false you'll get nuttin! if true you get everything
    */
    public function devMode($value = null) {

      if($value === null) {

        return $this->devMode;
      } else {

        $this->devMode = $value;
      }
    }

    /*
    * get and set the date prefix for messages
    */
    public function dateOn($value = null) {

      if($value === null) {

        return $this->dateOn;
      } else {

        $this->dateOn = $value;
      }
    }

    /*
    * get and set the error message prefix's used for all message types
    */
    public function prefixes($value = null) {

      if($value === null) {

        return $this->prefixes;
      } else {

        $this->prefixes = $value;
      }
    }


    // ** ----------------------- public functions for using the logger --------------------------- ** //

    public function output($message) {

      $now = "";
      if($this->dateOn) {
        $now = date('[d-M-Y H:i:s e]');
        $now .= "\n";
      }
      $output = $this->processError($message);
      if($this->devMode) {
        error_log($now.$output, $this->messageType, $this->destination);
      }
    }

    /*
    * uses a anonymous function call to execute and time any function and parameter list passed
    * to it.
    *
    * @param variable function $anonfunction - function passed to be clocked

    public function clockFunction($anonFunction, ...$args) {

      $timeStart = microtime(true);
      $anonFunction(...$args);
      $timeEnd = microtime(true);
      $time = ($timeEnd - $timeStart)*1000;
      $output = "Function executed in ".round($time,2)." ms";
      $this->output($output);
    }

    */

    /*
    * starts the clock
    */
    public function clockStart() {

      $this->timeStart = microtime(true);
    }

    /*
    * ends the clock and sends output to the log file
    */
    public function clockEnd($prefix = null) {

      $this->timeEnd = microtime(true);
      $output = "";
      if(is_string($prefix)) {
        $output .= $prefix;
      }
      $time = ($this->timeEnd - $this->timeStart)*1000;
      $output .= "script executed in ".round($time,2)." ms";
      $this->output($output);
    }

    /*
    * deletes and recreates the log file in order to refresh it
    */
    public function refresh() {
      unlink(LOGGING_DIR);
      fopen(LOGGING_DIR,"w+");
    }

    // ** ------------------------- Functions for processing message output ----------------------- ** //

    /*
    * processes the value passed according to type and calls the methods needed to format it
    *
    * @param mixed $value - a variety of data and object types
    * @return string - the final output message
    */
    private function processError($value) {

      switch($value) {

        case(null):
          return $this->prefixes["EMPTY"].gettype($value)."\n";

        case($value === true): // this code strangely is the only way to evaluate both true and false
          if($value === true) { // go figure. I dare you to replace it with is_bool and make it work :P
            $value = "true";
          } else {
            $value = "false";
          }
          return $this->prefixes["BOOLEAN"].$value."\n";

        case(is_array($value)):
          return $this->showArrayValues($this->prefixes["ARRAY"],$value);

        case(is_string($value)):
          return $this->prefixes["STRING"].$value."\n";

        case(is_int($value)):
          return $this->prefixes["INTEGER"].$value."\n";

        case(is_float($value)):
          return $this->prefixes["FLOAT"].$value."\n";

        case(is_object($value) && is_a($value, "Exception")):
          $mess = $this->getExceptionMessage($this->prefixes["EXCEPTION"], $value);
          return $mess;


      }
    }

    /*
    * gets the exception message depending on settings
    *
    * @param string $prefix - the exception message prefix
    * @param object $value - the exception object to be acted upon
    * @return string - the completed exception message
    */
    private function getExceptionMessage($prefix, $value) {

      $message = "";
      if(in_array("MESSAGE", $this->exOptions)) {
        $message .= $prefix." ".$value->getMessage()."\n";
      }
      if(in_array("FILE", $this->exOptions)) {
        $message .= $prefix." ".$value->getFile()."\n";
      }
      if(in_array("TRACE", $this->exOptions)) {
        $message .= $this->printTrace($prefix." ", $value->getTrace());
      }
      return $message;
    }

    /*
    * formats the stack trace output into a printable string
    *
    * @param string $prefix - the exception message prefix to be used
    * @param array $trace - the array containing the exception trace info
    * @return string - formatted trace output
    */
    private function printTrace($prefix, $trace) {

      $output = "";
      foreach($trace as $key => $val) {

        $output .= $prefix."\n".$prefix." ** FUNCTION CALL ".$key." **\n";

        foreach($val as $subkey => $subval) {
          $output .= $prefix."       ".$subkey." = ".$this->argumentTypes($subval)."\n";
        }
      }
      return $output;
    }

    /*
    * takes an array of parameters and returns a formatted string with their names
    *
    * @param array $args - the array of parameters to be formatted
    * @return string - the string containing the formatted result
    */
    private function argumentTypes($args) {

      $output = "";
      if(is_array($args)) {

        foreach($args as $value) {

          $output .= gettype($value).", ";
        }
      } else {
        $output = $args;
      }
      return $output;
    }

    /*
    * takes an array and formats a string to show the values and keys depending on
    * the passed values
    *
    * @param array $args - the array of parameters to be formatted
    * @return string - the string containing the formatted result
    */
    private function showArrayValues($prefix, $value) {

      $string = "";
      $string .= $prefix." Array containing\n";

      foreach($value as $key => $value) {

        $string .= $prefix."        ".$key." => ".$value."    (".gettype($value).")\n";
      }
      return $string;
    }
  }
?>
