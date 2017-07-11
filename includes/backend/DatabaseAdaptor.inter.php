<?php

  /**
  * database interface allowing access to relevant database class without the fuss
  *
  * @author - Ben Futterleib
  */

 
  interface DatabaseAdaptor {

    function runQuery($sql);

    function addValues($values);

    function setConnectionInfo($values = array());

    function fetchRow();

    function countEntries($table);
  }
 ?>
