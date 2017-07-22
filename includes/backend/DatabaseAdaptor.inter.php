<?php

  /**
  * database interface allowing access to relevant database class without the fuss
  *
  * @author - Ben Futterleib
  */


  interface DatabaseAdaptor {

    function setterQuery($values, $sql);

    function checkExists($values, $sql);

    function setConnectionInfo($values = array());

    function fetchRow();

    function countEntries($table);
  }
 ?>
