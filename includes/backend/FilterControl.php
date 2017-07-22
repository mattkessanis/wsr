<?php
  /**
  * Class: FilterControl
  * Stores and allows access to all the filter / validation rules used in the program
  *
  * @author - Ben Futterleib
  */

  class FilterControl {

    //** -----------------------------------------   Member rules --------------------------------------- **//

    private static $memberFilters = array(
      "name" => "trim|sanitize_string",
      "email" => "trim|sanitize_email",
      "phone" => "trim",
      "message" => "trim|sanitize_string",
    );
    private static $memberValidation = array(
      "name" => "required|valid_name|min_3|max_30",
      "email" => "required|valid_email|max_60",
      "phone" => "required|valid_numeric|min_9",
      "message" => "required|valid_text|min_3|max_300",
    );

    //** ----------------------------------------- Getter functions ------------------------------------- **//


    /*
    * returns the member filter options
    */
    public static function memberFilters() {
      return FilterControl::$memberFilters;
    }

    /*
    * returns the member validation options
    */
    public static function memberValidators() {
      return FilterControl::$memberValidation;
    }
  }
?>
