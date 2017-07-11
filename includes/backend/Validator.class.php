<?php

  /*
  * a general purpose form validation class
  *
  * @author - Ben Futterleib
  */

  class Validator {

    // holds a php log object for error handling purposes
    private $log;

    // validation rules for execution
    private $validationRules = array();

    // filter rules for execution
    private $filterRules = array();

    // name test
    private $nameCheck = "/^[^!@#$\^%&*0-9]+$/";

    // tests description
    private $textCheck = "/^[0-9a-z,' :!.]*$/i";

    // Tests for age and jumps fields
    private $numericCheck = "/^[0-9]*$/";

    // email test
    private $emailCheck = "/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i";

    // the class error message provided once validation is completed
    private $message = "";

    // the errors counted during validation
    private $errorCount = 0;

    private $errorMessages = array(
      "required" => "Error: {field} is a required field.",
      "name" => "Error: {field} can only contain letters and commas.",
      "numeric" => "Error: {field} must only contain numbers.",
      "email" => "Error: {field} contains invalid characters.",
      "text" => "Error: {field} contains invalid characters.",
      "min" => "Error: {field} must be at least {param} characters.",
      "max" => "Error: {field} must be less than {param} characters.",
      "exact" => "Error: {field} must be exactly {param} characters.",
    );

    // ** ----------------------------------- Constructor ---------------------------------------- ** //

    /*
    * constructor for validator class
    *
    * @param object $log - an instance of the php logger class (Plog)
    */
    public function __construct($log) {

      try {
        $this->log = $log;
        if(!is_object($log) && !is_a($log, "Plog")) {
          throw new Exception("Validator class needs Plog object passed to constructor");
        }
      } catch(Exception $e) {
        error_log("EXC: ".$e->getMessage()."\n", 3, LOGGING_DIR);
      }
    }


    // ** ------------------------------- getter and setters ------------------------------------ ** //

    /*
    * get and set the filter rules
    */
    public function message($message = "") {

      if(empty($message)) {

        return $this->message;
      } else {
        $this->message = $message;
      }
    }

    /*
    * get and set the filter rules
    */
    public function filterRules($rules = array()) {

      if(empty($rules)) {

        return $this->filterRules;
      } else {
        $this->filterRules = $rules;
      }
    }

    /*
    * get and set the validation rules
    */
    public function validationRules($rules = array()) {

      if(empty($rules)) {

        return $this->validationRules;
      } else {
        $this->validationRules = $rules;
      }
    }

    // ** ------------------------------- validation functions ------------------------------------ ** //

    /*
    * runs the validator class on a given array of values, performs both filter and validate
    * functions
    *
    * @param array $inputArray - array of values to be filtered and validated
    * @ return boolean - true if inputs are acceptable, false if not
    */
    public function run($inputArray) {

      $this->message = "";
      $inputArray = $this->filter($inputArray);
      return $this->validate($inputArray);
    }

    /*
    * filter the input array data according to the filtering rules already set above
    *
    * @param array $inputArray - the data to be filtered
    * @ return array - the filtered data
    */
    public function filter($inputArray) {

      $values = array_intersect_key($inputArray, $this->filterRules);

      foreach($values as $key => $val) {

        $filters = explode("|", $this->filterRules[$key]);

        foreach($filters as $filter) {

          if(function_exists($filter)) {

            $values[$key] = $filter($values[$key]);
          } else {
            $pieces = explode("_", $filter);
            $sanFilter = $pieces[1];
            $values[$key] = filter_var($values[$key], filter_id($sanFilter));
          }
        }
      }
      return $values;
    }

    /*
    * accepts an array of values and validates according to current validation rules
    * uses callback functions to cycle through relevant types. Keeps track of number of
    * errors and creates error message.
    *
    * @param array $inputArray - the array of values to be checked
    * @return boolean - true if values are acceptable, false if not
    */
    public function validate($inputArray) {

      $totalErrors = 0;
      $values = array_intersect_key($inputArray, $this->validationRules);

      foreach($values as $key => $val) {

        $functions = explode("|", $this->validationRules[$key]);
        $valueErrors = 0;

        foreach($functions as $function) {

          $func = explode("_", $function);

          if($valueErrors === 0) {
            // uses callbacks to call the functions needed
            if($func[0] === 'required') {
              $valueErrors += call_user_func("Validator::".$func[0]."Test", $key, $val);
            } else {
              $valueErrors += call_user_func("Validator::".$func[0]."Test", $key, $val, $func[1]);
            }
          }
        }
        $totalErrors += $valueErrors;
      }
      if($totalErrors === 0) {
        return true;
      } else {
        return false;
      }
    }

    // ** ----------------------------- privatelly used functions --------------------------------- ** //

    /*
    * test a given value against a reg ex pattern, uses variable variable to call correct reg ex
    *
    * @param string $key - the key used in associate array identifying the values position
    * @param mixed $value - the value to be checked against the reg ex pattern
    * @return numeric - 0 if acceptable, 1 if not
    */
    private function validTest($key, $value, $name) {

      $type = $name."Check";

      if(preg_match($this->$type, $value)) {
        return 0;
      } else {
        $this->addMessage($name, $key);
        return 1;
      }
    }

    /*
    * tests whether or not the given value is emtpy
    *
    * @param string $key - the associate key name
    * @param mixed $value - the value to be tested
    * @return numeric - 1 if empty, 0 if not
    */
    private function requiredTest($key, $value) {

      if(empty($value)) {
        $this->addMessage('required', $key);
        return 1;
      } else {
        return 0;
      }
    }

    /*
    * tests the length of a value to a given exact length
    *
    * @param string $key - the string name of the associate position in original ArrayAccess
    * @param mixed $value - the value to be tested for length
    * @param numeric $num - the length being tested form
    * @return numeric - 1 if length does not match, 0 if it does
    */
    private function exactTest($key, $value, $num) {

      if(strlen($value) != $num) {
        $this->errorCount++;
        $this->addMessage('exact', $key, $num);
        return 1;
      } else {
        return 0;
      }
    }

    /*
    * tests the length of a value to a given min length
    *
    * @param string $key - the string name of the associate position in original ArrayAccess
    * @param mixed $value - the value to be tested for length
    * @param numeric $num - the length being tested form
    * @return numeric - 1 if length is not greater than min, 0 if it does
    */
    private function minTest($key, $value, $num) {

      if(strlen($value) < $num) {
        $this->errorCount++;
        $this->addMessage('min', $key, $num);
        return 1;
      } else {
        return 0;
      }
    }

    /*
    * tests the length of a value to a given max length
    *
    * @param string $key - the string name of the associate position in original ArrayAccess
    * @param mixed $value - the value to be tested for length
    * @param numeric $num - the length being tested form
    * @return numeric - 1 if length is not less than max, 0 if it does
    */
    private function maxTest($key, $value, $num) {

      if(strlen($value) > $num) {
        $this->errorCount++;
        $this->addMessage('max', $key, $num);
        return 1;
      } else {
        return 0;
      }
    }

    /*
    * creates the final error message output used once validation is complete
    *
    * @param string $type - the type of error message being created
    * @param string $key - the associate key corresponding to this value
    * @param mixed $param - a given paramter that the value may have been tested for
    */

    private function addMessage($type, $key, $param = null) {

      $name = str_replace("-"," ",$key);
      $mess = str_replace("{field}", $name, $this->errorMessages[$type]);

      if($param !== null) {
        $mess = str_replace("{param}", $param, $mess);
      }
      if(strlen($this->message) != 0) {
        $this->message .= "\n";
      }
      $this->message .= $mess;
      $this->log->output("New message create :".$mess);
    }
  }
 ?>
