<?php
	// SET DEFAULT TIMEZONE (Redundant without session)
	date_default_timezone_set("Australia/Sydney");

	// DATABASE ACCESS
	define("DB_HOST", "localhost");		// Host Computer or Server
	define("DB_USER", "delegate");		// Username
	define("DB_PASS", ".@Delegate99");	// Password

	// FOR SESSION & SECURITY IMPLEMENTATION
	include $internal.'delegate.session.php';


/* 
		// create a database connection, using the constants from config/db.php (which we loaded in index.php)
		$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

		// change character set to utf8 and check it
		if (!$this->db_connection->set_charset("utf8")) {
		$this->errors[] = $this->db_connection->error;
		}

		// if no connection errors (= working database connection)
		if (!$this->db_connection->connect_errno) {

		// escape the POST stuff
		$user_name = $this->db_connection->real_escape_string($_POST['user']);
*/
	
	
	
	
?>